<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class StudentSys extends CI_Model
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

  public function setScore($score, $idQuizz, $nomEleve){

    $my_data = array(
        'id' => null,
        'score' => $score,
        'relatedQuizz' => $idQuizz,
        'nomEleve' => $nomEleve
      );

    $this->db->insert('score', $my_data);

    $insert_id = $this->db->insert_id();

    return  $insert_id;

  }
}
