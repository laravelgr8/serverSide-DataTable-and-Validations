<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

  <!-- For datatable  -->
  <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script>   -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script> -->
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script> -->
  <style>
  	.error{
  		color: red;
  	}
  </style>
</head>
<body>

<div class="container">
  <h2>Large Modal</h2>
  <!-- Button to Open the Modal -->
  <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#myModal">
    Signup Form
  </button>

  <!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Student Signup</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        	@if(Session('message'))
        	{{Session('message')}}
        	@endif
          <form method="post" action="{{route('create-student')}}" id="myform" enctype="multipart/form-data">
          	 @csrf
          	 <div class="col-xl-12">
          	 	<div class="form-group">
          	 		<label>Name : </label>
          	 		<input type="text" name="name" class="form-control">
          	 	</div>
          	 	@error('name')
          	 	{{$message}}
          	 	@enderror
          	 </div>
          	 <div class="col-xl-12">
          	 	<div class="form-group">
          	 		<label>Email : </label>
          	 		<input type="text" name="email" class="form-control">
          	 	</div>
          	 	@error('email')
          	 	{{$message}}
          	 	@enderror
          	 </div>
          	 <div class="col-xl-12">
          	 	<div class="form-group">
          	 		<label>Password : </label>
          	 		<input type="text" name="password" class="form-control">
          	 	</div>
          	 	@error('password')
          	 	{{$message}}
          	 	@enderror
          	 </div>

          	 <div class="col-xl-12">
          	 	<div class="form-group">
          	 		<label>Image : </label>
          	 		<input type="file" name="pic" class="form-control">
          	 	</div>
          	 </div>

          	 <div class="col-xl-12">
          	 	<div class="form-group">
          	 		<label>Country : </label>
          	 		<select name="country" class="form-control">
          	 			<option>Select country</option>
          	 			@foreach($countries as $data)
          	 			<option value="{{$data->id}}">{{$data->country}}</option>
          	 			@endforeach
          	 		</select>
          	 	</div>
          	 </div>

          	 <div id="appendid">
          	 	<div class="form-group">
	          	 	<div class="row" style="margin-left: 2px;">
	          	 		<div class="col-xl-10">
	          	 			Mobile : <input type="text" name="mobile[]" class="form-control">
	          	 		</div>
	          	 		<div class="col-xl-2"><br>
	          	 			<button class="btn btn-success" id="add">Add</button>
	          	 		</div>
	          	 	</div>
	          	</div>
	          	@error('mobile[]')
          	 	{{$message}}
          	 	@enderror
          	 </div>
          	 <br><br>

          	 <input type="submit" value="Signup" class="btn btn-block btn-info" id="submit">
          </form>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
  
</div>


<!-- Fetch data  -->
<div class="container">
    <h1>Student List</h1>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Pic</th>
                <th width="200px">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>


<script src="https://code.jquery.com/jquery-3.6.1.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script> -->
<script src="{{asset('js/validator.js')}}"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
  $(function () {
      
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('users.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'pic', name: 'pic'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
      
  });
</script>


<script>
	$(document).ready(function(){

		var i=1;
	
	$("#add").click(function(e){
		e.preventDefault();
		i++;
		var html="";
		html+='<div class="row" id="row'+i+'" style="margin-left: 2px;">';
		html+='<div class="col-xl-10">';
		html+='Mobile : <input type="text" name="mobile[]" class="form-control" id="mobile'+i+'">';
		html+='</div>';
		html+='<div class="col-xl-2"><br>';
		html+='<button class="btn btn-danger remove" id="'+i+'">Remove</button>';
		html+='</div>';
		html+='</div>';
		$("#appendid").append(html);
		// mobile();
	});

	$(document).on("click",'.remove',function(e){
		var id=$(this).attr('id');
		$("#row"+id).remove();
	});

	$("#submit").click(function(){
		$(".modal-body").show();
	});
		// var form=$("#myform");
			$("#myform").validate({
				// ignore: [],
				rules : {
					name:{
						required:true,
					},
					email:{
						required:true,
					},
					password:{
						required:true,
					},
					pic: {
						required :true,
						// accept:"jpg,png,jpeg,gif",
					},
					// 'mobile[]':{
					// 	required:true,
					// },
					"mobile[]": "required",
				},
				messages:{
					name:{
						required:'This is required',
					},
					email:{
						required:'This is required',
					},
					password:{
						required:'This is required',
					},
					pic: {
						required :'This is required',
						// accept:"Accept only jpg,png,jpeg,gif",
					},
					// 'mobile[]':{
					// 	required:'This is required',
					// },
				},
			});

	// function mobile(){
	// 		$(".mobile").each((i,e)=>{
	// 		$(e).rules('add',{required:true})
	// 	})
	// }
	// mobile();

	//for add more




	


	
	// mobile();

	

	});



	</script>
</body>
</html>
