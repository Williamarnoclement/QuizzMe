<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>QuizzMe</title>
  <link rel="stylesheet" type="text/css" href="<?php $this->load->helper('url'); echo base_url(); ?>frameworks/material.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="<?php $this->load->helper('url'); echo base_url(); ?>frameworks/material.min.js"></script>
  <style>
    .page-content{
      max-width: 900px;
      width:90%;
      margin-left: auto;
      margin-right: auto;
      margin-top: 90px;
    }

    body{
      background-color: #3f51b5;
    }
  </style>

<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>




    <!-- CECI EST LE CORPS DE NOTRE HEADER -->
    <!-- Always shows a header, even in smaller screens. -->
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
      <header class="mdl-layout__header">
        <div class="mdl-layout__header-row">
          <!-- Title -->
          <span class="mdl-layout-title">QuizzMe</span>
          <!-- Add spacer, to align navigation to the right -->
          <div class="mdl-layout-spacer"></div>
        </div>
      </header>
      <div class="mdl-layout__drawer">
        <span class="mdl-layout-title">QuizzMe</span>
        <nav class="mdl-navigation">
          <a class="mdl-navigation__link" href="<?php echo site_url('Welcome') ?>">Accueil</a>
					<!--<a class="mdl-navigation__link"href="<?php
					$this->load->library('session');
					$session_data = $this->session->userdata('session_email');
					if (!$session_data) {
						echo site_url('Registration');
					} else if($session_data) {
						echo  site_url('MySpace');
					}
					?>"><?php
					if (!$session_data) {
						echo "Inscription";
					} else if($session_data) {
						echo $this->session->userdata('session_email');
					}
					?></a>-->
					<?php if ($session_data) {
						echo "<a class='mdl-navigation__link'href=";
						echo  site_url('Deco');
						echo "> Deconnexion</a>";
					} else {
						echo "<a class='mdl-navigation__link'href=";
						echo  site_url('Registration');
						echo "> Inscription</a>";
						echo "<a class='mdl-navigation__link'href=";
						echo  site_url('Login');
						echo "> Connexion</a>";
					}?>

          <a class="mdl-navigation__link" href="">A propos</a>
        </nav>
      </div>
      <main class="mdl-layout__content">
        <div class="page-content"><!-- Your content goes here -->
