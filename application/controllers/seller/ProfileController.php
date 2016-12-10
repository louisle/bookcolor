<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ProfileController extends SellerBaseController{

	function __construct(){
		parent::__construct();
      	$this->load->model("logs");
	}

	public function index(){
		$reward = [];
	    $this->load->model('reward');
	    $rewards = $this->reward->filter(array(
    	'uid'=>$this->session->cu->id
    	));
    // echo "<pre/>";
    // echo json_encode($reward);
		$data = array(
			'user'=>$this->session->cu,
			'author'=>TRUE,
			'activities'=> $this->logs->getByUser($this->session->cu->id),
			'rewards'=>$rewards
		);
		$this->loadView('profile', $data);
	}
}