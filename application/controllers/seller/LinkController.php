<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class LinkController extends SellerBaseController{
  function __construct(){
    parent::__construct();
    $this->alias = 'link';
    $this->load->model('link');
  }

  public function index(){
    $data = array();

    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $limit = isset($_GET['limit']) ? $_GET['limit'] : 10;

    $query = [];

    $parentId = isset($_GET['parent']) ? $_GET['parent'] : 0;
    $parents = $this->link->get(array('id'=>$parentId), array(), 1, 1);
    $parent = isset($parents[0]) ? $parents[0] : NULL;

    $query['parent'] = $parent;

    $data['parentLink'] = $parent;
    $data['links'] = $this->link->get($query, array('id'=>'DESC'), $page, $limit);
    $data['current_page'] = $page;
    $data['total_result'] = $this->link->count($query);
    $this->loadView('link/index', $data);
  }  

  public function add(){
    $data = array();

    if(isset($_POST['submit'])){

      // validate
      $form_error = array();
      $parentId = isset($_GET['parent']) ? $_GET['parent'] : 0;
      $parents = $this->link->get(array('id'=>$parentId), array(), 1, 1);
      if(!isset($parents[0])){
        $form_error['parent'] = 'Dữ liệu bị lỗi';
      }

      if(!isset($_POST['title']) || strlen(trim($_POST['title'])) === 0){
        $form_error['title'] = 'Tiêu đề không được trống';
      }

      // valid target data
      $targetId = 0;
      $targetType = '';
      switch ($_POST['type']) {
        case '/admin/blogs':
          $this->load->model('blog');
          $blog = $this->blog->get(array('id'=>$_POST['target']), array(), 1, 1);
          $targetId = $blog[0]->id;
          $targetType = $blog[0]->type;
          break;
        case '/admin/articles':
          $this->load->model('article');
          $article = $this->article->get(array('id'=>$_POST['target']), array(), 1, 1);
          $targetId = $article[0]->id;
          $targetType = $article[0]->type;
          break;
        
        default:
          $form_error['type'] = 'Kiểu liên kết không hợp lệ';
          break;
      }


      if(count($form_error) == 0){
        // submit
        $link = new Entity\Link();

        $link->parent = $parents[0];
        $link->title = trim($_POST['title']);
        $link->status = $_POST['status'];
        $link->target_type = $targetType;
        $link->target_id = $targetId;

        $this->load->model('link');
        $this->link->add($link);

        header("Location:".$parents[0]->getAdminPath());
      }else{
        $data['form_error'] = $form_error;
        $data['form_data'] = $_POST;
      }

    }

    $this->loadView('link/add', $data);   

  }

  public function edit(){
    $this->load->model('link');
    $data = array(); 

    if(isset($_POST['submit'])){
      // validate
      $form_error = array();

      if(!isset($_POST['title']) || strlen(trim($_POST['title'])) === 0){
        $form_error['title'] = 'Tiêu đề không được trống';
      }

      // valid target data
      $targetId = 0;
      $targetType = '';
      switch ($_POST['type']) {
        case '/admin/blogs':
          $this->load->model('blog');
          $blog = $this->blog->get(array('id'=>$_POST['target']), array(), 1, 1);
          $targetId = $blog[0]->id;
          $targetType = $blog[0]->type;
          break;
        case '/admin/articles':
          $this->load->model('article');
          $article = $this->article->get(array('id'=>$_POST['target']), array(), 1, 1);
          $targetId = $article[0]->id;
          $targetType = $article[0]->type;
          break;
        
        default:
          $form_error['type'] = 'Kiểu liên kết không hợp lệ';
          break;
      }

      if(count($form_error) == 0){
        // submit
        $id = isset($_GET['id']) ? $_GET['id'] : false;
        if($id){
          // submit
          $link = $this->link->get(array('id'=>$id), array(), 1, 1);
          $link = $link[0];
          $link->title = trim($_POST['title']);
          $link->status = $_POST['status'];
          $link->target_type = $targetType;
          $link->target_id = $targetId;

          $this->link->edit($link);
          header("Refresh:0");
          return;
        }else{
          show_404();
        }
      }else{
        $data['form_error'] = $form_error;
        $data['form_data'] = $_POST;
      }

    }else{
      $id = isset($_GET['id']) ? $_GET['id'] : false;
      if($id){
        $links = $this->link->get(array('id'=>$id), array(), 1, 1);
        if(!isset($links[0])){
          show_404();
        }

        $data['form_data'] = array(
          'title'=>$links[0]->title,
          'status'=>$links[0]->status,
          'target_id'=>$links[0]->target_id,
          'target_type'=>$links[0]->target_type,
          'target_object'=>$links[0]->targetObject
        );   
      }else{
        show_404();
      }
    }

    
    $this->loadView('link/edit', $data); 
  }

  public function remove(){
    if(isset($_GET['id'])){
      $this->link->remove($_GET['id']);
    }
  }


}