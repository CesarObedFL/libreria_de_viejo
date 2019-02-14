@if(session('delete'))
	<div class="col-md-12">
		<div class="alert alert-danger alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<i class="icon fa fa-ban"></i> {{ session('delete') }}
		</div>
	</div>
@endif