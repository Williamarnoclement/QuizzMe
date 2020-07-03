<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {

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
    $eleve = $this->input->post('nomPrenom');
    $code = $this->input->post('codeQuizz');

    if (empty($eleve)) {
      echo "Qui êtes vous ?";
      exit();
    }
    if (empty($code)) {
      echo "Quel Quizz voulez-vous résoudre ?";
      exit();
    }

    $this->load->model('StudentSys', 'Sys_');

    $data['eleve'] = $eleve;
    $data['code'] = $code;

    $loadedData =$this->Sys_->getQuestFromQuizz($code);
    $QuizzInfo = $this->Sys_->getQuizzInfo($code);




    foreach ($QuizzInfo->result_array() as $row) {
      $data['illustration'] = $row['illustration'];
      $data['intitule'] = $row['intitule'];
      $etat = $row['etat'];
    }
    if ($etat != 1) {
      echo "Quizz expiré ou en préparation...";
      exit();
    }

    foreach ($loadedData->result_array() as $val) {
      if (!empty($val['intitule'])) {
        $question_ = $val['intitule'];
      } else if(empty($val['intitule'])) {
        $question_ = 'Question non nommée';
      }
      $loadedAnswer = $this->Sys_->getAnswersFromQuest($val['id']);
      $i = 0;
      foreach ($loadedAnswer->result_array() as $val2) {
        if (!empty($val2['intitule'])) {
          $reponse_[$i] = $val2['intitule'];
        }else{
          $reponse_[$i] = 'réponse vide';
        }
        $i++;
      }

      $data['mega'][] = (object) array('question' => $question_ ,
      'rep1' => $reponse_[0],
      'rep2' => $reponse_[1],
      'rep3' => $reponse_[2],
      'rep4' => $reponse_[3], );
    }


    $this->load->view('Header');
    $this->load->view('Resoudre', $data);
    $this->load->view('Footer');

  }


  public function Reponses($code, $nomEleve){

    $i = 0;
    $go;

    if(isset($_POST['submit'])){
      if(!empty($_POST['check_list'])) {
        $checked_count = count($_POST['check_list']);
        //echo "Vous avez selectionné le nombre d'options suivant : ".$checked_count."<br/>";
        foreach($_POST['check_list'] as $selected) {
          //echo "<p>".$selected ."</p>";
          $go[$i] = $selected;
          //echo "<p>".$go[$i]."</p>";
          $i++;
        }
      }
    }
    //echo "______";
    $this->load->model('StudentSys', 'Sys_');
    $loadedData =$this->Sys_->getQuestFromQuizz($code);
    $i = 0;
    $j = 0;
    $nombre_questions = 0;
    foreach ($loadedData->result_array() as $val) {
      $loadedAnswer = $this->Sys_->getAnswersFromQuest($val['id']);
      $nombre_questions++;
      foreach ($loadedAnswer->result_array() as $val2) {
        if ($val2['isTrue'] == 1) {
          $og[$j] = $i;
          //echo "<p>".$og[$j]."</p>";
          $j++;
        }
        $i++;
      }

    }

    $result = array_intersect($go, $og);

    //print_r($result);
    $bonnes_reponses = count($result);
    $total_reponses = count($og);

    $score = $bonnes_reponses/$total_reponses;
    //$this->Sys_->setScore($score, $code, $nomEleve);

    //return redirect()->to('Welcome');

    $data['cle_correction'] = $this->Sys_->setScore($score, $code, $nomEleve);

    $this->load->view('Header');
		$this->load->view('Content', $data);
		$this->load->view('Footer');

  }
}
