<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contentsearch extends CI_Controller {

	/*
	 * Search all contents of the website by title. Here it is dummy array.
	 * Aim: for getting ids and titles of all content of the application, for example when builing menu structure
	 * Security: Implement Your Own
	 *
	 * Maps to the following URL
	 * 		http://www.biz.biz/admin/Contentsearch
	 * This 
	 */
	 
	 //what are the details of the current logged in admin?
	
	 public function __construct(){
	 //build constrctor.
	   parent::__construct();
	  


	 }
	 
	public function index()
	{
	
header('Location:'.base_url());exit;
	
	}
	
//-------------------------------------

function basic($title){
//search titles and ids. This is ajax
if(!$title){echo json_encode(array());exit;}
$data = array(array("rowid"=>1,"route"=>base_url("animals/tiger"),"rowtitle"=>"Tigers","alias"=>"Wild Animals"),array("rowid"=>2,"route"=>base_url("animals/elephant"),"rowtitle"=>"Elephants","alias"=>"Wild Animals"),array("rowid"=>4,"route"=>base_url("animals/panda"),"rowtitle"=>"Pandas","alias"=>"Wild Animals"),array("rowid"=>8,"route"=>base_url("animals/monkey"),"rowtitle"=>"Monkeys","alias"=>"Wild Animals"));

//print_r($result);

echo json_encode($data);


}

	
}
