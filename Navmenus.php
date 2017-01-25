<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Navmenus extends CI_Controller {

	/*
	 * Design and setup of navigation menus
	 * Aim: for navigation menu managements
	 * Security: Logined
	 *
	 * Maps to the following URL
	 * 		http://www.biz.biz/admin/navmenus
	 * This 
	 */
	 
	
	 
	 
	 protected $themeNavMenuLocations=array(101=>'navmenu_topleft',102=>'navmenu_topright',103=>'navmenu_navbar',104=>'navmenu_navbarbottom',105=>'navmenu_bottomend');
	 public function __construct(){
	 //build constrctor.
	   parent::__construct();
	  
 
$this->lang->load('menus',applanguage()); //load controller specific language file
$this->load->model('Menus_model'); //load the Menus_model


	 }
	 
	public function index()
	{
	

//call header
//$this->load->view('admin/incl/header',$headerdata);
$data['msg']='';
$this->load->view('admin/menus',$data);
//$this->load->view('admin/incl/footer');

	
	}
	
//-------------------------------------

function deleteallmenus(){
//delete all the menus
$this->Menus_model->deleteallmenus();
echo 1;exit;
}

function clearcurrentmenus(){
//delete the location in language:
$menuLocation=$_POST['loc'];
$menuLanguage=$_POST['lang'];
$this->Menus_model->clearmenus($menuLocation,$menuLanguage);
echo 1;exit;
}



function showmenus($location,$language,$parent=0) { 

    // retrieve all children of $parent. The menu supports 4 levels maximum. To add more, replicate any of the blocks below, changing the value of id.  that would be like lvl5,lvl6 etc. If that happens, make sure you extend Menu_models model's function returnparentmenus() as well

    $categories = array();
$pool = array();
$q=$this->Menus_model->returnparentmenus($location,$language);
foreach ($q as $row ) {

//MENU BLOCK START
 if (in_array($row['lvl0_id'], $pool) === false && isset($row['lvl0_name']) && !is_null($row['lvl0_name'])) {
        $c = array('id' => $row['lvl0_id'],
                   'name' => $row['lvl0_name'],
				   'class' => $row['lv10_class'],
				   'link' => $row['lv10_link'],
				  
                   'level' => 0);
        $categories[] = $c;
    }
	
//MENU BLOCKE END


    if (in_array($row['lvl1_id'], $pool) === false && isset($row['lvl1_name']) && !is_null($row['lvl1_name'])) {
        $c = array('id' => $row['lvl1_id'],
                   'name' => $row['lvl1_name'],
				    'class' => $row['lv11_class'],
				   'link' => $row['lv11_link'],
                   'level' => 1);
        $categories[] = $c;
    }
    if (in_array($row['lvl2_id'], $pool) === false && isset($row['lvl2_name']) && !is_null($row['lvl2_name']) ) {
        $c = array('id' => $row['lvl2_id'],
                   'name' => $row['lvl2_name'],
				    'class' => $row['lv12_class'],
				   'link' => $row['lv12_link'],
                   'level' => 2);
        $categories[] = $c;
    }
    if (in_array($row['lvl3_id'], $pool) === false && isset($row['lvl3_name']) && !is_null($row['lvl3_name'])) {
        $c = array('id' => $row['lvl3_id'],
                   'name' => $row['lvl3_name'],
				    'class' => $row['lv13_class'],
				   'link' => $row['lv13_link'],
                   'level' => 3);
        $categories[] = $c;
    }
   /* if (in_array($row['lvl4_id'], $pool) === false && isset($row['lvl4_name'])) {
        $c = array('id' => $row['lvl4_id'],
                   'name' => $row['lvl4_name'],
                   'level' => 4);
        $categories[] = $c;
    }*/
    $pool[] = $row['lvl0_id'];
    $pool[] = $row['lvl1_id'];
    $pool[] = $row['lvl2_id'];
    $pool[] = $row['lvl3_id'];
   // $pool[] = $row['lvl4_id'];
}
/*
Sample outoput: [{"id":"1","name":"Home","class":null,"link":"#","level":0},{"id":"2","name":"How","class":null,"link":"#","level":0}]
*/
echo json_encode($categories);exit;

}


	
	
	

//-----------------------------------
private function childsubmenus($menuid,$e,$menuLocation,$menuLanguage){
$topmenusorder=1;
foreach ($e as $key => $block) {
    //echo $block['link'].' '.$block['cls'].' '.$block['id'].' '.$block['label'].'<br/>'; /* echo parent*/
	$menu=$this->Menus_model->insertmenu($block['label'],$block['cls'],$menuid,$block['link'],$topmenusorder,$menuLocation,$menuLanguage);
	
    if (isset($block['children'])) {

	$this->childsubmenus($menu,$block['children'],$menuLocation,$menuLanguage);
    
    }
	$topmenusorder++;
	
}


}


	function producemenus() {
	//produce menus
	
	//save the menu to db
	
$menuLocation=$_POST['loc'];
	$response = json_decode($_POST['s'], true); // decoding received JSON to array
	
	if(!array_key_exists($menuLocation,$this->themeNavMenuLocations)){
	echo 0;exit;
	}
	
	$menuLanguage=$_POST['lang'];
	$this->Menus_model->clearmenus($menuLocation,$menuLanguage);
	if(is_array($response)){

	//start saving now
	$topmenusorder=1;
	foreach ($response as $key => $block) {

	$menuid=$this->Menus_model->insertmenu($block['label'],$block['cls'],0,$block['link'],$topmenusorder,$menuLocation,$menuLanguage);

    if (isset($block['children'])) {
	//loopMe($block['children']);
       // loopChildren($block['link']['children']); /* children loop*/
	  
	   $this->childsubmenus($menuid,$block['children'],$menuLocation,$menuLanguage);
	  
	   
    }

	$topmenusorder++;
   }

	
	} //if is_array($response);
	
echo 1;exit;

	}		
//-----------------------------------	


	
}
