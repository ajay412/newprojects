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
use Exception;

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
		  ->where('block_status','1')
		  ->first();
		 if( $user_exists)
		 {
	     return response()->json(['status'=>0,'message'=>'Your account is blocked by admin !']);
		 }
		 else{
			 
		 
		 
		 $user_exists = DB::table('doctors')
          ->where('phonenumber',$mobile)
          ->where('user_id',$user_id)
		  
		  ->first();
  
		  
	     if(empty($user_exists)){
			return response()->json(['status'=>0,'message'=>'Incorrect UserId or Phone number!']);
		 }
         elseif(!empty($user_exists)){
			 
		 if($user_exists->device_id == ''){
				
		 $data=array();
		 $data['device_id']=$request->input('device_id');
		 $data['device_type']=$request->input('device_type');
		 $users  = DB::table('doctors')
				 ->where('user_id',$user_id)
				 ->where('phonenumber',$mobile)
				 ->update($data);
		 $doctor_details = DB::table('doctors')
				 ->where('user_id',$user_id)
				 ->where('phonenumber',$mobile)
				 ->where('device_id',$device_id)
				 ->first();
		if(!empty($doctor_details->image)){
		$doctor_details->image=url('/public/images/')."/".$doctor_details->image;
		 }
		return response()->json(['status'=>1,'message'=>'Doctor login successfully!','user_detail'=>$doctor_details]);
		 }
		 else{
		$doctor_detail  = DB::table('doctors')
				       ->where('user_id',$user_id)
				       ->where('phonenumber',$mobile)
				       ->where('device_id',$device_id)
				       ->first();
		if(empty($doctor_detail)){
		return response()->json(['status'=>0,'message'=>'This user is already linked with other device. Please use different user Id and phone number.']);
		} 
		if(!empty($doctor_detail->image))
		{
		$doctor_detail->image=url('/public/images/')."/".$doctor_detail->image;
		}
		if(!empty($doctor_detail)){
	    return response()->json(['status'=>1,'message'=>'Doctor login successfully!','user_detail'=>$doctor_detail]);
		 }
		} 
	  }  
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
					  ->where('firstname',$firstname)
					  ->where('lastname',$lastname)
					  ->first();
         $user_check= DB::table('doctors')
                      ->where('user_id',$user_id)
                      ->first();
		  if(!empty($user_check)){
		  if(empty( $user_exists)){
          if($image) {
          $file = $request->file('image');
          $extension = $file->getClientOriginalExtension(); // getting image extension
          $filename = time().'.'.$extension;
          $file->move('public/images/', $filename);
		  }
          else{
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
          $user = DB::table('patient')
                ->select('*')
                ->where('user_id',$user_id)						  
                ->get()
				->toArray();
					
		  foreach($user as $n=>$users)
	      {  
	      if($users->image)
	      {
	      $user[$n]->image=url('/public/images/')."/".$users->image;
	      }
	      else{
		   $user[$n]->image=''; 
	        }
	     }	
          return response()->json(['status'=>1,'message'=>'success','user_details'=>$user]);
            }
          else{
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
            $user_details->image=url('/public/images/')."/".$user_details->image;			  
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
		    $patient=DB::table('add_screening')
					   ->select('add_screening.screening_date','add_screening.screening_no')
					   ->where('add_screening.user_id',$user_id)
					   ->orderby('add_screening.screening_date','desc')
					   ->orderby('add_screening.screening_no','desc')
					   ->where('patient_id',$users->id)
					   ->first();
		   if( $patient ){
           $user_details[$n]->lastdate=$patient->screening_date;
		   $user_details[$n]->last_screening_id=$patient->screening_no;
		   }
		   else{
		   $user_details[$n]->lastdate='';
		   $user_details[$n]->last_screening_id='';
		   }
		   $user_details[$n]->image=url('/public/images/')."/".$users->image;
							
		   }
				           
	  	   if(!empty($user_details)){  
           return response()->json(['status'=>1,'message'=>'success','user_details'=>$user_details]);		 
            }
            else {
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
			      
		   $name=$request->input('name');
		   $user_id=$request->input('user_id');
	       if($name){
		   $user_firstname = DB::table('patient')
		                   ->select('*')
		                   ->where('firstname', 'LIKE', '%'.$name.'%')
		                   ->Where('user_id',$user_id)
		                   ->get()
		                   ->toArray();
		   $user_lastname = DB::table('patient')
						   ->select('*')
						   ->where('lastname', 'LIKE', '%'.$name.'%')
						   ->Where('user_id',$user_id)
						   ->get()
						   ->toArray(); 
		  if($user_firstname){
		  $user_name=array_merge($user_firstname,$user_lastname); 
		  $user_exists=array_unique($user_name, SORT_REGULAR);
		  }
		  else{
           $user_exists=$user_lastname;
			}
		 }
		  else{
		  $user_exists = DB::table('patient')
				       ->select('*')
				       ->Where('user_id',$user_id)
					   ->get();
		   }
		  foreach($user_exists as $n=>$users)    {
		  $patient=DB::table('add_screening')
				      ->select('add_screening.screening_date','add_screening.screening_no')
		              ->where('add_screening.user_id',$user_id)
				      ->orderby('add_screening.screening_date','desc')
				      ->where('patient_id',$users->id)
				      ->first();
		 $user_exists[$n]->lastdate='';
		 $user_exists[$n]->last_screening_id='';
		 if($patient){
		 $user_exists[$n]->lastdate=$patient->screening_date;
		 $user_exists[$n]->last_screening_id=$patient->screening_no;
		 }
		 $user_exists[$n]->image=url('/public/images/')."/".$users->image;
	     return response()->json(['status'=>1,'message'=>'success','user_details'=>$user_exists]);
		 }
		 else{
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
        if($image){
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
		             ->where('status','0')
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
      public function getscreening(Request $request){
		     $user_id=$request->input('user_id');
			 $patient_id=$request->input('patient_id');
			 $screening = DB::table('add_screening')
					     ->select('*')
				         ->select('add_screening.id','add_screening.patient_id','add_screening.user_id','add_screening.screening_date','add_screening.screening_no','patient.firstname','patient.lastname')
						 ->join('patient','patient.id','=','add_screening.patient_id')
					     ->where('add_screening.user_id',$user_id)
						 ->where('add_screening.patient_id',$patient_id)
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
		if($validator->fails()){
			return response()->json(['status'=>0,'message'=>$validator->errors()->first()]);
		}

		$user_id=$request->input('user_id');
		$patient_id=$request->input('patient_id');
		$screening_id=$request->input('screening_id');
		
		/* 	 $screening_details = DB::table('images')
			 ->select('id','screening_id','patient_id','user_id','screening_no','screening_date','image','image_name')
		     ->where('user_id',$user_id)
			 ->where('patient_id',$patient_id)
			 ->where('screening_id',$screening_id)
		   //->groupBy('screening_date')
			 ->get();
			 foreach($screening_details as $n=>$screening_detail)    {
			 $screening_details[$n]->image='http://119.81.1.69/~callmyma/cyo/public/images/'.$screening_detail->image;
				} */
				               
		$screening_details = DB::table('images')
			->select('screening_date')
			
			->distinct()
			->where('user_id',$user_id)
			->where('patient_id',$patient_id)
			->where('screening_id',$screening_id)
	        ->where('status','0')
			->get()
			->toArray();
			//print_r($screening_details);exit;
			//echo "<pre>"; print_r($screening_details); echo "</pre>"; exit;
	   if(!empty($screening_details)){
	   foreach($screening_details as $n=>$screening_detail){
	   $screening_images = DB::table('images')
				//->select('*')
			    ->select('id','screening_id','user_id','patient_id','screening_no','screening_date','image_name','created_at', DB::raw('CONCAT("http://119.81.1.69/~callmyma/cyo/public/images/","", image) AS image'))
				->where('user_id',$user_id)
				->where('patient_id',$patient_id)
				->where('screening_id',$screening_id)
				->where('status','0')
				->where('screening_date',$screening_detail->screening_date)
				->get();
			
			   //$screening_images->image='http://119.81.1.69/~callmyma/cyo/public/images/'.$screening_images->image; 
		$screening_details[$n]->user_details=$screening_images;
	   }
         return response()->json(['status'=>1,'message'=>'succees','user_details'=>$screening_details]); 
	   }
        else{
		return response()->json(['status'=>0,'message'=>'no records']); 
            }			
	    }
	
	
		/*=======================================================

     Dated : 17  june 2019

     Function Name : update doctor profile 

     Use: 

     ===========================================================*/

	public function update_doctor(Request $request)

	{
         $user_id=$request->input('user_id');
         $phonenumber=$request->input('phonenumber');
         $email=$request->input('email');
         $address=$request->input('address');
         $user_exists = DB::table('doctors') 
		              ->where('user_id',$user_id)
					  ->first();

	     if(!empty($user_exists)){
		 $user_no = DB::table('doctors')
                   ->where('phonenumber', $phonenumber)
				   ->first();
		 if($user_no){
				  
		  return response()->json(['status'=>0,'message'=>'Number already registered']);	  }
		  else{
		  $data=array();
		  $data['phonenumber']=$phonenumber;
          $data['email']=$email;
          $data['address']=$address;  
          $patient  = DB::table('doctors')
                    ->where('user_id',$user_id)
					->update($data); 
          $user_details = DB::table('doctors')
           		        ->select('*')	
					    ->where('user_id',$user_id)
						->first();						  
	
     	  $user_details->image=url('/public/images/')."/".$user_details->image;			  
          return response()->json(['status'=>1,'message'=>'success','user_details'=>$user_details]);
              }
		  }
		    else{
          return response()->json(['status'=>0,'message'=>'no user found']);	 

			 }

	}
	
	
	
	   /*=======================================================

        Dated : 17  june 2019

         Function Name : delete screening 

       ===========================================================*/
	
	 public function delete_screening(Request $request){
		 
		 
		 
		        $validator = Validator::make($request->all(),[

				'id'  => 'required'

	               ]);

	            if($validator->fails()){
                return response()->json(['status'=>0,'message'=>$validator->errors()->first()]);
				}
		 
		        $user_id=$request->input('id');
                $image_id= explode(",", $user_id);
		 	    $allusers=DB::table('images')
			     ->WhereIn('id', $image_id)
                 ->update(array('status' =>1));
				
                if($allusers >0)
			    {
			
	          	    return response()->json(['status'=>1,'message'=>'success']);
				 }
				 else{
					 return response()->json(['status'=>0,'message'=>'failure']);
				 }
	
	 }
	
	   /*=======================================================

        Dated : 17  june 2019

        Function Name : feedback
       ==========================================================*/
	 
	  public function feedback(Request $request)
	  {
	 
	            $validator = Validator::make($request->all(),[

				'user_id'  => 'required'
			

	               ]);

	            if($validator->fails()){
                return response()->json(['status'=>0,'message'=>$validator->errors()->first()]);
				}
				$user_id=$request->input('user_id');
				$feedmessage = "hello hello";
		 	    $doc=DB::table('doctors')
				        ->select('doctors.email')
			            ->Where('user_id', $user_id)
                        ->first();
						
						$email=$doc->email;
						
					// $baseUrl= url('/');
					 $sendEmail = env('MAIL_USERNAME','');	
					//print_r($email);
					exit;
					
					 $name = "";
					
						

              Mail::raw("Hello admin,\r\n\r\nPlease check the feedback which comes from doctor : \r\n\r\nPanel link:-".$baseUrl." \r\nEmail ".$email."  \r\nPassword: ".$password." ", function ($message) use ($email, $sendEmail) {
            $message->to($email)->from($sendEmail, 'CYO')
                ->subject("CYO: Feedback");
             });
	
				
	      }
 
     /*=======================================================

     Dated : 17  june 2019

     Function Name : block screening 

     Use: 

     ===========================================================*/
	
	 public function block_screening(Request $request){
		 
		 
		 $validator = Validator::make($request->all(),[

				'user_id'  => 'required'
			

	               ]);

	            if($validator->fails()){
                return response()->json(['status'=>0,'message'=>$validator->errors()->first()]);
				}
				
				$user_id=$request->input('user_id');
			    $doc=DB::table('doctors')
				        ->select('doctors.block_status')
			            ->Where('user_id', $user_id)
                        ->first();
					
	            if($doc){
				if($doc->block_status == '2'){
				return response()->json(['status'=>1,'message'=>'user exit','doctor_status'=>$doc->block_status]);	
				}
				else{
			    return response()->json(['status'=>0,'message'=>'user blocked','doctor_status'=>$doc->block_status]);	
				}
				 }
				else{
				return response()->json(['status'=>0,'message'=>'user not found','doctor_status'=>3]);
				}
				
		 
	 }
	
	
}