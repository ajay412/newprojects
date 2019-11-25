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

use Illuminate\Support\Facades\Hash;
use App\Url;
use DB;
use Redirect;
require_once(__DIR__.'/../../../vendor/autoload.php');
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Mail;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use thiagoalessio\TesseractOCR\TesseractOCR;
use Storage;
use Illuminate\Http\UploadedFile;
use Crypt;

use OCR;
session_start();

class Patient extends Controller{
	
	public function Patientlogin()
	{
		return view('patientlogin');
	}
		public function patientLoginn(Request $request)
		{
             $this->validate($request, ['email' => 'required',
                                        'password' => 'required']);
	                 $email=$request->input('email');
                     $password=$request->input('password');
	                 $check_user=DB::table('users')->where(['email'=>$email,'password'=>$password])
					                        ->where('accounttype',1)
											->where('status',0)
											->first();
	 
              if($check_user)
			  {
		  
             //if(Hash::check($password,$check_user->password))
			 //{
				 
                  $request->session()->put('loginId', $check_user->id);
				 $request->session()->put('patient_name', $check_user->firstname);
				 $request->session()->put('patient_image', $check_user->image);
				 $request->session()->put('patient_position', $check_user->dr_position);
				  $request->session()->put('mobile', $check_user->mobile);
				    //$ajay= $request->session()->get('patient_image');
			//echo $ajay;
			//exit; 
                 return redirect('patienthomescreen');
             }
			 else{
			
			
				  
                           Session::flash('message', 'My message');
                            return redirect()->route('Patientlogin')->with('user_email_notvalid', 'error|user notvalid...');  
				   return redirect()->route('Patientlogin');
             }
			  //}
        }
       
		
		
			
		public function signuplogin1()
		{
			



			return view('patientsignup');
				//return view('patientsignup2');
		}
		
		public function signup1(Request $request)
		{    

		
		       $randomNumber = rand(1000, 9999); 
      
               // Print 
            
			  $mobile=$request->input('mobile');
			
			   $countrycode=$request->input('country_code');
			  
			
			
			  $mobile_cntry_code   = 	explode(" ", $mobile);
                    print_r($mobile_cntry_code);
					
                        $patient_exists = DB::table('users')->where('mobile', $mobile_cntry_code[1])->where('accounttype', '1')->get();
			
												  
						  
                        if(empty($patient_exists[0])){
							echo"ok";
							exit;
  $account_sid = 'AC380d6d2ee6264b7970f78e07d8e1f8bb';
              $auth_token = '7c416e9a89bd9a2ca2e71fcfa0a263f5';
                // In production, these should be environment variables. E.g.:
                // $auth_token = $_ENV["TWILIO_ACCOUNT_SID"]

                // A Twilio number you own with SMS capabilities
              $twilio_number = "+17542292626";

              $client = new Client($account_sid, $auth_token);
			
              $client->messages->create(
              // Where to send a text message (your cell phone?)
                          $mobile,
                     array(
                              'from' => $twilio_number,
                              'body' => 'your otp is '.$randomNumber
                           )
                                        );
                            $request->session()->put('otp', $randomNumber);
                            $request->session()->put('mobile', $mobile);
                            $request->session()->put('countrycode', $countrycode);
                            return view ('patientsignup1');

					                         }
					                     else{
											echo"pp";
							exit
									
											 	Session::flash('message', 'My message');
                            return redirect()->route('signuplogin1')->with('user_registerd_exists', 'error|user exists...');  
				                          
			                      
											 }
			  
			  	 
			
			  
		}
		
		 public function signup2(Request $request)
			                      {
									   
					                     $randomnumber= $request->session()->get('otp');
										 $mobile= $request->session()->get('mobile');
						                 $otp=$request->input('otp');
						             
					                     if(	 $randomnumber==$otp)
											    //if(1==1)
					                         {
												   $mobile_cntry_code   = 	explode(" ", $mobile);
                    
                        $patient_exists = DB::table('users')->where('mobile', $mobile_cntry_code[1])->where('accounttype', '1')->get();
			
												  
						  
                        if(empty($patient_exists[0])){
                          

                          return view ('patientsignup2');
					                         }
					                     else{
											
									
											 	Session::flash('message', 'My message');
                            return redirect()->route('signuplogin1')->with('user_registerd_exists', 'error|user exists...');  
				                          
			                      
											 }
								  }
								  else{
									
									 					 	Session::flash('message', 'My message');
                            return redirect()->route('wrongotp')->with('wrongotp', 'error|user exists...');  
								  }
								  }
								  
								  
								   public function signupp(Request $request)
			                         {
										
				                             $mobile= $request->session()->get('mobile');
											
				                              $otp= $request->session()->get('otp');
											 // $password=$request->input('password');
		  //print_r();
		  //exit;
         // $hashed = Hash::make($password);
		 // print_r($hashed);
		  //exit;
											 	$mobile1 = explode(' ', $mobile);
											 
				                              $this->validate($request, ['email' => 'required',
                                            'password' => 'required',
										
										    'email' => 'required',
											'firstname' => 'required|min:3',
									        'lastname' => 'required|min:3',
										
										
											'gendor'=> 'required'

										
										
										
										   ]);
										         if ($request->hasFile('image')) {
                                                 $filename = $request->file('image')->getClientOriginalName();
                                                 $filename = url("/images") .
                                                             "/" . uniqid() .
                                                 $request->file('image')
                                                         ->getClientOriginalName();
                                                 //$destinationPath = "images";
												 $destinationPath = public_path(sprintf("\\images\\%s\\", str_random(8)));
                                                 $request->file('image')->move($destinationPath, $filename);

                                                                                  }
				                               $data=array();
	                                           $data['firstname']=$request->firstname;
	                                           $data['lastname']=$request->lastname;
	                                           $data['mobile']=$mobile1[1] ;
											   $data['countrycode']=$mobile1[0] ;
	                                           //$data['password']=$hashed;
											   $data['password']=$request->password;
	                                           $data['image']=$filename ;
											         $data['otp']=$otp ;
											   $data['accounttype']='1' ;
	                                    
                                              $data['email']=$request->email;
	                                          $data['gendor']=$request->gendor;
											  $newDate = date("j M Y", strtotime($request->age));
											       $data['age']= $newDate;  
													   

	                                          $st=DB::table('users')
	    
	                                           ->insert($data);
											
	                                          //return redirect()->route('patientdoctor');
											  return view('patientlogin');
				
			                         }
									 
									 public function forgotpass()
                                            {
	                                              return view('forgotpass');
                                            }
									 
								public function resetpassotp(Request $request)
{
	   
		
                    $randomNumber = rand(1000, 9999); 
                    $mobile=$request->input('mobile');
	                $countrycode=$request->input('countrycode');
			        $account_sid = 'AC380d6d2ee6264b7970f78e07d8e1f8bb';
                    $auth_token = '7c416e9a89bd9a2ca2e71fcfa0a263f5';
                    // In production, these should be environment variables. E.g.:
                    // $auth_token = $_ENV["TWILIO_ACCOUNT_SID"]

                    // A Twilio number you own with SMS capabilities
                    $twilio_number = "+17542292626";
                    $client = new Client($account_sid, $auth_token);
			        $client->messages->create(
                     // Where to send a text message (your cell phone?)
                            $mobile,
                                     array(
                                     'from' => $twilio_number,
                                     'body' => 'your otp is '.$randomNumber
                                           )
                                        );
										   
                            $request->session()->put('otp', $randomNumber);
						
                            $request->session()->put('mobile', $mobile);
                            $request->session()->put('countrycode', $countrycode);
							        //Session::put('otp', $randomNumber);
								    //Session::put('mobile', $mobile);
									//Session::put('countrycode', $countrycode);
							
                            return view ('forgotpass2');

	

}

public function resetpass2(Request $request)
{
	           $randomnumber= $request->session()->get('otp');
			     $mobile= $request->session()->get('mobile');
				 		$mobile1 = explode(' ', $mobile);
						$mob	= $mobile1[1];
						        $otp=$request->input('otp');
						         $contact=DB::table('users')
			                                 ->select('firstname','id')
                                             ->where('mobile',$mob)
                                             ->where('accounttype','1')                                         
										 ->first();
									
						
					             //if(	 $randomnumber==$otp)
					               if(1==1)
					                {
							
						             return view ('forgotpass3')->with('asst',$contact);
					                }
					             else
				                     return view ('assistant');
			            }	
				public function updatepassword(Request $request,$id)
						{
									$data=array();
	                                $data['password']=$request->password;
	
                                    $dlt=DB::table('users')
                                              ->where('id',$id)
		                                      ->update($data);
							
		                                 return redirect()->route('passchange');
						     }
							 
							 public function passchange()
                                   {
	                                   return view('passchanged');
                                   }
                             public function passlogin()
                                   {
	                                   return view('patientlogin');
                                   }
								    public function Patientappointment()
	                               {
		                               return view('patientappointment');
								   }
                                   
								    public function Patientdoctor()
                                     {
	 	                                return view('patientdoctor');
                                     }
                                    public function patientmessages()
                                     {
	                                    return view('patientmessages');
                                      }
                                     public function patientnotification()
                                       {
	                                    return view('patientnotifications');
                                       }
									     public function wrongotp()
                                       {
	                                    return view('patientsignup1');
                                       }
									       public function patientedit(Request $request)
                                       {
	          $id= $request->session()->get('loginId');
			     
		
			 
		       $edit_pro=DB::table('users')
			          ->where('id',$id)
                       ->first();
	
			 
            return view('patientedit')->with('edit_profile',$edit_pro);  
                                       }
									   
									   public function Updateview_patientprofile(Request $request,$id)

	{ 
	

	
	    $mobile=$request->input('mobile');
		$firstnamee=$request->input('firstname');
		$firstnamee=ucwords(	$firstnamee);
			$lastnamee=$request->input('lastname');
		$lastnamee=ucwords(	$lastnamee);
         $password=$request->input('password');
		 // password is form field
          //$hashed = Hash::make($password);
		   // $hashed = Hash::make($password);
		 
				
	    $str= $mobile;
        $mobile1= str_replace(' ','',$str);
        // gives 8098313245345
		$mobile1 = explode(' ', $mobile);
	  
       	if ($request->hasFile('image')) {
                                                 $filename = $request->file('image')->getClientOriginalName();
                                                 $filename = url("/images") .
                                                            "/" . uniqid() .
                                                 $request->file('image')
                                                         ->getClientOriginalName();
                                                 $destinationPath = "images";
                                                 $request->file('image')->move($destinationPath, $filename);

                                                                              }
																			  else{
																				$filename= $request->input('image_url');
																			  }
		$data=array();

        $data['gendor'] = $request->gendor;



	    $data['firstname']=$firstnamee;
	    $data['lastname']=	$lastnamee;
	    $data['email']=$request->email;
	    $data['mobile']=$mobile1[1] ;
		$data['countrycode']=$mobile1[0] ;
		$data['image']=$filename ;
		                           
	    $data['age']=$request->age;
		  $data['password']=$request->password;
	         
			   
		     $contact=DB::table('users')
	
			 ->where('id',$id)
             ->update($data);
         return redirect()->route('patientedit');
		 
		
	}
	
                 public function patientlogout(){
                      Auth::logout();
                      Session::flush();

	                 return redirect()->route('Patientlogin');

                                                }
                 public function patienthomescreen(Request $request) 
				 {
                  	 $searchdc = Session::get('searchdc');
		
									   

					if(isset($searchdc)&& !empty($searchdc)){
						//echo"<pre>";
							// print_r($searchdc);
							 //exit;
		
						   foreach ( $searchdc as $searchh){
							  
							         $searchdc1=$searchh->user_id;
							         $drsearchresult=DB::table('users')
                                     ->select('*')
									  ->where('id',$searchdc1)
                                       ->get();
						
									
									    //$drsearchresult_clean1 = $drsearchresult1->toarray();
									
									            $drsearchresult_clean = $drsearchresult->toarray();
									   			 $dr_category=(   $drsearchresult_clean[0]->dr_category);
												 //print_r( $dr_category);
							                      //exit;
							                     $drsearchcategory=DB::table('dr_categories')
                                                 ->select('*')
									             ->where('id',$dr_category)
                                                 ->get();
									             $drsearchcategory_clean=   $drsearchcategory->toarray();  
												 $dr_categorie= ($drsearchcategory_clean[0]->name); 
									   			  //print_r(   $dr_categorie);
												  //exit;
							                     //$dr_category=($drsearchresult_clean->dr_category);
							  		   			 //print_r(   $dr_category);
							                     //exit;
									             $drsearchresult_clean[0]->clinic_address = $searchh->clinic_name;
									  
									             $drsearchresult_clean[0]->dr_category =  $dr_categorie;
									             //print_r($drsearchresult_clean[0]);
									              //exit;
									   
									   	//$name = $drsearchresult_clean1->name;
									   //$drsearchresult_clean[0]->clinic_name = $name;
									  // $drsearchresult_clean[0]->clinic_address = $searchh->clinic_name;
									    $data['drresult'][]	=  $drsearchresult_clean[0];
						   } 
									
					}
					 else{
						   $data['drresult']	=  '';
						   
					 }
					 
				
            
			   $cliniclist=DB::table('dr_categories')
                                      ->select('*')
                                       ->get();
											
										
			                $city=DB::table('city')
                                      ->select('*')
                                      ->get();	
									  
									  	
						
				
									   
							
								
						$data['cliniclist']	=$cliniclist;
	                    $data['city']	= $city;	
							
						      
	             return view('patienthomescreen')->with('drsearch', $data);

                  }
				            public function drsearchresult(Request $request) 
				 {
					 
					 $searchdc = Session::get('searchdc');
					 $searchdc1= $searchdc->user_id;
            
			   $cliniclist=DB::table('dr_categories')
                                      ->select('*')
                                       ->get();
											
										
			                $city=DB::table('city')
                                      ->select('*')
                                      ->get();	
						$data['cliniclist']	=$cliniclist;
	                    $data['city']	= $city;	
						
						   
			   $drsearchresult=DB::table('users')
                                      ->select('*')
									  ->where('id',$searchdc1)
                                       ->get();
								$data['cliniclist']	=$cliniclist;
	                            $data['city']	= $city;
								 $data['drsearch']	=  $drsearchresult;
	             return view('patienthomescreen')->with('drsearch', $data);

                  }
				  
				  
	                public function ajaxcitylist()
	                    {

                             $id =   $_POST['id'];
							
							 
		                 
		                     $clinicarea=DB::table('area')
			                 ->select('*')
                             ->where('city_id',$id)	
                              ->get();						 
         
                             $cliniclist='';		   
		                     foreach ($clinicarea as $clinicareas)
							 { 
			                 $clinico = "<option value='". $clinicareas->id ."'>". $clinicareas->name."</option>";
			                $cliniclist .= $clinico;  
			                 }
                             echo  $cliniclist;		
		
	                    }
						
						public function drsearch(Request $request)
						{
		
		                       $patient_id= $request->session()->get('loginId');
							    //print_r($patient_id);
							   //exit;
		           
		                       $dr_category	= $request->input('drcategory');
			  //print_r($dr_category);
							  // exit;
		           
			                   $city_id	= $request->input('drcity');
							  //print_r($city_id);
							   //exit;
		           
		                       $area_id	= $request->input('drarea');
							    
							   $gender	= $request->input('gendor');
								
					           $data['accounttype'] = 2;		
		                       $data['dr_category'] =  $dr_category;		
		
									
			                  		   
                               $doc_rs = DB::table('users')
						                ->select('*')
					// ->where(array('accounttype'=>'2','dr_category'=>$cateogory_id,'gendor'=>$gender))
						                ->where('accounttype',2)
			                            ->where('dr_category',$dr_category)
								        ->where('gendor',  $gender)
						                ->get()->toArray();		
						          		  //echo "<pre>";
										//print_r(   $doc_rs);
//exit;										
															     
								  $doctor_arry = array();
		                          $doctor_arry2 = array();
		                             if(count($doc_rs)>0){			
			                         for ($i = 0; $i < count($doc_rs); $i++)
			                                             {		
		                              $patient_web_status_data='';
			                         $patient_web_status_data = $this->patient_web_status($patient_id,$doc_rs[$i]->id);	
	                                      
										    //echo "<pre>";
										//  print_r(     $patient_web_status_data); 
										  
				                         if($patient_web_status_data == 2)
										                       {
					                           $doctor_arry[] = $doc_rs[$i]->id;					
															   }
													
										
										
									
									
				                       
				                                              
						}	
								              if(count($doctor_arry)>0){
												  
												  		
											//echo "<pre>";
										//print_r(  $doctor_arry);
										//exit;
				                            $doc_rs2 = DB::table('users')
									           ->select('*')								
									           ->whereIn('id',$doctor_arry)
									            ->get()->toArray();	
												//echo "<pre>";
											 //print_r(  $doc_rs2 );
											 //die("oo");
				                          
				                       
					                    for ($i = 0; $i < count($doc_rs2); $i++)
				                        {		
	                                       	
				                            
											 
					                        //$doc_clinic = $this->search_clinic($city_id, $area_id,$doctor_arry[$i]);
											  
				                             
					                         //if(count($doc_clinic)>0){
												 		//echo "<pre>";
											 
						                $doctor_arry = $doc_rs[$i]->id;
										
											 	$get_clinic_data = DB::table('drclinic_list')
											->where('user_id',   $doctor_arry)
											->where('clinic_city', $city_id)
											->where('clinic_area', $area_id)										
								      ->get()->toArray();	
											 print_r($get_clinic_data);
											 exit;
											  for ($a = 0; $a < count( $get_clinic_data); $a++)
				                        {	
									  $doctor_arrry[] = $get_clinic_data[$a];
									 
									  

                          
									  		
										}
										
									 }
									 
									 return Redirect::to('patienthomescreen')->with('searchdc', $doctor_arrry);
									 }else{				
				echo "no record found";				
			}
						}
											 
								
				                          
				}
				
				
				
																   
		function patient_web_status($patient_id,$dr_id){
			//echo "ll";
		//print_r($patient_id);
		//echo "<pre>";
				//print_r($dr_id);
			// $user_rs[] = array();
		$user_rs = DB::table('block_patient')						
						->where('user_id', $dr_id) 
						->where('patient_id', $patient_id)
						->first();
							
		if(isset($user_rs) && !empty($user_rs)){
			return 1;				
		}else {
			return 2;
		}			
	}
						
			public function search_clinic($city_id, $area_id,$doc_id){
				//echo "ll";
				//exit;
							//echo $doc_id ,'<br>';
			//echo $city_id ,'<br>';
			//echo $area_id,'<br>';

			//exit;
	
		if(!empty($city_id) && !empty($area_id)){
			//echo "first";exit;
			$get_clinic_data = DB::table('drclinic_list')
											->where('user_id', $doc_id)
											->where('clinic_city', $city_id)
											->where('clinic_area', $area_id)
											
											->get();
											  //print_r( 	$get_clinic_data);
				                            //die("sscc");
			if(count($get_clinic_data)>0){
				$get_clinic_data =  $get_clinic_data;
			}else{
					$get_clinic_data = DB::table('drclinic_list')
											->where('user_id', $doc_id)
											->where('clinic_city', $city_id)
											->where('clinic_area', $area_id)										
											->get();
				
			}					

		}else if( empty($city_id) && empty($area_id)){
			// echo "second";exit;
			$get_clinic_data = DB::table('drclinic_list')
									->where('user_id', $doc_id)
									
									->get();
		}else if( !empty($city_id) && !empty($area_id)){
			// echo "third";exit;
			$get_clinic_data = DB::table('drclinic_list')
									->where('user_id', $doc_id)
									->where('clinic_city', $city_id)
									->where('clinic_area', $area_id)
									->get();
		}else{
			$get_clinic_data = array();
		}
		
		if(count($get_clinic_data)>0){
			$i=0;
			foreach($get_clinic_data as $value){
				// echo "******* id ****** ".$value->id;
				$get_clinic_data[$i]->clinic_city_name = $this->get_clinic_city($value->clinic_city);
				$get_clinic_data[$i]->clinic_area_name = $this->get_clinic_area($value->clinic_area);
				$get_clinic_data[$i]->availability = $this->get_clinic_availability($doc_id,$value->id);
				$i++;
			}
			return $get_clinic_data;				
		}else {
			return array();
		}				
	}
				
						
	
}


?>
