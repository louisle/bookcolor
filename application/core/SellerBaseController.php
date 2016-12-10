<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SellerBaseController extends MY_Controller{
  const LOG_TARGET_TYPE_ORDER = 1;
  const LOG_TARGET_TYPE_ORDER_DETAIL = 2;
  const LOG_TARGET_TYPE_COMMENT = 3;

  const LOG_ACTION_TYPE_ADD = 1;
  const LOG_ACTION_TYPE_DELETE = 2;
  const LOG_ACTION_TYPE_EDIT = 3;
  const LOG_ACTION_TYPE_LOGIN = 4;
  const LOG_ACTION_TYPE_ASSIGN = 5;

  const PRICE_BANNER = 139000;
  const PRICE_PAID_DESIGN = 50000;

  public $alias = 'home';

  function __construct(){
    parent::__construct();
    $this->load->library('doctrine');
    $this->em = $this->doctrine->em;

    if(!$this->checkLogin()){
      // $this->showLogin();
      // return;
      if($_SERVER['REQUEST_URI'] !== "/admin/login"){
        $this->session->set_userdata('redirect_affter_login', $_SERVER['REQUEST_URI']);
        redirect("/admin/login");
      }
    }
  }
  public function setNotify($notify){
    $notifies = $this->session->msgs ? $this->session->msgs : [];
    $notifies[] = $notify;
    $this->session->msgs = $notifies;
  }

  public function getNotify(){
    $notifies = $this->session->msgs ? $this->session->msgs : [];
    $this->session->msgs = [];
    $this->loadView(null, ['notify'=>$notifies], null);
  }

  public function loadView($page, $data = array(), $masterPage = 'seller/layout'){
    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
      header('Content-Type: application/json');
      echo json_encode($data);
    }else{
      $_data = $data;
  
      $_data['nav'] = array(
        '/admin'=>array(
                    'alias'=>'home',
                    'icon'=>"<i class='fa fa-home'></i>",
                    'text'=>'Trang chủ',
                    'notify'=> "<span class='label label-success pull-right'>3 thông báo</span>"
                  ),
        '/admin/blogs'=>array(
                    'alias'=>'blog',
                    'icon'=>"<i class='fa fa-file'></i>",
                    'text'=>'Blog',
                    'notify'=>null
          ),
        '/admin/articles'=>array(
                    'alias'=>'article',
                    'icon'=>"<i class='fa fa-file'></i>",
                    'text'=>'Bài viết',
                    'notify'=>null
          ),
        '/admin/links'=>array(
                    'alias'=>'link',
                    'icon'=>"<i class='fa fa-link'></i>",
                    'text'=>'Liên kết',
                    'notify'=>null
          )
      );

      $_data['alias'] = $this->alias;

      $_data['cu'] = $this->session->cu;
      
      $_data['title'] = isset($data['title'])?$data['title']:'Admin Control Panel';

      // $_data['userlist'] = $this->em->getRepository("\Entity\User")->findBy(['status'=>1]);
  
      $_data['page'] = "seller/page/" . $page;

      $this->load->view($masterPage, $_data);
    }
    $this->em->getConnection()->close();
  }
  public function checkLogin(){
    return $this->session->has_userdata('cu');
  }
  public function _404(){
    $this->load->view('404');
  }
  public function logout(){
    $this->session->sess_destroy();
    redirect("/admin");
  }
  public function login(){
    $data = [];

    if(isset($_POST['submit']) && isset($_POST['email']) && isset($_POST['password'])){

      $data['form'] = $_POST;

      $u_result = $this->em->getRepository('Entity\User')->findBy([
        'email'  =>  $_POST['email'],
        'password'  =>  md5($_POST['password'])
      ]);

      if(count($u_result) > 0){
        $this->session->set_userdata('cu', $u_result[0]);
        // $this->clog->write(NULL, NULL, self::LOG_ACTION_TYPE_LOGIN, "Đăng nhập hệ thống thành công");
        redirect($this->session->redirect_affter_login);
      }else{
        $data['error'] = 'Sai email hoặc mật khẩu, vui lòng thử lại';
      }

    }
    $this->load->view('seller/login', $data);
  }
  /**
  *
  * Chuyển đổi chuỗi kí tự thành dạng slug dùng cho việc tạo friendly url.
  *
  * @access    public
  * @param    string
  * @return    string
  */
  function create_slug($string) {
        $search = array (
            '#(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)#',
            '#(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)#',
            '#(ì|í|ị|ỉ|ĩ)#',
            '#(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)#',
            '#(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)#',
            '#(ỳ|ý|ỵ|ỷ|ỹ)#',
            '#(đ)#',
            '#(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)#',
            '#(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)#',
            '#(Ì|Í|Ị|Ỉ|Ĩ)#',
            '#(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)#',
            '#(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)#',
            '#(Ỳ|Ý|Ỵ|Ỷ|Ỹ)#',
            '#(Đ)#',
            "/[^a-zA-Z0-9\-\_]/",
            ) ;
        $replace = array (
            'a',
            'e',
            'i',
            'o',
            'u',
            'y',
            'd',
            'A',
            'E',
            'I',
            'O',
            'U',
            'Y',
            'D',
            '-',
            ) ;
        $string = preg_replace($search, $replace, $string);
        $string = preg_replace('/(-)+/', '-', $string);
        $string = strtolower($string);
        return $string;
  }
}