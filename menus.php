<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

 <div class="content-wrapper">
 
    <section class="content-userer">
      <h1>
       <?php echo langline('menus');?>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          

          <div class="box">
          
            <!-- /.box-userer -->
            <div class="box-body">
            <?php
      echo form_open('#',array(),array(),'frmmenus');
	  echo form_close();
	      ?>
          
            <span id="generate" style="color:#FF0000; font-weight:bold;"></span> &nbsp;&nbsp;<input type="button" id="deleteallmenus" class="btn bg-red pull-right" value="<?php echo langline('menusGenerateClearAllMenus');?>"/> <input type="button" id="deletecurrentmenus" class="btn bg-red pull-right" value="<?php echo langline('menusGenerateClearCurrentMenus');?>"/> <input type="button" id="savenavmenus" class="btn bg-orange pull-right" value="<?php echo langline('menusGenerate');?>"/>
           <div style="width:100%; height:2px; clear:both;">&nbsp;</div>
           
   
           <div class="row">
           <div class="col-xs-4">
           
            <div id="menulocations">
             <select id="menu_locations" class="form-control">
           
            <option value="101"><?php echo langline('menusLocationTopLeft');?></option>
             <option value="102"><?php echo langline('menusLocationTopRight');?></option>
              <option value="103"><?php echo langline('menusLocationTopNavBar');?></option>
               <option value="104"><?php echo langline('menusLocationBottomNavBar');?></option>
                <option value="105"><?php echo langline('menusLocationBottomEnd');?></option>
           
            </select> 
          
            </div>
            
            <div>
             
             
               <select id="menu_languages" class="form-control">
              
			  <option value="english">English</option>
              <option value="it">Italian</option> 
              <option value="nl">Dutch</option>
                 </select>
                 
                 <button class="btn bg-blue" id="btn_showmenu"><?php echo langline('menusShowMenus');?></button>
                 <span class="spinloadstrucute"></span>
                 <p>&nbsp;</p>
                 
                  <div id="menusources">
  
  <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab"><?php echo langline('menusSourceGeneral');?></a></li>
              <li><a href="#tab_2" data-toggle="tab"><?php echo langline('menusSourceContent');?></a></li>
      
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
              
  
              <select id="menu_target" class="form-control ">
              <option value="#"><?php echo langline('menusSourceGeneralNone');?></option>
              <option value="<?php echo base_url();?>"><?php echo langline('menusSourceGeneralHome');?></option>
              <option value="<?php echo base_url('about');?>about"><?php echo langline('menusSourceGeneralAbout');?></option>
              <option value="<?php echo base_url('contact');?>"><?php echo langline('menusSourceGeneralContact');?></option>
              <option value="<?php echo base_url('team');?>"><?php echo langline('menusSourceGeneralExperts');?></option>
              <option value="<?php echo base_url('gallery');?>"><?php echo langline('menusSourceGeneralGallery');?></option>
              
              </select>
                             <br/>
                <input type="button" class="btn btn-theme addtonavmenu" value="<?php echo $this->lang->line('menusAddToStructure');?>" />
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
              <input type="text" class="form-control" id="quicksearchcontent"/>
              <span class="spinquicksearchcontent"></span>
              
              <div class="searchcontentresult navmenucontentzone"></div>
              
              
              
              </div>
             
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
    
             </div>
    
            
            
            </div>
            
          
           </div>
           
           <div class="col-xs-8">
           
          <div id="menustructure"> 
<div class="dd" id="nestable">
<ol class="dd-list" id="webmenus">

</ol>
</div>
</div>

           </div>
           
           </div>
          
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          
          
            <!-- /.box-body -->
          </div>
          
          
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>


 <script src="<?php echo currentlanguagefolder();?>navmenu_lang.js"></script>
<script src="<?php echo currentjsfolder();?>navmenu.js"></script>
<script src="<?php echo currentpluginsfolder();?>nestle/jquery.nestable.js"></script>

      
        <script>
		$(document).ready(function(){
	
		$('#generate').html('');
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
	
	$('#nestable').nestable({maxDepth:4});
	
	
 $("#savenavmenus").click(function() {
     
    
 //send the requests now
    var structure=updateOutput($('#nestable').data('output', $('#generate')));

//
if(structure==false){
showalert('error',languages_navmenu['oldbrowser']);
return false;
}

var loc=$('#menu_locations').val();
var lang=$('#menu_languages').val();
var postForm=$('#frmmenus').serialize()+'&loc='+loc+'&lang='+lang+'&s='+structure;

		
$('#generate').html(languages_navmenu['processing']);
       $.ajax({
                type: "POST",
                url: SiteRoot+"admin/navmenus/producemenus",
               
                data: postForm,
                dataType : "json",
                cache: "false",
                success: function (result) {
			
                    //remove it
					if(result=='1'){
					//success
					nestlelistchanged=false;
					$('#generate').html(languages_navmenu['saved']);
					}
					
					else {
						$('#generate').html(languages_navmenu['nosaved']);
					}
                },
				fail: function (result){
				showalert('error',languages_navmenu['servererror']);
				}
				
				
            });
  
		
	});
	$('#generate').html('');
	});
</script>
 

</div>             
             
             
             </div>
             
                     
                 
                           </div>
                      
                      <hr />
   
		</section><! --/wrapper -->
      </section><!-- /MAIN CONTENT -->