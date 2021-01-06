<?php
require 'header.php'
?>




<script type="text/javascript">
	$(document).ready(function(){
		// alert("ok");
		$("#editStudentdiv").hide();
		getStudentlist();

		function getStudentlist(){
			$.get("studentlist.json", function(responce){
				// console.log(typeof(responce));
				var studentObjectArray=responce;
				var html="";
				var j=1;
				$.each(studentObjectArray,function(i,v){
					var name=v.name;
					var email=v.email;
					var gender=v.gender;
					var address=v.address;

					html+=`<tr>
					<td>${j++}</td>
					<td>${name}</td>
					<td>${email}</td>
					<td>${gender}</td>
					<td>${address}</td>
					<td>
					<button class="detail btn btn-success" data-id="${i}">Detail</button>
					<button class="edit btn btn-warning" data-id="${i}">Edit</button>
					<button class="delete btn btn-danger" data-id="${i}">Delete</button>
					</td>
					</tr>`
					$("tbody").html(html);
				})
			})
		}
		$('tbody').on('click','.edit',function(){
	    		$('#editStudentdiv').show();
	    		$('#addStudentdiv').hide();

	    		var id = $(this).data('id');

	    		$.get('studentlist.json',function(response){

	    			var studentObjArray = JSON.parse(response);

	    			var  name = studentObjArray[id].name;
	    			var  email = studentObjArray[id].email;
	    			var  gender = studentObjArray[id].gender;
	    			var  address = studentObjArray[id].address;
	    			var  profile = studentObjArray[id].profile;

	    			$('#edit_name').val(name);
	    			$('#edit_email').val(email);
	    			$('#edit_address').val(address);

	    			if (gender == "Male") {
	    				$('#edit_male').attr('checked', 'checked');
	    			}
	    			else{
	    				$('#edit_female').attr('checked', 'checked');

	    			}

	    			$('#showOldPhoto').attr('src',profile);
 
	    			$('#edit_id').val(id);

	    			$('#edit_oldprofile').val(profile);

	    		});
	    	});

	    	// $('tbody').on('click','.detail',function(){

	    	// 	$('#detailModal').modal('show');

	    	// 	var id = $(this).data('id');

	    	// 	$.get('studentlist.json',function(response){

	    	// 		var studentObjArray = JSON.parse(response);

	    	// 		var  name = studentObjArray[id].name;
	    	// 		var  email = studentObjArray[id].email;
	    	// 		var  gender = studentObjArray[id].gender;
	    	// 		var  address = studentObjArray[id].address;
	    	// 		var  profile = studentObjArray[id].profile;

	    	// 		$('#detail_name').text(name);
	    	// 		$('#detail_gender').text(gender);
	    	// 		$('#detail_email').text(email);
	    	// 		$('#detail_address').text(address);

	    	// 		$('#detail_profile').attr('src',profile);


	    	// 	});
	    	// });

	    	// $('tbody').on('click','.delete',function(){

	    	// 	var id = $(this).data('id');

	    	// 	var ans = confirm('Are you sure want to delete?');

	    	// 	if (ans) {
	    	// 		$.post(
	    	// 			'deletestudent.php', {sid:id},
	    	// 			function(data){
	    	// 				getStudentlist();
	    	// 			}
	    	// 		)
	    	// 	}

	    	// })


	})
</script>
	<!-- student form -->
	<div class="container" id="addStudentdiv">
		<h1 class="text-center my-5" >Add New Student</h1>
		<form action="addstudent.php" method="Post" emctype="multipart/form-data">
			
			<label class="my-3 mx-5">Profile</label>
			<input type="file" name="profile" id="profile">
			<br>
			<label class="my-3 mx-5" for="name">Name</label>
			<input type="text" name="name" placeholder="Enter Your Name" id="name" class="w-75">
			<br>
			<label class="my-3 mx-5" for="mail">Email</label>
			<input type="email" name="email" placeholder="Enter Your Email" id="mail"
			class="w-75">
			<br>
			<label class="my-3 mx-5">Gender</label>
			<input type="radio" name="gender" value="male" id="male"><label class="mr-3" for="male">Male</label>
			<input type="radio" name="gender" value="female" id="female"><label for="female">Female</label>
			<br>
			<label class="my-3 mx-5">Address</label>
			<textarea class="w-75" name="address"></textarea>
			<br>
			<button class="my-3 mx-5 btn btn-primary" type="submit">Save</button>
		</form>	
	</div>
	<br>

	<!-- edit form -->
	<div class="container" id="editStudentdiv">
		<h1 class="text-center my-5" >Edit Exisiting Student</h1>
		<form action="updatestudent.php" method="POST" enctype="multipart/form-data">
			<input type="hidden" name="edit_id" id="edit_id">
			<input type="hidden" name="edit_oldprofile" id="edit_oldphoto">
			<input type="hidden" name="edit_oldprofile" id="edit_oldprofile">
			<div class="form-group row">
				<label for="profile" class="col-sm-2 col-form-label"> Profile </label>
				<div class="col-sm-10">
					<ul class="nav nav-tabs" id="myTab" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" id="oldprofile-tab" data-toggle="tab" href="#oldprofile" role="tab" aria-controls="oldprofile" aria-selected="true"> Old Profile </a>
						</li>

						<li class="nav-item">
							<a class="nav-link" id="newprofile-tab" data-toggle="tab" href="#newprofile" role="tab" aria-controls="newprofile" aria-selected="false"> New Profile</a>
						</li>
					</ul>
					<div class="tab-content" id="myTabContent">
						<div class="tab-pane fade show active" id="oldprofile" role="tabpanel" aria-labelledby="oldprofile-tab">
							<img src="" id="showOldPhoto" class="img-fluid" width="100px" height="90px">
						</div>

						<div class="tab-pane fade" id="newprofile" role="tabpanel" aria-labelledby="newprofile-tab">
							<input type="file"  id="profile" name="edit_newprofile">
						</div>
					</div>


				</div>
			</div>

			<label class="my-3 mx-5">Profile</label>
			<input type="file" name="">
			<br>
			<label class="my-3 mx-5" for="name">Name</label>
			<input type="text" name="edit_name" placeholder="Enter Your Name" id="name" class="w-75">
			<br>
			<label class="my-3 mx-5" for="mail">Email</label>
			<input type="mail" name="edit_email" placeholder="Enter Your Email" id="mail" class="w-75">
			<br>
			<label class="my-3 mx-5">Gender</label>
			<input type="radio" name="edit_gender" value="male" id="male"><label class="mr-3" for="male">Male</label>
			<input type="radio" name="edit_grnder" value="female" id="female"><label for="female">Female</label>
			<br>
			<label class="my-3 mx-5">Address</label>
			<textarea class="w-75" name="edit_address"></textarea>
			<br>
			<button class="my-3 mx-5 btn btn-primary">Update</button>	
		</form>	
	</div>
	<br>

	<div class="container">
		<table class="w-100" border="1">
			<thead>
				<th>No</th>
				<th>Name</th>
				<th>Email</th>
				<th>Gender</th>
				<th>Address</th>
				<th>Action</th>
			</thead>
			<tbody>
				
			</tbody>
		</table>
	</div>




	<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
		    <div class="modal-content">
		      	<div class="modal-header">
		        	<h5 class="modal-title" id="exampleModalLabel"> Student Information </h5>
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          		<span aria-hidden="true">&times;</span>
		        	</button>
		      	</div>

		      	<div class="modal-body">
		        	<div class="container">
		        		<div class="row">
		        			<div class="col-4">
		        				<img src="" id="detail_profile" class="img-fluid">
		        			</div>
		        			<div class="col-8">
		        				<h1 id="detail_name"></h1>
		        				<p id="detail_gender"></p>
		        				<p id="detail_email"></p>
		        				<p id="detail_address"></p>
		        			</div>
		        		</div>
		        	</div>
		      	</div>
		    </div>
		</div>
	</div>



	<?php
	require 'footer.php'
	?>





