<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
  <h2>Employeelist</h2>
            <div class="alert alert-success" style="display: none;">
            </div>
            <button id="btn-Add" class="btn btn-success">Add New</button>
			<button id="btn-restore" class="btn btn-success">Add Restore</button>
					<!--<a href="{{url('view_screening')}}">screening</div>-->
<label class="switch">
  <input type="checkbox" id="toggle-event" data-toggle="toggle" data-on="Enabled" data-off="Disabled" >

  <span class="slider round"></span>
    <div id="console-event"></div>
</label>


<style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>

            <table class="table table-bordered table-responsive" style="margin-top:20px;" border="2px" width="1050px">
                <thead>
		            <tr>
		                 <td>Id</td>
		                 <td> Name</td>
		                 <td>email</td>
				         <td>phone</td>
				
		                 <td>Action</td>
		
		            </tr>
		         </thead>
		
		        <tbody id="showdata">
	<div class="load" id="loaddata">
	<div class="load" id="loaddatamessage">

	</div>
			
			    </tbody>


            </table>

             </div>
			 <div id="myModal" class="modal fade" tabindex="-1" role="dialog">
                     <div class="modal-dialog" role="document">
                     <div class="modal-content">
                     <div class="modal-header">
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                         <h4 class="modal-title">Modal title</h4>
                     </div>
                    <div class="modal-body">
        	             <form id="myForm" action="" method="post" class="form-horizontal">
        	
        		        <div class="form-group">
        			          <label for="name" class="label-control col-md-4"> Name</label>
        			        <div class="col-md-8">
        				       <input type="text" name="name" id= "name" class="form-control">
							   <span style="color:#FF0000" id="name1">*</span></td>
							
							
        			        </div>

        		        </div>
        		            <div class="form-group">
        			          <label for="name" class="label-control col-md-4"> email</label>
        			        <div class="col-md-8">
        				       <input type="text" name="email" id= "email" class="form-control">
							   <span style="color:#FF0000" id="email1">*</span></td>
							
							
        			        </div>

        		        </div>
						      <div class="form-group">
        			          <label for="name" class="label-control col-md-4">phone</label>
        			        <div class="col-md-8">
        				       <input type="text" name="phone" id= "phone" class="form-control">
							   <span style="color:#FF0000" id="phone1">*</span></td>
							
							
        			        </div>

        		        </div>
				
				
	                       <div class="modal-footer">
                             <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                             <button type="button" onclick="addemployee()" id="btnSave" class="btn btn-primary">Save changes</button>
                         </div>
						 </form>
             </div><!-- /.modal-content -->
             </div><!-- /.modal-dialog -->
             </div>
			 </div>
			 
			 <div id="myModall" class="modal fade" tabindex="-1" role="dialog">
                     <div class="modal-dialog" role="document">
                     <div class="modal-content">
                     <div class="modal-header">
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                         <h4 class="modal-title">Modal title</h4>
                     </div>
                    <div class="modal-body">
        	             <form id="myForm" action="" method="post" class="form-horizontal">
        	
        		        <div class="form-group">
        			          <label for="name" class="label-control col-md-4"> Name</label>
        			        <div class="col-md-8">
        				       <input type="text" name="name" id="namee" class="form-control">
							   <span style="color:#FF0000" id="name1">*</span></td>
							
							
        			        </div>

        		        </div>
						
						        <div class="form-group">
        			          <label for="name" class="label-control col-md-4"> id</label>
        			        <div class="col-md-8">
        				       <input type="text" name="docid" id= "docidd" class="form-control">
					
							
							
        			        </div>

        		        </div>
        		            <div class="form-group">
        			          <label for="name" class="label-control col-md-4"> email</label>
        			        <div class="col-md-8">
        				       <input type="text" name="email" id= "emaill" class="form-control">
							   <span style="color:#FF0000" id="email1">*</span></td>
							
							
        			        </div>

        		        </div>
						      <div class="form-group">
        			          <label for="name" class="label-control col-md-4">phone</label>
        			        <div class="col-md-8">
        				       <input type="text" name="phone" id= "phonee" class="form-control">
							   <span style="color:#FF0000" id="phone1">*</span></td>
							
							
        			        </div>

        		        </div>
				
	                       <div class="modal-footer">
                             <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                             <button type="button"  id="btnSave" onclick="editchanges()" class="btn btn-primary">Save changes</button>
                         </div>
						 </form>
             </div><!-- /.modal-content -->
             </div><!-- /.modal-dialog -->
             </div>
			 </div>
			 
			 
			 
			   <div id="deleteModal" class="modal fade" tabindex="-1" role="dialog">
                                     <div class="modal-dialog" role="document">
                                     <div class="modal-content">
                                     <div class="modal-header">
                                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                         <h4 class="modal-title">Confirm Delete</h4>
                                     </div>
                                     <div class="modal-body">
        	                             Do you want to delete this record?
                                    </div>
                                    <div class="modal-footer">
                                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                          <button type="button" id="btnDelete" class="btn btn-danger">Delete</button>
                                     </div>
                                     </div><!-- /.modal-content -->
                                 </div><!-- /.modal-dialog -->
                                 </div><!-- /.modal -->
								 
								 
           <div id="restore" class="modal fade" tabindex="-1" role="dialog">
           <div class="modal-dialog" role="document">
           <div class="modal-content">
           <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           <h4 class="modal-title">Modal title</h4>
           </div>
           <div class="modal-body">
	       <form id="myForm22" action="" method="post" class="form-horizontal">
           <table cellspacing="5px" cellpadding="20px" border="1px solid" style="margin-left:90px;">
		   <thead>
						 <tr>
							 <td >Id</td>
							 <td>Employee Name</td>
							 <td>Action</td>
						
						 </tr>
					</thead>
					<tbody id="res_id" >
					
					</tbody>
        		</table>
		</form>
			
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="btnRestore" class="btn btn-primary">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
<div class="showdata" id="showalldata">
<div id="loaddata"></div>
<div id="loaddatamessage"></div>

<tr>
<td></td>
</tr>
</div>
							 
								 


 <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script>
  
  
   $(document).ready(function(){
			  
			
             showAllEmployee();
                 
		 
		
          function showAllEmployee(){
		  $.ajax({
          type:'POST',
          url:'alldata',     
          data:{
         _token :'<?php echo csrf_token() ?>',
		  
		  },
	      success:function(data){
			console.log(data);
		
			
          var html='';
		  var i;
		  for (i=0;i<data.length;i++)
		  {
		  console.log(data[i]);
           
		  html +=								  
		  '<tr>'+
		  '<td>'+data[i].id+'</td>'+
		  '<td>'+data[i].name+'</td>'+
		  '<td>'+data[i].email+'</td>'+
		  '<td>'+data[i].phone+'</td>'+
          '<td>'+
		  //'<input type="hidden"  id="edit_employe_id" value="'+data[i].id+'"/>'+
		  '<a href="javascript:;" class="btn btn-info item-edit" data="'+data[i].id+'">Edit</a>'+
		  '<a href="javascript:;" class="btn btn-danger item-delete" data="'+data[i].id+'">Delete</a>'+
          '</td>'+
		  '</tr>';
		  }
		  $('#showdata').html(html); 
		  
		  
	
		  }
		  });
          }
   });
          $('#btn-Add').click(function(){
		  $('#myModal').modal('show');
		  $('#myModal').find('.modal-title').text('Add New Employee');
		  });
          function addemployee()
		     {
		    var name=$("#name").val();
			var email=$("#email").val();
			var phone=$("#phone").val();
			alert(name);
			
					$.ajax({
              type:'POST',
              url:'savedata',     
              data:{
              _token :'<?php echo csrf_token() ?>',
		     'name':name,'email':email,'phone':phone
		           },
		 success:function(data){
			 
		   $('#myModal').modal('hide');
		   $('#myForm')[0].reset();
		    var html='';
		    html +=								  
		    '<tr>'+
			'<td>'+data+'</td>'+
			'<td>'+name+'</td>'+
		    '<td>'+email+'</td>'+
			'<td>'+phone+'</td>'+
			'<td>'+
			'<a href="javascript:;" class="btn btn-info item-edit" data="'+data+'">Edit</a>'+
			'<a href="javascript:;" class="btn btn-danger item-delete" data="'+data+'">Delete</a>'+
			'</td>'+
			'</tr>';
			$('#showdata').append(html); 
	        },
		    });
			
			 }
            
			
		   $('#showdata').on('click', '.item-delete', function(){
           var id = $(this).attr('data');
           $('#deleteModal').modal('show');
           $('#btnDelete').click(function(){
		   $.ajax({
           type:'POST',
           url:'deletedata', 
           dataType: 'json',											  
           data:{
            _token :'<?php echo csrf_token() ?>',
            'id':id
	            },
		   success:function(data){
			
		   $('#deleteModal').modal('hide');
		   location.reload();
		   $('.alert-success').html('Employee Deleted successfully').fadeIn().delay(4000).fadeOut('slow');
		  // $('#showdata').append(html); 
		   },							
		   });
		   });
		   });
		   
		   	$('#showdata').on('click', '.item-edit', function(){
		   var id = $(this).attr('data');
		   $.ajax({
           type:'POST',
           url:'editdata',     
           data:{
           _token :'<?php echo csrf_token() ?>',
		   'id':id
		   },
	       success:function(data){
	      
		   $('#myModall').modal('show');
		   $('input[name=name]').val(data["0"].name);
		   $('input[name=docid]').val(data["0"].id);
		   $('input[name=email]').val(data["0"].email);
		   $('input[name=phone]').val(data["0"].phone);
		   },
		   });
		   });
		   
		   function editchanges()
		   {
		    var name=$("#namee").val();
	        var id=$("#docidd").val();
			var email=$("#emaill").val();
			var phone=$("#phonee").val();
		      $.ajax({
              type:'POST',
              url:'updataedataa',     
              data:{
             _token :'<?php echo csrf_token() ?>',
		      'name':name,'email':email,'phone':phone,'id':id
	        },
		    success:function(data){
			console.log(data);
			exit;
	        $('#myModall').modal('hide');
		    window.location.reload();
		    $('.alert-success').html('Employee Edited successfully').fadeIn().delay(4000).fadeOut('slow');
		   	//$('#showdata').append(html);
		
 
			},
		    });
		    }
			
		  $(document).on('click', '#btn-restore',function(){
		  $('#restore').modal('show');	
		  $.ajax({
          type:'POST',
          url:'restoredata',     
          data:{
          _token :'<?php echo csrf_token() ?>',
		  },
		   success:function(data){
			   
			   if(data.status == '1')
			   {
				   var html='';
				   var i;
				   var result=data.result;
				   for(i=0;i<result.length;i++){
					   html+=
					   '<tr>'+
					   '<td id="restore_id" value="'+result[i].id+'">'+result[i].id+'</td>'+
				
					   '<td id="restore_check">'+
					   '<input type="checkbox" value="'+result[i].id+'">'+
					   '</td>'+
					   '</tr>'
				   }
				     console.log(html)
				      $('#res_id').html(html);
			   }
			   else
			   {
				   $('#res_id').html("no records"); 
			   }
		   }
		  });
		  });
					   
				 $(document).on('click','#btnRestore',function(){	
        	  var name= $('#restore_name').attr('value');
			  var id= $('#restore_id').attr('value');
			  var check= $("input[type='checkbox']").val();
			  
			  alert(name);
			  alert(id);
			  alert(check);
			   $.ajax({
               type:'POST',
               url:'restoredelete',     
               data:{
              _token :'<?php echo csrf_token() ?>',
			   'name':name,'id':id,check:check
		       },
		       success:function(data){
			   alert(data)
			     window.location.reload();
				 showAllEmployee();
				 
			 
			   }
			 });
			 });
			
  </script>