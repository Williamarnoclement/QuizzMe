<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $this->load->library('javascript');
    $this->load->library('form_validation');
    $this->load->library('email');
    $this->load->library('session');
    $this->load->helper('url');
  }

  public function index()
  {
    $this->load->view('Header');
    $this->displayForm();
    $this->load->view('Footer');

  }

  public function reIndex()
  {
    $this->load->view('Header');
    print_r ("email déjà existant...");
    $this->displayForm();
    $this->load->view('Footer');

  }

  private function displayForm()
  {
    $this->load->view('SignUpPage');
  }

  public function SignUp(){

    $email = $this->input->post('email');

    $password = $this->input->post('password');


    $name = $this->input->post('name');


    $this->load->model('AccountSys', 'Sys_');

    $nameCheckQuery = $this->Sys_->checkEmailAlreadyExists($email);



    if ($nameCheckQuery->num_rows() > 0){
        //email déjà utilisé
        redirect('Registration/reIndex/', 'refresh');
        exit();
    }
    else{
        //echo "false";
    }

    //echo("super hero");

    //add user to table



    $salt = "\$5\$rounds=5000\$" ."gillsforprem" . $email . "\$";

    $hash = crypt($password, $salt);

    //echo $username;

    //$insertuserquery = "INSERT INTO players (username,hash,salt) VALUES ('$username','$hash','$salt')";




    //$this->db->query("INSERT INTO prof (email,name,hash,salt) VALUES ('$email','$name','$hash','$salt')") or die("deuxieme injection sql a echouee");


    $this->Sys_->registering($email, $name, $hash, $salt);


    //echo ("Inscription réussie");


    redirect('Login', 'refresh');



  }

}
