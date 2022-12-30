<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-xl-5">
			<div id="msg"></div>
			<form id="myform"  method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label>Name : </label>
					<input type="text" name="name" class="form-control">
				</div>
				<div class="form-group">
					<label>Email : </label>
					<input type="text" name="email" class="form-control">
				</div>
				<div class="form-group">
					<label>Password : </label>
					<input type="text" name="password" class="form-control">
				</div>
				<div class="form-group">
					<label>Mobile : </label>
					<input type="text" name="mobile" class="form-control">
				</div>
				<div class="form-group">
					<label>Gender : </label>
					<input type="radio" name="gender" value="male">Male
					<input type="radio" name="gender" value="female">Female
				</div>
				<div class="form-group">
					<label>Qualification : </label>
					<input type="checkbox" name="qualification[]" value="MCA">MCA
					<input type="checkbox" name="qualification[]" value="BCA">BCA
					<input type="checkbox" name="qualification[]" value="B.Tech">B.Tech
				</div>
				<div class="form-group">
					<label>Pic : </label>
					<input type="file" name="pic" class="form-control">
				</div>
				<input type="submit" name="save" value="save" class="btn btn-info">

			</form>
		</div>


		<!--  For Listing -->
		<div class="col-xl-7">
			<div>
				<?php 
				session_start();
				if(isset($_SESSION['delete_message']))
				{
					echo $_SESSION['delete_message'];
					unset($_SESSION['delete_message']);
				}
				?>
			</div>
			
			<table class="table">
				<tr>
					<td>ID</td><td>NAme</td><td>Email</td><td>Mobile</td><td>Gender</td><td>Qualification</td><td>Image</td>
				</tr>
				<?php
				$i=1;
				$con=mysqli_connect("localhost","root","","ajax");
				$qry=mysqli_query($con,"select * from user");
				while($row=mysqli_fetch_array($qry))
				{
					extract($row);
				?>
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $name; ?></td>
					<td><?php echo $email; ?></td>
					<td><?php echo $mobile; ?></td>
					<td><?php echo $gender; ?></td>
					<td><?php echo $qualification; ?></td>
					<td><img src="image/<?php echo $pic; ?>" style="width:80px;"></td>
					<td><a href="edit.php?id=<?php echo $id ?>" class="btn btn-info">Edit</a></td>
					<td><a href="delete.php?id=<?php echo $id ?>" class="btn btn-danger">Delete</a></td>
				</tr>
				<?php
				$i++;
				}
				?>
			</table>
		</div>

		<!-- listing end -->
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
			password : {
				required : true,
			},
			mobile : {
				required : true,
			},
			pic : {
				required : true,
			},
		},

		submitHandler: function(form)
		{
			save();
		}
	});

	function save()
	{
		$.ajax({
			url : 'insert.php',
			type: 'POST',
			data: new FormData($('form')[0]),
			contentType:false,
			cache:false,
			processData:false,
			success:function(data)
			{
				$('#myform').trigger("reset");
				$("#msg").html("Data Saved Successfully");
			}
		});
	}
</script>
</body>
</html>