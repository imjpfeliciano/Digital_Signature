
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Client</div>
				<div class="panel-body">
					You are logged in {{ Auth::user()->username }}!

					<ul>
						<li><a href="upload">Subir Archivo</a></li>
						<li><a href="misArchivos">Mis Archivos</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
