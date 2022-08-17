 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<a class="btn btn-primary" href="<?php echo base_url('user/add')?>">Add Record</a>
		</div>
	</div> 
	<table class="table table-striped">
	  <thead>
	    <tr>
	      <th scope="col">#</th>
	      <th scope="col">Name</th>
	      <th scope="col">Date of Birth</th>
	      <th scope="col">Email</th>
	      <th scope="col">Color</th>
	      <th scope="col">Created At</th>
	      <th scope="col">Actions</th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php 
	  		if(!empty($users)){
	  			foreach ($users as $key => $user) { ?>
	  				<tr>
				      <th scope="row"><?php echo $user['id'] ?></th>
				      <td><?php echo $user['name'] ?></td>
				      <td><?php echo date('m/d/Y',strtotime($user['dob'])) ?></td>
				      <td><?php echo $user['email'] ?></td>
				      <td><span style="padding: 5px;background:<?php echo '#'.$user['color'] ?>"></span>&nbsp;<?php echo '#'.$user['color'] ?></td>
				      <td><?php echo date('m/d/Y H:i a',strtotime($user['created_at'])) ?></td>
				      <td><a class="btn btn-info" href="<?php echo base_url('user/edit/').$user['id'] ?>">Edit</a>&nbsp;<a  class="btn btn-danger delete" data-id="<?php echo $user['id'] ?>" href="javascript:void(0)">Delete</a></td>
				    </tr>
	  	<?php		
	  			}
	  		}
	  	?>
	    
	  </tbody>
	</table>
</div>
<script type="text/javascript">
 var base_url = '<?php echo base_url() ?>'; 
 $(document).on('click','.delete',function(){
  if(confirm('Do you really want to delete this record ?')){	
   var id = $(this).data('id');
    if(id){
      $.ajax({
        type: 'post',
        url: base_url + 'formController/delete',
        data: {id:id},
        dataType:'json',
        success: function (data) {
         if(data && data.status == true){
          toastr.success('Success',data.msg);
          setTimeout(function(){ location.reload() },  2000 );
         }else if(data && data.status == false){
          toastr.error('Error',data.msg);
         }
        }
      });
     } 
   }
 }); 
</script>