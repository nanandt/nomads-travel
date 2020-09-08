@extends('layouts.admin')

@section('content')
	<div class="container-fluid">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Edit User {{ $item->username }}</h1>
	</div>

	@if ($errors->any())
	<div class="alert alert-danger">
		<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
	@endif

	<div class="card shadow">
		<div class="card-body">
			<form action="{{ route('alluser.update', $item->user_id) }}" method="POST">
					@method('PUT')
					@csrf
					<div class="form-group">
						<label for="roles">Roles</label>
						<select name="roles" required class="form-control">
							<option value="{{ $item->roles }}">
								Jangan Ubah ({{ $item->roles }})
							</option>
							<option value="ADMIN">Admin</option>
							<option value="USER">User</option>
						</select>
					</div>
					<button type="submit" class="btn btn-primary btn-block">
							Ubah
					</button>
			</form>
		</div>
	</div>
</div>
@endsection