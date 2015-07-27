<?php

class ecommerce  extends Controller  {

	
	public function __construct() {
			parent::__construct();
			$this->load->cls = $this;
	}
	
	public function addToCart() {
		
		$ecommerce = unserialize( ecommerce );
		
		if($_POST['chk']) {
			if($_POST['product_name']) {
			
			$query = $this->db->getQuery($this->db->runQuery( "SELECT * from `".PRODUCT."` where `partNum` = '".$this->db->clearText($_POST['product_name'])."' " ));	
			if($query) {
			
				$_POST['product_id'] = $query['id'];
				$_POST['product_price'] = $query['price'];
				$_POST['product_img'] = $query['productPhoto'];
				$_POST['product_col'] = 'nocol'.$data['id'];
			}
			else {
				redirect($ecommerce['cart']['slug'], "succ|$msg");
				}
			 } else {
				redirect($ecommerce['cart']['slug'], "succ|$msg");
				}
		}
		
		

	if($_POST[product_qty]==''){ $_POST[product_qty]='1';}
		$color = str_replace($_POST[product_id],' ',$_POST['product_col']);
		
		/*$qry=mysql_query("select * from product_stock where product_id='$_POST[product_id]' "); 
		$d1= mysql_fetch_array($qry);*/
		
		$_POST['product_col']=$_POST['product_col'].'|'.$_POST['product_siz'];
		
		
		$pd=explode(",", $_SESSION['product_id']);
		$qt=explode(",", $_SESSION['product_qty']);
		$pr=explode(",", $_SESSION['product_price']);
		$img=explode(",", $_SESSION['product_img']);
		$col=explode(",", $_SESSION['product_col']);
		$siz=explode(",", $_SESSION['product_siz']);
		
		if(!in_array($_POST['product_col'],$col)) {
			
			$_SESSION['product_id']=implode(",", array_filter(explode(",", $_SESSION['product_id'].','.$_POST[product_id])));
			
			$_SESSION['product_qty']=implode(",", array_filter(explode(",", $_SESSION['product_qty'].','.$_POST[product_qty])));
			
			$_SESSION['product_price']=implode(",", array_filter(explode(",", $_SESSION['product_price'].','.$_POST[product_price])));
			
			$_SESSION['product_img']=implode(",", array_filter(explode(",", $_SESSION['product_img'].','.$_POST[product_img])));
			
			$_SESSION['product_col']=implode(",", array_filter(explode(",", $_SESSION['product_col'].','.$_POST[product_col])));
			
			$_SESSION['product_siz']=implode(",", array_filter(explode(",", $_SESSION['product_siz'].','.$_POST[product_siz])));
		}
		else {
			$key= array_search($_POST['product_col'], $col);
			$qt[$key]=$qt[$key]+$_POST[product_qty];
			$_SESSION['product_qty']=implode(",", $qt);
		}
		$_SESSION['crt'] = $_POST['product_name'];
		
		if($_POST['no'] != '1') {
			redirect($ecommerce['cart']['slug'], "succ|$msg");
			die;
			}

	}


	public function cartDel() {
	
		$shp = $_REQUEST['ship'];
		$pd=explode(",", $_SESSION['product_id']);
		$qt=explode(",", $_SESSION['product_qty']);
		$pr=explode(",", $_SESSION['product_price']);
		$img=explode(",", $_SESSION['product_img']);
		$col=explode(",", $_SESSION['product_col']);
		$siz=explode(",", $_SESSION['product_siz']);
		
		$key= array_search($_REQUEST['product_col'], $col);
		
		unset($pd[$key]);
		unset($qt[$key]);
		unset($pr[$key]);
		unset($img[$key]);
		unset($col[$key]);
		unset($siz[$key]);
		
		$_SESSION['product_id']=implode(",", $pd);
		$_SESSION['product_qty']=implode(",", $qt);
		$_SESSION['product_price']=implode(",", $pr);
		$_SESSION['product_img']=implode(",", $img);
		$_SESSION['product_col']=implode(",", $col);
		$_SESSION['product_siz']=implode(",", $siz);
		
		sort($qt);
		sort($pr);
		for($i=0; $i< count($qt); $i++)
		{
			$tot=$pr[$i]*$qt[$i];
			$_SESSION['totalamount']= $tot1=$tot1+$tot;
		}
		
		if($tot1==''){ $tot1="Cart is empty"; $_SESSION['totalamount']='0'; }
		else{ $tot1="$tot1"; }
		
		echo round($shp).'|'.round($tot1).'|'.count($qt);
	}
	
	
	public function checkoutAsGuest() {
	
		$this->load->controller('user');
		$_POST['password'] = substr(number_format(time() * rand(),0,'',''),0,4);
		$_POST['type'] = 'user';
		@list($userId, $addId) =  $this->user->signup('', 'getid' );
		
		$data = array('userId' => $userId,
						'shipAdd' => $addId,
							'billAdd' => $addId,
								'pMode' => 'paypal' );
		$this->checkout($data);
	}
	
	
	public function checkout( $data = NULL ) {
		
		$orderNo = substr(number_format(time() * rand(),0,'',''),0,4);	
		$code = base64_encode($orderNo);
		$userId = empty($_POST['userId']) ? $data['userId'] : $_POST['userId'];
		$shipAdd = empty($_POST['shipAdd']) ? $data['shipAdd'] : $_POST['shipAdd'];
		$billAdd = empty($_POST['billAdd']) ? $data['billAdd'] : $_POST['billAdd'];
		$pMode = empty($_POST['pMode']) ? $data['pMode'] : $_POST['pMode'];
		$status = 'pending';
		$ttoott = $_SESSION[totalamount];
		$ship='0'; $discount=0; $cpn=0;
		
		$data = array('orderId' => $orderNo,
							'date' => date('Y-m-d'),
								'userId' => $userId,
									'payType' => $pMode,
										'productId' => 'paypal',
											'productId' => $_SESSION['product_id'],
												'qty' =>  $_SESSION['product_qty'],
													'color' => $_SESSION['product_col'],
														'size' => $_SESSION['product_siz'],
															'price' => $_SESSION['product_price'],
																'discountAmount' => '',
																	'totalAmount' => $_SESSION['totalamount'],
																		'discountId' => '',
																			'shipAdd' => $_SESSION['shipping'],
																				'billAdd' => $_SESSION['billing'],
																					'status' => $status,
																						'code' => $code );
		if ( $this->db->insert( ORDER, $data ) ) {
			$getid= $this->db->lastInsertID();
		}
			
			
		if($pMode == 'CCavenue') {
			$CCAvenue = explode('|',CCAvenue);
			
			$Merchant_Id = $CCAvenue[0];
			$Amount = $_SESSION['totalamount'];
			$Order_Id = $orderNo;
			$WorkingKey = $CCAvenue[1];
			$Redirect_Url = site_url.'/redirecturl/';
			$_SESSION['hold']=$getid; ?>
			
			<form id="form2" name="frm1" method="post" action="">
			<input type="hidden" name="Merchant_Id" value="<?php echo $Merchant_Id; ?>">
			<input type="hidden" name="working_key" value="<?=$WorkingKey?>">
			<input type="hidden" name="Amount" value="<?=$_SESSION['totalamount']; ?>">
			<input type="hidden" name="Order_Id" value="<?php echo $Order_Id; ?>">
			<input type="hidden" name="Redirect_Url" value="<?php echo $Redirect_Url; ?>">
			
			<input name="billing_cust_name" type="hidden" value="<?=$baddress['fname'].' '.$baddress['name']?>">
			<input name="billing_cust_address" type="hidden" value="<?=$baddress['address']?>">
			<input name="billing_cust_country" type="hidden" value="<?=$baddress['country']?>">
			<input name="billing_cust_state" type="hidden" value="<?=$baddress['state']?>">
			<input name="billing_city" type="hidden" value="<?=$baddress['city']?>">
			<input name="billing_zip" type="hidden" value="<?=$baddress['pin']?>">
			<input name="billing_cust_tel" type="hidden" value="<?=$baddress['phone']?>">
			<input name="billing_cust_email" type="hidden" value="<?=$data['user_email']?>">
			 <input name="<?=frontend?>" type="hidden" value="ecommerce/ccave" />     
			</form>
			<? echo '<script>document.frm1.submit();</script>';die;
	
		}
		
		##paypal
		if($pMode=='paypal')
		{ $paypal = explode('|',paypal_standard); $_SESSION['hold']=$getid; ?>
		<form action="https://www.paypal.com/cgi-bin/webscr" method="post" name="frm" >
		<input type="hidden" name="cmd" value="_ext-enter">
		<input type="hidden" name="redirect_cmd" value="_xclick">
		<input type="hidden" name="return" value="<?=site_url.'/'.userType('slug', 'user').$code?>/paypal/success/">
		<input type="hidden" name="cancel_return" value="<?=site_url.'/'.userType('slug', 'user').$code?>/paypal/failed/">
		<input type="hidden" name="business" value="<?=$paypal[2]?>">
		<input type="hidden" name="item_name" value="<?=title?>">
		<input type="hidden" name="amount" value="<?=$_SESSION['totalamount']?>">
		 <input type="hidden" name="email" value="<?=$locations['paypal'];?>">   
		<input type="hidden" name="currency_code" value="USD">
		</form>
		<? echo '<script>document.frm.submit();</script>';die;  }
	
	}
	
	
	public function ccave() {
	
			$this->load->third_party('ccavenue','adler32.php' );
			$this->load->third_party('ccavenue','Aes.php' );
			
			//error_reporting(0);
			$merchant_id=$_POST['Merchant_Id']; 
			$working_key=$_POST['working_key'];
			$amount=$_POST['Amount'];
			$order_id=$_POST['Order_Id'];
			$url=$_POST['Redirect_Url']; 
			$billing_cust_name=$_POST['billing_cust_name'];
			$billing_cust_address=$_POST['billing_cust_address'];
			$billing_cust_country=$_POST['billing_cust_country'];
			$billing_cust_state=$_POST['billing_cust_state'];
			$billing_city=$_POST['billing_city'];
			$billing_zip=$_POST['billing_zip'];
			$billing_cust_tel=$_POST['billing_cust_tel'];
			$billing_cust_email=$_POST['billing_cust_email'];
			$delivery_cust_name=$_POST['delivery_cust_name'];
			$delivery_cust_address=$_POST['delivery_cust_address'];
			$delivery_cust_country=$_POST['delivery_cust_country'];
			$delivery_cust_state=$_POST['delivery_cust_state'];
			$delivery_city=$_POST['delivery_city'];
			$delivery_zip=$_POST['delivery_zip'];
			$delivery_cust_tel=$_POST['delivery_cust_tel'];
			$delivery_cust_notes=$_POST['delivery_cust_notes'];
			
			$checksum=getchecksum($merchant_id,$amount,$order_id,$url,$working_key);
		$merchant_data= 'Merchant_Id='.$merchant_id.'&Amount='.$amount.'&Order_Id='.$order_id.'&Redirect_Url='.$url.'&billing_cust_name='.$billing_cust_name.'&billing_cust_address='.$billing_cust_address.'&billing_cust_country='.$billing_cust_country.'&billing_cust_state='.$billing_cust_state.'&billing_cust_city='.$billing_city.'&billing_zip_code='.$billing_zip.'&billing_cust_tel='.$billing_cust_tel.'&billing_cust_email='.$billing_cust_email.'&delivery_cust_name='.$delivery_cust_name.'&delivery_cust_address='.$delivery_cust_address.'&delivery_cust_country='.$delivery_cust_country.'&delivery_cust_state='.$delivery_cust_state.'&delivery_cust_city='.$delivery_city.'&delivery_zip_code='.$delivery_zip.'&delivery_cust_tel='.$delivery_cust_tel.'&billing_cust_notes='.$delivery_cust_notes.'&Checksum='.$checksum;
		$encrypted_data=encrypt($merchant_data,$working_key);
		?>
		
			<form method="post" name="redirect" action="http://www.ccavenue.com/shopzone/cc_details.jsp"> 
				<?
				echo "<input type=hidden name=encRequest value=$encrypted_data>";
				echo "<input type=hidden name=Merchant_Id value=$merchant_id>";
				?>
			</form>
			<script language='javascript'>document.redirect.submit();</script>
		
		<? die;
	}
	
	
	public function ShipBill() {
	
		$add = $this->db->getRecord( ADDRESS, '', "id = '".$_POST['add']."' "  );
		
		if($_POST['acts']=="test") {?>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="nothing">
			<tr>
				<td><label><?=ucwords(@$add[0]['name'])?></label></td>
			</tr>
			<tr>
				<td><label><?=ucwords(@$add[0]['address'])?></label></td>
			</tr>
				<td><label><?=ucwords(@$add[0]['city'])?> - <?=ucwords(@$add[0]['pincode'])?> </label></td>
			</tr>
			<tr>
				<td><label><?=ucwords(@$add[0]['state'])?></label></td>
			</tr>
			<tr>
				<td><label><?=ucwords(@$add[0]['country'])?></label></td>
			</tr>
			<tr>
				<td><label><?=ucwords(@$add[0]['mobileNo'])?></label></td>
			</tr>
			</table>
			
			<? echo "|"; if($_POST['chk']=='1'){?>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="nothing">
			<tr>
			<td><label><?=ucwords(@$add[0]['name'])?></label></td>
			</tr>
			<tr>
			<td><label><?=ucwords(@$add[0]['address'])?></label></td>
			</tr>
			<td><label><?=ucwords(@$add[0]['city'])?> - <?=ucwords(@$add[0]['pincode'])?> </label></td>
			</tr>
			<tr>
			<td><label><?=ucwords(@$add[0]['state'])?></label></td>
			</tr>
			<tr>
			<td><label><?=ucwords(@$add[0]['country'])?></label></td>
			</tr>
			<tr>
			<td><label><?=ucwords(@$add[0]['mobileNo'])?></label></td>
			</tr>
			</table>
			<? }}

		if($_POST['acts']=="test1") { echo "|"; ?>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="nothing">
			<tr>
			<td><label><?=ucwords(@$add[0]['name'])?></label></td>
			</tr>
			<tr>
			<td><label><?=ucwords(@$add[0]['address'])?></label></td>
			</tr>
			<td><label><?=ucwords(@$add[0]['city'])?> - <?=ucwords($add[0]['pincode'])?> </label></td>
			</tr>
			<tr>
			<td><label><?=ucwords(@$add[0]['state'])?></label></td>
			</tr>
			<tr>
			<td><label><?=ucwords(@$add[0]['country'])?></label></td>
			</tr>
			<tr>
			<td><label><?=ucwords(@$add[0]['mobileNo'])?></label></td>
			</tr>
			</table>
		<? }}
		
	
	public function paymentResponse( $slug ) {
		
		$code = $slug[1];
		$type = $slug[2];
		$cnd = $slug[3];
		$msg = ''; 
		if($_SESSION['hold']) {
		$add = $this->db->getRecord( ORDER, '', "id = '".$_SESSION['hold']."' " );
		
			if($add[0]['status'] != 'pending')
				$msg = '<strong>no order found</strong> <br />';
			
							
			else if($type == 'paypal' && $add[0]['code'] == $code ) {
				
				if($cnd == 'failed' ) {
					$this->db->update( ORDER, array('status' => 'failed' ) ,  "id = '".$_SESSION['hold']."' ") ;
					$msg = '<strong>Your payment has been declined</strong>';
				}
				if($cnd == 'success' ) {
						$this->db->update( ORDER, array('status' => 'completed' ) ,  "id = '".$_SESSION['hold']."' ") ;
						//send_mail('12','',$sc,$locations);
						$msg =  '<strong>Thank you, your payment has been successfully completed! <br />
						You will 	receive a confirmation e-mail from us shortly with your order details. </strong>';
				}
			}
			
			$_SESSION[product_id]='';
			$_SESSION[product_qty]='';
			$_SESSION[product_price]='';
			$_SESSION[product_col]='';
			$_SESSION[product_siz]='';
			$_SESSION[totalamount]='';
			$_SESSION[product_img]='';
			$_SESSION['coupon']='';
			$_SESSION['hold']='';
			$_SESSION['shipping']='';
			$_SESSION['address']='';
		}
		return $msg;
	}
	
	
	public function subCategory ( $pid, $strname = '' ) {
		
		static $level=0;
		static $strid="";
		static $strname="";
		$query = $this->db->runQuery( "SELECT * from `".CAT."` where  category_parent =".$pid." " );
		while( $row = $this->db->getQuery( $query ) ) {
			$id=$row['id'];
			$level--;
			for($p=1;$p<($level*-1);$p++)		
			$strname.=$row['id'].',';
			$rid = $this->subCategory($id,$strname);
			$strid[]=$row['id'];
			$level++;
		}
		return @trim(implode(',',array_unique($strid)).','.$pid,',');
	}
	
	
	public function tablecsv() {
	$this->load->model('site_function');
	$output = "";
	
	$par = explode(',',$_POST['par']);
	for($i=0; $i< count($par); $i++)
	$etra[] = $this->site_function->parameters($par[$i]);

	$title = array_merge(explode(',',preg_replace( '/\s+/', ' ','Image,
							Part Number,
							Manufacturer Part Number,
							Manufacturer,
							Description,
							Quantity Available,
							Unit Price,
							Minimum Quantity
					')),$etra);
	
	for ($i = 0; $i < count($title); $i++)
		$output .= '"'.$title[$i].'",';
	$output .="\n";
	
	###
	
	$sql = $this->db->runQuery("$_POST[query]");
	while ($row1= $this->db->getQuery($sql)) {
	
	$row[0] = img_path.$row1['productPhoto'];
	$row[1] = $row1['partNum'];
	$row[2] = $row1['mPartNum'];
	$row[3] = $this->site_function->manufacturer($row1['manufacturer']);
	$row[4] = $row1['description'];
	$row[5] = $row1['quantity'];
	$row[6] = $row1['price'];
	$row[7] = $row1['minQty'];
	
	for($i=0; $i< count($par); $i++) {
		$j= 8+$i;
		$row[$j] = $this->site_function->masters($row1[$par[$i]]);
		}
	
	
	for ($i = 0; $i <= count($par)+8; $i++) {
	$output .='"'.$row["$i"].'",';
	}
	$output .="\n";
	}

	##
	
	$filename = "myFile.csv";
	header('Content-type: application/csv');
	header('Content-Disposition: attachment; filename='.$filename);
	echo $output;
	exit;
	
	}
	
	
	public function address() {
		//print_r($_POST);
		$address = array('userId' => $_POST['userId'],
							'country' => $_POST['country'],
								'name' => $_POST['firstname'].' '.$_POST['lastname'],
									'address' => $_POST['address1'],
										'address2' => $_POST['address2'],
											'city' => $_POST['city'],
												'state' => $_POST['state'],
													'pincode' => $_POST['pincode'],
														'email' => $_POST['email'],
															'website' => $_POST['website'],
																'mobileNo' => $_POST['mobileNo']
		);
		
		$_POST['notification'] = 'profilemsg';
		$this->db->insert( ADDRESS, $address );
		$addId = $this->db->lastInsertID();
		$_SESSION[$_POST['addtype']] =  $addId;
		if($_POST['goto'] == 'checkout2' )
			redirect($_POST['goto'],'succ|');
		else
			$this->checkout();
		
	}
	
	
	public function createBom() {
		
		$uni = substr(number_format(time() * rand(),0,'',''),0,7);
		$data= array('date' => date('y-m-d') ,
						'uniqueId' => $uni,
									'name' => $_POST['name'],
										'userId' => $_POST['userId'],
											'partNum' => $_SESSION['product_namep'],
												'qty1' => $_SESSION['qty1'],
													'qty2' => $_SESSION['qty2'],
														'qty3' => $_SESSION['qty3']
													);
														
		if( $this->db->insert( BOM, $data ) ) {
			$_SESSION['product_namep'] = '';
			$_SESSION['qty1'] = '';
			$_SESSION['qty2'] = '';
			$_SESSION['qty3'] = '';
			redirect("bom-view/$uni",'succ|');
		}
	
	}
	
	
	public function delBom() {
	
		$this->db->runQuery("delete from ".BOM." where id='".$_POST['id']."' ");
		redirect('referer','succ|deleted successfully!!');
	}
	
	
	public function delPartlist() {
	
		$key =$_POST['id'];
		$name=explode(",", $_SESSION['product_namep']);
		$qty1=explode(",", $_SESSION['qty1']);
		$qty2=explode(",", $_SESSION['qty2']);
		$qty3=explode(",", $_SESSION['qty3']);
		
		unset($name[$key]);
		unset($qty1[$key]);
		unset($qty2[$key]);
		unset($qty3[$key]);
			
		$_SESSION['product_namep'] = implode(",", $name);
		$_SESSION['qty1'] = implode(",", $qty1);
		$_SESSION['qty2'] = implode(",", $qty2);
		$_SESSION['qty3'] = implode(",", $qty3);
		
		redirect('referer', "succ|$msg");
	}
	
	
	public function partList() {
		
		if($_POST[product_qtyp]==''){ $_POST[product_qtyp]='1';}
		
		$query = $this->db->getQuery($this->db->runQuery( "SELECT * from `".PRODUCT."` where `partNum` = '".$this->db->clearText($_POST['product_namep'])."' " ));	
		
		if($query) {
			
			$_SESSION['product_namep']=implode(",", array_filter(explode(",", $_SESSION['product_namep'].','.$_POST[product_namep])));
			
			$_SESSION['qty1']=implode(",", array_filter(explode(",", $_SESSION['qty1'].','.$_POST[qty1])));
			$_SESSION['qty2']=implode(",", array_filter(explode(",", $_SESSION['qty2'].','.$_POST[qty2])));
			$_SESSION['qty3']=implode(",", array_filter(explode(",", $_SESSION['qty3'].','.$_POST[qty3])));
		}
		
		redirect('bom-manager-part-list/', "succ|$msg");
		die;

	}
	
	
	public function partListCart() {
	
			$ecommerce = unserialize( ecommerce );
			
			$part = explode(',',$_SESSION['product_namep']);
			$qty = explode(',',$_SESSION['qty1']);
			
			for($i=0; $i< count($part); $i++){
			
				$_POST['product_name'] = $part[$i];
				$_POST['product_qty'] = $qty[$i];
				$_POST['no'] = '1';
				$_POST['chk'] = '1';
				$this->addToCart();
			}
				
				redirect($ecommerce['cart']['slug'], "succ|$msg");
	}
	
	
	public function editBom() {
	
		//print_r($_POST);die;
		if($_POST['cnd'] == 'save') {
			$data= array('partNum' => @implode(',',$_POST['name']),
							'qty1' => @implode(',',$_POST['qty1']),
								'qty2' => @implode(',',$_POST['qty2']),
									'qty3' => @implode(',',$_POST['qty3'])
									);
															
			$this->db->update( BOM, $data, "id = '".$_POST['id']."' "  );
			redirect('referer','succ|deleted successfully!!');
		}
		
		
		if($_POST['cnd'] == 'del') {
		
			$data = $this->db->getQuery($this->db->runQuery( "SELECT * from `".BOM."` where  id = '".$_POST['id']."' " ));
				
				$key =$_POST['del'];
				$name=explode(",", $data['partNum']);
				$qty1=explode(",", $data['qty1']);
				$qty2=explode(",", $data['qty2']);
				$qty3=explode(",", $data['qty3']);
				
				unset($name[$key]);
				unset($qty1[$key]);
				unset($qty2[$key]);
				unset($qty3[$key]);
				
				$data= array('partNum' => @implode(",", $name),
								'qty1' => @implode(",", $qty1),
									'qty2' => @implode(",", $qty2),
										'qty3' => @implode(",", $qty3)
									);
															
			$this->db->update( BOM, $data, "id = '".$_POST['id']."' "  );
			redirect('referer','succ|deleted successfully!!');
		
		}
		
		
		if($_POST['cnd'] == 'add') {
		
				if($_POST[product_qtyp]==''){ $_POST[product_qtyp]='1';}
				
				$data = $this->db->getQuery($this->db->runQuery( "SELECT * from `".BOM."` where  id = '".$_POST['id']."' " ));
				$query = $this->db->getQuery($this->db->runQuery( "SELECT * from `".PRODUCT."` where `partNum` = '".$this->db->clearText($_POST['product_nameb'])."' " ));	
							
				if($query) {
						$data= array('partNum' => trim($data['partNum'].','.$_POST['product_nameb'],','),
										'qty1' => trim($data['qty1'].','.$_POST['qty'],','),
											'qty2' => trim($data['qty2'].',0',','),
												'qty3' => trim($data['qty3'].',0',',')
											);
																	
						$this->db->update( BOM, $data, "id = '".$_POST['id']."' "  );
			
				}
			redirect('referer', "succ|");
			die;
		
			}
			
		
		if($_POST['cnd'] == 'cart') {
			
			//print_r($_POST);
			$ecommerce = unserialize( ecommerce );
			
			$part = $_POST['name'];
			$qty = $_POST['qty1'];
			
			for($i=0; $i< count($part); $i++){
			
				$_POST['product_name'] = $part[$i];
				$_POST['product_qty'] = $qty[$i];
				$_POST['no'] = '1';
				$_POST['chk'] = '1';
				$this->addToCart();
			}
				
				redirect($ecommerce['cart']['slug'], "succ|$msg");
			
			 
		}
	
	}
}
?>