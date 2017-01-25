<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//display navigation menus in client side
function topleft($classname='',$language='',$id='',$submenuclass=''){
//return the top left menu

return menus(101,$language,$classname,$id,$submenuclass);
}

function topright($classname='',$language='',$id='',$submenuclass=''){
//return the top right menu

return menus(102,$language,$classname,$id,$submenuclass);
}

function topnavbar($classname='',$language='',$id='',$submenuclass=''){
//return the top full nav bar

return menus(103,$language,$classname,$id,$submenuclass);
}

function bottomnavbar($classname='',$language='',$id='',$submenuclass=''){
//return the bottom full nav bar

return menus(104,$language,$classname,$id,$submenuclass);
}

function bottomendnavbar($classname='',$language='',$id='',$submenuclass=''){
//return the bottom end full nav bar: copyright e.g.

return menus(105,$language,$classname,$id,$submenuclass);
}

function menus($location,$language,$classname,$id,$submenuclass){
//Don't call this directly.
$categories = array();
$pool = array();
$ci=& get_instance();
$ci->load->model('Menus_model');
$structure='';
$q=$ci->Menus_model->returnparentmenus($location,$language);
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


$structure='<ul class="'.$classname.'" id="'.$id.'">';
$count = count($categories);
if($count>0){

if ($count == 1) {
  //  echo '<li>', $categories[0]['name'], '</li>', "\n";
$link=$categories[0]["link"];
$class=stripslashes($categories[0]["class"]);
$name=stripslashes($categories[0]['name']);
$structure.='<li><a href="'.$link.'" class="'.$class.'">'.$name.'</a></li>';

} 
else {
    $i = 0;
    while (isset($categories[$i])) {
       // echo '<li>', $categories[$i]['name'];
	   $link=$categories[$i]["link"];
$class=stripslashes($categories[$i]["class"]);
$name=stripslashes($categories[$i]['name']);
$structure.='<li><a href="'.$link.'" class="'.$class.'">'.$name.'</a>';

        if ($i < $count - 1) {
            if ($categories[$i + 1]['level'] > $categories[$i]['level'])
            {
			$structure.='<ul class="'.$submenuclass.'">';
              
            }
            else {
			$structure.='</li>';
             
            }
            if ($categories[$i + 1]['level'] < $categories[$i]['level']) {
                $structure.= str_repeat('</ul></li>' . "\n",
                $categories[$i]['level'] - $categories[$i + 1]['level']);
            }
        } else {
            $structure.= '</li>';
            $structure.= str_repeat('</ul></li>' . "\n", $categories[$i]['level']);
        }
    $i++;
    }
}

}


$structure.='</ul>';
return $structure;

}



?>