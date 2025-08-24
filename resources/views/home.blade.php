@extends('layouts.wrapper')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>
                Home
            </h1>
            <div class="panel panel-default">

                <div class="panel-heading">
                    <p class="lead">
                        {{ $username }}, you may have found this page in error.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
