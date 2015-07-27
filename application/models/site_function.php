<?php

class site_function  extends Controller  {

public $clas;
public $setName;//name
public $setId;//value
public $setFirstRow = true;


	public function __construct() {
		parent::__construct();
	}
	
	public function __get($property) {
            if (property_exists($this, $property)) {
                return $this->$property;
            }
    }
	
	
	public function images_upload( $name, $ext1 = 'image', $pth='', $exp=',' ) {
		$filess=$_FILES[$name]['name'];
		$tempss=$_FILES[$name]['tmp_name'];
		
			if($ext1=='image')
				@$ext=explode(",", img_ext );
			else if($ext1=='file')
				@$ext=explode(",", file_ext );
			else if($ext1=='all')
				@$ext=explode(",", img_ext.','.file_ext );
			else 
				die('correct function is: images_upload(filename,image/file/all);');
			
			if($ext[0]=='')
				die('image/file extention not save in db');
				
			for ($i=0; $i< count($filess); $i++) {
				if($filess[$i]!="") {
					$image=$filess[$i];
					$date_filename=substr(number_format(time() * rand(),0,'',''),0,5);	
					$attached_file=explode(".",$image);
					$total_result=count($attached_file);
					$file_extension=strtolower($attached_file[$total_result-1]);
					
					if(in_array($file_extension, $ext)) {
						
						$uv=$pth.image_folder.'/'.$FILE=$date_filename.".".$file_extension;
						$uvs[]=$FILE;
						$upload=move_uploaded_file($tempss[$i],$uv);
					}
				}
				else {
					$uvs[]='';
				}
			}
			return @implode("$exp", $uvs);
	}
	
	
	public function slugify($text) {
		$text = preg_replace('~[^\\pL\d]+~u', '-', $text);
		$text = trim($text, '-');
		$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
		$text = strtolower($text);
		$text = preg_replace('~[^-\w]+~', '', $text);
		if (empty($text))
			return 'n-a';
		return $text;
	}


	public function mailLoop( $array ) {
		foreach($array as $key => $value) {
			if($value)
			$data .= "<strong>".ucwords($key)."</strong>: &nbsp;&nbsp; ".ucwords($value)."<br />";
		}
		return $data;
	}
	
	
	public function sendMail($ids, $data = array() ) {
		
		set_time_limit(0);
		$eSetup = json_decode(stripslashes( emailConfiguration ), TRUE);
		
		if(  ( $temp = $this->db->getRecord( EMAILTEMP, '', "id IN($ids)" ) ) && ( $eSetup['status'] == 'enable' ) )  {
			
			if($data['userId']) { @$user = $this->db->getRecord( USERS, '', "userId = '".$data['userId']."' " ); }
			if($data['contactus']){ $contactus = $this->mailLoop($data['contactus']); }
			//$logo = '<a href='.site_url.'><img src='.img_path.site_logo.' /></a>';
			$logo = '<a href='.site_url.'><img src="http://s29.postimg.org/l8vguwlsn/logo.png" /></a>';
			$siteUrl = '<a href='.site_url.'>'.site_url.'</a>';
			$activation = site_url.'/activation/'.$user[0]['email'].'/'.$user[0]['password'];
			$resetpassword = site_url.'/resetPassword/'.$user[0]['email'].'/'.$user[0]['password'];
			$search = array ('{siteLogo}','{DATE}','{siteName}','{siteUrl}','{siteMail}','{userName}','{userEmail}','{userPass}','{activationLink}','{resetLink}','{contactusForm}');
			$replace=array($logo, date('d M Y'), title, $siteUrl, site_mail, ucwords($user[0]['name']),$user[0]['email'],$data['password'], $activation, $resetpassword, $contactus );
			
			$this->load->third_party('swiftmailer','swift_required.php' );
			$mailer = new Swift_Mailer(new Swift_MailTransport()); 
			//Swift_Preferences::getInstance()->setCacheType('array');
		
		
			if ( $eSetup['type'] == 'smtp' ) {
				@$transport = Swift_SmtpTransport::newInstance($eSetup['smtp'], $eSetup['port'])
				->setUsername($eSetup['username'])
				->setPassword($eSetup['password']);
				$mailer = Swift_Mailer::newInstance($transport);
			}
			//echo $body = stripslashes(str_replace($search,$replace,$temp[0]['content']));die;
			for($i=0; $i<count($temp); $i++) {
				if ( $temp[$i]['status'] == 'active' ) {
					
					$from = ($temp[$i]['type'] == 'admin') ? array( site_mail => title ) : array($temp[$i]['email'] => title );
					$to = ($temp[$i]['type'] == 'admin') ? array($temp[$i]['email']  => title ) : array($user[0]['email']  => ucwords($user[$i]['name']));
					$subject = str_replace($search,$replace,$temp[$i]['subject']);
					$body = stripslashes(str_replace($search,$replace,$temp[$i]['content']));
					
					@$message = Swift_Message::newInstance()
						->setSubject($subject) 
						->setFrom($from) 
						->setTo($to)
						->setContentType("text/html; charset=UTF-8")
						->setBody($body, 'text/html');
						@$mailer->send($message);
				}
			}
		}
	}
	
	
	public function getData($name, $id, $limit = '' ) {
	
		$d=$this->db->getQuery($this->db->runQuery("select * from ".FORM." where category_id='$id' and title='".strtolower($name)."' "));
		
		if($d['forms']=='img') {
			if($limit) {
				if($d['h']=='1'){$d['content']='';}
				$l=explode(',',$limit);
				return array(array_slice(explode('||',$d['content']), $l[0],$l[1]), explode('||',$d['content2']));
			}
			else{
				return array(explode('||',$d['content']), explode('||',$d['content2']));
			}
		}
		else if($d['forms']=='editor')
		{
				$qry=$this->db->runQuery("select img,slug from ".IMG." ");
				if(mysqli_num_rows($qry) > 0){
				while($data= $this->db->getQuery($qry))
				{
					$search[]=$data['slug'];
					$replace[]="<img src='".img_path.'/'.$data['img']."' />";
				}}
				
				$nun='';
				if($limit=='<p>')
				{
					$search[]='<p>';
					$search[]='</p>';
				}
				else
				{
					$search[]='';
				}
				$replace[]=$nun;
				$content =str_replace($search,$replace,$d['content']);
				return htmlspecialchars_decode(stripslashes($content));
		}
		else{
			return htmlspecialchars_decode(stripslashes($d['content']));
		}		
	}
	
	
	
	public function dropDown( $table, $name, $where = '' ) {
		
		$cnd = empty($where) ? '' : " where ".$where." ";
		$sName = empty($this->setName) ? 'name' : $this->setName;
		$sId = empty($this->setId) ? 'id' : $this->setId;
		$chk = $_POST[str_replace("[]",'',$name )];
		if (is_string($chk)) $chk =explode(',',$chk);
		$query = $this->db->runQuery( "SELECT * from `".$table."` ".$cnd." " );?>
        
       		<select name="<?=$name?>" id="<?=$name?>" <?=$this->clas?>   >
			<? if($this->setFirstRow == true){?><option value="">Select <?=ucwords(str_replace("[]",'',$name ))?></option><? }?>
			<? while( $row = $this->db->getQuery( $query ) ){ ?>
            <option <? if(@in_array($row[$sId], $chk))echo'selected';?> value="<?=$row[$sId]?>"><?=ucwords($row[$sName])?></option>
			<? 
			@$this->clas ='';
			@$this->setFirstRow = true;
			@$this->setId ='';
			@$load->site_function->setName = '';
			}?></select>
	<? }
	
	
	public function getCountry($input) {
		$row = $this->db->getRecord( COUNTRY, 's_name', "pk_c_code = '$input' " );
		return @$row[0]['s_name'];
	}
	
	
	public function getState($input) {
		$row = $this->db->getRecord( REGION, 's_name', "pk_i_id = '$input' " );
		return @$row[0]['s_name'];
	}
	
	
	public function getCity($input) {
		$row = $this->db->getRecord( CITY, 's_name', "pk_i_id = '$input' " );
		return @$row[0]['s_name'];
	}
	
	public function getName($input) {
		
			$row = $this->db->getRecord( USERS, 'name', "userId = '$input' " );
			return @$row[0]['name'];
	}
	
	public function masters($input) {
		
			if ( $row = $this->db->getRecord( MASTERS, 'name', "id = '$input' " ) )
				return @$row[0]['name'];
			else 
				return '-';
	}
	
	public function manufacturer($input) {
		
			$row = $this->db->getRecord( MANU, 'name', "id = '$input' " );
			return @$row[0]['name'];
	}
	
	public function parameters($input) {
		
			if( $row = $this->db->getRecord( PAR, 'name', "slug = '$input' " ) )
				return @$row[0]['name'];
			else
				return $input;
	}
	
	public function catId($input) {
		
			$row = $this->db->getRecord( CAT, 'category_title', "id = '$input' " );
			return @$row[0]['category_title'];
	}
	
	public function numPro($input) {
		
			$row = $this->db->getRecord( PRODUCT, 'COUNT(catId) as tot', "catId = '$input' AND status = 'active' " );
			return @$row[0]['tot'];
	}
	
	public function price($qty, $productId) {
			
			//echo 'qty > '.$qty; die;
			$pro= $this->db->getQuery($this->db->runQuery("Select * from ".PRODUCT." where id = '".$productId."'  ")); 
			$price = explode(',', $pro['price']);
			
			if($qty == '1')
				$ans = $price[0];
			if($qty >= '10'  && $qty <= '99')
				$ans = $price[1];
			if($qty >= '100'  && $qty <= '499')
				$ans = $price[2];
			if($qty >= '500'  && $qty <= '999')
				$ans = $price[3];
			if($qty >= '1000'  && $qty <= '2499')
				$ans = $price[4];
			if($qty >= '2500')
				$ans = $price[5];
			return $ans;
			
	}
	
	
	public function img($img, $type = 'profile', $width = '100', $height = '' ) {
		$profile = '<img src="{img}" class="img-circle" style="width="60px; height="60px;">';
		$admin = '<img src="{img}" height="'.$width.'" alt="" />';
		
		if($type == 'profile') {
			if($img == '')
				return str_replace('{img}', temp_path.'/images/profile.png', $profile );
			elseif(substr($img, 0, 4) == 'http' )
				return str_replace('{img}', $img, $profile );
			elseif( !file_exists( $baseurl.image_folder.'/'.$img ) )
				return str_replace('{img}', temp_path.'/images/profile.png', $profile );
			else
				return str_replace('{img}', img_path.$img, $profile );
		}
		elseif($type == 'admin') {
			if($img == '')
				return str_replace('{img}', temp_path.'/images/profile.png', $admin );
			elseif(substr($img, 0, 4) == 'http' )
				return str_replace('{img}', $img, $admin );
			else
				return str_replace('{img}', img_path.$img, $admin );
			
		}
	}
}
?>