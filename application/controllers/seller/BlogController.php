<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class BlogController extends SellerBaseController{
  function __construct(){
    parent::__construct();
    $this->alias = 'blog';
  }

  public function index(){
    $this->load->model('blog');
    $data = array();

    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $limit = isset($_GET['limit']) ? $_GET['limit'] : 10;
    $title = isset($_GET['q']) ? $_GET['q'] : '';

    $query = [];
    $query['title'] = $title;

    $data['blogs'] = $this->blog->get($query, array('id'=>'DESC'), $page, $limit);
    $data['total_result'] = $this->blog->count($query);
    $data['current_page'] = $page;

    $this->loadView('blog/index', $data);
  }  

  public function add(){
    $data = array(); 

    if(isset($_POST['submit'])){
      // validate
      $form_error = array();

      if(!isset($_POST['title']) || strlen(trim($_POST['title'])) === 0){
        $form_error['title'] = 'Tiêu đề không được trống';
      }

      if(!isset($_POST['url']) || strlen(trim($_POST['url'])) === 0){
        $form_error['url'] = 'URL không được trống';
      }

      if($this->create_slug($_POST['url']) != $_POST['url']){
        $form_error['url'] = 'URL không hợp lệ';
      }

      if(count($form_error) == 0){
        // submit
        $blog = new Entity\Blog();
        $blog->title = trim($_POST['title']);
        $blog->url = trim($_POST['url']);
        $blog->status = $_POST['status'];

        $this->load->model('blog');
        $this->blog->add($blog);
      }else{
        $data['form_error'] = $form_error;
        $data['form_data'] = $_POST;
      }

    }

    $this->loadView('blog/add', $data);   

  }

  public function edit(){
    $this->load->model('blog');
    $data = array(); 

    if(isset($_POST['submit'])){
      // validate
      $form_error = array();

      if(!isset($_POST['title'])){
        $form_error['title'] = 'Tiêu đề không được trống';
      }

      if(!isset($_POST['url'])){
        $form_error['url'] = 'URL không được trống';
      }

      if($this->create_slug($_POST['url']) != $_POST['url']){
        $form_error['url'] = 'URL không hợp lệ';
      }

      if(count($form_error) == 0){
        // submit
        $id = isset($_GET['id']) ? $_GET['id'] : false;
        if($id){
          $blogs = $this->blog->get(array('id'=>$id), array(), 1, 1);
          if(!isset($blogs[0])){
            show_404();
          }

          $blogs[0]->title = $_POST['title'];
          $blogs[0]->url = $_POST['url'];
          $blogs[0]->status = $_POST['status'];

          $this->blog->edit($blogs[0]);
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
        $blogs = $this->blog->get(array('id'=>$id), array(), 1, 1);
        if(!isset($blogs[0])){
          show_404();
        }

        $data['form_data'] = array(
          'title'=>$blogs[0]->title,
          'url'=>$blogs[0]->url,
          'status'=>$blogs[0]->status,
        );   
      }else{
        show_404();
      }
    }

    
    $this->loadView('blog/edit', $data); 
  }

  public function remove(){
    if(isset($_GET['id'])){
      $this->load->model('blog');
      $this->blog->remove($_GET['id']);
      
    }
  }


}