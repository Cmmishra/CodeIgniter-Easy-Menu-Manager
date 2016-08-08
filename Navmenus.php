<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Navmenus extends CI_Controller {

	/*
	 * Design and setup of navigation menus
	 * Aim: for bavnebys
	 * Security: Logined
	 *
	 * Maps to the following URL
	 * 		http://www.biz.biz/admin/navmenus
	 * This 
	 */
	 protected $adminDetails;
	 protected $structure;
	
	 public function __construct(){
	 
	   parent::__construct();
	   $this->load->library('visitortracker');
$this->adminDetails=$this->visitortracker->returnuserdetails(true);
 
$this->lang->load('core',applanguage());
	 $this->lang->load('menus',applanguage());
	 $this->load->model('Menus_model');

	 }
	 
	public function index()
	{
	$this->display_children();
	
	}
	
//-------------------------------------	

function display_children($parent=0) { 

    // retrieve all children of $parent 

    $categories = array();
$pool = array();
$q=$this->Menus_model->returnparentmenus();
foreach ($q as $row ) {


 if (in_array($row['lvl0_id'], $pool) === false && isset($row['lvl0_name'])) {
        $c = array('id' => $row['lvl0_id'],
                   'name' => $row['lvl0_name'],
				   'class' => $row['lv10_class'],
				   'link' => $row['lv10_link'],
				  
                   'level' => 0);
        $categories[] = $c;
    }
    if (in_array($row['lvl1_id'], $pool) === false && isset($row['lvl1_name'])) {
        $c = array('id' => $row['lvl1_id'],
                   'name' => $row['lvl1_name'],
				    'class' => $row['lv11_class'],
				   'link' => $row['lv11_link'],
                   'level' => 1);
        $categories[] = $c;
    }
    if (in_array($row['lvl2_id'], $pool) === false && isset($row['lvl2_name'])) {
        $c = array('id' => $row['lvl2_id'],
                   'name' => $row['lvl2_name'],
				    'class' => $row['lv12_class'],
				   'link' => $row['lv12_link'],
                   'level' => 2);
        $categories[] = $c;
    }
    if (in_array($row['lvl3_id'], $pool) === false && isset($row['lvl3_name'])) {
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

$this->load->model('Services_model');
$data['services']=$this->Services_model->services(2);
//get projects

$this->load->model('Projects_model');
$data['projects']=$this->Projects_model->projects(2);

//get page gropus
$this->load->model('Pages_model');
$data['pages']=$this->Pages_model->pagesParentChildren();

//get gallery types
$this->load->model('Gallery_model');
$data['gallerytypes']=$this->Gallery_model->gallerytypes();

$this->load->model('About_model');
$data['aboutus']=$this->About_model->sections(2);

$this->load->model('Events_model');
$data['eventtypes']=$this->Events_model->eventtypes();

//get blogtypes types
$this->load->model('Blogs_model');
$data['blogtypes']=$this->Blogs_model->blogtypes(2);

     

$headerdata['visitordetails']=$this->adminDetails;
$headerdata['navmenu']='true';
$this->load->view('admin/incl/header',$headerdata);
$data['msg']='';
$data['categories']=$categories;
$this->load->view('admin/menus',$data);
$this->load->view('admin/incl/footer');


}


	
	
	

//-----------------------------------
private function childsubmenus($menuid,$e){
$topmenusorder=1;
foreach ($e as $key => $block) {
    //echo $block['link'].' '.$block['cls'].' '.$block['id'].' '.$block['label'].'<br/>'; /* echo parent*/
	$menu=$this->Menus_model->insertmenu($block['label'],$block['cls'],$menuid,$block['link'],$topmenusorder);
	$this->structure.='<li><a href="'.$block['link'].'" '.$block['cls'].'>'.$block['label'].'</a>'."\n";
    if (isset($block['children'])) {
$this->structure.="<ul class='sub-menu'>";
	$this->childsubmenus($menu,$block['children']);
    $this->structure.="</ul>";
    }
	$topmenusorder++;
	$this->structure.='</li>'."\n";
}


}


	function producemenus() {
	//produce menus
	
	//save the menu to db then write it to the menu struture.
	
	$response = json_decode($_POST['s'], true); // decoding received JSON to array
	
	$this->Menus_model->clearMenus();
	if(is_array($response)){
	

	//start saving now
	$topmenusorder=1;
	foreach ($response as $key => $block) {

	$menuid=$this->Menus_model->insertmenu($block['label'],$block['cls'],0,$block['link'],$topmenusorder);
$this->structure.='<li><a href="'.$block['link'].'" '.$block['cls'].'>'.$block['label'].'</a>';
    if (isset($block['children'])) {
	//loopMe($block['children']);
       // loopChildren($block['link']['children']); /* children loop*/
	   $this->structure.="<ul class='sub-menu'>";
	   $this->childsubmenus($menuid,$block['children']);
	   $this->structure.="</ul>";
	   
    }
	$this->structure.='</li>'."\n";
	$topmenusorder++;
   }

	
	} //if is_array($response);
	
	//export to file
	




//menus found. write them to file now
//write to file now
$this->load->helper('file');
$fileName=APPPATH.'views/public/incl/menu.php';
if ( ! write_file($fileName, $this->structure))
{
        echo -1;
		exit;
}
else
{
        echo 1;
		exit;
}


	}		
//-----------------------------------	


	
}
