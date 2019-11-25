<?php
/**** Author : Nitin  **********/
namespace App\Http\Controllers;
use App\Http\Controllers\ResponseController;
use Illuminate\Http\Request;
use DB;
use Session;
use Redirect;
use Hash;
use Storage;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Response;
// use Illuminate\Support\Facades\Auth;
use Mail;
use Auth;
use App\user;


Class Ajax extends Controller{
		
		
		  public function index(){
			  $user=user::find(1);
			  return $user;
		  //return view ('welcome');
		  }
		
			  
			  
			  
			  public function alldata(){
				
		      $alldoctors = DB::table('users')
			               ->select('*')
						   ->orderBy('id','desc')
						      ->where('status','0')
						   //->limit('2')
						   ->get();
              return $alldoctors;
	}
	
	
			 public function editdata()
			                   {
								   
			    $id= $_POST['id'];
			    $singledoc= DB::table('users')
						->where('id',$id)
						->get();
					
			 return $singledoc;
	                            }
			public function savedata()
			{
				
				$name= $_POST['name'];
				$email= $_POST['email'];
				$phone= $_POST['phone'];
				
				
			    $data=array();
				$data['name']= $name;
			    $data['email']=$email ;
			    $data['phone']=$phone ;
				$st=DB::table('users')
                ->insertGetId($data);
			    return $st;
				
			}
				public function updataedataa()
			{
				$name= $_POST['name'];
				$email= $_POST['email'];
				$phone= $_POST['phone'];
				$id= $_POST['id'];
			
			    $data=array();
				$data['name']= $name;
			    $data['email']=$email ;
			    $data['phone']=$phone ;
				$st=DB::table('users')
				->where('id',$id)
                ->update($data);
			    return $st;
				
			}
									
	        public function updatedata()
	        {
		       $name= $_POST['name'];
		       $email= $_POST['email'];
		       $phone= $_POST['phone'];
		       $data=array();
	           $data['name']= $name;
	           $data['email']=$email ;
			   $data['phone']=$phone ;
			   $st=DB::table('users')
	           ->insertGetId($data);
		       return $st;
			}
			
            public function deletedata()
	        {
	           $id= $_POST['id'];
	           $st=DB::table('users')
	              ->where('id',$id)
	              ->update(array(
                         'status'=>1));
			    return response()->json(['status'=>'1', 'message'=>'delete successfully!']);
		
	        }
			
			
			
			
			 public function restoredata()
	        {
	          
	            $st=DB::table('users')
	              ->where('status',1)
	              ->get();
				  //return $st;
				if(!empty($st['0']))
				{
					return response()->json(['status'=>'1', 'result'=> $st]);
				}
				else{
					return response()->json(['status'=>'0', 'result'=> $st]);
				}
		
	        }
			
				 public function restoredelete()
	        {
	                 $id= $_POST['id'];
	                $st=DB::table('users')
	              ->where('id',$id)
	              
				 ->update(array('status'=>0));
				 
				//return $st;
			   // return response()->json(['status'=>'1', 'message'=>'added successfully!']);
		
	        }
				  public function getdata(){
		      $alldoctors = DB::table('users')->get();
              return $alldoctors;
}


/*=========================================
        function :: view_screening to view screening
          
        =========================================*/

		  
}
	