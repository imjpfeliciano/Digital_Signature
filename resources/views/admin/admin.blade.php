
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Admin</div>

				<div class="panel-body">
					You are logged in {{ Auth::user()->username }}!

					<ul>
						<li><a href="create">Create user</a></li>
						<!--<li><a href="edit_group">Edit Group</a></li>-->
						<li><a href="upload">Upload File</a></li>
						<li><a href="misArchivos">My Files</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
