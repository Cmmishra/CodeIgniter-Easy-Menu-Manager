<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?> 

<!-- GENERATOR BUTTON . Click the button to save the menu structure to database as well as save it to menu.php file in views/public/incl/menu.php-->

            <span id="generate" style="color:#FF0000; font-weight:bold;"></span> <input type="button" id="savenavmenus" class="btn btn-theme reallyclear fright" value="Save Menu"/> 
            
            <div style="clear:both; width:100%; height:10px;"></div>  
            
             <div class="mymenus">
             <div id="menusources">
              <select id="menu_target" class="form-control ">
                               <option value="<?php echo base_url();?>#">None</option>
                              
                             <option value="<?php echo base_url();?>home">Home</option>
                             <option value="<?php echo base_url();?>about">About</option>
                           
                             <option value="<?php echo base_url();?>contact">Contact</option>
                            
							 <option value="<?php echo base_url();?>services">Services</option>
							 <?php
							 //here can go specific services from the database.
							 /*
							 if(!empty($services)){
							 foreach($services as $info){
							 $serviceid=$this->switcher->hideme($info['serviceid']);
							 $serviceTitle=stripslashes($info['servicetitle']);
							 ?>
                             <option value="<?php echo base_url();?>services/detail/<?php echo $serviceid;?>"><?php echo " &nbsp;&nbsp;&nbsp;&nbsp;".$serviceTitle;?></option>
                             
                             <?php
							 }
							 }
							 
							 */
							 ?>
							
                             <br/>
                             <input type="button" class="btn btn-theme addtonavmenu" value="<?php echo $this->lang->line('biz_admin_menus_add');?>" />
             
             <br/><br/>
             <hr/>
             <!-- menu editor-->
             Name:<br/>
             <input type="text" class="form-control requiredfields" id="mname" name="mname" required="required" value="" maxlength="75">
             Target:<br/>
             <input type="text" class="form-control requiredfields" id="mtarget" name="mtarget" required="required" value="" maxlength="255">
             CSS Class:<br/>
             <input type="text" class="form-control requiredfields" id="mclass" name="mclass" value="" maxlength="255">
            <br/>
              <input type="button" class="btn btn-theme updatenavmenu" value="Edit" />
              <span class="hidden" id="missingmenuname">Please Enter Name</span>
             </div>
             
            <!-- Print the current menu structure-->
<div id="menustructure"> 
<div class="dd" id="nestable">
<ol class="dd-list" id="webmenus">
<?php
$count = count($categories);
if($count>0){

if ($count == 1) {
  //  echo '<li>', $categories[0]['name'], '</li>', "\n";
	?>
    
    <li class="dd-item" data-label="<?php echo $categories[0]['name'];?>" data-id="<?php echo $categories[0]['id'];?>" data-link="<?php echo $categories[0]['link'];?>" data-cls="<?php echo $categories[0]['class'];?>">
                    <div class="dd-handle"><?php echo $categories[0]['name'];?></div> <span class="nestleeditd fa fa-pencil"></span> <span class="nestledeletedd fa fa-trash"></span>
                </li>
                
    <?php
} else {
    $i = 0;
    while (isset($categories[$i])) {
       // echo '<li>', $categories[$i]['name'];
		?>
        
         <li class="dd-item" data-label="<?php echo $categories[$i]['name'];?>" data-id="<?php echo $categories[$i]['id'];?>" data-link="<?php echo $categories[$i]['link'];?>" data-cls="<?php echo $categories[$i]['class'];?>"><div class="dd-handle"><?php echo $categories[$i]['name'];?></div>  <span class="nestleeditd fa fa-pencil"></span> <span class="nestledeletedd fa fa-trash"></span>
        <?php
        if ($i < $count - 1) {
            if ($categories[$i + 1]['level'] > $categories[$i]['level'])
            {
                ?><ol class="dd-list"><?php
            }
            else {
               ?>
               </li>
               <?php
            }
            if ($categories[$i + 1]['level'] < $categories[$i]['level']) {
                echo str_repeat('</ol></li>' . "\n",
                                $categories[$i]['level'] - $categories[$i + 1]['level']);
            }
        } else {
            echo '</li>', "\n";
            echo str_repeat('</ol></li>' . "\n", $categories[$i]['level']);
        }
    $i++;
    }
}
?>

<?php

}

?>
</ol>
        <script src="<?php echo base_url();?>assets/js/jquery.nestable.js"></script>
        <script src="<?php echo base_url();?>assets/js/navmenu.js"></script>
        <script>
		$(document).ready(function(){
		var working=$('#generate');
		working.html('');
		var updateOutput = function(e)
    {
        var list   = e.length ? e : $(e.target),
            output = list.data('output');
        if (window.JSON) {
            return (window.JSON.stringify(list.nestable('serialize')));//, null, 2));
        } else {
           
		   return false;
        }
    };
	
	$('#nestable').nestable();
	
	
 $("#savenavmenus").click(function() {
     //clicked Save menu button. Send POST request to Navmenus to save the structure to database and menu.php
    
 //send the requests now
    var structure=updateOutput($('#nestable').data('output', $('#generate')));

//
if(structure==false){
alert('Your browser is old');
return false;
}
 working.html('');

  
  var postForm = { //Fetch form data
            's':structure, 
			'<?php echo $this->security->get_csrf_token_name();?>': '<?php echo $this->security->get_csrf_hash();?>'
        };
working.html('<img src="<?php echo base_url();?>/assets/img/loading24.gif"/>');
       $.ajax({
                type: "POST",
                url: "<?php echo base_url();?>navmenus/producemenus",
               
                data: postForm,
                dataType : "json",
                cache: "false",
                success: function (result) {
				
                    //remove it
					if(result=='1'){
					working.html('<?php echo $this->lang->line("biz_admin_menus_saved");?>');
					}
					
					else {
					working.html('<?php echo $this->lang->line("biz_admin_menus_savedno");?>');
					}
                },
				fail: function (result){
				working.html('<?php echo $this->lang->line("biz_admin_server_err");?>');
				}
				
				
            });
  
	working.html('');
	});
	
	});
</script>
 
