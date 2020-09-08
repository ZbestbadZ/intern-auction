@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="form-group col-4">
                <form action="\products" method="GET">
                    <input type="text" name="search" placeholder="Name: ex(banana)">
                    <button class="btn btn-primary">Search</button>
                </form>
            </div>

            <div class="col-6">
                <a href="/products/create">Add a new product</a>
            </div>
            <div class=" col-4 ">
                <form action="\products" method="GET">
                    <label for="sortBy">Sort By:</label>
                    <select id="sortBy" name="sortBy">
                        <option value="name">Name</option>
                        <option value="endDate">End Date</option>
                        <option value="startDate">Start Date</option>

                    </select>
                    <button class="btn btn-primary">Sort</button>
                </form>
            </div>
            @if ($errors->any())
                <div class="row" style="">
                    <div class="alert alert-danger text-center">{{ $errors->first() }}</div>
                </div>
            @endif

            <table class="table">
                <tr>
                    <td></td>
                    <td>Name</td>
                    <td>Highest price</td>
                    <td>Options</td>
                </tr>
                @foreach ($products as $item)
                    <tr>
                        <td>

                            <div class="col-4">
                                @if (count($item->images) === 0)
                                    <a href="products/{{ $item->id }}">
                                        <img class="img-fluid" style="height: 150px"
                                            src="{{ URL::asset('/img/defaultProductImage.jpg') }}" alt="">
                                    </a>

                                @else

                                    <a href="products/{{ $item->id }}">
                                        <img class="img-fluid" src="{{ asset('storage/' . $item->images['0']->image_url) }}"
                                            alt="{{ asset('/img/defaultProductImage.jpg') }}">
                                    </a>
                                @endif

                            </div>
                        </td>
                        <td><a href="products/{{ $item->id }}">{{ $item->name }}</a></td>
                        <td>
                            <p>{{ $item->hasBidder() ? 'Current highest price: ' . $item->getHighestBidPrice() : 'Doesnt have bidder' }}
                            </p>
                        </td>

                        <td>
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
                        </td>


                    </tr>

                @endforeach
            </table>
            <div class="row justify-content-center">

            </div>

        </div>
        <div class=" row justify-center">{{ $products->links() }}</div>

    </div>
@endsection
