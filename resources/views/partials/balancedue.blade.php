@if(session('balancedue'))
	<div class="col-md-12">
		<div class="alert alert-info alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<i class="icon fa fa-dollar"></i> {{ session('balancedue') }}
		</div>
	</div>
@endif