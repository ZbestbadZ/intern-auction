@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class=" col-5">
                <form method="POST" enctype="multipart/form-data" action="/products">
                    <div class="form-group">
                        @csrf
                        <label for="name">Name: </label>
                        <input class="form-control" type="text" name="name" id="name" value="">
                        @error('name')

                        <strong>{{ $message }}</strong>

                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Description: </label>
                        <textarea rows="4" cols="50" class="form-control" name="description" id="description">
                            </textarea>
                        @error('description')

                        <strong>{{ $message }}</strong>

                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="startprice">Start price: </label>
                        <input class="form-control" type="text" name="start_price" id="startprice" value="0">
                        @error('start_price')

                        <strong>{{ $message }}</strong>

                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="minimumbid">Minimum Bid: </label>
                        <input class="form-control" type="text" name="minimum_bid" id="minimumbid" value="0">
                        @error('minimum_bid')

                        <strong>{{ $message }}</strong>

                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="ispublic">On auction: </label>
                        <input onclick="return function(){if(document.getElementById('ispublic').getAttribute('checked')) }" type="checkbox" name="is_bidding" id="ispublic">
                    </div>
                    <div class="form-group">
                        <input type="file" class="form-control-file" id="image" name="image[]" multiple>
                        @error('image')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                    <button class="btn btn-primary" type="submit" name="create">Create</button>
                </form>
            </div>
        </div>
    </div>
@endsection
