@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			
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

				@if (count($myfiles) > 0)
					<div class="panel panel-default">
					<!--<div class="panel-heading">Mis Archivos</div>-->
					<div class="panel-body">
						<table class="table table-bordered">
							<caption><b>Mis Archivos</b></caption>
		  					<tr class="active">
		    					<th>Filename</th>
		    					<th>Type</th>
		    					<th>Description</th>
		    					<th>Size</th>
		    					<th>Download</th>
		    					<th>Share File</th>
		  					</tr>

						@foreach ($myfiles as $mfile)
							<tr>
								<td>{{$mfile->filename}}</td>
								@if($mfile->type == '1')
									<td>Contrato</td>
								@endif
								@if($mfile->type == '2')
									<td>Reglamento</td>
								@endif
								@if($mfile->type == '3')
									<td>Otro</td>
								@endif
								<td>{{$mfile->description}}</td>
								<td>{{$mfile->size}}</td>
								<td><a href="download/{{$mfile->id}}">Here!</a></td>
								<td><a href="share/{{$mfile->id}}">Share this File</a></td>
							</tr>
						@endforeach
						</table>
					</div>	

				</div>

				@endif
			

			
				@if (count($sharedwithme) > 0)
				<div class="panel panel-default">
					<!--<div class="panel-heading">Compartido Conmigo</div>-->
					<div class="panel-body">
						<table class="table table-bordered">
							<caption><b>Compartido Conmigo</b></caption>
		  					<tr class="active">
		    					<th>Filename</th>
		    					<th>Type</th>
		    					<th>Description</th>
		    					<th>Size</th>
		    					<th>Download</th>
		  					</tr>

						@foreach ($sharedwithme as $mfile)
							<tr>
								<td>{{$mfile->filename}}</td>
								<td>{{$mfile->type}}</td>
								<td>{{$mfile->description}}</td>
								<td>{{$mfile->size}}</td>
								<td><a href="download/{{$mfile->id}}">Here!</a></td>
							</tr>
						@endforeach
						</table>
					</div>	
				</div>
				@endif
			
		</div>
	</div>
</div>
@endsection
