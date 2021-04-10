@extends('layouts.profile')

@section('content')

    <div class="row">
        <div class="col-md-2">
            <a href="#" class="thumbnail">
                <img class="img-circle" src="https://placehold.it/150x150">
            </a>
        </div>

        <div class="col-md-2">
            <strong>{{ $model->fullName }}</strong>
            <small class="block">{{ $model->email }}</small>
        </div>


        <div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">About Me</h3>
                </div>
                <div class="panel-body">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    Duis ac mollis tellus. Aenean vel auctor turpis, non porttitor lectus.
                    Morbi ac lacus bibendum, sollicitudin felis vitae, feugiat justo.
                    Integer diam nunc, lacinia ut tincidunt et, pellentesque ac eros.
                    Nullam felis arcu, dignissim sed lorem sit amet, rhoncus maximus nisi.
                </div>
            </div>
        </div>

        <div class="col-md-3">

            <div class="splash bg-success">
                <h2 class="m-top-none">Profile Views</h2>

                <h5>{{ $model->views }}</h5>

                <div class="stat-icon">
                    <i class="fa fa-eye fa-3x"></i>
                </div>
            </div>

        </div>
    </div>
@stop