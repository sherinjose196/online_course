<?php

namespace App\Http\Controllers;


use Request;
use Hash;
use DB;
use Auth;
use URL;
use Redirect;
use App\Category;
use App\Course;
use App\User;

class SettingsController extends Controller
{
     public function getView($id = 0)
    {
        $view = '';
        $data = Array();

        switch(Request::segment(1)) {

          case 'categorys':

	            $data['categorys'] = Category::where('is_deleted','=',0)->get();
	            $view = 'categorys';
           break;

          case 'create_category':
                 
                $view = 'create_category';
          break; 

          case 'edit_category':
                $data['category'] = Course::where('id' ,$id)->first();
                $view = 'edit_category';
          break; 
          case 'courses':

	            $data['courses'] = Course::join('categorys','courses.category_id','=','categorys.cat_id')
	                                       ->where('courses.is_deleted','=',0)->get();
	            $view = 'courses';
           break;

          case 'create_course':
                $data['categorys'] = Category::where('is_deleted','=',0)->get(); 
                $view = 'create_course';
          break; 

          case 'edit_course':
                $data['categorys'] = Category::where('is_deleted','=',0)->get(); 
                $data['course'] = Course::join('categorys','courses.category_id','=','categorys.cat_id')
                                              ->where('cat_id' ,$id)->first();
                $view = 'edit_course';
          break; 

          case 'user':

            $view = 'user';
          break;
          case 'register':
            $data['courses'] = Course::join('categorys','courses.category_id','=','categorys.cat_id')->where('courses.is_deleted','=',0)->get(); 
            $view = 'register';
          break;

          case 'online_course':
        
             $data['course'] = Course::select( 'courses.*','categorys.*','users.*','users.id as user_id','courses.id as course_id')
             ->join('categorys','courses.category_id','=','categorys.cat_id')
                                        ->join('users','users.course','=','courses.id')
                                        ->where('users.id','=',Auth::user()->id)
                                  ->where('courses.is_deleted','=',0)->first();

            $view = 'online_course';
          break;

        	}
        return view($view)->with($data);
    }
public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
    public function authManage(){
        $message = "";
        $status = 0;
        $html = "";
        $data = "";


        switch (Request::input('type')) {
            case 'login':
          
                if (Auth::attempt(['email' => Request::input('email'), 'password' => Request::input('password')]))
                {

                    $status = 1;
                }else
                {
                    $status = 0;
                }



            break;
            case 'login_user':
          
                if (Auth::attempt(['email' => Request::input('email'), 'password' => Request::input('password')]))
                {

                    $status = 1;
                }else
                {
                    $status = 0;
                }



            break;

            case 'register':
            $password = Hash::make(Request::input('password'));
            $user =User::create([                    
	                       'name' => Request::input('name'),
	                       'email' => Request::input('email'), 
	                       'password' => $password,  
	                       'course' => Request::input('course'),                   
	                 ]);
            $status = 1;
            break;
        }
      return response()->json(['status' => $status, 'message' => $message, 'html' => $html, 'data' => $data]);
    }
}
