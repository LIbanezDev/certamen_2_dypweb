@extends('layout.base')
@section('contenido')
    <div class="row">
        <div class="col-12 mb-3">
            <h1 class="text-center"> Bienvenido al centro de distribución eléctrica Sansaquinta </h1>
            <h4 class="text-center text-muted"> Seleccione accion a realizar </h4>
        </div>
        <div class="col col-lg-6 col-sm-12">
            <div class="card">
                <img src="https://www.o4uchile.cl/wp-content/uploads/2019/01/Depositphotos_100730138_l-2015-distribuidora-electrica-1110x695.jpg" class="card-img-top" alt="distribuidora electrica">
                <div class="card-body">
                    <h5 class="card-title"><a href="{{route('mediciones')}}">Ver mediciones</a></h5>
                    <p class="card-text">Lista de las mediciones registradas, aquí podrá ver y descartar mediciones.</p>
                </div>
            </div>
        </div>
        <div class="col col-lg-6 col-sm-12">
            <div class="card">
                <img src="http://www.diarioeldia.cl/sites/default/files/styles/flexslider_full/public/032019/cuanto-te-costara-el-nuevo-contador-de-la-luz-que-te-van-a-instalar-las-electricas-en-casa.jpg?itok=vJgeAis-" class="card-img-top" alt="medidor electrico">
                <div class="card-body">
                    <h5 class="card-title"><a href="{{route('registrar_lectura')}}">Agregar lectura</a></h5>
                    <p class="card-text">Formulario donde podrá agregar nuevas lecturas obtenidas directamente de los medidores.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
