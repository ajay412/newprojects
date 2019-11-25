<?php
/**** Author : Ajay  **********/
namespace App\Http\Controllers;

use App\User;
//use App\Http\Controllers\Controller;
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
	/*=========================================
        function ::Post method signup function  
          
    =========================================*/
	
		
	public function doctor_signup (Request $request)
	{
	$random_number = mt_rand(1001, 9999);	
	$image=$request->file('image');
	
	$firstnamee=$request->input('firstname');
	$lastnamee=$request->input('lastname');
	$email=$request->input('email');
	$phonenumber=$request->input('phonenumber');
	$cityy=$request->input('city');
	$address=$request->input('address');
	$gender=$request->input('gender');
	$specializations=$request->input('specialization');
	$certificationnumbers=$request->input('certificationnumber');
	$dealernames=$request->input('dealername');
	$firstname=ucfirst($firstnamee);
	$lastname=ucfirst($lastnamee);
	$city=ucfirst($cityy);
	$specialization=ucfirst($specializations);
	$certificationnumber=ucfirst($certificationnumbers);
	$dealername=ucfirst($dealernames);
	if( $gender == 'male')
	{
	$gender='0';
	}
       elseif( $gender == 'female')
	{
	$gender='1';
	}
	 $doctor_exists = DB::table('doctors')
	 ->where('phonenumber', $phonenumber)
	 
	 ->first();
	
	 if(!empty($doctor_exists)){
	 return redirect()->route('doctor_registration')->with('user_registerd_exists', 'Phone number already registered ')->withInput();
							
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
		   $data['city']=$city ;
		   $data['address']=$address;
		   $data['gender']=$gender;
		   $data['image']=$filename ;
                    $data['status']='0' ;
		   $data['account_type']='1' ;
		   $data['block_status']='2' ;
		   $data['user_id']=$random_number ;
		   $data['specialization']=$specialization;
		   $data['certification_number']=$certificationnumber;
		   $data['dealer_name']=$dealername;
	       $doctor_id   = DB::table('doctors')->insertGetId($data);	
	      return redirect()->route('doctor_registration')->with('user_registerd_exists', 'Doctor registered successfully');     		   
}
	
	}
	
	
	
    /*=========================================
        function ::Get method admin_login function  
          
    =========================================*/
	public function login()
	{
		return view('admin/admin_login');
	}
	

	
	/*=========================================
        function ::Post method admin_login function  
          
    =========================================*/
		
   public function admin_login(Request $request)
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
			  session()->put('loginId', 'A');
			  
               return redirect()->route('dashboard');
             }
			 else{
				 
             
			
             return redirect()->route('admin')->with('user_pass_notvalid', 'Incorrect Email or Password!')
			 ->withInput();  
				
			 }
			
			
		     
       
		}
	  /*=========================================
        function ::Get method dashboard function  
          
    =========================================*/
	
	public function dashboard()
	{
		
		$alldoc=DB::table('doctors')
			          ->select('*')
					  ->where('account_type','1')
					 
					  ->where('status','0')
					  
                      ->count();
					   
		$allpatient=DB::table('patient')
                ->select('*')
	            
	            ->count();
			
		$data['alldoctors']=$alldoc;
		$data['allpatient']=$allpatient;
	
					   
		return view('admin/dashboard')->with('alldoc',$data);
	}
	   
       /*=========================================
        function :: doctorlist to show all doctors  
          
        =========================================*/
	    public function doctorlist()
	          {
		
			      $alldocs=DB::table('doctors')
			            ->select('*')
			            ->where('account_type','1')
					    ->where('status',0)
				        ->orderBy('id', 'desc')
					    ->get();
		
		return view('admin/doctorlist')->with('doclist',$alldocs);
		
	          }
	
		 /*=========================================
          function :: add doctor from  doctorlist
          
          =========================================*/
	     public function doctor_add (Request $request)
	        {
			$random_number = mt_rand(1001, 9999);	
			$image=$request->file('image');
			
			$firstnamee=$request->input('firstname');
			$lastnamee=$request->input('lastname');
			$email=$request->input('email');
			$phonenumber=$request->input('phonenumber');
			$cityy=$request->input('city');
			$address=$request->input('address');
			$gender=$request->input('gender');
			$specializations=$request->input('specialization');
			$certificationnumbers=$request->input('certificationnumber');
			$dealernames=$request->input('dealername');
			$firstname=ucfirst($firstnamee);
			$lastname=ucfirst($lastnamee);
			$city=ucfirst($cityy);
			$specialization=ucfirst($specializations);
			$certificationnumber=ucfirst($certificationnumbers);
			$dealername=ucfirst($dealernames);
	        if( $gender == 'male')
	        {
	        $gender='0';
	        }
            elseif( $gender == 'female')
	        {
	        $gender='1';
	        }
	        $doctor_exists = DB::table('doctors')
	        ->where('phonenumber', $phonenumber)
	        ->first();
	
	        if(!empty($doctor_exists)){
	       return redirect()->route('doctorlist')->with('user_registerd_exists', 'Phone number already registered ')->withInput();
							
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
		   $data['city']=$city ;
		   $data['address']=$address;
		   $data['gender']=$gender;
		   $data['image']=$filename ;
                    $data['status']='0' ;
		   $data['account_type']='1' ;
		   $data['block_status']='2' ;
		   $data['user_id']=$random_number ;
		   $data['specialization']=$specialization;
		   $data['certification_number']=$certificationnumber;
		   $data['dealer_name']=$dealername;
	       $doctor_id   = DB::table('doctors')->insertGetId($data);	
	      return redirect()->route('doctorlist')->with('user_registerd_exists', 'Doctor registered successfully');     		   
            }
	
	        }
	
	
	 /*=========================================
        function :: logout to logout 
          
        =========================================*/
		
		 public function logout(){
                      Auth::logout();
                      Session::flush();

	                 return redirect()->route('admin');
	            
				 }
				 
	   /*=========================================
        function :: delete to delete doctor from doctor list
          
        =========================================*/
	     public function delete($id){
                       $userid= $id;
					  
                      $allusers=DB::table('doctors')
			                    ->where('id', $userid)
                               //->update(array('status' =>1));
							  ->delete();
						 $allpatient=DB::table('patient')
			                    ->where('user_id', $userid)
                               //->update(array('status' =>1));
							  ->delete();
                          $allscreening=DB::table('add_screening')
			                    ->where('user_id', $userid)
                               //->update(array('status' =>1));
							  ->delete();	


                           $allimages=DB::table('images')
			                    ->where('user_id', $userid)
                               //->update(array('status' =>1));
							  ->delete();							  
               
		
	            return redirect()->route('doctorlist')->with('doctor', 'Doctor deleted successfully');
				 }
				 
		/*=========================================
        function :: block to blockdoctor from doctor list
          
        =========================================*/
	     public function block($id){
                       $userid= $id;
					  
                      $allusers=DB::table('doctors')
			                    ->where('id', $userid)
                                ->update(array('block_status' => '1'));
							
               
					
	            return redirect()->route('doctorlist')->with('doctor', 'Doctor blocked successfully');
				 }
				 
				 
				 
	    /*=========================================
        function :: unblock to unblockdoctor from doctor list
          
        =========================================*/
	     public function unblock($id){
                       $userid= $id;
					  
                      $allusers=DB::table('doctors')
			                    ->where('id', $userid)
                                ->update(array('block_status' => '2'));
							
               
					
	            return redirect()->route('doctorlist')->with('doctor', 'Doctor unblocked successfully');
				 }
				 
				 
				 
				 
	   /*=========================================
        function :: add_doctor to add_doctor into doctor list
          
        =========================================*/
	     public function add_doctor(){
			 
			 return view('admin/add_doctor');
			 
		 }
		 
		   /*=========================================
        function :: refresh to refresh device_id
          
        =========================================*/
	     public function refresh_device_id($id)
		 {
			 $user_id=$id;
			  $users=DB::table('doctors')
			                    ->where('id', $user_id)
                                ->update(array('device_id' => ''));
			return redirect()->route('doctorlist')->with('doctor', 'Device refreshed successfully');
		
			 
		 }
		 
		 
		 
	
		/*=========================================
        function :: view_patient to view page
          
        =========================================*/
	     public function view_patient($id)
		 {
			 $user_id=$id;
		     // print_r( $user_id);exit;
			  $users=DB::table('patient')
			  ->select('*')
			  ->where('patient.user_id', $user_id)
              ->get();
			$doctors=DB::table('doctors')
			            ->select('*')
			            ->where('user_id', $user_id)
                        ->get();
					$data['patient']= $users;
                    $data['doctors']= $doctors;					
								 
          return view('admin/patientview')->with('patient_list',$data);
		
			 
		 }
		 
		 
		/*=========================================
        function :: view_screening to view screening
          
        =========================================*/
	     public function view_screening($id)
		 
		 {
			    $user_id=$id;
				    $screen=DB::table('images')
			         ->select('images.screening_no')
					 //->select('*')
				     ->distinct()
					 ->where('patient_id',$user_id)
				     ->orderBy('screening_no', 'asc')
				    
                       ->get();
					   

		
	
			   
					
						     foreach($screen as $n=>$screens){
                               $screening_dates = DB::table('images')
				               ->select('images.screening_date')
				              //->where('patient_id',$user_id)
				             ->where('screening_no', $screens->screening_no)
                             ->orderBy('screening_date', 'desc')
							   ->distinct()
							 -> get();
							 
							 foreach($screening_dates as $m=>$images){
								  $screening_images = DB::table('images')
				                         ->select('images.image','images.image_name','images.id','images.status')
				            
				                      ->where('screening_no', $screens->screening_no)
							   ->where('screening_date', $images->screening_date)
                               
							   -> get(); 
							   
					$screening_dates[$m]->screeningimages=$screening_images;		   
							 }
							 
					$screen[$n]->screeningdates=$screening_dates;									
	           		
							}
				
						
				      $patient_detail=DB::table('patient')
			                   ->select('patient.firstname','patient.lastname','patient.id','patient.user_id')
							   ->where('id',$user_id)
							   ->first();
			          $doctors_detail=DB::table('doctors')
			                   ->select('doctors.firstname','doctors.lastname','doctors.user_id')
							   ->where('user_id',$patient_detail->user_id)
							   ->first();
								
					$data['screening']=$screen;
		            $data['patient_detail']=$patient_detail;
		            $data['doctors_detail']=$doctors_detail;						
								 
          return view('admin/screening')->with('screening_detail',$data);
		
			 
		 }
		  
		
			
				 
				 
}