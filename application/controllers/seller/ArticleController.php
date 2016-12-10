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
        $this->load->model('article');
        $data = array();

        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $limit = isset($_GET['limit']) ? $_GET['limit'] : 10;
        $title = isset($_GET['q']) ? $_GET['q'] : '';

        $query = [];
        $query['title'] = $title;

        $data['articles'] = $this->article->get($query, array('id'=>'DESC'), $page, $limit);
        $data['total_result'] = $this->article->count($query);
        $data['current_page'] = $page;

        $this->loadView('article/index', $data);
    }

    public function add()
    {
        $data = array();
        if (isset($_POST['submit'])) {

            // validate

            $form_error = array();
            if (!isset($_POST['title']) || strlen(trim($_POST['title'])) === 0) {
                $form_error['title'] = 'Tiêu đề không được trống';
            }

            if (!isset($_POST['url']) || strlen(trim($_POST['url'])) === 0) {
                $form_error['url'] = 'URL không được trống';
            }

            if ($this->create_slug($_POST['url']) != $_POST['url']) {
                $form_error['url'] = 'URL không hợp lệ';
            }

            if (count($form_error) == 0) {
                $this->load->model('blog');

                // submit

                $blogs = [];
                if (isset($_POST['blog'])) {
                    $blogs = $this->blog->get(array(
                        'id' => $_POST['blog']
                    ) , array() , -1, -1);
                }

                if (count($blogs) === 0) {
                    $form_error['blog'] = 'Blog không hợp lệ';
                }
                else {
                    $article = new Entity\Article();
                    $article->title = trim($_POST['title']);
                    $article->url = trim($_POST['url']);
                    $article->content = $_POST['content'];

                    // $article->addon = $_POST['addon'];

                    $article->status = $_POST['status'];
                    $article->blogs = $blogs;
                    $this->load->model('article');
                    $this->article->add($article);

                    // tags

                    $this->load->model('tag');
                    $tags = [];
                    $tagArr = explode(',', trim($_POST['tags']));
                    foreach($tagArr as $index => $text) {
                        $tagSlug = $this->create_slug($text);
                        $tagDb = $this->tag->get(array(
                            'url' => $tagSlug
                        ) , array() , 1, 1);
                        if (count($tagDb) == 0) {

                            // add if not exist

                            $tag = new Entity\Tag();
                            $tag->title = trim($text);
                            $tag->url = $tagSlug;
                            $tag->articles[] = $article;
                            $this->tag->add($tag);
                        }
                        else {
                            $tagDb[0]->articles[] = $article;
                            $this->tag->edit($tagDb[0]);
                        }
                    }
                }
            }
            else {
                $data['form_error'] = $form_error;
                $data['form_data'] = $_POST;
            }
        }

        $this->load->model('blog');
        $blogs = $this->blog->get(array() , array() , -1, -1);
        $data['blogs'] = $blogs;
        $this->loadView('article/add', $data);
    }

    public function edit()
    {
        $this->load->model('blog');
        $this->load->model('article');
        $data = array();

        // has POST data

        if (isset($_POST['submit'])) {

            // validate

            $form_error = array();
            if (!isset($_POST['title']) || strlen(trim($_POST['title'])) === 0) {
                $form_error['title'] = 'Tiêu đề không được trống';
            }

            if (!isset($_POST['url']) || strlen(trim($_POST['url'])) === 0) {
                $form_error['url'] = 'URL không được trống';
            }

            if ($this->create_slug($_POST['url']) != $_POST['url']) {
                $form_error['url'] = 'URL không hợp lệ';
            }

            if (count($form_error) == 0) { // validate success

                // submit
                // process blog

                $blogs = [];
                if (isset($_POST['blog'])) {
                    $blogs = $this->blog->get(array(
                        'id' => $_POST['blog']
                    ) , array() , -1, -1);
                }

                if (count($blogs) === 0 && isset($_POST['blog'])) {
                    $form_error['blog'] = 'Blog không hợp lệ'; // blog fail
                }
                else {

                    // get article

                    $id = isset($_GET['id']) ? $_GET['id'] : false;
                    if ($id) {
                        $articles = $this->article->get(array(
                            'id' => $id
                        ) , array() , 1, 1);
                        if (!isset($articles[0])) {
                            show_404();
                        }

                        $article = $articles[0];
                        $article->title = trim($_POST['title']);
                        $article->url = trim($_POST['url']);
                        $article->content = $_POST['content'];

                        // $article->addon = $_POST['addon'];

                        $article->status = $_POST['status'];
                        $article->blogs = $blogs;

                        // process tags
                        $this->load->model('tag');
                        $tagArr = explode(',', trim($_POST['tags']));
                        $tagIds = new ArrayCollection();
                        foreach($tagArr as $index => $text) {
                            $tagSlug = $this->create_slug($text);
                            $tagDb = $this->tag->get(array(
                                'url' => $tagSlug
                            ) , array() , 1, 1);
                            if (count($tagDb) == 0) {

                                // add if not exist

                                $tag = new Entity\Tag();
                                $tag->title = trim($text);
                                $tag->url = $tagSlug;
                                $tag->articles->add($article);
                                $this->tag->add($tag);
                                $tagIds->add($tag->id);
                            }
                            else {

                                // add to article if not yet
                                if (!$tagDb[0]->articles->contains($article)) {
                                    $tagDb[0]->articles->add($article);
                                }

                                $tagIds->add($tagDb[0]->id);
                            }
                        }

                        // clear tag from article
                        foreach($article->tags as $tag){
                            echo $tag->id . '-';
                            if(!$tagIds->contains($tag->id)){
                                $tag->articles->removeElement($article);
                            }
                        }

                        $this->article->edit($article);
                        header('Location: ' . $_SERVER['REQUEST_URI']);
                    }
                }
            }
            else {
                $data['form_error'] = $form_error;
                $data['form_data'] = $_POST;
            }
        }
        else {
            $id = isset($_GET['id']) ? $_GET['id'] : false;
            if ($id) {
                $articles = $this->article->get(array(
                    'id' => $id
                ) , array() , 1, 1);
                if (!isset($articles[0])) {
                    show_404();
                }

                $tagStrs = array();
                foreach($articles[0]->tags as $tag) {
                    $tagStrs[] = $tag->title;
                }

                $blogIds = array();
                foreach($articles[0]->blogs as $blog) {
                    $blogIds[] = $blog->id;
                }

                $data['form_data'] = array(
                    'title' => $articles[0]->title,
                    'url' => $articles[0]->url,
                    'status' => $articles[0]->status,
                    'content' => $articles[0]->content,
                    'blogs' => $blogIds,
                    'tags' => implode(",", $tagStrs) ,
                );
            }
            else {
                show_404();
            }
        }

        $blogs = $this->blog->get(array() , array() , -1, -1);
        $data['blogs'] = $blogs;
        $this->loadView('article/edit', $data);
    }

    public function remove()
    {
        if (isset($_GET['id'])) {
            $this->load->model('article');
            $this->article->remove($_GET['id']);
        }
    }
}

