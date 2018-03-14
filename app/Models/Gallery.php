<?php
namespace App\Models;

use Illuminate\Support\Facades\DB;

class Gallery{
    public $id;
    public $url;

    private $table = 'Gallery';

    public function createGallery(){
        $gallery = DB::table($this->table)
        ->insert([
            'url'      => $this->url,])
        ;

        return $gallery;
    }

    public function getAll() {
        $gallery = DB::table($this->table)
        ->get()
        ;
        return $gallery;
    }

    public function getGallery() {
        $gallery = DB::table($this->table)
        ->where('id', $this->id)
        ->first()
        ;
        return $gallery;
    }

    public function updateGallery() {
		$data = [
			'url' => $this->url,
		];
		

		$rez = DB::table($this->table)
		        ->where('id',$this->id)
				->update($data)
				;
		return $rez;
    }

    public function deleteGallery() {
        $post = DB::table($this->table)
        ->where('id', $this->id)
        ->delete()
        ;
    }

}

