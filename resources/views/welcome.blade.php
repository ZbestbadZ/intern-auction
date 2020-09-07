@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>HomePage</h1>
                @if (Auth::check())
                    @if (Auth::user()->role == 1)
                        <a href="/products">Products management</a>
                    @elseif(Auth::user()->role == 0)
                        <a href="/user/list_product">List of auctions</a>
                    @endif
                @endif
            </div>
        </div>
    </div>
@endsection
