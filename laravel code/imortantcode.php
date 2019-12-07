<?php





twillio
https://www.twilio.com/login?g=%2Fconsole%2Fsms%2Fgetting-started%2Fbuild%3F&t=f1497695808a2e02c63325b5b5a7683256685c4ac489b128835291792f0ee59c
for path file
"{{ URL::asset('public/css/style.css') }}"
"{{url('css/style2.css')}}"
"{{url('js/jquery.calendar.js')}}"

multipleid send
{{url('deletearea/'.$post->id,$post->city_id)}}


laravel image in loop display

"{{ URL::asset($alldoctor->image) }}"

Remove space in phone number

  $phone=(str_replace( ' ', '', $mobile ));
print_r($phone);


intel country code no show
<script>
jQuery(function($){
   // Your jQuery code here, using the $
     $("#phone").intlTelInput();
});

</script>

ajax call in laravel


 $.ajax({
     type:'POST',
     url:'http://clinido.com/blog/public/drbookingconfirmed',







  data:{
         _token :'<?php echo csrf_token() ?>',
		  'dr_id':dr_id,'appoint':appoint, 'firsttime':firsttime,'dat':dat,'pt_id':pt_id
		      },
  
			  success: function (data) {
				alert(data);
				   $("#booking-detail").removeClass("fade").modal("hide");
                   $("#bokcnfm").modal("show");
			  }
			  	  success: function (data) {
				alert(data);
				   $("#booking-detail").removeClass("fade").modal("hide");
                   $("#bokcnfm").modal("show");
			  }




input radio button check 
value="Male" {{ $edit_profile['contact']->gendor == 'Male' ? 'checked ' : '' }}
 
session vlaue check radio button

value='Male'{{ session('gendor') == 'Male' ? 'checked ' : '' }}



count function 

	     @if($single_con['clinic']->count() > 0)



laravel errror fade up

	  <script>
       setTimeout(function() {
           $('#error').fadeOut('slow');
       }, 2000);

array merge
							
$drsearchresult_clean[0]->clinic_address = $searchh(another array value)->clinic_name;
									  
 $drsearchresult_clean[0]->dr_category = (another array)- $dr_categorie;



multile with in view
	return view('admin/published-doctors')->with('single_con',$dlt)->with('category',$category);

self join

		 $dlt=DB::table('users')
				->select('users.*','drclinic_list.clinic_address','drclinic_list.clinic_name','drclinic_list.clinic_address_ar','doc.firstname as doc_name')
				->join('drclinic_list','drclinic_list.id','=','users.clinic_id')
				->join('users as doc','doc.id','=','users.dr_id')
				->where('users.accounttype',3)
				->where('users.status',1)			
				->where('users.delete_status',0)
				->get();


important input filed check
{{$alldoctor->clinic_fees?$alldoctor->clinic_fees.' EGP':''}}

laravel 
where  and conditiomn
->where([['accounttype','!=','2'],['accounttype','!=','3']])?>