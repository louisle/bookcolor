<?php
/**
* 
*/
defined('BASEPATH') OR exit('No direct script access allowed');

use Doctrine\Common\Collections\ArrayCollection;

class BlogController extends BuyerBaseController
{
	public $em;
	function __construct()
	{
		parent::__construct();
		$this->load->library('doctrine');
		$this->em = $this->doctrine->em;
	}

	public function index(){
		$this->loadView('blog');
	}
}
?>