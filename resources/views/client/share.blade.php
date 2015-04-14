@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Sharing files</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif


					@if(count($vecinos) > 0)
						<form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="/sharewith">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="_file" value="{{ $archivo }}">
							<fieldset>
								<legend>Select who can see your file!</legend>
							</fieldset>

							@foreach( $vecinos as $vecino)
								<input type="checkbox" name="{{ $vecino->id }}"  value="1"/><label for="{{ $vecino->id }}">{{ $vecino->username }}</label><br />
							@endforeach
						
							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<button type="submit" class="btn btn-primary">
										Share
									</button>
								</div>
							</div>

						</form>
					@endif


					<!--
					<form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="upload">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Name</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="filename" value="{{ old('filename') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Type</label>
							<div class="col-md-6">
								<select name="opcion">
									<option value="1">Contrato</option>
  									<option value="2">Reglamento</option>
									<option value="3">Otros</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Description</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="description" value="{{ old('description') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">File</label>
							<div class="col-md-6">
								<input type="file" class="form-control" name="data" value="{{ old('data') }}">
							</div>
						</div>
				
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Upload
								</button>
							</div>
						</div>
					</form>
				-->
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
