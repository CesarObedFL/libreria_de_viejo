@if (session('edit'))
    <div class="col-md-12">
        <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <i class="icon fa fa-info"></i>{{ session('edit') }}
        </div>
    </div>
@endif