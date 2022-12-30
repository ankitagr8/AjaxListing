<?php 
$id=$_REQUEST['id'];
$con=mysqli_connect("localhost","root","","ajax");
$qry=mysqli_query($con,"select * from user where id='$id'");
$row=mysqli_fetch_array($qry);
extract($row);
$qualification=explode(",", $qualification);
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<div class="container">
	<div class="col-md-4">
		<div id="msg"></div>
		<form id="myform"  method="post">
			<div class="form-group">
				<label>Name : </label>
				<input type="text" name="name" class="form-control" value="<?php echo $name ?>" >
			</div>
			<div class="form-group">
				<label>Email : </label>
				<input type="text" name="email" class="form-control" value="<?php echo $email ?>" >
			</div>
			<div class="form-group">
				<label>Mobile : </label>
				<input type="text" name="mobile" class="form-control" value="<?php echo $mobile ?>" >
			</div>
			<div class="form-group">
				<label>Gender : </label>
				<input type="radio" name="gender" value="male" <?php echo $gender=='male' ? 'checked' : '' ?> >Male
				<input type="radio" name="gender" value="female" <?php echo $gender=='female' ? 'checked' : '' ?> >Female
			</div>
			<div class="form-group">
				<label>Qualification : </label>
				<input type="checkbox" name="qualification[]" value="MCA"
				<?php  
				if(in_array("MCA",$qualification))
				{
					echo "checked";
				}
				?>
				>MCA
				<input type="checkbox" name="qualification[]" value="BCA"
				<?php  
				if(in_array("BCA",$qualification))
				{
					echo "checked";
				}
				?>
				>BCA
				<input type="checkbox" name="qualification[]" value="B.Tech"
				<?php  
				if(in_array("B.Tech",$qualification))
				{
					echo "checked";
				}
				?>
				>B.Tech
			</div>
			<input type="hidden" name="id" value="<?php echo $id ?>">
			<input type="submit" name="update" value="update" class="btn btn-info">
		</form>
	</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script>
	$("#myform").validate({
		rules : {
			name : {
				required : true,
			},
			email : {
				required : true,
			},
			mobile : {
				required : true,
			},
		},

		submitHandler: function(form)
		{
			update();
		}
	});

	function update()
	{
		$.ajax({
			url : 'update.php',
			type: 'POST',
			data: new FormData($('form')[0]),
			contentType:false,
			cache:false,
			processData:false,
			success:function(data)
			{
				$("#msg").html("Data Update Successfully");
			}
		});
	}
</script>