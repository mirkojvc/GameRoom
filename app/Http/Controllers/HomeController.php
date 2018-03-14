<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Survey;
use App\Models\SurveyAnswers;
use App\Models\SurveyResults;

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
        $page === null? $page = 1:$page; 
        $posts = new Post();
        $user   = $request->session()->get('user');
        if($user !== null){
            $survey = new Survey();
            $userId = $user[0]->id;
            $answers = new SurveyAnswers();
            $survey = $survey->getNotDone($userId);
            if($survey !== null) {
                $answers->surveyId = $survey->id;
                $answers = $answers->getAll(); 
                $this->data['survey'] = $survey;
                $this->data['answers'] = $answers;
            }
        }
        $this->data['page'] = $page;
        $this->data['posts'] = $posts->getPosts($this->limit, $page);
        $this->data['pages_no'] =ceil($posts->getPostNo()/$this->limit);

        if($request->session()->get('user') !== null) {
			$user = $request->session()->get('user');
			$user = $user[0]->username;
		} else {
			$user = $request->ip();
		}
		
		\Log::info('Poseta pocetnoj strani od  strane:'.$user);

        return view('components.index', $this->data);
    }

    public function category($category_id = null, $page = null, Request $request){
        $page === null? $page = 1:$page; 
        $posts = new Post();
        $this->data['page'] = $page;
        $this->data['posts'] = $posts->getPostsByCategory($category_id, $this->limit, $page);
        $this->data['pages_no'] = ceil($posts->getCategoryPostNo($category_id)/$this->limit);

        if($request->session()->get('user') !== null) {
			$user = $request->session()->get('user');
			$user = $user[0]->username;
		} else {
			$user = $request->ip();
		}
		
		\Log::info('Poseta strani kategorije od strane:'.$user);

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


                        if($request->session()->get('user') !== null) {
                            $user = $request->session()->get('user');
                            $user = $user[0]->username;
                        } else {
                            $user = $request->ip();
                        }
                        
                        \Log::info('Registracija od  strane:'.$user);

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

                        if($request->session()->get('user') !== null) {
                            $user = $request->session()->get('user');
                            $user = $user[0]->username;
                        } else {
                            $user = $request->ip();
                        }
                        
                        \Log::info('Logovanje od  strane:'.$user);

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
        
		if($request->session()->get('user') !== null) {
			$user = $request->session()->get('user');
			$user = $user[0]->username;
		} else {
			$user = $request->ip();
		}
		
		\Log::info('Poseta logout od strane:'.$user);

		return redirect('/');
    }

    public function author() {
        return view('components.author',$this->data);
    }
    
    public function insertSurveyResult($id, $survId, Request $request) {
        
        if($request->session()->has('user')){ 
            $check = new SurveyResults();
            $check->surveyId = $survId;
            $user = $request->session()->get('user')[0];
            $check->userId = $user->id;


            if($request->session()->get('user') !== null) {
                $user = $request->session()->get('user');
                $user = $user[0]->username;
            } else {
                $user = $request->ip();
            }
            
            \Log::info('Pokusaj glasanja od strane:'.$user);

            try {
                if($check->canVote()){
                    $check->answerId = $id;
                    $check->ip_address = $request->ip();
                    $check = $check->createSurveyResult();

                    return '<p>Hvala na glasanju!</p>';
                } else {
                    return '<p>vec ste glasali na ovoj anketi</p>';
                }
            }   catch(\ErrorException $ex) { 
                \Log::error('Problem sa unosom u bazu '.$ex->getMessage());
                return redirect()->back()->with('error','Desila se greska..');
             } 
        }
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
