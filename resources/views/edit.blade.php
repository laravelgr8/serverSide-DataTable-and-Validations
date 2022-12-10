<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="col-xl-6" style="margin-left:150px;">
	<form method="post" action="{{route('create-student')}}" id="myform" enctype="multipart/form-data">
          	 @csrf
          	 <div class="col-xl-12">
          	 	<div class="form-group">
          	 		<label>Name : </label>
          	 		<input type="text" name="name" class="form-control" value="{{$data->name}}">
          	 	</div>
          	 	@error('name')
          	 	{{$message}}
          	 	@enderror
          	 </div>
          	 <div class="col-xl-12">
          	 	<div class="form-group">
          	 		<label>Email : </label>
          	 		<input type="text" name="email" class="form-control" value="{{$data->email}}">
          	 	</div>
          	 	@error('email')
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
          	 			@foreach($countries as $value)
          	 			<option value="{{$value->id}}" {{$value->id==$data->country_id ? 'selected' : '' }} >{{$value->country}}</option>
          	 			@endforeach
          	 		</select>
          	 	</div>
          	 </div>

          	 <div id="appendid">
          	 	@foreach($mobile as $key => $mob)
          	 	<div class="form-group">
	          	 	<div class="row" style="margin-left: 2px;">
	          	 		<div class="col-xl-10">
	          	 			Mobile : <input type="text" name="mobile[]" class="form-control" value="{{$mob->mobile}}">
	          	 		</div>
	          	 		@if($key=='0')
	          	 		<div class="col-xl-2"><br>
	          	 			<button class="btn btn-success" id="add">Add</button>
	          	 		</div>
	          	 		@endif
	          	 	</div>
	          	</div>
	          	@endforeach
	          	@error('mobile[]')
          	 	{{$message}}
          	 	@enderror
          	 </div>
          	 <br><br>

          	 <input type="submit" value="Signup" class="btn btn-block btn-info" id="submit">
          </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.1.js"></script>
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
	});
</script>
</body>
</html>