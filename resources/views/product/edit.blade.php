@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-10">
                <form method="POST" enctype="multipart/form-data" action="/products/{{ $product->id }}">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="name">Name: </label>
                        <input class="form-control" type="text" name="name" id="name" value="{{ $product->name }}">
                        @error('name')

                        <strong>{{ $message }}</strong>

                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Description: </label>
                        <textarea rows="4" cols="50" class="form-control" name="description"
                            id="description">{{ $product->description }}
                        </textarea>

                        @error('description')

                        <strong>{{ $message }}</strong>

                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="startprice">Start price: </label>
                        @if ($hasBidder)

                            <br><span>{{ $product->start_price }}</span>
                        @else
                            <input class="form-control" type="text" name="start_price" id="startprice"
                                value="{{ $product->start_price }}">
                        @endif

                        @error('start_price')

                        <strong>{{ $message }}</strong>

                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="minimumbid">Minimum Bid: </label>

                        <input class="form-control" type="text" name="minimum_bid" id="minimumbid"
                            value="{{ $product->minimum_bid }}">
                        @error('minimum_bid')

                        <strong>{{ $message }}</strong>

                        @enderror
                    </div>

                    <div class="form-group">
                        @if ($product->status == 1)
                            Product is successfully finished an auction session if you wish to restart auction <a
                                href="/products/{{$product->id }}/edit?restart=1">Click here</a>
                        @else
                            <div class="form-group">
                                <label for="end_date">End time:</label>
                                <input type="datetime-local" name="end_date" id="end_date"
                                    value="{{ $endDate ? $endDate->format('Y-m-d\TH:i:s') : $endDate }}"><br>
                                @error ('end_date')
                                <strong>{{ $message }}</strong>
                                @enderror
                            </div>
                            <label for="ispublic">On auction: </label>
                            <input type="checkbox" name="is_bidding" id="ispublic" @if ($product->is_bidding) checked=checked @endif>
                        @endif
                    </div>
                    <div class="form-group">

                        @if (count($images) != 0)
                            <table class="table">
                                <tr>
                                    <th>image</th>
                                    <th>name</th>
                                    <th>size</th>
                                    <th></th>
                                </tr>
                                @foreach ($images as $item)
                                    <tr>
                                        <td>
                                            <div class="w-50">
                                                <img class="img-fluid" src="{{ asset('storage/' . $item->image_url) }}"
                                                    alt="">
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                {{ $item->name }}
                                            </div>
                                        </td>
                                        <td>
                                            <div>

                                            </div>
                                        </td>
                                        <td>
                                            <form action=""></form>
                                            <form method="POST" action="{{ url("/productImage/{$item->id}") }}">
                                                @csrf
                                                @method('DELETE')

                                                <button class="btn btn-primary" type="submit">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        @endif
                        <label for="image">Add Images</label>
                        <input type="file" class="form-control-file" id="image" name="image[]" multiple>
                        @error('image')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                    <button class="btn btn-primary" type="submit" name="edit">Save</button>
                </form>

            </div>

        </div>
    </div>
@endsection
