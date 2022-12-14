@extends('layouts.theme')

@section('title', 'Home')

@section('content') <!-- VISTA PARA EL CARRUCEL DE IMAGENES -->

    @include('partials.error')

    <div class="box-body">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                <li data-target="#carousel-example-generic" data-slide-to="3" class=""></li>
            </ol>
            <div class="carousel-inner">
                <div class="item active">
                    <img src="{{ asset('dist/img/slides/c.jpg') }}" alt="First slide" width="100%" height="100%">
                </div>
                <div class="item">
                    <img src="{{ asset('dist/img/slides/a.jpg') }}" alt="Second slide" width="100%" height="100%">
                </div>
                <div class="item">
                    <img src="{{ asset('dist/img/slides/s.jpg') }}" alt="Third slide" width="100%" height="100%">
                </div>
                <div class="item">
                    <img src="{{ asset('dist/img/slides/e.jpg') }}" alt="Third slide" width="100%" height="100%">
                </div>
            </div> <!-- /. class="carousel-inner" -->
            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                <span class="fa fa-angle-left"></span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                <span class="fa fa-angle-right"></span>
            </a>
        </div> <!-- /. id="carousel-example-generic" -->
    </div> <!-- /. class="box-body" -->

@endsection
