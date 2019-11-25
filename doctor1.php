<?php
/**** Author : Ajay  **********/
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


Class Doctor extends Controller
{
	

	/*=========================================
        function ::Get method signup function  
          
    =========================================*/
	
	
	public function signup ()
	{
		return view('doctor_signup');
	}
	
		public function dashboard ()
	{
		 $doctor_id   = DB::table('books')
		               ->get();
		                 
		
		return view('dashboard')->with('doctordetail',$doctor_id );
	}
	/*=========================================
        function ::Post method signup function  
          
    =========================================*/
	
		
	public function doctorsignup (Request $request)
	{
	
$random_number = mt_rand(1001, 9999);	
	$image=$request->file('image');
	//$request['password']=bcrypt($request->password);
	$firstnamee=$request->input('firstname');
	$lastnamee=$request->input('lastname');
	$email=$request->input('email');
	$phonenumber=$request->input('phonenumber');
	$password=$request->input('password');
	$gender=$request->input('gender');
	if($gender == 'male')
	{
		$gender='0';
	}
	else{
		$gender='1';
	}
	
	$firstname=ucfirst($firstnamee);
	$lastname=ucfirst($lastnamee);
	 $doctor_exists = DB::table('doctors')->where('phonenumber', $phonenumber)->first();
	
	 if(!empty($doctor_exists)){
		
	 return redirect()->route('signup')->with('user_registerd_exists', 'Number already registered.please login..')->withInput();
							
     }
     else
	 {
		    //$image_name = str_random(20).'.png';
		
			//Storage::putFileAs('public/profile_images', $request->file('image'), $image_name);
			//$mediaUrl = url('storage/profile_images/'.$image_name);
			//$img_url = $image_name;
      if ($request->hasFile('image')) {
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension(); // getting image extension
          $filename = time().'.'.$extension;
          $file->move('public/images/', $filename);
        
    }	
else{
	  $filename ='';
}	
		   $data=array();
		   $data['firstname']=$firstname;
		   $data['lastname']=$lastname;
		   $data['phonenumber']=$phonenumber ;
		   $data['email']=$email ;
		   $data['gender']=	$gender;
		   $data['image']=$filename ;
              $data['password']=bcrypt($password);
		   $data['account_type']='1' ;
		   $data['block_status']='unblocked' ;
		   $data['user_id']=$random_number ;
		  
	       $doctor_id   = DB::table('users')->insertGetId($data);	
	      return redirect()->route('login')->with('user_registerd_exists', 'signup successful');     		   
}
	
	}
	public function login()
	{
		//dd("dd");
		return view('login');
	}
	
	public function loginnew()
	{
		dd("dd");
		return view('login');
	}
	      public function logout(){
                      Auth::logout();
                      Session::flush();

	                 return redirect()->route('login');
				 }
	public function adminlogin(Request $request)
	{
		
		if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
			
		{
			  	$check_user = DB::table('users')
							->where('email','=',$request->email)
							->first();
							$request->session()->put('loginId', $check_user->id);
							///$ajay= $request->session()->get('loginId');
							//print_r($check_user);exit;
			 return redirect()->route('dashboard');
		}
		else{
		  return redirect()->route('login')->with('user_pass_notvalid', 'Email or password not matched')
			 ->withInput(); 
		}
		
	}
	   public function admin(Request $request)
   {

	          $email=$request->input('email');
              $password=$request->input('password');
	          $check_user = DB::table('admin')
							   ->where('email',$email)
							   ->where('password',$password)
							   ->where('id',1)
							  ->first();
							  
							  // exit;
			
	         if(!empty($check_user)){

			
				 
		      /****putting loginuserid ito session****/
			  //$request->session()->put('loginId', $check_user->id);
			  
               return redirect()->route('dashboard');
             }
			 else{
				 
         
			
             return redirect()->route('login')->with('user_pass_notvalid', 'Email or password not matched')
			 ->withInput();  
				
			 }
			
			
		     
       
		}

}