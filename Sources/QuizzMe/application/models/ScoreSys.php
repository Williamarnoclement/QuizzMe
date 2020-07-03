<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ScoreSys extends CI_Model
{

  public function getQuestFromQuizz($QuizzId){

    $this->db->select('*');
    $this->db->from('question');
    $this->db->where('ConQuizz =',$QuizzId);
    $loadedData = $this->db->get();

    return $loadedData;
  }

  public function getAnswersFromQuest($QuestId){

    $this->db->select('*');
    $this->db->from('reponse');
    $this->db->where('relatedQ =',$QuestId);
    $loadedData = $this->db->get();

    return $loadedData;
  }

  public function getQuizzInfo($quizzId){

    $this->db->select('intitule, illustration, etat');
    $this->db->from('quizz');
    $this->db->where('id =',$quizzId);
    $loadedData = $this->db->get();


    return $loadedData;
  }

  public function getCodeQuizzFromScore($scoreId){

    $this->db->select('relatedQuizz');
    $this->db->from('score');
    $this->db->where('id =',$scoreId);
    $loadedData = $this->db->get();

    foreach ($loadedData->result_array() as $row) {
      $dataGo = $row['relatedQuizz'];
    }

    return $dataGo;
  }



  public function getUserNameFromScore($scoreId){

    $this->db->select('nomEleve');
    $this->db->from('score');
    $this->db->where('id =',$scoreId);
    $loadedData = $this->db->get();

    foreach ($loadedData->result_array() as $row) {
      $dataGo = $row['nomEleve'];
    }

    return $dataGo;
  }


  public function getResultFromScore($scoreId){

    $this->db->select('score');
    $this->db->from('score');
    $this->db->where('id =',$scoreId);
    $loadedData = $this->db->get();

    foreach ($loadedData->result_array() as $row) {
      $dataGo = $row['score'];
    }

    return $dataGo;
  }
}
