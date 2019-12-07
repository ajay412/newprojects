<?php


 <div class="collapse navbar-collapse" >
		<div class="nav navbar-nav navbar-right" id="myNavbar">
      <ul class="nav navbar-nav navbar-right icon-top">
	  <li class="{{ Request::segment(1)=='patienthomescreen' ? 'active' : '' }}">
       <a href="{{route('patienthomescreen')}}"><img src= "{{url('image/ic-doctors-normal.png')}}"  alt=""  id="bg" height="20" width="20"><br>Doctors</a></li>
      </li>

	    <li class="{{ Request::segment(1)=='patientappointment' ? 'active' : '' }}">
       <a href="{{route('patientappointment')}}"><img src= "{{url('image/ic-mynotes-pressed-1.png')}}" alt="" height="20"  id="bg1" width="20"><br>Appointments</a></li>
      </li>
	    <li class="{{ Request::segment(1)=='patientmessages' ? 'active' : '' }}">
       <a href="{{route('patientmessages')}}"><img src="{{url('image/ic-message-normal.png')}}"   alt="" height="20" width="20"  id="bg2"><br>Messages</a></li>
      </li>
	    <li class="{{ Request::segment(1)=='patientnotification' ? 'active' : '' }}">
       <a href="{{route('patientnotification')}}"><img src="{{url('image/ic-notification-normal@3x.png')}}" alt="" height="20" width="20"  id="bg3"><br>Notifications</a></li>
      </li>
	  <!----<li class="btn"><a href="{{route('patientdoctor')}}"><img src= "{{url('image/ic-doctors-normal.png')}}"  alt=""><br>Doctors</a></li>
		<li class="btn" ><a href="{{route('patientappointment')}}"><img src= "{{url('image/ic-mynotes-pressed.png')}}" alt="" height="20" width="20"><br>Appointments</a></li>
        <li class="btn"><a href="{{route('patientmessages')}}"><img src="{{url('image/ic-message-normal.png')}}"   alt="" height="20" width="20"><br>Messages<span class="dot"></span></a></li>
        <li class="btn"><a href="{{route('patientnotification')}}"><img src="{{url('image/ic-notification-normal@3x.png')}}" alt="" height="20" width="20"><br>Notifications<span class="dot"></span></a></li>--->
		<li class="btn"><a href="#"><i class="fa fa-bars" style="font-size:24px" onclick="openNav()" height="40" width="40"></i><!--<img src= "{{$check_user[0]->image}}"  alt="" onclick="openNav()" height="40" width="40">--></a></li>
      </ul>
    </div>
	</div>
  </div>
</nav>



<div id="mySidenav" class="sidenav colrbl">
	<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
	<a href="{{route('patientedit')}}"><img src= "{{$check_user[0]->image}}"  class="img-circle" alt="" height="50px" width="50px"></br> 
	<img src= "{{url('image/ic-profile-edit@3x.png')}}" alt="" style="width:20px; float:right;margin-top: 25px;"><h3>{{$check_user[0]->firstname}} {{$check_user[0]->lastname}}</h3></a>
	
	<a href="#"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp; Examination history</a>
    <a href="#"><i class="fa fa-heart" aria-hidden="true"></i>&nbsp; Favourite doctor</a>
	<a href="#"><i class="fa fa-cog" aria-hidden="true"></i>&nbsp; Settings </a></a>
   <a href="#"><i class="fa fa-phone" aria-hidden="true"></i>&nbsp; Contact Us  </a></a>
 
   <!-- <a href="{{route('patientlogout')}}"><img src="{{url('image/img-pharma@3x.png')}}" width="30">&nbsp Logout</a></a>-->
 
  <div class="row" id="cnt1">
   <div class="sllogbtn" style=".sidenav a:hover: color: #fff;">
      <a href="{{route('patientlogout')}}" type="button" class="btn btn-danger btn-block">Logout</a>
	  </br>
  </div>
	<div class="col-md-8">
		<div class="sit"> 
			<img src="{{url('image/logo-menu@2x.png')}}"alt="" width="100">
		</div>			
			
	</div>
		<div class="col-md-4"><div class="fl"><p>Version 1.0</p></div></div>
	</div>
	  @yield('content')
	  <script>
var pathname = window.location.pathname; // Returns path only (/path/example.html)
var url      = window.location.href;     // Returns full URL (https://example.com/path/example.html)
var origin   = window.location.origin; 

var str1 = url;

var str2 = "patienthomescreen";
var str3 = "patientappointment";
var str4 = "patientmessages";
var str5 = "patientnotification";

if(str1.indexOf(str2) != -1){

	
 $("#bg").attr('src','http://clinido.com/blog/public/image/ic-doctors-pressed.png');
}
if(str1.indexOf(str3) != -1){
 $("#bg1").attr('src',"http://clinido.com/blog/public/image/ic-mynotes-pressed.png");
}
if(str1.indexOf(str4) != -1){
 $("#bg2").attr('src',"http://clinido.com/blog/public/image/ic-message-normal2.png");
}
if(str1.indexOf(str5) != -1){
 $("#bg3").attr('src',"http://clinido.com/blog/public/image/ic-notification-pressed.png");
}
</script>?>