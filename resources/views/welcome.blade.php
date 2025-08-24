@extends('layouts.wrapper')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>
                Welcome to Gotcha!
            </h1>
            <div class="panel panel-default">

                <div class="panel-heading">
                 To play, you will need to create an account and upload a photo of yourself, or <a href="{{ route('login') }}">log back in</a>.
               </div>
                <div class="panel-body">
                    <a
                            href="register"
                            class="btn btn-success"
                    >
                        Next
                        <i class="fa fa-arrow-circle-o-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
