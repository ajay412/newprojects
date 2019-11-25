@extends('dashboard.dashboardlayouts')
		@section('content')
		    <?php
		   //echo"<pre>";
		   // print_r($screening_detail);exit;
		    ?>
			<?php if(isset($screening_detail['doctors_detail'] ) && !empty($screening_detail['doctors_detail'] )){?>
		
	        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		    <div class="row">
			<div class="col-lg-12">
			<h3 class="page-header">Doctor Name : {{$screening_detail['doctors_detail']->firstname}} {{$screening_detail['doctors_detail']->lastname}}</h3>
			</div>
		    </div><!--/.row-->

		    <?php } ?>
		
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading pheadset">
						<?php if(isset($screening_detail['patient_detail'] ) && !empty($screening_detail['patient_detail'] )){?>
						Patient Name : {{$screening_detail['patient_detail']->firstname}} {{$screening_detail['patient_detail']->lastname}}
					    <?php } ?></div>
					<div class="panel-body">
						<!--div class="pull-right">
						<label>Sort</label>
							<select>
							  <option value="All">All</option>
							  <option value="Normal">Normal</option>
							  <option value="Acetic Acid">Acetic Acid</option>
							  <option value="Lugol’s Iodine">Lugol’s Iodine</option>
							</select>
						</div-->
	          <?php if(isset($screening_detail['screening'] ) && !empty($screening_detail['screening'] )){?>
                @foreach($screening_detail['screening'] as $screening)
				<div class="today-imgs">
				
					<div class="panel panel-default">
						<div class="panel-body">
							<h3>Screening no {{$screening->screening_no}}</h3>
							 @foreach($screening->screeningdates as $dates)
					
							<span>{{ date("j M Y", strtotime($dates->screening_date))}}</span>
							</br>
						 @foreach($dates->screeningimages as $images)
				<div class="img-box">
						<div class="polaroid">
                          @if($images->status == '1')
							  <h6 class="text-center text-danger"> Deleted</h6>
						  @endif
						
						  <img id="myImg{{$images->id}}" class="myImg" src="{{ asset('public/images/') }}{{"/".$images->image}}" alt="Normal" width="100%" height="100px">
						<div class="tittle">
					
						  <h6>{{$images->image_name }}</h6>
					 
						  </div>
						</div>
						<!-- The Modal -->
						<div id="myModal" class="modal">
						  <span class="close">&times;</span>
						   <a href="{{asset('public/images/') }}{{"/".$images->image}}"  download="{{$images->image_name}}" class="del"><i class="fa fa-download" aria-hidden="true"></i>&nbsp;</a>
						  <img class="modal-content" id="img01">
						  <div id="caption"></div>
						</div>
						
					</div>
					
							@endforeach
							</br>
								@endforeach
						</div>
					</div>

			
				
					</div>
					@endforeach
					    <?php } ?></div>
			
				</div>
		

					</div>
					 
				</div>
			</div>
		</div><!--/.row-->	
		
	</div>	<!--/.main-->
	  

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	
	<script>
$( ".myImg" ).click(function() {
// Get the modal
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var id=$(this).attr('id');
console.log(id);
var img = document.getElementById(id);
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");

  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;


// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
}
});
</script>
	<style>
#example_filter{
	text-align:right;
	
}
div#example_paginate{
	text-align:right;
	
}
</style> 
	 @endsection
</body>
</html>
