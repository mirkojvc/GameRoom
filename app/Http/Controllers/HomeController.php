<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Survey;

use Illuminate\Http\Request;
use Validator;
class HomeController extends Controller
{


    private $limit = 2;
    private $data  = null;



    public function __construct()
    {
        $categories = new PostCategory();
        $this->data['categories'] =  $categories->getCategories();
    }

    public function index($page = null, Request $request) {
        $survey = new Survey();
        $user   = $request->session()->get('user');
        $userId = $user[0]->id;

        $survey = $survey->getNotDone($userId);
        $page === null? $page = 1:$page; 
        $posts = new Post();
        $this->data['page'] = $page;
        $this->data['posts'] = $posts->getPosts($this->limit, $page);
        $this->data['pages_no'] =ceil($posts->getPostNo()/$this->limit);
        return view('components.index', $this->data);
    }

    public function category($category_id = null, $page = null){
        $page === null? $page = 1:$page; 
        $posts = new Post();
        $this->data['page'] = $page;
        $this->data['posts'] = $posts->getPostsByCategory($category_id, $this->limit, $page);
        $this->data['pages_no'] = ceil($posts->getCategoryPostNo($category_id)/$this->limit);
        return view('components.index', $this->data);
    }

    public function userForm(Request $request) {
        if($request->input('register_submit') !== null) {

            $rules = [
                
                'username' => 'required|min:3|unique:User',
                'password' => 'required|min:5|regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/'
            ];
            $custom_messages = [
                'required' => 'Polje :attribute je obavezno!',
                'min' => 'Plje :attribute mora imati minimum :size karaktera',
                'regex' => 'Polje :attribute mora sadrzati makar jedno veliko slovo i jedan broj i biti vece od 8 karaktera',
            ];
            $request->validate($rules, $custom_messages);

            $username = $request->input('username');
            $password = $request->input('password');
            $roleId   = 2;
            try {
                $user = new User();
                $user->username = $username;
                $user->password = md5($password);
                $user->roleId   = $roleId;

                $success = $user->createUser();	
                if($success) {

                        $getUser = $user->getUser();
                        $request->session()->push('user', $getUser);
                        return redirect('/');        
                }	
            } catch(\ErrorException $ex) { 
                \Log::error('Problem sa unosom u bazu '.$ex->getMessage());
                return redirect()->back()->with('error','Desila se greska..');
            } 
        } else if($request->input('login_submit') !== null) {
            $username = $request->input('username');
            $password = $request->input('password');
            try {
                $user = new User();
                $user->username = $username;
                $user->password = $password;

                $getUser = $user->getUser();
                if(!empty($getUser)){
                    if($getUser->roleId === 1) {
                        $request->session()->push('user', $getUser);
                        return redirect('/admin');
                    } else {
                        $request->session()->push('user', $getUser);
                        return redirect('/');
                    }        
                } else {
                    return redirect('/')->with('login_error','Unknown username or password');
                }
            }   catch(\ErrorException $ex) { 
                \Log::error('Problem sa unosom u bazu '.$ex->getMessage());
                return redirect()->back()->with('error','Desila se greska..');
            } 

        }
    }

    public function logout(Request $request){
		$request->session()->forget('user');
		$request->session()->flush();
		return redirect('/');
	}

    public function ajax_pagination($page = null) {
        $page === null? $page =  1:$page; 
        $posts = new Post();
        $this->data['page'] = $page;
        $this->data['posts'] = $posts->getPosts($this->limit, $page);
        $this->data['pages_no'] = ceil($posts->getPostNo()/$this->limit);
        return view('components.articleSingleCompact', $this->data);
    }

    public function category_pagination($category_id ,$page = null) {
        $page === null? $page =  1:$page; 
        $posts = new Post();
        $this->data['page'] = $page;
        $this->data['posts'] = $posts->getPostsByCategory($category_id, $this->limit, $page);
        $this->data['pages_no'] = ceil($posts->getCategoryPostNo($category_id)/$this->limit);
        return view('components.articleSingleCompact', $this->data);
    }
}
