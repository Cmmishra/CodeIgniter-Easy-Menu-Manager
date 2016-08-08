// JavaScript Document for Nav Menu
/*Author: KM Sium (kmsium@gmail.com)
Description: This is added from menus.php (view) to manage the resetting of existing menus to their original values, creating new menu items, editing menu items.
*/
							
$(document).ready(function(){
						   
    var editmenu="";

	
	function reseteditmenu(){
	//reset edit menu
	editmenu="";
	$('#mname').val('');
	$('#mtarget').val('');
	$('#mclass').val('');
	}
	
	$(document).on('click','.nestleeditd', function(){
    editmenu=$(this);
	var info=editmenu.closest("li");
	var mname=info.attr('data-label');
	var mlink=info.attr('data-link');
    var mclass=info.attr('data-cls');
    $('#mname').val(mname);
	$('#mtarget').val(mlink);
	$('#mclass').val(mclass);
});
	
	$(document).on('click','.nestledeletedd', function(){
 reseteditmenu();
	$(this).closest("li").remove();
});
	

	  
	   $('.updatenavmenu').click(function(e){
												if(editmenu==""){return false;}
											
											//edit the menu
											var mname=$('#mname').val().trim();
											var mtarget=$('#mtarget').val().trim();
											var mclass=$('#mclass').val().trim();
                                             if(mname==""){
												$('#missingmenuname').removeClass("hidden");
												$('#missingmenuname').addClass("show");
												return false;
											 }
											 
											 var info=editmenu.closest("li");
											 info.attr('data-label', mname);
											 info.attr('data-link', mtarget);
											 info.attr('data-cls', mclass);
											 info.find("div:first").html(mname);
											//$(this).find("td").eq(1).text(moleorder);
															// editmenu.closest("li").find("div span.mlabel").html(mname);
															  
															 });
							
							
							                     
												 $('#mname').change(function(e){
													
												if(editmenu=="")
												{
													return false;
												}
												
												if($('#mname').val().trim()==''){
													$('#missingmenuname').removeClass("hidden");
												$('#missingmenuname').addClass("show");
												}
												
												else{
													$('#missingmenuname').removeClass("show");
												$('#missingmenuname').addClass("hidden");
												}
											
															 });
	 
	$('.addtonavmenu').click(function(e){
											  reseteditmenu();
											  var menu=$('#menu_target option:selected').val();
											  var menuname=$('#menu_target option:selected').text();
						   $('#webmenus').append('<li class="dd-item" data-id="0" data-link="'+menu+'" data-label="'+menuname+'" data-cls=""><div class="dd-handle">'+menuname+'</div> <span class="nestleeditd fa fa-pencil"></span> <span class="nestledeletedd fa fa-trash"></span></li>');
						   $('#nestable').nestable();
										    
										   });
	
							   });
						