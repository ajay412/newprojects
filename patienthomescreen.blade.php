@extends('patientlayout')
@section('content')
</div>
<?php
$session_id = Session::get('loginId');
  $patientinfo=DB::table('users')
  ->select('*')

					                        ->where('id',$session_id)
											->get();
						$RRy='';					
if(isset($drsearch['drresult']) && !empty($drsearch['drresult'])){
//echo"<pre>";
//print_r($drsearch['drresult']);
//exit;
$RRy = $drsearch['drresult'];


}
?>  

<div class="set">
	<div class="container">
		<div class="cr">
			<img src="image/btn-close-big.png" alt=""  width="40px" height="40px">
			<p><a href="">Search Doctor</a></p>
		</div>
		<div class="row">
			<div class="col-md-3">
				<div class="tab">
				<div class="txt-c">
					<a href="#"><img src="{{$patientinfo[0]->image}}" alt="" height="50" width="50"class="img-circle" ></a>
					</br>
					<h3>{{$patientinfo[0]->firstname}}</h3>
					
				</div>
				
				  <button class="tablinks" onclick="openCity(event, 'Ophthalmology')" id="defaultOpen">Ophthalmology</button>
				  <button class="tablinks" onclick="openCity(event, 'Gynaecology')">Gynaecology</button>
				  <button class="tablinks" onclick="openCity(event, 'Dermatology')">Dermatology</button>
				    <button class="tablinks" onclick="openCity(event, 'Surgery')">Surgery</button>
				  <button class="tablinks" onclick="openCity(event, 'Cardlology')">Cardlology</button>
				  <button class="tablinks" onclick="openCity(event, 'Family-Medicine')">Family Medicine</button>
				  <button class="tablinks" onclick="openCity(event, 'Gynaecology')">Gynaecology</button>
				  
				</div>
			
			</div>

			<div class="col-md-9">
				<div id="Ophthalmology" class="tabcontent" style="background:none;">
					<div class="ophtse">
					 <form>
						<i class="fa fa-search"></i>
						<input type="text" placeholder="Find your doctor" class="form-control" data-toggle="modal" data-target="#finddr">
					</form>
					</div>
					</br>
					<?php if(isset($RRy ) && !empty($RRy )){?>
					@foreach($RRy as $search)
				
					<div class="ophtseinfirs">
					<div class="phcl">
							<div class="hrtblink">
								<input id="toggle-heart" type="checkbox"/>
								<label for="toggle-heart">❤</label>
							</div><hr>
							<div class="plsset">
								<a href=""><img src="image/ic-appointments-pressed2.png" alt="" ></a>
							</div>
					</div>
						<div class="ophiimg">
							<img src="{{ URL::asset($search->image) }}"" alt="" class="img-circle"	width="50px" height="50px" >
							<p>{{$search->firstname}}</br><small>{{$search->dr_category}}</small></p></br>
						
						
						</div>
						
					</div>
					
					
					
					</br>
				@endforeach
					<?php }else{ ?>
			
			<div class="ophtseinfirs">
					No Record Found
						
					</div>
			
			<?php } ?>
				</div>

				<div id="Gynaecology" class="tabcontent">
					
					
				</div>

				<div id="Dermatology" class="tabcontent" style="height:auto!important;">
					
				</div>
				<div id="Surgery" class="tabcontent" style="height:auto!important;">
					
				</div>
				<div id="Cardlology" class="tabcontent" style="height:auto!important;">
					
				</div>
				
				<div id="Gynaecology" class="tabcontent" style="height:auto!important;">
					
				</div>
			</div>
		
		</div>
	</div>
</div>  

<div class="container">
  <!-- Modal -->
  <div class="modal fade" id="booking-detail" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><img src="image/btn-close-big.png" alt="close"></button>
          <h4 class="modal-title">Booking details</h4>
        </div>
        <div class="modal-body">
          <p><img src="image/checkbox-active.png" alt="close">&nbsp; Sunday </br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;9:00 AM  -  12:00 PM </p>
		  <div class="cose-bht">
			<label>Appointment type</label>
			<div class="cssradio">
				<input type="radio" name="radio" id="radio1" checked>
				<label for="radio1">New</label>
				<input type="radio" name="radio" id="radio2"/>
				<label for="radio2">Consult</label>
			</div>
		  </div>
		  </br>
		  <div class="isit-tgl">
			<p>Is it your first time?</p>
			<div class="pull-right">
				<label class="switch">
				  <input type="checkbox" checked>
				  <span class="slider round"></span>
				</label>
			</div>
		  </div>
        </div>
        <div class="modal-footer bookres">
          <a href="" type="button" class="" data-dismiss="modal" data-toggle="modal" data-target="#bokcnfm">Book Now</a>
        </div>
      </div>
      
    </div>
  </div>
  
</div>

<div class="container">
  <!-- Modal -->
  <div class="modal fade" id="bokcnfm" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><img src="image/btn-close-big.png" alt="close"></button>
        </div>
        <div class="modal-body">
			<div class="dtcnt">
				<img src="image/ic-clock.png" alt="close">
				</br>
				</br>
				
				<p>Your reservations is pending till</br>the doctor’s assistant accept it </p>
			</div>
			</br>
			</br>
			<div class="chcnf">
			<a href="" type="button" class="" data-dismiss="modal">Check your appointents</a>
			
			</div>
        </div>
        <div class="modal-footer">
          
        </div>
      </div>
      
    </div>
  </div>
  
</div>


<div class="container">
  <!-- Modal -->
  <div class="modal fade" id="finddr" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
	  
			
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
		
        <div class="modal-body">
					<form class="global-nav" action="{{route('drsearch')}}" accept-charset="UTF-8" method="post">
			
		       {{ csrf_field() }}
			<label>Select Category</label></br>
		<div class="ctalit">

		   <select id="my_select" name="drcategory" >
					  <option value="0" name="drcategory">Select doctor</option>
						    <?php 
								  foreach($drsearch['cliniclist'] as $clinilist): ?>
							<option value="<?php echo $clinilist->id ?>" data-id="<?php echo $clinilist->id ?>" id="drcategory" name="drcategory"><?php echo $clinilist->name   ?></option>
						    <?php endforeach; ?>
								 
							</select>
		</div>
		</br>
		<div class="ctalit">
		<label>Select City</label></br>
		 <select id="my_selectt" name="drcity" >
					  <option value="0" name="drcity">Select City</option>
						    <?php 
								  foreach($drsearch['city'] as $city): ?>
							<option value="<?php echo $city->id ?>" data-id="<?php echo $city->id ?>" id="drcity" name="drcity"><?php echo $city->name   ?></option>
						    <?php endforeach; ?>
								 
							</select>
		</div>
		</br>
		<div class="ctalit">
			<label>Area</label></br>
		
					<select id="selectt" name="drarea" >
					 <option value="0" id="drarea" name="drarea">Select Area</option>
					
						<label>Hospital / Clinic name</label>
						
					</select>
		</div>
		</br>
		<div class="cose-bht">
			<label>Choose Gender</label>
			<div class="cssradio" id="rd64">
				<input type="radio" name="gendor" id="radio" value="male">
				<label for="radio">Male</label>
				<input type="radio" name="gendor" id="radio4" value="female"/>
				<label for="radio4">Female</label>
				<input type="radio" name="gendor" id="radio3" value="both"/>
				<label for="radio3">Both</label>
			</div>
		  </div>
		  		      <div class="modal-footer adsbt" style="text-align:center;">
          <button type="submit" class="" ><img src="image/check-btn.png" ></button>
		  </form>

        </div>
        </div>
        </div>
        </div>
    
	
      </div>
      
    </div>
  </div>
  
</div>

<script>

				<!-- Modal -->
$("#my_selectt").change(function() {
  var id = $('#my_selectt option:selected').data('id');

  $.ajax({
     type:'POST',
     url:'ajaxcitylist',
     
     data:{
         _token :'<?php echo csrf_token() ?>',
		 'id':id
		
     },
     success:function(data){
		 $("#selectt").empty();
         $("#selectt").append(data);
     }
});
});
</script>
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
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
</script>

@endsection
</body>
</html>