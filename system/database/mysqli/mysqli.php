<?php

// My database Class called myDBC
class myDBC {

// our mysqli object instance
public $mysqli = null;
 
// Class constructor override
public function __construct() {
  
//require_once DB_CONFIG_FILE;      
        
$this->mysqli = 
   new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
 
if ($this->mysqli->connect_errno) {
    echo "Error MySQLi: (".$this->mysqli->connect_errno 
    . ") " . $this->mysqli->connect_error;
    exit();
 }
   $this->mysqli->set_charset("utf8"); 
}
 
// Class deconstructor override
public function __destruct() {
	$this->CloseDB();
 }


 // default set scope
public $curl;

	public function CustomURL($input) {
		$this->curl = $input;
	}
	
	
// runs a sql query
    public function runQuery($qry) {
        $result = $this->mysqli->query($qry) or die( $this->mysqli->error  );
		return $result;
    }

// fetch records
     public function getQuery($qry) {
          $result = $qry->fetch_assoc();
		 return $result;
    }
	
	public function getQuerys($qry) {
          $result = $qry->fetch_array();
		 return $result;
    }
	
// runs multiple sql queres
    public function runMultipleQueries($qry) {
        $this->mysqli->multi_query($qry);
		$result = $this->mysqli->store_result();
        return $result;
    }
	
// count num of rows 
     public function numRow($qry) {
         return $qry->num_rows;
    }

// Escape the string get ready to insert or update
    public function clearText($text) {
        $text = trim($text);
        return $this->mysqli->real_escape_string($text);
    }

// Get the last insert id 
    public function lastInsertID() {
        return $this->mysqli->insert_id;
    }
	
// Close database connection
    protected function CloseDB() {
		$this->mysqli->close();
    }
	
// single/multiple table records 
     public function getRecord($table, $field='', $where='', $remove='', $img='') {
		
		$field = empty($field) ? '*' : $field;
		$cnd = empty($where) ? '' : " where ".$where." ";
		$column = empty($remove) ? '' : array_filter(explode(',',$remove)); @sort($column);
		$img = empty($img) ? '' : array_filter(explode(',',$img)); @sort($img);
		$rs2 = '';
		$rs1 = $this->runQuery("SELECT ".$field." from `".$table."` ".$cnd." ");
		$num = $this->numRow($rs1);
		if( $num > 1 )
		{
			$i=0;
			while($array = $this->getQuery($rs1))
			{
				for( $j=0; $j<count($column); $j++ ) {	unset($array[$column[$j]]);	}
				for( $k=0; $k<count($img); $k++ ){if($array[$img[$k]]) $array[$img[$k]]=$this->curl.$array[$img[$k]]; }
				$rs2[$i] = $array;	
				$i++;
			}
   		}
		else if( $num == 1 )
		{
			$rs2[] = $this->getQuery($rs1);
			for( $j=0; $j<count($column); $j++ ) { unset($rs2[0][$column[$j]]); }
			for( $k=0; $k<count($img); $k++ ) { if($rs2[0][$img[$k]]) $rs2[0][$img[$k]]=$this->curl.$rs2[0][$img[$k]]; }
		}
		return $rs2;
    }

// no of records
     public function getNumRow($table, $field='*', $where='') {
		$field = empty($field) ? '*' : $field;
		$cnd = empty($where) ? '' : " where ".$where." ";
		$rs1 = $this->runQuery("select $field from `".$table."` ".$cnd." ");
		return $this->numRow($rs1);	
	}

	public function insert($table, $data) {
		$q="INSERT INTO `$table` ";
		$v=''; $n='';
	
		foreach($data as $key=>$value) {
			$n.="`$key`, ";
			$v.= "'".$this->clearText($value)."', ";
		}
		$q .= "(". rtrim($n, ', ') .") VALUES (". rtrim($v, ', ') .");";
		if($this->runQuery($q))
			return true;
		else
			return false;
	}
	
	public function update($table, $data, $where) {
	       $q="UPDATE `$table` SET ";
	       foreach($data as $key=>$val) {
		   		if(strtolower($val)=='null') $q.= "`$key` = NULL, ";
		  		elseif(strtolower($val)=='now()') $q.= "`$key` = NOW(), ";
           		elseif(preg_match("/^increment\((\-?\d+)\)$/i",$val,$m)) $q.= "`$key` = `$key` + $m[1], "; 
	       		else $q.="`$key`='".$this->clearText($val)."',";
	        }
  		   $q = rtrim($q, ', ') . ' WHERE '.$where.';';
           if($this->runQuery($q))
				return true;	
		   else
           		return false;	
	}

	
// Gets the total count and returns integer
	protected function totalCount($fieldname, $tablename, $where = "")  {
	$q = "SELECT count(".$fieldname.") FROM "
	. $tablename . " " . $where;
			 
	$result = $this->mysqli->query($q);
	$count = 0;
	if ($result) {
		while ($row = mysqli_fetch_array($result)) {
		$count = $row[0];
	   }
	  }
	  return $count;
	}

} 
?>