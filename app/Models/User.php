<?php
namespace App\Models;

use Illuminate\Support\Facades\DB;

class User {

    public $id;
    public $username;
    public $password;
    public $roleId;

    private $table = 'User';
    

    public function createUser() {
        $query = DB::table($this->table)
        ->insert([
            'username' => $this->username,
            'password' => md5($this->password),
            'roleId'   => $this->roleId,
        ]);

        return $query;
    }

    public function getUsers() {
        $users = DB::table($this->table)
        ->select();

        return $users;
    }

    public function getUser(){
        $user = DB::table($this->table)
        ->where('username', $this->username)
        ->where('password', md5($this->password))
        ->first()
        ;
        return $user;
    }

    public function updateUser() {
        $user = DB::table($this->table)
        ->select()
        ->where('id', $this->id)
        ;

        if(isset($this->username)) {
            $user->username = $this->username;
        }

        if(isset($this->password)) {
            $user->password = md5($this->password);
        }

        if(isset($this->roleId)) {
            $user->roleId = $this->roleId;
        }

        $user->save();
    }

    public function deleteUser() {
        $user = DB::table($this->table)
        ->where("id", $this->id)
        ->delete()
        ;

    }
}
