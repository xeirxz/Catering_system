@extends('admin.dashboard')
@section('admin')


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>	

<div class="page-content">

	<nav class="page-breadcrumb">
		<ol class="breadcrumb"  style="background-color: transparent; border: 1px; color:black; font-weight:bolder; font-size:20px;">
			<li class="breadcrumb-item " aria-current="page">Edit Information</li>
		</ol>
	</nav>	

<div class="row">
	<div class="col-md-8 grid-margin stretch-card">
        <div class="card d-flex align-items-left flex-wrap text-nowrap	">
              <div class="card-body">
								<form class="forms-sample" enctype="multipart/form-data" method="POST" action="{{route('admin.profile.store')}}" >
									@csrf
									<div class="mb-3">
										<label for="Inputname" class="form-label">Name</label>
										<input type="text"  name="name"  class="form-control" id="Inputname" autocomplete="off" placeholder="First Name" value="{{ $profileData->name }}">
									</div>
									<div class="mb-3">
										<label for="Inputlastname" class="form-label">Last name</label>
										<input type="text" name="lastname"  class="form-control" id="Inputlastname" autocomplete="off" placeholder="" value="{{ $profileData->lastname }}">
									</div>
									<div class="mb-3">
										<label for="Inputaddress" class="form-label">Address</label>
										<input type="text" name="address"  class="form-control" id="Inputaddress" autocomplete="off" placeholder="" value="{{ $profileData->address }}">
									</div>
									<div class="mb-3">
										<label for="Inputphone" class="form-label">Phone</label>
										<input type="text" name="phone" class="form-control" id="Inputphone" autocomplete="off" placeholder="" value="{{ $profileData->phone }}">
									</div>
									<div class="mb-3">
										<label for="Inputemail" class="form-label">Email</label>
										<input type="email" name="email"  class="form-control" id="Inputemail" placeholder="Email" value="{{ $profileData->email }}" required>
									</div>
									<div class="mb-3">
										<label for="exampleInputPassword1" class="form-label">Image</label>
										<input class="form-control" name="image"  type="file" id="image">
									</div>

									<button type="submit" class="btn btn-primary me-2">Save</button>
									<a type="button" class="btn btn-primary me-2" href="{{route('admin.dashboard')}}">Cancel</a>
								</form>
              </div>
   		</div>
	</div>
			<div class="col-md-4 grid-margin">
				<div class="card">
						<div class="card-body">
                            <div class="d-flex justify-content-center">
                    			<img id="showImage" class="wd-105 rounded-circle" src="{{(!empty($profileData->image)) ? url('upload/admin_images/'.$profileData->image) : url('upload/no_image.jpg')}}" alt="profile">	
              				</div>

						<div class="mt-3">
						<label class="tx-11 fw-bolder mb-0 text-uppercase">Name</label>
						<p class="text-muted">{{ $profileData->name }}</p>
						</div>
						<div class="mt-3">
						<label class="tx-11 fw-bolder mb-0 text-uppercase">Last Name:</label>
						<p class="text-muted">{{$profileData->lastname}}</p>
						</div>
						<div class="mt-3">
						<label class="tx-11 fw-bolder mb-0 text-uppercase">Address:</label>
						<p class="text-muted">{{$profileData->address}}</p>
						</div>
						<div class="mt-3">
						<label class="tx-11 fw-bolder mb-0 text-uppercase">Phone:</label>
						<p class="text-muted">{{$profileData->phone}}</p>
						</div>
						<div class="mt-3">
						<label class="tx-11 fw-bolder mb-0 text-uppercase">Email Adress:</label>
						<p class="text-muted">{{$profileData->email}}</p>
						</div>
						

                            
						</div>
				</div>
					</div>
				</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#image').change(function(e){
			var reader = new FileReader();
			reader.onload = function(e){
				$('#showImage').attr('src',e.target.result);
			}
			reader.readAsDataURL(e.target.files['0']);
		});
	});
</script>

	<!-- endinject -->





@endsection