<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AccountSys extends CI_Model
{
	public function checkEmailAlreadyExists($email)
	{
    $this->db->select('email');
    $this->db->from('prof');
    $this->db->where('email',$email);
    $nameCheckQuery = $this->db->get();

    return $nameCheckQuery;
	}

  public function registering($email, $name, $hash, $salt){

    $my_data = array(
        'email' => $email,
        'name' => $name,
        'hash' => $hash,
        'salt' => $salt
      );

    $this->db->insert('prof', $my_data);

  }


  public function getLoginInfo($email){

    $namecheckquery = "SELECT email, salt as salt, hash as hash FROM prof WHERE email = '$email'";

    $namecheck = $this->db->query($namecheckquery);

    return $namecheck;
  }
}
