<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct(){
  parent::__construct();
  $this->load->library('javascript');
  $this->load->library('form_validation');
  $this->load->library('email');
  $this->load->library('session');
}

	public function index()
	{
		$this->load->view('Header');
		$this->load->view('Content');
		$this->load->view('Footer');

	}
}
