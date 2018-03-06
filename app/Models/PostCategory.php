<?php
namespace App\Models;

use Illuminate\Support\Facades\DB;

class PostCategory {
    private $id;
    private $category_name;

    private $table = 'PostCategory';
    public function createCategory() {
        $category = DB::table($this->table)
        ->insert([
            'category_name' => $this->category_name,
        ])
        ;
    }

    public function getCategories() {
        $categories = DB::table($this->table)
        ->get();
        return $categories;
    }

    public function updateCategory() {
        $category = DB::table($this->table)
        ->select()
        ->where('id', $this->id)
        ;

        if(isset($this->category_name)) {
            $category->category_name = $this->category_name;
        }

        $category->save();
    }

    public function deleteCategory() {
        $category = DB::table($this->table)
        ->where('id', $this->id)
        ->delete()
        ;
    }


}
