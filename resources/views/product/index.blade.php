@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="">
            <div class="">
                <a href="/products/create">Add a new product</a>
            </div>

            <div class="row justify-content-center">
                @foreach ($products as $item)

                    <div class="border col-6 ">
                        <div class="col-4">
                            @if (count($item->images) === 0)
                                <a href="products/{{ $item->id }}">
                                    <img class="img-fluid" style="height: 150px"
                                        src="{{ URL::asset('/img/defaultProductImage.jpg') }}" alt="">
                                </a>
                                
                            @else

                                <a href="products/{{ $item->id }}">
                                    <img class="img-fluid" src="{{ 'storage/' . $item->images['0']->image_url }}" alt="">
                                </a>
                            @endif
                            <a href="products/{{ $item->id }}">{{ $item->name }}</a>
                            <p>{{$item->hasBidder??'Doesnt have bidder'}}</p>
                        </div>
                        <div class="col-2 float-right">
                            <form method="GET" action="{{ url("/products/{$item->id}/edit") }}">
                                <button class="btn btn-primary" type="submit">Edit</button>
                            </form>
                            <form method="POST" action="{{ url("/products/{$item->id}") }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-warning" type="submit">Delete</button>
                            </form>
                        </div>

                    </div>
                @endforeach
            </div>

        </div>
        <div class=" row justify-center">{{ $products->links() }}</div>
        <div class="row" style="t">
            @if ($errors->any())
                <div class="alert alert-danger text-center">{{ $errors->first() }}</div>
            @endif
        </div>
    </div>
@endsection
