<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Survey;
use App\Models\SurveyAnswers;
use App\Models\SurveyResult;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Validator;

class AdminController extends Controller
{

    private $data = [];

    public function __construct(){

    }
    public function admin() {
        return view('components.admin', $this->data);
	}
	

	////////////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////////////
		/* Surveys */
	////////////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////////////
	public function surveyAnswer($id = null, $anId = null) {
        $answers = new SurveyAnswers();
		$answer   = new SurveyAnswers();
		$survey   = new Survey();
		$survey->id   = $id;
		$this->data['survey']   = $survey->getSurvey();
        if($anId !== null) {
            $answer->id   = $anId;
            $this->data['answer']   = $answer->getSurveyAnswer();
		}
		$answers->surveyId = $id;
        $this->data['answers'] = $answers->getAll();
        return view('components.adminSurveyAnswer',$this->data);
	}
	
	public function survey($id = null) {
        $surveys = new Survey();
        $survey   = new Survey();
        if($id !== null) {
            $survey->id   = $id;
            $this->data['survey']   = $survey->getSurvey();
        }
        $this->data['surveys'] = $surveys->getAll();

        return view('components.adminSurveys',$this->data);
    }


    public function deleteAnswer($id = null, $anId = null) {
        try{
            $answer = new SurveyAnswers();
            $answer->id = $anId;
            $answer->deleteSurveyAnswer();
            return redirect()->back();
        }   catch(\ErrorException $ex) { 
                \Log::error('Problem sa unosom u bazu '.$ex->getMessage());
                return redirect()->back()->with('error','Desila se greska..');
        } 

    }

    public function deleteSurvey($id = null) {
        try{
            $survey = new Survey();
            $survey->id = $id;
            $survey->deleteSurvey();
            return redirect()->back();
        }   catch(\ErrorException $ex) { 
                \Log::error('Problem sa unosom u bazu '.$ex->getMessage());
                return redirect()->back()->with('error','Desila se greska..');
        } 

    }

    public function createSurveyAnswer($id = null, Request $request){    
		$rules = [
			'answer_text' => 'required',
		];
		$custom_messages = [
			'required' => 'Polje :attribute je obavezno!',
		];
		$request->validate($rules, $custom_messages);
        try {		
			$survey = new SurveyAnswers();
			$survey->answer_text        = $request->get('answer_text');
			$survey->surveyId           = $id;
			$survey->createSurveyAnswer();

			return redirect()->back();
		}
		catch(\Illuminate\Database\QueryException $ex){
			\Log::error($ex->getMessage());
			return redirect()->back()->with('error','Greska pri dodavanju posta u bazu!');
		}
		catch(\ErrorException $ex) { 
			\Log::error('Problem sa fajlom!! '.$ex->getMessage());
			return redirect()->back()->with('error','Desila se greska..');
		}
    }

    public function createSurvey(Request $request){    
		$rules = [
			'name' => 'required',
		];
		$custom_messages = [
			'required' => 'Polje :attribute je obavezno!',
		];
		$request->validate($rules, $custom_messages);
        try {		
			$survey = new Survey();
			$survey->name        = $request->get('name');
			$survey->createSurvey();

			return redirect()->back();
		}
		catch(\Illuminate\Database\QueryException $ex){
			\Log::error($ex->getMessage());
			return redirect()->back()->with('error','Greska pri dodavanju posta u bazu!');
		}
		catch(\ErrorException $ex) { 
			\Log::error('Problem sa fajlom!! '.$ex->getMessage());
			return redirect()->back()->with('error','Desila se greska..');
		}
    }
    public function updateSurvey($id, Request $request) {
        $name      = $request->get('name');
        
		$survey  = new Survey();
		$survey->id      = $id;
		$survey->name    = $name;
        try{ 
            $res = $survey->updateSurvey();
            return redirect('/admin/surveys');
        }
		catch(\Symfony\Component\HttpFoundation\File\Exception\FileException $ex) {
			\Log::error('Problem sa fajlom!! '.$ex->getMessage());
			return redirect()->back()->with('error','Greska pri dodavanju slike!');
		}
		catch(\ErrorException $ex) { 
			\Log::error('Problem sa fajlom!! '.$ex->getMessage());
			return redirect()->back()->with('error','Desila se greska..');
		}
	}	

    public function updateAnswer($id = null, $anId = null, Request $request) {
        $answer_text      = $request->get('answer_text');
		$survey  				= new SurveyAnswers();
		$survey->id      		= $anId;
		$survey->answer_text    = $answer_text;
        try{ 
            $res = $survey->updateSurveyAnswer();
            return redirect()->back();
        }
		catch(\Symfony\Component\HttpFoundation\File\Exception\FileException $ex) {
			\Log::error('Problem sa fajlom!! '.$ex->getMessage());
			return redirect()->back()->with('error','Greska pri dodavanju slike!');
		}
		catch(\ErrorException $ex) { 
			\Log::error('Problem sa fajlom!! '.$ex->getMessage());
			return redirect()->back()->with('error','Desila se greska..');
		}
	}	
	


	////////////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////////////
		/* Categories */
	////////////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////////////
    

    public function categories($id = null) {
        $categories = new PostCategory();
        $category   = new PostCategory();
        if($id !== null) {
            $category->id   = $id;
            $this->data['category']   = $category->getCategory();
        }
        $this->data['categories'] = $categories->getCategories();

        return view('components.adminCategory',$this->data);
    }

    public function deleteCategory($id = null) {
        try{
            $category = new PostCategory();
            $category->id = $id;
            $category->deleteCategory();
            return redirect()->back();
        }   catch(\ErrorException $ex) { 
                \Log::error('Problem sa unosom u bazu '.$ex->getMessage());
                return redirect()->back()->with('error','Desila se greska..');
        } 

    }


    public function createCategory(Request $request){    
		$rules = [
			'name' => 'required',
		];
		$custom_messages = [
			'required' => 'Polje :attribute je obavezno!',
		];
		$request->validate($rules, $custom_messages);
        try {		
			$category = new PostCategory();
			$category->name        = $request->get('name');
			$category->createCategory();

			return redirect()->back();
		}
		catch(\Illuminate\Database\QueryException $ex){
			\Log::error($ex->getMessage());
			return redirect()->back()->with('error','Greska pri dodavanju posta u bazu!');
		}
		catch(\ErrorException $ex) { 
			\Log::error('Problem sa fajlom!! '.$ex->getMessage());
			return redirect()->back()->with('error','Desila se greska..');
		}
    }
    public function updateCategory($id, Request $request) {
        $name      = $request->get('name');
        
		$category  = new PostCategory();
		$category->id      = $id;
		$category->name    = $name;
        try{ 
            $res = $category->updateCategory();
            return redirect('/admin/categories');
        }
		catch(\Symfony\Component\HttpFoundation\File\Exception\FileException $ex) {
			\Log::error('Problem sa fajlom!! '.$ex->getMessage());
			return redirect()->back()->with('error','Greska pri dodavanju slike!');
		}
		catch(\ErrorException $ex) { 
			\Log::error('Problem sa fajlom!! '.$ex->getMessage());
			return redirect()->back()->with('error','Desila se greska..');
		}
	}

	////////////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////////////
		/* POSTS */
	////////////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////////////
    public function posts($id = null) {
        $categories = new PostCategory();
        $posts      = new Post();
        $post       = new Post();
        if($id !== null) {
            $post->id   = $id;
            $this->data['post']       = $post->getPost();
        }
        $this->data['categories'] = $categories->getCategories();
        $this->data['posts']      = $posts->getAll();

        return view('components.adminPosts',$this->data);
    }

    public function deletePost($id = null) {
        try{
            $post = new Post();
            $post->id = $id;
            $post->deletePost();
            return redirect()->back();
        }   catch(\ErrorException $ex) { 
                \Log::error('Problem sa unosom u bazu '.$ex->getMessage());
                return redirect()->back()->with('error','Desila se greska..');
        } 

    }

    public function createPost(Request $request){    
		$rules = [
			'title' => 'regex:/^[A-Z][a-z]+(\s[\w\d\-]+)*$/',
			'text' => 'required',
			'image' => 'required|mimes:jpg,jpeg,png,gif|max:3000',
			'category' => 'required|not_in:0'
		];
		$custom_messages = [
			'required' => 'Polje :attribute je obavezno!',
			'title.regex' => 'Polje title nije u ispravnom formatu!',
			'max' => 'Fajl ne sme biti veci od :max KB.',
			'mimes' => 'Dozvoljeni formati su: :values.'
		];
		$request->validate($rules, $custom_messages);



		$photo = $request->file('image');
		$extension = $photo->getClientOriginalExtension();
		$tmp_path = $photo->getPathName();
		
		$folder = 'images/';
		$file_name = time().".".$extension;
		$new_path = public_path($folder).$file_name;
		try {

			File::move($tmp_path, $new_path);

			$post = new Post();
			$post->title        = $request->get('title');
			$post->text         = $request->get('text');
			$post->categoryId   = $request->get('category');
			$post->first_image  = 'images/'.$file_name;
			$post->createPost();

			return redirect()->back()->with('success','Uspesno ste dodali post i sliku!');
		}
		catch(\Illuminate\Database\QueryException $ex){ // greske u upitu
			\Log::error($ex->getMessage());
			return redirect()->back()->with('error','Greska pri dodavanju posta u bazu!');
		}
		catch(\Symfony\Component\HttpFoundation\File\Exception\FileException $ex) { // greske sa fajlom
			\Log::error('Problem sa fajlom!! '.$ex->getMessage());
			return redirect()->back()->with('error','Greska pri dodavanju slike!');
		}
		catch(\ErrorException $ex) { 
			\Log::error('Problem sa fajlom!! '.$ex->getMessage());
			return redirect()->back()->with('error','Desila se greska..');
		}
    }

    public function updatePost($id, Request $request) {
		$title      = $request->get('title');
		$text       = $request->get('text');
		$categoryId = $request->get('category');
		
		$slika = $request->file('image');

		$post               = new Post();
		$post->id           = $id;
		$post->title        = $title;
		$post->text         = $text;
		$post->categoryId   = $categoryId;
        try{ 
            if(!empty($slika)){ 
                $post_update = $post->getPost();
                File::delete($post_update->first_image);

                $tmp_putanja = $slika->getPathName();
                $ime_fajla = time().'.'.$slika->getClientOriginalExtension();
                $putanja = 'images/'.$ime_fajla;
                $putanja_server = public_path($putanja);

                File::move($tmp_putanja, $putanja_server);

                $post->first_image = $putanja;
            }

            $res = $post->updatePost();
            return redirect('/admin/posts');
        }
		catch(\Illuminate\Database\QueryException $ex){ // greske u upitu
			\Log::error($ex->getMessage());
			return redirect()->back()->with('error','Greska pri dodavanju posta u bazu!');
		}
		catch(\Symfony\Component\HttpFoundation\File\Exception\FileException $ex) { // greske sa fajlom
			\Log::error('Problem sa fajlom!! '.$ex->getMessage());
			return redirect()->back()->with('error','Greska pri dodavanju slike!');
		}
		catch(\ErrorException $ex) { 
			\Log::error('Problem sa fajlom!! '.$ex->getMessage());
			return redirect()->back()->with('error','Desila se greska..');
		}
	}
}
