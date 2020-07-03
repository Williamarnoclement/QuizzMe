<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Deco extends CI_Controller
{

  public function __construct(){
    parent::__construct();
    $this->load->library('javascript');
    $this->load->library('form_validation');
    $this->load->library('email');
    $this->load->library('session');
    $this->load->helper('url');
    $this->load->helper(array('form', 'url'));
    $this->load->helper('form');
  }


  public function index(){
    $this->session->sess_destroy();
    redirect('Welcome','refresh');
  }

}
