<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
        	<form id="myForm" action="<?php echo base_url() ?>employee/addEmployee" method="post" class="form-horizontal">
        		<input type="hidden" name="txtId" value="0">
        		<div class="form-group">
        			<label for="name" class="label-control col-md-4">Employee Name</label>
        			<div class="col-md-8">
        				<input type="text" name="txtEmployeeName" id= "e_name" class="form-control">
        			</div>

        		</div>
        		<div class="form-group">
        			<label for="address" class="label-control col-md-4">Address</label>
        			<div class="col-md-8">
        				<textarea class="form-control" name="txtAddress"></textarea>
        			</div>
        		</div>
        	</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="btnSave" class="btn btn-primary">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!
-- /restore -->

  <div id="restoreModal" class="modal fade" tabindex="-1" role="dialog">
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
							 <td>Id</td>
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







<script>        

  
	

         $(function(){
			 
			showAllEmployee();
			
			   $('#btn-Add').click(function(){
				 
				   	$('#myModal').modal('show');
					$('#myModal').find('.modal-title').text('Add New Title');
					//$('#myForm').attr('action', '<?php echo base_url() ?>employee/addEmployee');
			   });
			   
			   
			   
			   		$('#btnSave').click(function(){
			var url = $('#myForm').attr('action');
			var data = $('#myForm').serialize();
			//validate form
			var empoyeeName = $('input[name=txtEmployeeName]');
			var address = $('textarea[name=txtAddress]');
			var result = '';
			if(empoyeeName.val()==''){
				empoyeeName.parent().parent().addClass('has-error');
			}else{
				empoyeeName.parent().parent().removeClass('has-error');
				result +='1';
			}
			if(address.val()==''){
				address.parent().parent().addClass('has-error');
			}else{
				address.parent().parent().removeClass('has-error');
				result +='2';
			}

			if(result=='12'){
				$.ajax({
					type: 'ajax',
					method: 'post',
					url: "<?php echo base_url();?>index.php/employee/addEmployee",
					
				data: data,
					async: false,
					dataType: 'json',
					success: function(response){
						if(response.success){
							$('#myModal').modal('hide');
							$('#myForm')[0].reset();
							if(response.type=='add'){
								var type = 'added'
							}else if(response.type=='update'){
								var type ="updated"
							}
							$('.alert-success').html('Employee '+type+' successfully').fadeIn().delay(4000).fadeOut('slow');
							showAllEmployee();
						}else{
							alert('Error');
						}
					},
					error: function(){
						alert('Could not add data');
					}
				});
			}
		});
			 //edt
			$('#showdata').on('click', '.item-edit', function(){
			var id = $(this).attr('data');
			//alert(id);
			$('#myModal').modal('show');
			$('#myModal').find('.modal-title').text('Edit Employee');
			$('#myForm').attr('action', '<?php echo base_url() ?>employee/updateEmployee');
			$.ajax({
				type: 'ajax',
				method: 'get',
				url: '<?php echo base_url() ?>index.php/employee/editEmployee',
				data: {id: id},
				
				dataType: 'json',
				success: function(data){
					$('input[name=txtEmployeeName]').val(data.employee_name);
					$('textarea[name=txtAddress]').val(data.address);
					$('input[name=txtId]').val(data.id);
				},
				error: function(){
					alert('Could not Edit Data');
				}
			});
		});
			 
			//delete

		$('#showdata').on('click', '.item-delete', function(){
			var id = $(this).attr('data');
			$('#deleteModal').modal('show');
			//prevent previous handler - unbind()
			$('#btnDelete').unbind().click(function(){
				$.ajax({
					type: 'ajax',
					method: 'get',
					url: '<?php echo base_url() ?>index.php/employee/deleteEmployee',
					data:{id:id},
					success: function(response){
						
						if(response){
							$('#deleteModal').modal('hide');
							$('.alert-success').html('Employee Deleted successfully').fadeIn().delay(4000).fadeOut('slow');
							showAllEmployee();
						}else{
							alert('Error');
						}
					},
					error: function(){
						alert('Error deleting');
					}
				});
			});
		});			
			 //restoreModal

				$('#btn-restore').click(function(){
				 	$('#restoreModal').modal('show');
					$('#restoreModal').find('.modal-title').text('Restore ');
						$('#myForm22').attr('action', '<?php echo base_url() ?>employee/restoreAllEmployee');
				
			
			   
		
				
			   
				$.ajax({

				
					url:"<?php echo base_url();?>index.php/employee/restoreAllEmployee",
					dataType:'json',
					success:function(data){
						console.log(data);
						

    if(data.result == true)
    {
        // Entered captcha is correct
   
					 var html='';
					 var i;
					 for (i=0;i<data.length;i++)
					 {
							 //html +=	'<div class="form-group" style="margin-left:80px">'+
								//  "id "  +data[i].id+""+
								 //"name "+ "" +data[i].employee_name+""+
						   
								  //'</div>';
							html  += '<tr><td>'+data[i].id+""+'</td><td>'+data[i].employee_name+""+'</td><td><input type="checkbox" name="checkId[]" id="checkId" value="'+data[i].id+'"></td></tr>'	 

					  }
					 $('#res_id').html(html); 
					}
					
					else
					{
					$('#res_id').html("no records"); 
					}
				},

					error:function(){
					 alert('could not get data from data base');
					}
					
				});
				});
		
				 $('#btnRestore').click(function(){
						
						var url = $('#myForm22').attr('action');
						var data = $('#myForm22').serialize();
						
							$.ajax({
									type: 'ajax',
									method: 'post',
									url: "<?php echo base_url();?>index.php/employee/restoreData",
									data: data,
									async: false,
									dataType: 'json',
									success: function(response){
										// alert('calleddd'+JSON.stringify(response));
										window.location = '<?php echo base_url();?>index.php/employee';
									},
									error: function(){
										alert('Could not add data');
									}
								});
				
				 });				 
					
	
                 
				            
  	 

			   
			   
			
			 
			 
			 
			 
                 function showAllEmployee(){
					                           $.ajax({
						
				                                 
						                         url:"<?php echo base_url();?>index.php/employee/showAllEmployee",
						                         dataType:'json',
						                         success:function(data){
							                     var html='';
							                     var i;
							                     for (i=0;i<data.length;i++)
							                     {
								 	              html +=	'<tr>'+
			                                     '<td>'+data[i].id+'</td>'+
			                                     '<td>'+data[i].employee_name+'</td>'+
			                                     '<td>'+data[i].address+'</td>'+
			                                     '<td>'+data[i].created_at+'</td>'+
			                                     '<td>'+
			                                     '<a href="javascript:;" class="btn btn-info item-edit" data="'+data[i].id+'">Edit</a>'+
			                                     '<a href="javascript:;" class="btn btn-danger item-delete" data="'+data[i].id+'">Delete</a>'+
										
			                                     '</td>'+
			                                     '</tr>';
										 
								 
								 
		
                                                }
							                         $('#showdata').html(html); 
						                                                 },
						
						                         error:function(){
							                    alert('could not get data fro data base');
						                                         }
					                            });
				                              }					 
						});	 
							 
							 
							         
	 
                      

</script>









