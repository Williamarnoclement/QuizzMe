<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scoring extends CI_Controller {

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
    $scoreCode = $this->input->post('codeScore');

    if (empty($scoreCode)) {
      echo "Quel score voulez-vous consulter ?";
      exit();
    }

    $this->load->model('ScoreSys', 'Sys_');

    //$data['eleve'] = $eleve;


    $code = $this->Sys_->getCodeQuizzFromScore($scoreCode);
    $data['eleve'] = $this->Sys_->getUserNameFromScore($scoreCode);
    $data['note'] = $this->Sys_->getResultFromScore($scoreCode);


    $loadedData =$this->Sys_->getQuestFromQuizz($code);
    $QuizzInfo = $this->Sys_->getQuizzInfo($code);

    foreach ($QuizzInfo->result_array() as $row) {
      $data['illustration'] = $row['illustration'];
      $data['intitule'] = $row['intitule'];
      $etat = $row['etat'];
    }
    if ($etat == 1) {
      echo "Quizz encore en cours d'exploitation...";
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

        $estVrai[$i] = $val2['isTrue'];
        $i++;
      }



      $data['mega'][] = (object) array('question' => $question_ ,
      'rep1' => $reponse_[0],
      'rep2' => $reponse_[1],
      'rep3' => $reponse_[2],
      'rep4' => $reponse_[3],
      'b1' => $estVrai[0],
      'b2' => $estVrai[1],
      'b3' => $estVrai[2],
      'b4' => $estVrai[3], );
    }


    $this->load->view('Header');
    $this->load->view('MonScore', $data);
    $this->load->view('Footer');

  }


}
