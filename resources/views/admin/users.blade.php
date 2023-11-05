@extends('admin.dashboard')
@section('admin')

<div class="page-content">

<div class="row">
	<div class="col-md-12 grid-margin stretch-card">
						<div class="card">
							<div class="card-body">
								<h6 class="card-title">Bordered table</h6>
								<p class="text-muted mb-3">Add class <code>.table-bordered</code></p>
								<div class="table-responsive pt-3">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>#</th>
												<th>Name</th>
												<th>Last Name</th>
												<th>Address</th>
												<th>Phone #</th>
												<th>Role</th>
												<th>Email</th>
											</tr>
										</thead>
										<tbody>
                                            @foreach($usersData as $users)
											<tr>
												<td>{{$users->id}}</td>
												<td>{{$users->name}}</td>
												<td>{{$users->lastname}}</td>
												<td>{{$users->address}}</td>
												<td>{{$users->phone}}</td>
												<td>{{$users->role}}</td>
												<td>{{$users->email}}</td>
											</tr>
                                            @endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
	</div>
</div>




@endsection