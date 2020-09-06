@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="justify-content-center">

            <div class="">
                <a href="/products/create">Add a new product</a>
            </div>

            <div class="row">
                @foreach ($products as $item)

                    <div class="pb-5 row col-6">
                        <div class="col-4">
                            @if (count($item->images) === 0)
                                <a href="products/{{ $item->id }}">
                                    <img class="img-fluid" style="height: 150px"
                                        src="{{URL::asset('/img/defaultProductImage.jpg')}}"
                                        alt="">
                                </a>
                            @else

                                <a href="products/{{ $item->id }}">
                                    <img class="img-fluid" src="{{ 'storage/' . $item->images['0']->image_url }}" alt="">
                                </a>
                            @endif
                        </div>
                        <div class="col-2">
                            <form method="GET" action="{{ url("/products/{$item->id}/edit") }}">
                                <button class="btn btn-primary" type="submit">Edit</button>
                            </form>
                            <form method="POST" action="{{ url("/products/{$item->id}") }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-primary" type="submit">Delete</button>
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
