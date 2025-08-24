@extends('layouts.wrapper')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>
                Play Gotcha!
            </h1>
            <div class="panel panel-default">

                <div class="panel-heading">
                    <p class="lead">
                        Player Dashboard
                        @include('partials.navigation')
                    </p>
                    <p>
                        @if ( str_contains(url()->previous(), 'profile') )
                            Thank you, {{ $username }}, for adding your picture.
                        @else
                            Welcome back, {{ $username }}
                        @endif
                    </p>
                </div>
                <div class="panel-body">
    
                    <h3 class="btn btn-success">
                        <a href="{{ route('game.index') }}">
                            Show All Games
                            <i class="fa fa-arrow-circle-o-up"></i>
                        </a>
                    </h3>

                    @if( $isAdmin )
                    <h3 class="btn btn-primary">
                        <a href="{{ route('game.create') }}">
                            Create Game
                            <i class="fa fa-arrow-circle-o-right"></i>
                        </a>
                    </h3>
                    @endif

                    @if( !$isAdmin )
                    <h3 class="btn btn-primary">
                        <a href="{{ route('game.index') }}">
                            Join Games
                            <i class="fa fa-arrow-circle-o-right"></i>
                        </a>
                    </h3>
                    @endif
    
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
