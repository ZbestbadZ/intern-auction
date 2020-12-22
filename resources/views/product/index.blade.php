@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="form-group col-4">
                <form action="/products" method="GET">
                    <input type="text" name="search" placeholder="Name: ex(banana)">
                    <button class="btn btn-primary">Search</button>
                </form>
            </div>

            <div class="col-6">
                <a href="/products/create" class="btn btn-primary">Add a new product</a>
            </div>
            <div class=" col-4 ">
                <form action="/products" method="GET">
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
                <div class="row text-danger" style="">
                    <div class="alert alert-danger text-center">{{ $errors->first() }}</div>
                </div>
            @endif

            <table class="table table-hover table-bordered table-striped display" style="width:100%">

                <tr id="tbl-first-row" style="font-weight: bold;">

                    <td width="10%">ID</td>
                    <td width="10%" style="white-space: nowrap ;">Name</td>
                    <td width="10%">Status</td>
                    <td width="10%">Is_Bidding</td>
                    <td width="10%">StartPrice</td>
                    <td width="10%">StepPrice</td>
                    <td width="50%">Image</td>
                    <td width="30%">Action</td>

                </tr>

                @foreach($products as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td><a href="products/{{ $item->id }}">{{$item->name}}</a></td>
                        <td>{{$item->status}}</td>
                        <td>{{$item->is_bidding}}</td>
                        <td>{{$item->start_price}}</td>
                        <td>{{$item->minimum_bid}}</td>
                        <td>
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
                        </td>
                        <td><form method="GET" action="{{ url("/products/{$item->id}/edit") }}">
                                <button class="btn btn-primary" type="submit">Edit</button>
                            </form>
                            <form method="POST" action="{{ url("/products/{$item->id}") }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-primary" type="submit">Delete</button>
                            </form></td>
                    </tr>
               @endforeach
            </table>
            <div class="row justify-content-center">
            </div>
        </div>
        <div class=" row justify-center">{{ $products->links() }}</div>

    </div>
@endsection
