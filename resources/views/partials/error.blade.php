@if (session('error'))
	<div class="col-md-12">
	    <div class="alert alert-warning alert-dismissible">
	        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	        <i class="icon fa fa-warning"></i>{{ session('error') }}
	    </div>
	</div>
@endif