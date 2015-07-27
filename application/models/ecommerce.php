<?php

class ecommerce extends Controller  {

	public function __construct() {
		parent::__construct();
	}
	
	public function __get($property) {
            if (property_exists($this, $property)) {
                return $this->$property;
            }
    }
	
	
	public function category_url($id,$url="",$rpt='') {
	
	if($id!='' && $id!=$rpt)
	{
		$data= $this->db->getQuery($this->db->runQuery("select id,category_parent,slug from ".CAT." where id='$id'"));
		$url[]=$data['slug'];
		return $this->category_url($data['category_parent'],$url,$id);
	}
	else
		return @trim(implode("/", array_reverse($url, true)), ' / ');
	}
}
?>