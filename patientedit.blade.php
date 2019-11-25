
@extends('patientlayout')
@section('content')
</div>
<div class="set">

	<div class="container">
		<div class="cr">
			<img src="image/back-arrow-Copy.png" alt=""  width="40px" height="40px">
			<p><a href="">Settings</a></p>
		</div>
		<div class="row">
			<div class="col-md-3">
				<div class="tab">
				<button class="tablinks bn" onclick="openCity(event, 'dana')" id="defaultOpen" style="margin-bottom: 175px; border:none; background-color:#fff;">
				<div class="txt-c">
					<a href="#"><img src="{{URL::asset($edit_profile->image)}}" alt=""  width="150" height="150" class="img-circle" ></a>

								
				
					</br>
					<h3>{{$edit_profile->firstname}}</h3>
				
				</div>
				</button>
				  <button class="tablinks" onclick="openCity(event, 'Language')" id="">Language</button>
				  <button class="tablinks" onclick="openCity(event, 'Notifications')">Notifications</button>
				  <button class="tablinks" onclick="openCity(event, 'Write-Feedback')">Write Feedback</button>
				  <button class="tablinks" onclick="openCity(event, 'Privacy')">Privacy & Policy</button>
				  <button class="tablinks" onclick="openCity(event, 'Find')">Find us</button>
				  <div class="row" id="cnt">
				  <div class="col-md-8">
				  <div class="sit"> 
					<img src="image/group-17.png" alt="" width="30"></div>
					<div style="margin: 10px;font-size: 20px;"><p>CliniDo<p></div>
					
					</div>
				  
				
			<div class="col-md-4"><div class="fl"><p>Version 1.0</p></div></div>
				</div>
				</div>
			
			</div>
<form class="form-horizontal" method="POST" enctype='multipart/form-data' action="{{url('update-patientprofile/'.$edit_profile->id)}}">
{{ csrf_field() }}
		<div class="col-md-9 edp">
			<div id="dana" class="tabcontent">
					

					<div class="form-group">
						<div class=" pdetimg">
					
						<div class="profileedt">
								<div class="row">
									   <div class="small-12 medium-2 large-2 columns">
										 <div class="circle">
										   <!-- User Profile Image -->
										   <img class="profile-pic" src="{{URL::asset($edit_profile->image)}}" class="img-circle" width="200" height="200" required>
											
										   <!-- Default Image -->
										   <!-- <i class="fa fa-user fa-5x"></i> -->
										 </div>
									
										     <span style="color:#FF0000" id="profilepic1"></span>
										 <div class="p-image">
										   <i class="fa fa-camera upload-button"></i>
											<input class="file-upload" id="profilepic" type="file" name="image">
											<input type="hidden" name="image_url" value="{{URL::asset($edit_profile->image)}}">
											
										
										</div>
									  </div>
									</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="cssradio" style="display: flex;">
							<input type="radio" name="gendor" id="radio1" value="Male" {{ $edit_profile->gendor == 'Male' ? 'checked ' : '' }}>	
						<label for="radio1">Male</label>
								<input type="radio" name="gendor" id="radio2" value="Female" {{ $edit_profile->gendor == 'Female' ? 'checked ' : '' }}>
								
						<label for="radio2">Female</label>
							
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-6">
								<label>First name</label>
								<input type="text" class="form-control" id="fname" placeholder=""  style="text-transform: capitalize;" name="firstname" value="{{$edit_profile->firstname}}">
								<p style="color:#FF0000"  id="fname1"></p>
							</div>
							<div class="col-md-6">
								<label>Last name</label>
								<input type="text" class="form-control" id="lname" placeholder=""   style="text-transform: capitalize;" name="lastname" value="{{$edit_profile->lastname}}">
									<span style="color:#FF0000" id="lname1"></span></td>
							</div>
						
						</div>
					</div>
							    
					<div class="form-group clrable">
					
						<label style="margin-right: 38px;">Phone No</label></br>
						<input type="tel" id="mobile-number" name="mobile" class="form-control" placeholder="e.g. +1 702 123 4567" style="width: 100%;" value="{{$edit_profile->countrycode}} {{$edit_profile->mobile}}">
		
							<span style="color:#FF0000" id="mobile1"></span></td>
						
					</div>
					<div class="form-group">
						<label>Email address</label>
						<input type="email" class="form-control" id="email" placeholder="" name="email" value="{{$edit_profile->email}}">
							<span style="color:#FF0000" id="email1"></span></td>
					</div>
					<div class="form-group">
					<label>Change Password</label>
					<input type="Password" class="form-control" id="password" placeholder="" name="password" value="{{$edit_profile->visible_password}}">
						<span style="color:#FF0000" id="password1"></span></td>
					</div>
					<div class="form-group">
					<label>Birthday</label>
					<input type="text" class="form-control dr_sign" data-toggle="datepicker" id="birth" name="age" placeholder=" MM / DD / YY" value="{{date('j M Y', strtotime($edit_profile->age))}}">
						<span style="color:#FF0000" id="birth1"></span></td>
					
					</div>
				
					<div class="form-button pull-right">
					<button type="submit"  onclick="return validation()" class="btn btn-info">Save </button>
					</div>
				</form>
			</div>
				<div id="Language" class="tabcontent mb">
				  <h3>Select Langauge</h3>
							<form> 
								<label class="con">English
								  <input type="radio" name="colors" id="red">
								  <span class="checkmark"></span>
								</label>
								<label class="con">اللغه العربية
								  <input type="radio"  name="colors" id="blue">
								  <span class="checkmark"></span>
								</label>
							</form>
				</div>

				<div id="Notifications" class="tabcontent nds">
				<p>Manage your notification</p> 
				  <h3>Push notification</h3>
				  <label class="switch">
					  <input type="checkbox">
					  <span class="slider round"></span>
					</label>
				  
				</div>

				<div id="Write-Feedback" class="tabcontent">
				<p>Help us to know your feedback</p>
				  <input type="text" id="feedback" name="feedback" placeholder="Write your feedback..">
				  <a class="bttn" href="#popup1"><button type="button" class="btn btn-info"><img src="image/check-btn.png" alt=""  ></button></a>
				</div>
				<div id="Privacy" class="tabcontent">
					<div class="cenp">
					<a href="#"><img src="image/ic-logo.png" alt="" ></a>
					<p>Version 1.0</p>
					</div>
					<div class="inp">
						<h4>Privacy & Policy</h4>
						
						<p>So strongly and metaphysically did I conceive of my situation then, that while earnestly watching his motions, I seemed distinctly to perceive that my own individuality was now merged in a joint stock company of two; that my free will had received a mortal wound; and that another's mistake or misfortune might plunge innocent me into unmerited disaster and death. Therefore, I saw that here was a sort of interregnum in Providence; for its even-handed equity never could have so gross an injustice. And yet still further pondering—while I jerked him now and then from between the whale and ship, which would threaten to jam him—still further pondering, I say, I saw that this situation of mine was the precise situation of every mortal that breathes; only, in most cases, he, one way or other, has this Siamese connexion with a plurality of other mortals. If your banker breaks, you snap; if your apothecary by mistake sends you poison in your pills, you die. True, you may say that, by exceeding caution, you may possibly escape these and the multitudinous other evil chances of life. But handle Queequeg's monkey-rope heedfully as I would, sometimes he jerked it so, that I came very near sliding overboard. Nor could I possibly forget that, do what I would, I only had the management of one end of it.</p>
					</div>
					<div class="inp">
						<h4>Title section dummy text</h4>
						
						<p>So strongly and metaphysically did I conceive of my situation then, that while earnestly watching his motions, I seemed distinctly to perceive that my own individuality was now merged in a joint stock company of two; that my free will had received a mortal wound; and that another's mistake or misfortune might plunge innocent me into unmerited disaster and death. Therefore, I saw that here was a sort of interregnum in Providence; for its even-handed equity never could have so gross an injustice. And yet still further pondering—while I jerked him now and then from between the whale and ship, which would threaten to jam him—still further pondering, I say, I saw that this situation of mine was the precise situation of every mortal that breathes; only, in most cases, he, one way or other, has this Siamese connexion with a plurality of other mortals. If your banker breaks, you snap; if your apothecary by mistake sends you poison in your pills, you die. True, you may say that, by exceeding caution, you may possibly escape these and the multitudinous other evil chances of life. But handle Queequeg's monkey-rope heedfully as I would, sometimes he jerked it so, that I came very near sliding overboard. Nor could I possibly forget that, do what I would, I only had the management of one end of it.</p>
					</div>
				</div>
				<div id="Find" class="tabcontent">
				  <p>Find us on social media</p>
					<div class="isc">
						<a href=""><i class="fa fa-facebook-f"></i><p>Like us on Facebook</p></a>
						
					</div>
					<div  class="isc">
						<a href=""><i class="fa fa-twitter"></i><p>Follow us on Twitter</p></a>
					</div>
					<div  class="isc">
						<a href=""><i class="fa fa-google-plus"></i><p>Follow us on G+</p></a>
					</div>
					<div  class="isc2">
						<a href=""><i class="fa fa-share-alt"></i><p>Share 3eyadty</p></a>
					</div>
				  
				</div>
			</div>
		<form>
		</div>
	</div>
</div>  
<script>
function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
<script>
function check() {
    document.getElementById("red").checked = true;
}
function uncheck() {
    document.getElementById("red").checked = false;
}
</script>

<script type="text/javascript" src="http://www.jqueryshare.net/cdn/jquery.1.12.4min.js"></script>

<script src="build/js/intlTelInput.js"></script> 
<script>
	$( document ).ready(function() {

      $("#mobile-number").intlTelInput();

      });
</script>

<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
</script>
  <script src="js/datepicker.js"></script>
  <script>
    $(function() {
      $('[data-toggle="datepicker"]').datepicker({
        autoHide: true,
        zIndex: 2048,
      });
    });
  </script>
    <script>
 
	  
	  

   $( "#dctrsgn" ).click(function() {
  $.each($('.dr_signn'),function() {
  if ($(this).val().length == 0) {
   event.preventDefault();
  }
});
   });
  </script>
<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
</script>
<script>
$(document).ready(function() {

    
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.profile-pic').attr('src', e.target.result);
            }
    
            reader.readAsDataURL(input.files[0]);
        }
    }
    

    $(".file-upload").on('change', function(){
        readURL(this);
    });
    
    $(".upload-button").on('click', function() {
       $(".file-upload").click();
    });
});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script>
function validation()
{
			
	
		if(document.getElementById('fname').value=="")
	{
		document.getElementById('fname1').innerHTML="Enter First Name";
		document.getElementById('fname').focus();
		return false;
	}
	else
		
	{
	 document.getElementById('fname1').innerHTML="";
	} 
	
	if(document.getElementById('lname').value=="")
	{
		document.getElementById('lname1').innerHTML="Enter Last Name";
		document.getElementById('lname').focus();
		return false;
	}
	else
	{
	 document.getElementById('lname1').innerHTML="";
	} 
	var value = document.getElementById('mobile-number').value;

	if(value.length < "6")
	{
		document.getElementById('mobile1').innerHTML="Enter valid number";
		document.getElementById('mobile-number').focus();
		return false;
	}
	else
	{
	 document.getElementById('mobile1').innerHTML="";
	} 
	

	
	if(document.getElementById('email').value=="")
	{
	  document.getElementById('email1').innerHTML="Enter Email";
	  document.getElementById('email').focus();
	  return false;
	} 
	else
	{
	 document.getElementById('email1').innerHTML="";
	} 
	
	var emailid = document.getElementById('email');
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    if (!filter.test(emailid.value)) 
	{
    document.getElementById('email1').innerHTML="Provide a valid Email address";
    emailid.focus();
    return false;
	}
	
	if(document.getElementById('password').value=="")
	{
	  document.getElementById('password1').innerHTML="Enter Password";
	  document.getElementById('password').focus();
	  return false;
	}
	else
	{
	 document.getElementById('password1').innerHTML="";
	} 
	
	

	
	
	if(document.getElementById('birth').value=="")
	{
		document.getElementById('birth1').innerHTML="Fill Birthday";
		document.getElementById('birth').focus();
		return false;
	}
	else
		
	{
	 document.getElementById('birth1').innerHTML="";
	}
	
	 
}
</script>
 <style>
 .profile-pic {
    max-width:115px;
    max-height: 200px;
    display: block;
}

.file-upload {
    display: none;
}
.circle {
    border-radius: 1000px !important;
    overflow: hidden;
    width: 128px;
    height: 128px;
    top: 72px;
}
.profileedt img {
    //max-width: 100%;
    height: auto;
}
.p-image {
 position: relative;
color: #666666;
transition: all .3s cubic-bezier(.175, .885, .32, 1.275);
text-align: center;
        right: -50px;
    top: -55px;
}
.p-image{
	color:#000;
}
.p-image:hover {
  transition: all .3s cubic-bezier(.175, .885, .32, 1.275);
}
.upload-button {
  font-size: 1.2em;
}

.upload-button:hover {
  transition: all .3s cubic-bezier(.175, .885, .32, 1.275);
  color: #999;
}
.file-upload {
display: none !important;
}
.profileedt {
   // margin-left: 50px;
    //margin-top: 50px;
	    text-align: -webkit-center;
}

 
 
 </style>
@endsection
</body>
</html>