<?php

namespace App\Http\Controllers;
use App\Libraries\UploadFileHandler;
use Request;
use App\Category;
use App\Course;

class PostController extends Controller
{
    public function postManage(){
              $status = 0;
              $data = null;
              $html='';
     	 switch (Request::input('type')) {

             case 'newCategory':
	            $cat =Category::create([                    
	                       'category' => Request::input('category'),                         
	                 ]);
	                       
             break;
             case 'editCategory':

                    $update =Category::find(Request::input('cat_id'));
                    $update->category =Request::input('category');
                    $update->save();

           break;

           case 'delete_category':

                    $delete = Category::where('cat_id',Request::input('delete_id'))->first();
                    $delete->is_deleted = 1;
                    $delete->save();
                    $status = 1;
            break;

            case 'newCourse':
            $vdeoURL =  Request::input('fileURLs');
			  
                           $image =Course::create([                    
                         'description' => Request::input('descrip'),
                         'category_id' => Request::input('category'),
                         'video' => $vdeoURL,
                 ]);
                      
			
                       
                break;
         case 'editCourse':
			
                $vdeoURL =  Request::input('fileURLs');

                $update =Course::find(Request::input('course_id'));
                $update->description =Request::input('descrip') ;
                $update->category_id =Request::input('category') ;
                
                $update->video =$vdeoURL ;

                $update->save();
               
                break;

        case 'delete_course':

                    $delete = Course::where('id',Request::input('delete_id'))->first();
                    $delete->is_deleted = 1;
                    $delete->save();
                    $status = 1;
            break;    



     	 	 }
     	 return response()->json(['status' => $status,'data' => $data]);
    }
     public function postFileUpload(){

        $option = array(

            'upload_dir' => 'data/temp/',
        );
       
        $upload_handler = new UploadFileHandler($option);
    }
}
