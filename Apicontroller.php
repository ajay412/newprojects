<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Session;
use App\Http\Requests\storevalidation;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\ValidationException;
use Validator;
use Input;
// use Hash;
use File;
use Twilio\Rest\Client;
use \Firebase\JWT\JWT;
use Twilio\Exceptions\TwilioException;
use Illuminate\Support\Facades\Hash;
use App\Url;
use DB;
use Redirect;

use validate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use thiagoalessio\TesseractOCR\TesseractOCR;
use Storage;
use Illuminate\Http\UploadedFile;
use Crypt;

use OCR;

class Apicontroller extends BaseController
{
	
	
   /*=======================================================
   Dated : 17  june 2019
   Function Name : login Doctor
   Use: 
   ===========================================================*/
	public function login_doctor(Request $request)
	{
		 $validator = Validator::make($request->all(),[
				'user_id'  => 'required',
				'mobile'  =>  'required',  
		        'device_type'  =>  'required', 
		        'device_id'  =>  'required'  		
			]);
	
		    if($validator->fails()){
	
			return response()->json(['status'=>0,'message'=>$validator->errors()->first()]);
		    }
			 
			 $mobile=$request->input('mobile');
			 $user_id=$request->input('user_id');
			
			 $device_type=$request->input('device_type');
			 $device_id=$request->input('device_id');
			    
				$device_exists = DB::table('doctors')
		
			                    ->where('device_id',$device_id)
			
			                    ->first();
		       if(!empty($device_exists)){
			 	  if($device_id ==  $device_exists->device_id )
		  {
			  return response()->json(['status'=>0,'message'=>'Device_id already exit']);
		  }
			   }
			
		  
		   $user_exists = DB::table('doctors')
			  ->where('phonenumber',$mobile)
			  ->where('user_id',$user_id)
			
			  ->first();
		
			print_r();exit;
			    
		 
			    if(!empty( $user_exists))
			 {
			$data=array();
		    $data['device_id']=$request->input('device_id');
		    $data['device_type']=$request->input('device_type');
	          $users  = DB::table('doctors')
			       	   ->where('phonenumber',$mobile)
			           ->update($data);
		      $doctor_detail  = DB::table('doctors')
			       	   ->where('phonenumber',$mobile)
					     ->where('device_id',$device_id)
			          ->first();
		    return response()->json(['status'=>1,'message'=>'inserted','user_detail'=> $doctor_detail]);
			 }
			 else
			 {
			return response()->json(['status'=>0,'message'=>'user not found ']);
			 }
			   
		  
			
	}
	
	/*=======================================================
     Dated : 17  june 2019
     Function Name : login_doc_confirm to confirm login
     Use: 
     ===========================================================*/
	public function login_doc_confirm(Request $request)
	{
		 $validator = Validator::make($request->all(),[
				'user_id'  => 'required',
				'mobile'  =>  'required',  
		        'device_id'  =>  'required'  		
			]);
	
		    if($validator->fails()){
	
			return response()->json(['status'=>0,'message'=>$validator->errors()->first()]);
		    }
			
		 $mobile=$request->input('mobile');
		 $user_id=$request->input('user_id');
		 $device_id=$request->input('device_id');
		  $user_exists = DB::table('doctors')
		               ->where('phonenumber',$mobile)
		               ->where('user_id',$user_id)
					   ->where('device_id',$device_id)
		                ->first();
		 $doctor_detail  = DB::table('doctors')
			       	    ->where('phonenumber',$mobile)
						->where('user_id',$user_id)
					   ->where('device_id',$device_id)
			             ->first();			
						
			  if(!empty( $user_exists))
			 {
		return response()->json(['status'=>1,'message'=>'success','user_detail'=> $doctor_detail]);	 
			 }
			 else
			 {
			return response()->json(['status'=>0,'message'=>'user not found ']);		 
			 }
	
	}
	
	/*=======================================================
     Dated : 17  june 2019
     Function Name : add_patient to confirm login
     Use: 
     ===========================================================*/
	public function add_patient(Request $request)
	{
		 $validator = Validator::make($request->all(),[
				'user_id'  => 'required',
				'firstname'  =>  'required',
				'lastname'  =>  'required',
				'gender'  =>  'required',  
		        'mobile'  =>  'required'  		
			]);
	
		    if($validator->fails()){
	
			return response()->json(['status'=>0,'message'=>$validator->errors()->first()]);
		    }
			
	
		 $user_id=$request->input('user_id');
		 $firstname=$request->input('firstname');
		 $lastname=$request->input('lastname');
		 $gender=$request->input('gender');
		 $mobile=$request->input('mobile');
		 $image=$request->file('image'); 
		 $email=$request->input('email');
		 
		 $user_exists = DB::table('patient')
			         
			               ->where('mobile',$mobile)
			               ->first();
	      
		  if(empty( $user_exists))
			 {
				if($image) {
		
          $file = $request->file('image');
          $extension = $file->getClientOriginalExtension(); // getting image extension
          $filename = time().'.'.$extension;
          $file->move('public/images/', $filename);

		  }
		  else
		  {
		  $filename='';
		  }
		  
		  	$data=array();
		    $data['user_id']=$user_id;
		    $data['firstname']=$firstname;
			$data['lastname']=$lastname;
			$data['gender']=$gender;  
		    $data['mobile']=$mobile;  
			$data['email']=$email;
			$data['image']=$filename;
	        $patient  = DB::table('patient')->insert($data); 
			 $user_details = DB::table('patient')
			              ->select('*')
                          ->where('user_id',$user_id)						  
                          ->get();						  
	     
		    return response()->json(['status'=>1,'message'=>'success','user_details'=>$user_details]);
 
			 }
			 else
			 {
			return response()->json(['status'=>0,'message'=>'Patient already registered']);	 
			 }
			
			
			
	}
	
	/*=======================================================
     Dated : 17  june 2019
     Function Name : update patient to login
     Use: 
     ===========================================================*/
	public function update_patient(Request $request)
	{
	      	 $validator = Validator::make($request->all(),[
				'user_id'  => 'required',
				'firstname'  =>  'required',
				'lastname'  =>  'required',
				'gender'  =>  'required',  
		        'mobile'  =>  'required'  		
			]);
	
		    if($validator->fails()){
	
			return response()->json(['status'=>0,'message'=>$validator->errors()->first()]);
		    }
			
	
		 $user_id=$request->input('user_id');
		 $firstname=$request->input('firstname');
		 $lastname=$request->input('lastname');
		 $gender=$request->input('gender');
		 $mobile=$request->input('mobile');
		 $image=$request->file('image'); 
		 $email=$request->input('email');
		  $patient_id=$request->input('patient_id');
		 
		 $user_exists = DB::table('patient')
			               ->where('user_id',$user_id)
			               ->where('id',$patient_id)
			               ->first();
	      
		  if(!empty( $user_exists)){
			 if($image){
				 
		  
          $file = $request->file('image');
          $extension = $file->getClientOriginalExtension(); // getting image extension
          $filename = time().'.'.$extension;
          $file->move('public/images/', $filename);

		  }
		  else
		  {
		  $filename=$user_exists->image;
		  			
		 
		  }
		  
		  	$data=array();
		    $data['user_id']=$user_id;
		    $data['firstname']=$firstname;
			$data['lastname']=$lastname;
			$data['gender']=$gender;  
		    $data['mobile']=$mobile;  
			$data['email']=$email;
			$data['image']=$filename;
	        $patient  = DB::table('patient')
			              ->where('user_id',$user_id)
			               ->where('id',$patient_id)
			         ->update($data); 
			 $user_details = DB::table('patient')
			              ->select('*')	
						     ->where('user_id',$user_id)
			               ->where('id',$patient_id)
                           ->first();						  
     	$user_details->image='http://localhost/cyo/public/images/'.$user_details->image;			  
	 
		    return response()->json(['status'=>1,'message'=>'success','user_details'=>$user_details]);
 
			 }
			 else
			 {
			return response()->json(['status'=>0,'message'=>'no user found']);	 
			 }
	}
		

     /*=======================================================
     Dated : 17  june 2019
     Function Name : login_doc_confirm to confirm login
     Use: 
     ===========================================================*/		
	public function patient_list(Request $request)
	{
		 	 $validator = Validator::make($request->all(),[
				'user_id'  => 'required'
				
				  		
			]);
	
		    if($validator->fails()){
	
			return response()->json(['status'=>0,'message'=>$validator->errors()->first()]);
		    }
			
			$user_id=$request->input('user_id');
		    $user_details = DB::table('patient')
			              
						  ->where('user_id',$user_id)
						  
                           ->get();
					   
			 if(!empty($user_details))
			 {  
           return response()->json(['status'=>1,'message'=>'success','user_details'=>$user_details]);		 
			 }
			 else
			 {
			return response()->json(['status'=>0,'message'=>'No user found']);
			 }
				 
		    
						   
	}
	
}