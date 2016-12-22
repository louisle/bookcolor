<?php
use Doctrine\Common\Collections\ArrayCollection;
defined('BASEPATH') OR exit('No direct script access allowed');
class ArticleController extends SellerBaseController

{
    function __construct()
    {
        parent::__construct();
        $this->alias = 'article';
    }

    public function index()
    {
        $this->load->model('theme');
        $data = array();

        $data['themes'] = $this->theme->get($query, array('id'=>'DESC'));
        $data['total_result'] = $this->article->count($query);
        $data['current_page'] = $page;

        $this->loadView('theme/index', $data);
    }

}

