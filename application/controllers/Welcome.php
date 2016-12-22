<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Doctrine\Common\Collections\ArrayCollection;

class Welcome extends BuyerBaseController {
	public $em;
	function __construct(){
		parent::__construct();
		$this->load->library('doctrine');
		$this->load->library('Dx');
		$this->em = $this->doctrine->em;
	}

	public function index()
	{
		echo 'welcome';
	}
}
