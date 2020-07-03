<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MySpace extends CI_Controller {

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

	public function index()
	{
		$session_data = $this->session->userdata('session_email');
		if (!$session_data) {
			//echo "string";
			return redirect()->to('Login');
		} else if($session_data) {
			$this->load->view('Header');
			$data['session_data'] = $session_data;

			$data['quizz_data'] = $this->loadQuizz($session_data);
			$this->load->view('MesQuizz',$data);
			$this->load->view('Footer');
		}


	}



	public function switchState($quizzId){

		$session_data = $this->session->userdata('session_email');
		if (!$session_data) {
			return redirect()->to('MySpace');
		} else if($session_data) {
			//user a verifier

			$this->load->model('SpaceSys', 'Sys_');

			$trueQuizzCreator = $this->Sys_->whoIsCreator($quizzId);

			$session_data = $this->session->userdata('session_email');
			foreach ($trueQuizzCreator->result_array() as $row) {
				$trueQuizzCreator_ =  $row['email'];
			}
			if ($session_data != $trueQuizzCreator_) {

				//echo "Vous n'êtes pas le créateur du quizz...";
				redirect('MySpace', 'refresh');

				exit();
			}
			//ici, on sait que l'utilisateur est le créateur.
			//getQuizzState()

			$Qstate = $this->Sys_->getQuizzState($quizzId);

			//SetQuizzState()
			if ($Qstate == 0) {
				// Quizz en préparation
				$this->Sys_->setQuizzState($quizzId,1);
			} else if ($Qstate == 1) {
				// Quizz valide
				$this->Sys_->setQuizzState($quizzId,2);
			} else if ($Qstate == 2) {
				// Quizz Expiré
				$this->Sys_->setQuizzState($quizzId,1);
			}
			redirect('MySpace', 'refresh');
		}
	}

	private function loadQuizz($session_data){
		//debut
		$this->load->model('SpaceSys', 'Sys_');
		$request = $this->Sys_->whatIsMyUserId($session_data);

		foreach ($request->result_array() as $row) {
			$userId =  $row['id'];
		}
		//fin


		 return $this->Sys_->getQuizzFromUser($userId);
	}


	public function create(){
		$nomQuizz = $this->input->post('nomQuizz');

		if(empty($nomQuizz)){

			//chaine vide.
			return redirect()->to('admin/MySpace');

		} else {
			$data['nomQuizz'] = $nomQuizz;

			$this->load->view('Header');
			$this->load->view('newQuizz',$data);
			$this->load->view('Footer');
		}

	}

	public function quizzManager($idQuizz){

		if (empty($idQuizz)) {
			redirect('MySpace', 'refresh');
		}

		$this->load->model('SpaceSys', 'Sys_');

		$trueQuizzCreator = $this->Sys_->whoIsCreator($idQuizz);

		$session_data = $this->session->userdata('session_email');
		foreach ($trueQuizzCreator->result_array() as $row) {
			$trueQuizzCreator_ =  $row['email'];
		}
		if ($session_data != $trueQuizzCreator_) {

			//echo "Vous n'êtes pas le créateur du quizz...";
			redirect('MySpace', 'refresh');

			exit();
		}
		//on récupère les infos sur le quizz
		$data['nomQuizz'] = $this->Sys_->whatIsTheQuizzName($idQuizz);
		$data['currentId'] = $idQuizz;
		//on récupère les questions / réponses
		$loadedData =$this->Sys_->getQuestFromQuizz($idQuizz);

		$data['moyenne'] = $this->Sys_->moyenneQuizz($idQuizz);


		//$data['question'] = $loadedData;

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





		//$AnswerData = $this->Sys_->getQuestFromQuizz($row['id']);


		$this->load->view('Header');
		$this->load->view('qQuestions',$data);
		$this->load->view('Footer');

	}


	public function addQA($myQuizzId){

		$question = $this->input->post('question');

		$r_uno = $this->input->post('reponse1');
		$v_uno = $this->input->post('options1');

		$r_dos = $this->input->post('reponse2');
		$v_dos = $this->input->post('options2');


		$r_tres = $this->input->post('reponse3');
		$v_tres = $this->input->post('options3');

		$r_quatro = $this->input->post('reponse4');
		$v_quatro = $this->input->post('options4');


		$this->load->model('SpaceSys', 'Sys_');
		$idQuestion = $this->Sys_->newQuestion($question, $myQuizzId);

		$this->Sys_->newReponse($r_uno, $idQuestion, $v_uno);
		$this->Sys_->newReponse($r_dos, $idQuestion, $v_dos);
		$this->Sys_->newReponse($r_tres, $idQuestion, $v_tres);
		$this->Sys_->newReponse($r_quatro, $idQuestion, $v_quatro);


		redirect('MySpace', 'refresh');

	}



	public function launch(){

		$this->load->model('SpaceSys', 'Sys_');

		$config['upload_path']          = './uploads/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 1000;
		$config['max_width']            = 1024;
		$config['max_height']           = 768;

		$intitule = $this->input->post('intitule');

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('imageFile'))
		{

			//echo "Erreur de telechargement de l'image...";
			//$error = array('error' => $this->upload->display_errors());
			//echo $error['error'];

			$upload_path = $this->upload->data('full_path');

			//id	intitule	createur	illustration	etat
			$session_data = $this->session->userdata('session_email');

			$request = $this->Sys_->whatIsMyUserId($session_data);

			foreach ($request->result_array() as $row) {
				$userId =  $row['id'];
			}

			$this->Sys_->setQuizz(null, $intitule, $userId, "", 0);
		}
		else
		{
			$upload_path = $this->upload->data('full_path');

			//echo "Telechargement de l'image réussie !";

			//id	intitule	createur	illustration	etat
			$session_data = $this->session->userdata('session_email');

			$request = $this->Sys_->whatIsMyUserId($session_data);

			foreach ($request->result_array() as $row) {
				$userId =  $row['id'];
			}

			$this->Sys_->setQuizz(null, $intitule, $userId, $upload_path, 0);
		}

		redirect('MySpace', 'refresh');


	}
}
