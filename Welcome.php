<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Forms controller.
	 * Aim: a controller for forms display.
	 * 
	 *
	 * Maps to the following URL
	 * 		http://www.businessname.biz/forms
	 * 
	 */
	 
	 public function __construct()
        {
                 parent::__construct();
                // Your own constructor code
			
		$this->load->helper('my_publicmenus');
	
		
        }
	public function index()
	{
	
     $this->load->view('public/welcome');
	}
	
	
	
	//-------------------------------------------------------------------
	
}
