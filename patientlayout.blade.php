<!DOCTYPE html>
<html lang="en">
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{url('css/style2.css')}}">
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <link rel="stylesheet" href="{{url('build/css/intlTelInput.css')}}">
	<link rel="stylesheet" href="{{url('build/css/demo.css')}}">
</head>
<style>
body{background:#ededed;}
#cnslbn a{
background:#d0021b;
border-radius:50px !important;
color:#fff;
padding: 5px 15px;
text-decoration:none
}
#cnslbn{
margin-top:8px;
    margin-left:0px;
    margin-right: 10px;
	}
#cnslbr{
border:none;
display: initial;
}
#clrms small,b{
color:#0095bc;
}
</style>
<script>
// Add active class to the current button (highlight it)
var header = document.getElementById("myNavbar");
var btns = header.getElementsByClassName("btn");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
  var current = document.getElementsByClassName("active");
  current[0].className = current[0].className.replace(" active", "");
  this.className += " active";
  });
}
</script>
<body>
<?php
$session_id = Session::get('loginId');
  $check_user=DB::table('users')
  ->select('*')

					                        ->where('id',$session_id)
											->get();
											//echo "<pre>";
											//print_r($check_user);
											//exit;
?>
<nav class="navbar navbar-default navbar-static-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#"><img src="{{url('image/logop.png')}}" alt="" height="40" width="40" class="img-responsive"></a>
    </div>
    <div class="collapse navbar-collapse" >
		<div class="nav navbar-nav navbar-right" id="myNavbar">
      <ul class="nav navbar-nav navbar-right icon-top">
	  <li class="{{ Request::segment(1)=='patientdoctor' ? 'active' : '' }}">
       <a href="{{route('patientdoctor')}}"><img src= "{{url('image/ic-doctors-normal.png')}}"  alt=""><br>Doctors</a></li>
      </li>
	    <li class="{{ Request::segment(1)=='patientappointment' ? 'active' : '' }}">
       <a href="{{route('patientappointment')}}"><img src= "{{url('image/ic-mynotes-pressed.png')}}" alt="" height="20" width="20"><br>Appointments</a></li>
      </li>
	    <li class="{{ Request::segment(1)=='patientmessages' ? 'active' : '' }}">
       <a href="{{route('patientmessages')}}"><img src="{{url('image/ic-message-normal.png')}}"   alt="" height="20" width="20"><br>Messages<span class="dot"></span></a></li>
      </li>
	    <li class="{{ Request::segment(1)=='patientnotification' ? 'active' : '' }}">
       <a href="{{route('patientnotification')}}"><img src="{{url('image/ic-notification-normal@3x.png')}}" alt="" height="20" width="20"><br>Notifications<span class="dot"></span></a></li>
      </li>
	  <!----<li class="btn"><a href="{{route('patientdoctor')}}"><img src= "{{url('image/ic-doctors-normal.png')}}"  alt=""><br>Doctors</a></li>
		<li class="btn" ><a href="{{route('patientappointment')}}"><img src= "{{url('image/ic-mynotes-pressed.png')}}" alt="" height="20" width="20"><br>Appointments</a></li>
        <li class="btn"><a href="{{route('patientmessages')}}"><img src="{{url('image/ic-message-normal.png')}}"   alt="" height="20" width="20"><br>Messages<span class="dot"></span></a></li>
        <li class="btn"><a href="{{route('patientnotification')}}"><img src="{{url('image/ic-notification-normal@3x.png')}}" alt="" height="20" width="20"><br>Notifications<span class="dot"></span></a></li>--->
		<li class="btn"><a href="#"><img src= "{{$check_user[0]->image}}"  alt="" onclick="openNav()" height="40" width="40"></a></li>
      </ul>
    </div>
	</div>
  </div>
</nav>



<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="{{route('patientedit')}}"><img src= "{{$check_user[0]->image}}"  class="img-circle" alt="" width="50px"></br><img src= "{{url('image/ic-profile-edit@3x.png')}}" alt="" style="width:10px; float:right"><b>{{$check_user[0]->firstname}}</b></a>
	<div class="row chkin">
		
	<i class="fa fa-stethoscope"></i>
	</div>
  <a href="#"><img src="{{url('image/invalid-name.png')}}" width="20">&nbsp Examination history</a>
    <a href="#"><img src="{{url('image/ic-doctors-pressed.png')}}" width="20">&nbsp Favourite doctor</a>
  <a href="#"><img src="{{url('image/img-settings@3x.png')}}" width="30">&nbsp Settings </a></a>
   <a href="#"><img src="{{url('image/img-phone2.png')}}" width="20">&nbsp Contact Us  </a></a>
 
    <a href="{{route('patientlogout')}}"><img src="{{url('image/img-pharma@3x.png')}}" width="30">&nbsp Logout</a></a>
  
  <div class="row" id="cnt1">
	<div class="col-md-8">
		<div class="sit"> 
			<img src="{{url('image/group-17.png')}}" alt="" width="30">
		</div>			
		<div style="margin: 10px;font-size: 20px;"><p>CliniDo</p><p></p></div>			
	</div>
		<div class="col-md-4"><div class="fl"><p>Version 1.0</p></div></div>
	</div>
	  @yield('content')