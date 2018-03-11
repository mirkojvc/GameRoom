<?php
namespace App\Models;

use Illuminate\Support\Facades\DB;

class Post{
    public $id;
    public $title;
    public $text;
    public $first_image;
    public $categoryId;

    private $table = 'Post';

    public function createPost(){
        $post = DB::table($this->table)
        ->insert([
            'title'      => $this->title,
            'text'       => $this->text,
            'first_image'=> $this->first_image,
            'categoryId' => $this->categoryId,
        ])
        ;
    }

    public function getPostNo() {
        $no = DB::table($this->table)
        ->get();
        return count($no);
    }

    public function getAll() {
        $posts = DB::table($this->table)
        ->select('*', 'Post.id as postId')
        ->join('PostCategory', 'categoryId', '=', 'PostCategory.id')
        ->get()
        ;
        return $posts;
    }

    public function getCategoryPostNo($categoryId = null) {
        $no = DB::table($this->table)
        ->where('categoryId', $categoryId)
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

    public function getPostsByCategory($categoryId, $limit, $page){
        $offset = $limit * ($page-1);
        $posts = DB::table($this->table)
        ->where('categoryId', $categoryId)
        ->offset($offset)
        ->limit($limit)
        ->get()
        ;
        return $posts;
    }

    public function getPost() {
        $post = DB::table($this->table)
        ->where('id', $this->id)
        ->first()
        ;
        return $post;
    }

    public function updatePost() {
		$data = [
			'title' => $this->title,
			'text' => $this->text,
			'categoryId' => $this->categoryId
		];
		
		if(!empty($this->first_image)){ // ako je upload-ovana slika
			$data['first_image'] = $this->first_image;
		}

		$rez = DB::table($this->table)
		        ->where('id',$this->id)
				->update($data)
				;
		return $rez;
    }

    public function deletePost() {
        $post = DB::table($this->table)
        ->where('id', $this->id)
        ->delete()
        ;
    }

}

