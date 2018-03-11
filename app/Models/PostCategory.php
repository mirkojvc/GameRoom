<?php
namespace App\Models;

use Illuminate\Support\Facades\DB;

class PostCategory {
    public $id;
    public $name;

    private $table = 'PostCategory';
    public function createCategory() {
        $category = DB::table($this->table)
        ->insert([
            'name' => $this->name,
        ])
        ;
    }

    public function getCategories() {
        $categories = DB::table($this->table)
        ->get();
        return $categories;
    }

    public function getCategory() {
        $categories = DB::table($this->table)
        ->where('id', $this->id)
        ->first();
        return $categories;
    }

    public function updateCategory() {
		$data = [
			'name' => $this->name,
		];
		$rez = DB::table($this->table)
		        ->where('id',$this->id)
				->update($data)
				;
		return $rez;
    }

    public function deleteCategory() {
        $category = DB::table($this->table)
        ->where('id', $this->id)
        ->delete()
        ;
    }


}
