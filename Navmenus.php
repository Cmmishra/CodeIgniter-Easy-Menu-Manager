<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Navmenus extends CI_Controller {

	/*
	 * Design and setup of navigation menus
	 * Author: KM Sium (kmsium@gmail.com)
	 * GPU Licenced.
	 * Maps to the following URL
	 * 		http://www.biz.biz/navmenus
	 * 
	 * Note: the application don't include language settings.
	 
	  $structure Menu structure could be saved into physical file. The structure is globally stored in the $structure variable and written to file. That would reduce database load since require() is quicker.
	 $menufile is the file where the menu can be written too. The structure is saved to database. However, it can also be written automatically to file. That is speedy typically. Typically, you would have a file structure like this:
	 
	 application/views/includes/header.php
	 
	 Menus go in header.php, typically in <ul>...</ul> version. So, instead of writting the menus, do
	 
	 <ul class="" id=""><?php require('menu.php');?></ul>
	 
	 the <li> items will be produced each time you produce your menus. That also gives you plenty of rooms to style your menus.
	 
	 leave $menufile empty if you don't want to save to file.
	 
	 */
	
	
	
	 protected $structure;
	protected $menufile=APPPATH.'views/public/incl/menu.php';
	 public function __construct(){
	 
	   parent::__construct();

	 $this->load->model('Menus_model');

	 }
	 
	public function index()
	{
	$this->display_children();
	
	}
	
//-------------------------------------	

function display_children($parent=0) { 

    // retrieve all children of $parent It can retrieve and work upto for levels. If you need more, add here lvl4,lvl5...
	//id is auto number of the menu in the database table, name is its name, class is any CSS class applicable to the menu and link is the target of the menu

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
  
    $pool[] = $row['lvl0_id'];
    $pool[] = $row['lvl1_id'];
    $pool[] = $row['lvl2_id'];
    $pool[] = $row['lvl3_id'];
   // $pool[] = $row['lvl4_id'];
}

//Below are items that possibly can be linked to menus. This is similar to posts or pages of wordpress so user can select and link existing content to menus.
/*
$this->load->model('Services_model');
$data['services']=$this->Services_model->services(2);
*/
$data['categories']=$categories;
$this->load->view('admin/menus',$data);



}


	
	
	

//-----------------------------------
private function childsubmenus($menuid,$e){
//this is used only when user wants to produce the menu structure to menu.php. It fetches children of a given menu item and creates a <ul> submenu items with the class sub-menu for easy CSS styling.
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
	//it accepts the strucutre in the form of json data, saves it to database and writes to file.
	//if no file writing is needed, delete all file operation related lines.
	
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
	




if($this->menufile){
//write to menu file
$this->load->helper('file');
$fileName=$this->menufile;
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
else{
echo 1;exit;
}



	}		
//-----------------------------------	


	
}
