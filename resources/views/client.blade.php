<br>cliente

<br>
<form class="form-horizontal" role="form" method="POST" action="/upload">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">

	<div class="form-group">
		<label class="col-md-4 control-label">File Name</label>
		<div class="col-md-6">
			<input type="text" class="form-control" name="filename" value="{{ old('filename') }}">
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
				Register
			</button>
		</div>
	</div>
</form>