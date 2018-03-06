<?php
namespace App\Models;

use Illuminate\Support\Facades\DB;

class Post{
    private $id;
    private $title;
    private $text;
    private $first_image;
    private $categoryId;

    private $table = 'Post';

    public function createPost(){
        $post = DB::table($this->table)
        ->insert([
            'title'      => $this->title,
            'text'       => $this->text,
            'first_image'=> $this->first_image,
        ])
        ;
    }

    public function getPostNo() {
        $no = DB::table($this->table)
        ->get();
        return count($no);
    }

    public function getPosts($limit, $page){
        $offset = $limit * ($page-1);
        $posts = DB::table($this->table)
        ->offset($offset)
        ->limit($limit)
        ->get()
        ;
        return $posts;
    }

    public function getPostsByCategory(){
        $offset = $this->limit * $this->page;
        $posts = DB::table($this->table)
        ->where('categoryId', $this->categoryId)
        ->offset($offset)
        ->limit(5)
        ->get()
        ;
        $no = count($posts)/$this->limit;
        return $posts;
    }

    public function getPost() {
        $post = DB::table($this->table)
        ->where('id', $this->id)
        ->get()
        ;
    }

    public function updatePost() {

    }

    public function deletePost() {
        $post = DB::table($this->table)
        ->where('id', $this->id)
        ->delete()
        ;
    }

}

