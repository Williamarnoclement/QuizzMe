<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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

		$session_data = $this->session->userdata('session_email');
		if (!$session_data) {
			$this->load->view('Header');
			$this->displayForm();
			$this->load->view('Footer');
		} else if($session_data) {
			return redirect()->to('MySpace');
		}


	}

	private function displayForm()
	{
		$this->load->view('LoginPage');
	}

	public function go() {
		$data = array(
			'user_name' => $this->input->post('email'),
		);

		// Show submitted data on view page again.
		$this->load->view("LoginPage", $data);
	}

	public function run(){

		//$current_email = $this->input->post('email');

		//$query = $this->db->query("SELECT email, hash from prof where email='$current_email'");

		/**if ($query)
		{
		echo "Success!";
	}
	else
	{
	echo "Query failed!";
}**/


$email = $this->input->post('email');

$password = $this->input->post('password');

if (empty($email)){ echo "Veuillez entrer un nom d'utilisateur"; exit();}

$this->load->model('AccountSys', 'Sys_');
$namecheck = $this->Sys_->getLoginInfo($email);

//$namecheckquery = "SELECT email, salt as salt, hash as hash FROM prof WHERE email = '$email'";
//echo $namecheckquery;

//$namecheck = mysqli_query($con, $namecheckquery) or die("2: name check query failed");


//$existinginfo=$namecheck->result_array();
if(isset($namecheck))  {

	foreach ($namecheck->result_array() as $existinginfo) {

		$salt=$existinginfo["salt"];
		$hash=$existinginfo["hash"];
		$loginhash = crypt($password, $salt);
		if($hash != $loginhash)
		{
			echo "6: incorrect password";
			return redirect()->to('admin/login');
			exit();
		}
		if($hash == $loginhash){
			//session_start ();
			// on enregistre les paramètres de notre visiteur comme variables de session ($login et $pwd) (notez bien que l'on utilise pas le $ pour enregistrer ces variables)
			//$_SESSION['session_email'] = $_POST['email'];
			$this->load->library('session');
			$this->session->set_userdata('session_email', $_POST['email']);
			//echo "gg wp";

			// on redirige notre visiteur vers une page de notre section membre

			return redirect()->to('admin/login');
		}
	}

}










}





}
