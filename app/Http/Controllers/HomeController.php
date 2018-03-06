<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\PostCategory;
class HomeController extends Controller
{


    private $limit = 2;
    private $data;



    public function __construct()
    {
        $categories = new PostCategory();
        $this->data['categories'] =  $categories->getCategories();
    }

    public function index($page = null) {
        $page === null? $page = 1:$page; 
        $posts = new Post();
        $this->data['page'] = $page;
        $this->data['posts'] = $posts->getPosts($this->limit, $page);
        $this->data['pages_no'] =ceil($posts->getPostNo()/$this->limit);
        return view('components.index', $this->data);
    }

    public function test() {
        $test = "test";
        return $test;
    }

    public function ajax_pagination($page = null) {
        $page === null? $page =  1:$page; 
        $posts = new Post();
        $this->data['page'] = $page;
        $this->data['posts'] = $posts->getPosts($this->limit, $page);
        $this->data['pages_no'] =ceil($posts->getPostNo()/$this->limit);
        return view('components.articleSingleCompact', $this->data);
    }
}
