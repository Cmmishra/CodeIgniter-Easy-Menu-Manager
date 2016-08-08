<?php
//Model for retrieving menu structure from the database
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Menus_model extends CI_Model {

function returnparentmenus(){
$parameters=array();

$sql="SELECT t0.menuid AS lvl0_id, t0.menulabel AS lvl0_name, t0.menuparent AS lv10_menuparent,t0.menulink as lv10_link,t0.menuclass as lv10_class, t1.menuid AS lvl1_id, t1.menulabel as lvl1_name,t1.menuparent AS lv11_menuparent,t1.menulink as lv11_link,t1.menuclass as lv11_class, t2.menuid AS lvl2_id, t2.menulabel as lvl2_name,t2.menuparent AS lv12_menuparent,t2.menulink as lv12_link,t2.menuclass as lv12_class, t3.menuid AS lvl3_id, t3.menulabel as lvl3_name,t3.menuparent AS lv13_menuparent,t3.menulink as lv13_link,t3.menuclass as lv13_class FROM tblwebmenus AS t0 LEFT JOIN tblwebmenus AS t1 ON t1.menuparent = t0.menuid LEFT JOIN tblwebmenus AS t2 ON t2.menuparent = t1.menuid LEFT JOIN tblwebmenus AS t3 ON t3.menuparent = t2.menuid ORDER BY t0.menuid,t0.menusort,t1.menuid,t1.menusort,t2.menuid,t2.menusort,t3.menuid,t3.menusort ";

$query = $this->db->query($sql, $parameters);
$result=$query->result_array();
//$query->next_result();
$query->free_result();
return $result;

}

function clearMenus(){
$parameters=array();
$sql="TRUNCATE TABLE tblwebmenus;";
$query = $this->db->query($sql, $parameters);
$query2 = $this->db->query($sql, $parameters);
}

function insertmenu($name,$class,$id,$target,$order){

$result="";

$parameters=array($name,$target,$class,$id,$order);
$sql='INSERT INTO tblwebmenus(menulabel,menulink,menuclass,menuparent,menusort) VALUES(?,?,?,?,?);';
$query = $this->db->query($sql, $parameters);
return $this->db->insert_id();

//$query->next_result();
//$query->free_result();

}




//------------------------------------------

}


?>