@if (count($errors) > 0)
	<div class="col-md-12">
	    <div class="alert alert-warning alert-dismissible">
	        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	       	@foreach ($errors->all() as $error)
	       		<div>{{ $error }}</div>
	      	@endforeach
	    </div>
	</div>
@endif