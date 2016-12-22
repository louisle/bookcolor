<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class BuyerBaseController extends MY_Controller{

  const THEMEDIR = "buyer/themes/";

  public $alias = 'home';

  function __construct(){
    parent::__construct();
    $this->load->library('doctrine');
    $this->em = $this->doctrine->em;
    $this->load->model('site');
  }

  public function loadView($page, $data = array()){
    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
      // header('Content-Type: application/json');
      // echo json_encode($data);
    }else{
      $domain = $this->parseDomain();
      $SITE = $this->site->getOne($domain);
      if(!$SITE){
        $this->load->view('404');
      }
      
      $themeDir = self::THEMEDIR . $SITE->theme->directory . "/";

      $this->buildScripts($themeDir);
      die();

      $masterPage =  $themeDir . "layout";

      $_data = $data;

      $_data['alias'] = $this->alias;
      
      $_data['title'] = isset($data['title'])?$data['title']:$SITE->theme->default_title;

      $_data['page'] = $themeDir . "pages/" . $page;


      $this->load->view($masterPage, $_data);
    }
    $this->em->getConnection()->close();
  }
  public function parseDomain(){
    return $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'];
  }
  public function buildScripts($themeDir){
    print_r(parse_ini_file(APPPATH."views/" . $themeDir . "scripts.php"));
    // $scripts =$this->load->view($themeDir . "scripts");
  }
  public function buildStyles($themeDir){
    
  }
  public function _404(){
    $this->load->view('404');
  }
}