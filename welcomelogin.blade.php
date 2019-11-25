<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

     <link href="{{ asset('css/style2.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<style>

</style>
<body>


<header class="bg-img">
<div class="bg">
	<img src="{{url('image/img-bg.png')}}" alt="" class="img-responsive">
</div>


	<div class="logo">
		<img src="{{url('image/logom.png')}}" alt="" class="img-responsive" width="" height="">
	</div>
	<!--<div class="Oval-2">
		<img src="image/arrow-down.png" alt=""  width="20px" height="20px">
	</div>
	<div class="Rectangle-2"></div>-->
		<div class="wel-text">
			<h1>Welcome to CliniDo</h1>
			<div class="clk">
			<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Please Choose <b>account type</b><img src="image/back-arrow.png" alt=""  width="30px" height="30px"></button>
			</div>
		</div>
</header>
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content pca">
        <div class="modal-header pcap">
          <button type="button" class="close" data-dismiss="modal"><img src="{{url('image/btn-close.png')}}" alt="" width="50" height="50"></button>
          <h2 class="modal-title">Please Choose</br> <b>account type</b></h2>
        </div>
        <div class="modal-body">
          <div class="row">
					  <div class="col-md-4 column">
						<div class="card">
							<img src="{{url('image/img-patient.png')}}" alt="" width="40px" height="40px">
							<h4>Patient</h4>
						  
						  <div class="control-group">
							<label class="con">
							<input checked="" type="radio" name="colors" value="red1"  >
						
								  <span class="checkmark"></span>
								</label>
						  </div>
						  
						</div>
					  </div>

					  <div class="col-md-4 column">
						<div class="card">
						<img src="{{url('image/img-doctor.png')}}" alt="" width="40px" height="40px">
						  <h4>Doctor</h4>
							<div class="control-group">
							<label class="con">
								  <input type="radio" name="colors" value="red2" >
								  <span class="checkmark"></span>
								</label>
						  </div>
						</div>
					  </div>
					  
					  <div class="col-md-4 column">
						<div class="card">
						<img src="{{url('image/img-assistant.png')}}" alt="" width="40px" height="40px">
						  <h4>Doctor Assistant</h4>
						  
							<div class="control-group">
							<label class="con">
								  <input type="radio" name="colors" value="red3" data-href="">
								  <span class="checkmark"></span>
								</label>
						  </div>
						</div>
						</div>
					</div>
			
        </div>
        <div class="modal-footer pcmf">
          <button type="submit"  onclick="idForm()" class="btn btn-primary"><img src="image/check-btn@3x.png" alt="" width="20px" height="20px" id="down_icon2"></button>
        </div>
      </div>

    </div>
  </div>

</div>

<script>
function idForm(){
   var selectvalue = $('input[name=colors]:checked', '#myModal').val();


if(selectvalue == "red1"){
window.open('{{ route('Patientlogin') }}');
return true;
}
if(selectvalue == "red3"){
window.open('{{ route('assistantlogin') }}');
return true;
}
else if(selectvalue == "red2"){
window.open('{{ route('Drlogin') }}');
return true;
}
return false;
};
</script>
	
<script>
function check() {
    document.getElementById("red").checked = true;
}
function uncheck() {
    document.getElementById("blue").checked = false;
}


$(window).on('load', function() { // makes sure the whole site is loaded 
  $('#status').fadeOut(); // will first fade out the loading animation 
  $('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website. 
  $('body').delay(350).css({'overflow':'visible'});
})
</script>
</body>
</html>