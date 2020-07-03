<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SpaceSys extends CI_Model
{
  public function whoIsCreator($quizzId){
    $this->db->select('email');
    $this->db->from('prof P,quizz Q');
    $this->db->where('P.id=Q.createur AND Q.id =',$quizzId);
    $loadedData = $this->db->get();

    return $loadedData;
  }


  public function whatIsMyUserId($session_data){
    $this->db->select('id');
    $this->db->from('prof');
    $this->db->where('email',$session_data);
    $loadedData = $this->db->get();

    return $loadedData;

  }

  public function moyenneQuizz($quizzId){
    $this->db->select('AVG(score) as moy');
    $this->db->from('score');
    $this->db->where('relatedQuizz=',$quizzId);
    $query = $this->db->get();

    foreach ($query->result() as $row)
    {
        $moyenne = $row->moy;
    }


    return $moyenne;

  }


  public function whatIsTheQuizzName($quizzId){

    $this->db->select('intitule');
    $this->db->from('quizz');
    $this->db->where('id =',$quizzId);
    $loadedData = $this->db->get();

    foreach ($loadedData->result_array() as $row) {
      $QuizzName =  $row['intitule'];
    }

    return $QuizzName;

  }


  public function setQuizz($id, $intitule, $userId, $illustration, $etat){

    $my_data = array(
        'id' => null,
        'intitule' => $intitule,
        'createur' => $userId,
        'illustration' => $illustration,
        'etat' => 0
      );

    $this->db->insert('quizz', $my_data);
  }


  public function getQuizzFromUser($userId){

    $this->db->select('*');
    $this->db->from('quizz');
    $this->db->where('createur =',$userId);
    $loadedData = $this->db->get();

    return $loadedData;
  }

  public function getQuizzState($quizzId){

    $this->db->select('etat');
    $this->db->from('quizz');
    $this->db->where('id =',$quizzId);
    $loadedData = $this->db->get();

    foreach ($loadedData->result_array() as $row) {
      $QuizzState =  $row['etat'];
    }

    return $QuizzState;
  }

  public function setQuizzState($quizzId, $newState){

    $my_data = array(
        'etat' => $newState
      );

      $this->db->where('id', $quizzId);
      $this->db->update('quizz', $my_data);

  }


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


  public function newQuestion($intitule, $Qid){

    $my_data = array(
        'id' => null,
        'intitule' => $intitule,
        'ConQuizz' => $Qid
      );

    $this->db->insert('question', $my_data);

    $insert_id = $this->db->insert_id();

    return  $insert_id;
  }


  public function newReponse($intitule, $relatedQuest, $bool){

    $my_data = array(
        'id' => null,
        'intitule' => $intitule,
        'relatedQ' => $relatedQuest,
        'isTrue' => $bool
      );

    $this->db->insert('reponse', $my_data);
  }
}
