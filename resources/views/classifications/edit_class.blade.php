@section('title', 'Clasificaciones')

<body>
    <div class="container">
        <h1>Edición de Clase : {{ $CLASS->clase }}</h1>
    </div>
    <div>
        <form role="form" action="{{ route('classification.update', $CLASS->id) }}" method="PUT">
            {{ csrf_field() }}
            <div class="box-body">
                <input name="_method" type="hidden" value="PATCH">
                <div class="form-group col-md-12">
                    <label for="class"> Clase </label>
                    <input type="text" class="form-control" id="class" name="class" value="{{ $CLASS->class }}">
                </div>
                <div class="form-group col-md-12">
                    <label for="location"> Ubicación </label>
                    <input type="text" class="form-control" id="location" name="location" value="{{ $CLASS->location }}">
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-block"> Aceptar </button>
                <!-- <a class="btn btn-danger btn-block" href="{ route('classification.edit', $classification->id) }}"> Cancel </a> -->
            </div>
        </form>
    </div>
</body>