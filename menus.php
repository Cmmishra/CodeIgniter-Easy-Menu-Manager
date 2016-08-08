<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>  <section id="main-content">
          <section class="wrapper">
          	<h3><i class="fa fa-angle-right"></i> <?php echo $this->lang->line('biz_admin_navmenus');?></h3>
            <span id="generate" style="color:#FF0000; font-weight:bold;"></span> <input type="button" id="savenavmenus" class="btn btn-theme reallyclear fright" value="<?php echo $this->lang->line('biz_admin_menus_generate');?>"/> 
            
            <div style="clear:both; width:100%; height:10px;"></div>  
            
             <div class="mymenus">
             <div id="menusources">
              <select id="menu_target" class="form-control ">
                               <option value="<?php echo base_url();?>#"><?php echo $this->lang->line('biz_admin_menus_dest_none');?></option>
                              
                             <option value="<?php echo base_url();?>home"><?php echo $this->lang->line('biz_admin_menus_dest_home');?></option>
                             <option value="<?php echo base_url();?>about"><?php echo $this->lang->line('biz_admin_menus_dest_about');?></option>
                            <?php
							 if(!empty($aboutus)){
						
							 foreach($aboutus as $abtinfo){
							 
							$aid=$this->switcher->hideme($abtinfo['hpid']);
							$aname=stripslashes($abtinfo['hptitle']);
							
							 ?>
                              <option value="<?php echo base_url();?>about/more/<?php echo $aid;?>"><?php echo " &nbsp;&nbsp;&nbsp;&nbsp;".$aname;?></option>
                             <?php
							 }
							 }
							 ?>
                             <option value="<?php echo base_url();?>contact"><?php echo $this->lang->line('biz_admin_menus_dest_contact');?></option>
                             <option value="<?php echo base_url();?>prices"><?php echo $this->lang->line('biz_admin_menus_dest_price');?></option>                         <option value="<?php echo base_url();?>events"><?php echo $this->lang->line('biz_admin_menus_dest_events');?></option>
                             <?php
							 if(!empty($eventtypes)){
							 foreach($eventtypes as $info){
							 $aid=$this->switcher->hideme($info['eventtypeid']);
							 $aname=stripslashes($info['eventtypename']);
							 ?>
                              <option value="<?php echo base_url();?>events/cat/<?php echo $aid;?>"><?php echo " &nbsp;&nbsp;&nbsp;&nbsp;".$aname;?></option>
                             <?php
							 }
							 }
							 ?>
                             <option value="<?php echo base_url();?>experts"><?php echo $this->lang->line('biz_admin_menus_dest_experts');?></option>
                             <option value="<?php echo base_url();?>clients"><?php echo $this->lang->line('biz_admin_menus_dest_clients');?></option>
                             <option value="<?php echo base_url();?>faq"><?php echo $this->lang->line('biz_admin_menus_dest_faq');?></option>
                             <option value="<?php echo base_url();?>blogs"><?php echo $this->lang->line('biz_admin_menus_dest_blog');?></option>
                             
                              <?php
							 if(!empty($blogtypes)){
							 foreach($blogtypes as $info){
							 $aid=$this->switcher->hideme($info['blogtypeid']);
							 $aname=stripslashes($info['blogtypename']);
							 ?>
                              <option value="<?php echo base_url();?>blogs/categories/<?php echo $aid;?>/1/1"><?php echo " &nbsp;&nbsp;&nbsp;&nbsp;".$aname;?></option>
                             <?php
							 }
							 }
							 ?>
                           <option value="<?php echo base_url();?>testimonials"><?php echo $this->lang->line('biz_admin_menus_dest_testimonial');?></option>
                              <option value="<?php echo base_url();?>gallery"><?php echo $this->lang->line('biz_admin_menus_dest_gallery');?></option>
                             <?php
							 if(!empty($gallerytypes)){
							 foreach($gallerytypes as $info){
							 $gtypeid=$this->switcher->hideme($info['occassionid']);
							 $gtypename=stripslashes($info['occassionname']);
							 ?>
                              <option value="<?php echo base_url();?>gallery/cat/<?php echo $gtypeid;?>"><?php echo " &nbsp;&nbsp;&nbsp;&nbsp;".$gtypename;?></option>
                             <?php
							 }
							 }
							 ?>
							 <option value="<?php echo base_url();?>services"><?php echo $this->lang->line('biz_admin_menus_dest_services');?></option>
							 <?php
							 if(!empty($services)){
							 foreach($services as $info){
							 $serviceid=$this->switcher->hideme($info['serviceid']);
							 $serviceTitle=stripslashes($info['servicetitle']);
							 ?>
                             <option value="<?php echo base_url();?>services/detail/<?php echo $serviceid;?>"><?php echo " &nbsp;&nbsp;&nbsp;&nbsp;".$serviceTitle;?></option>
                             
                             <?php
							 }
							 }
							 
							 
							 ?>
							 <option value="<?php echo base_url();?>projects"><?php echo $this->lang->line('biz_admin_menus_dest_projects');?></option>
							 <?php
							 if(!empty($projects)){
							 foreach($projects as $info){
							 $proid=$this->switcher->hideme($info['projectid']);
							 $proTitle=stripslashes($info['projecttitle']);
							 ?>
                             <option value="<?php echo base_url();?>projects/detail/<?php echo $proid;?>"><?php echo " &nbsp;&nbsp;&nbsp;&nbsp;".$proTitle;?></option>
                             
                             <?php
							 }
							 }
							 
							 if(!empty($pages)){
							 ?>
							
							 <?php
							 foreach($pages as $info){
							 $type=$info['val'];//if 0 we are on parent page, else children pages
							 $id=$this->switcher->hideme($info['id']);
							 $proTitle=stripslashes($info['title']);
							  if($type==0){
							 ?>
                             <option value="<?php echo base_url();?>content/top/<?php echo $id;?>"><?php echo $proTitle;?></option>
                             
                             <?php
							 }
							 else {//specific page
							 $type=$this->switcher->hideme($type);
							 ?>
							 <option value="<?php echo base_url();?>content/detail/<?php echo $id;?>/<?php echo $type;?>"><?php echo " &nbsp;&nbsp;&nbsp;&nbsp;".$proTitle;?></option>
                             <?php
							 }
							 }
							 }
							 ?>
                             </select>
                             <br/>
                             <input type="button" class="btn btn-theme addtonavmenu" value="<?php echo $this->lang->line('biz_admin_menus_add');?>" />
             
             <br/><br/>
             <hr/>
             <?php echo $this->lang->line('biz_admin_menus_name');?>:<br/>
             <input type="text" class="form-control requiredfields" id="mname" name="mname" required="required" value="" maxlength="75">
              <?php echo $this->lang->line('biz_admin_menus_target');?>:<br/>
             <input type="text" class="form-control requiredfields" id="mtarget" name="mtarget" required="required" value="" maxlength="255">
             <?php echo $this->lang->line('biz_admin_menus_class');?>:<br/>
             <input type="text" class="form-control requiredfields" id="mclass" name="mclass" value="" maxlength="255">
            <br/>
              <input type="button" class="btn btn-theme updatenavmenu" value="<?php echo $this->lang->line('biz_admin_edit');?>" />
              <span class="hidden" id="missingmenuname"><?php echo $this->lang->line('biz_admin_menus_namemissing');?></span>
             </div>
             
            
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
     
    
 //send the requests now
    var structure=updateOutput($('#nestable').data('output', $('#generate')));

//
if(structure==false){
alert('<?php echo $this->lang->line("biz_admin_oldbrowser");?>');
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
                url: "<?php echo base_url();?>admin/navmenus/producemenus",
               
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
 

</div>             
             
             
             </div>
             
                     
                 
                           </div>
                      
                      <hr />
                      
           
         

		
		
		</section><! --/wrapper -->
      </section><!-- /MAIN CONTENT -->