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


class Apiicontroller extends BaseController

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

			    


	

			   

			

		  

		   $user_exists = DB::table('doctors')

			  ->where('phonenumber',$mobile)

			  ->where('user_id',$user_id)

			

			  ->first();

		


			    

		 

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
		 		
				$age=$request->input('age');

		 

		 $user_exists = DB::table('patient')

			         

			               ->where('mobile',$mobile)

			               ->first();

	      
		 $user_check= DB::table('doctors')

			         

			               ->where('user_id',$user_id)

			               ->first();
						   if(!empty($user_check))
						   {

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
			$data['age']=$age;

	        $patient  = DB::table('patient')->insert($data); 

			 $user_details = DB::table('patient')

			              ->select('*')

                          ->where('user_id',$user_id)						  

                          ->get();						  

	     

		    return response()->json(['status'=>1,'message'=>'success']);

 

			 }

			 else

			 {

			return response()->json(['status'=>0,'message'=>'Patient already registered']);	 

			 }
						   }
			 else{
				 	return response()->json(['status'=>0,'message'=>'User not registered']);	
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
		  $age=$request->input('age');

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
			
			$data['age']=$age;

	        $patient  = DB::table('patient')

			              ->where('user_id',$user_id)

			               ->where('id',$patient_id)

			         ->update($data); 

			 $user_details = DB::table('patient')

			              ->select('*')	

						     ->where('user_id',$user_id)

			               ->where('id',$patient_id)

                           ->first();						  

     	$user_details->image='http://119.81.1.69/~callmyma/cyo/public/images/'.$user_details->image;			  

	 

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

					    foreach($user_details as $n=>$users)    {
							
							$user_details[$n]->lastdate='';
							$user_details[$n]->previous_screening_id='';
							$user_details[$n]->next_screening_id='';
							$user_details[$n]->next_screening_name='';
					        $user_details[$n]->image='http://119.81.1.69/~callmyma/cyo/public/images/'.$users->image;
							
						}
				
	  			  

			 if(!empty($user_details))

			 {  

           return response()->json(['status'=>1,'message'=>'success','user_details'=>$user_details]);		 

			 }

			 else

			 {

			return response()->json(['status'=>0,'message'=>'No user found']);

			 }

				 

		    

						   

	}
	
	
	  /*=======================================================

     Dated : 17  june 2019

     Function Name : patient_search to confirm login

     Use: 

     ===========================================================*/		

	public function patient_search(Request $request)

	{
			          $validator = Validator::make($request->all(),
				  [
			  
				  'name'  => 'required',
			
			      ]);
				  if($validator->fails())
				  {
	     
			      return response()->json(['status'=>0,'message'=>$validator->errors()->first()]);
			       }
				   
				   $name=$request->input('name');
				   $user_id=$request->input('user_id');
				   $user_exists = DB::table('patient')
				                 ->select('*')
				                 ->where('firstname', 'LIKE', '%'.$name.'%')
							->orWhere('lastname', 'LIKE', '%'.$name.'%')
								 ->get();
						if(count($user_exists)>0)
								{
					      return response()->json(['status'=>1,'message'=>'success','user_details'=>$user_exists]);
								}
								else
								{
					return response()->json(['status'=>0,'message'=>'No user found with this name']);
								}
		
	}
	
	  /*=======================================================

     Dated : 19 june 2019

     Function Name : add screening  to add screening

     Use: 

     ===========================================================*/
      public function addscreening(Request $request)
	{
		$validator = Validator::make($request->all(),
		[  
			'user_id'  => 'required',
			'image'=>'required',
			'patient_id'=>'required',
			'screening_date'=>'required',
		]);
		if($validator->fails())
		{
			return response()->json(['status'=>0,'message'=>$validator->errors()->first()]);
		}
				   
		$user_id=$request->input('user_id');
		$patient_id=$request->input('patient_id');
		$imagename=	$request->input('image_name');
		$screening_no=$request->input('screening_no');
		$screening_date=$request->input('screening_date');
		$image=$request->file('image'); 
		
		$image_name = explode(",", $imagename);
		//echo"<pre>"; print_r($image_name); echo"</pre>";
		//echo"<pre>"; print_r($_FILES); echo"</pre>";
		//exit;

		$user_check=DB::table('doctors')
		->where('user_id',  $user_id)
		->first(); 

		$add_screening= DB::table('add_screening')
		->where('screening_no', $screening_no)
		->where('user_id',  $user_id)
		->where('patient_id',  $patient_id)
		->first(); 
                             
		if(!empty($add_screening))
		{

							
			$data=array();
				
			$data['screening_date']=$screening_date;
			$patient_detail = DB::table('add_screening') 
			->where('user_id',$user_id)
			->where('patient_id',$patient_id)	
			->where('screening_no',$screening_no)	
			->update($data);	
						  
			$patient_details=$add_screening->id;

									  
		}
		else{

			$data=array();
			$data['user_id']=$user_id;
			$data['patient_id']=$patient_id;
			$data['screening_no']= $screening_no;
			$data['screening_date']=$screening_date;
			$patient_detail = DB::table('add_screening')
			->insertGetId($data); 
			
			$patient_details=$patient_detail;	  
		}

			//print_r($patient_detail);
			//return response()->json(['status'=>1,'message'=>'success','user_details'=>    $patient_detail]);

		if($image)
		{
			
			$file = $request->file('image');
			
		
		
			foreach ($file as $n =>$files){
			

				$filename= time().'.'.$files->getClientOriginalExtension();
				$new_filename=rand(123456,999999).'.'. $filename;
				
				$files->move('public/images/',$new_filename);
				
				$data=array();
				$data['image']=$new_filename;
				$data['user_id']=$user_id;
				$data['patient_id']=$patient_id;
				$data['image_name']=$image_name[$n];
				$data['screening_no']= $screening_no;
				$data['screening_date']=$screening_date;
				$data['screening_id']=$patient_details;

				$patient  = DB::table('images')->insert($data);
			}
			
			$user_exists = DB::table('images')
			->select('*')
			->get();
			return response()->json(['status'=>1,'message'=>'success']); 

		}
		else{
			return response()->json(['status'=>0,'message'=>'No image selected']); 
		} 
	
	}
	
		  /*=======================================================

     Dated : 19 june 2019

     Function Name : getscreening  to get screening

     Use: 

     ===========================================================*/
            	public function getscreening(Request $request)

	{
		
		
		
		     $validator = Validator::make($request->all(),
				  [
			  
				   'user_id'  => 'required',
				 
				   'patient_id'=>'required',
				
				
			
			      ]);
				  if($validator->fails())
				  {
	     
			      return response()->json(['status'=>0,'message'=>$validator->errors()->first()]);
			       }
				
					 $user_id=$request->input('user_id');
					 $patient_id=$request->input('patient_id');
					 
					 $screening = DB::table('add_screening')
				                 ->select('*')
							      ->where('user_id',$user_id)
								  ->where('patient_id',$patient_id)
				                  ->get();
			return response()->json(['status'=>1,'message'=>'succees','user_details'=>$screening]);   
	
	}
	
	
	
			  /*=======================================================

     Dated : 19 june 2019

     Function Name : screening details  to get screening

     Use: 

     ===========================================================*/
            	public function screening_details(Request $request)

	{
		   $validator = Validator::make($request->all(),
				  [
			  
				   'user_id'  => 'required',
				 
				   'patient_id'=>'required',
				     
				   'screening_id'=>'required',
				
				
			
			      ]);
				  if($validator->fails())
				  {
	     
			      return response()->json(['status'=>0,'message'=>$validator->errors()->first()]);
			       }
		
		          $user_id=$request->input('user_id');
				  $patient_id=$request->input('patient_id');
				   $screening_id=$request->input('screening_id');
		
		          			 $screening_details = DB::table('images')
				                 ->select('id','screening_id','patient_id','user_id','screening_no','screening_date','image','image_name')
							
							      ->where('user_id',$user_id)
								  ->where('patient_id',$patient_id)
								  ->where('screening_id',$screening_id)
								   //->groupBy('screening_date')
							        ->get();
							    foreach($screening_details as $n=>$screening_detail)    {
							
					
					        $screening_details[$n]->image='http://119.81.1.69/~callmyma/cyo/public/images/'.$screening_detail->image;
								}
				               
							
			return response()->json(['status'=>1,'message'=>'succees','user_details'=>$screening_details]);   
		
		
		
		
		
	}
}