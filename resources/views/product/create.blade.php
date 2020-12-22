@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center pt-4 pb-5">
            <div class="col-7">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title d-flex align-items-center"><span class=""><b>CREATE NEW PRODUCT</b></span></h5>
                    </div>
                    <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="/products">
                        <div class="form-group">
                            @csrf
                            <label for="name">Name: </label>
                            <input class="form-control" type="text" name="name" id="name" value="">
                            @error('name')

                            <div class="text-danger" ><strong>{{ $message }}</strong></div>

                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Description: </label>
                            <textarea rows="4" cols="50" class="form-control" name="description" id="description">
                                </textarea>
                            @error('description')

                            <div class="text-danger" ><strong>{{ $message }}</strong></div>

                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="startprice">Start price: </label>
                            <input class="form-control" type="text" name="start_price" id="startprice" value="0">
                            @error('start_price')

                            <div class="text-danger" ><strong>{{ $message }}</strong></div>

                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="minimumbid">Minimum Bid: </label>
                            <input class="form-control" type="text" name="minimum_bid" id="minimumbid" value="0">
                            @error('minimum_bid')

                            <div class="text-danger" ><strong>{{ $message }}</strong></div>

                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="end_date">End time:</label>
                            <input type="datetime-local" name="end_date" id="end_date"
                                value=""><br>
                                @error ('end_date')
                                <div class="text-danger" ><strong>{{ $message }}</strong></div>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label for="ispublic">On auction: </label>
                            <input  type="checkbox" name="is_bidding" id="ispublic">
                        </div>
                        <div class="form-group">
                            <input type="file" class="form-control-file" id="image" name="image[]" multiple>
                            @error('image')
                            <div class="text-danger" ><strong>{{ $message }}</strong></div>
                            @enderror
                        </div>
                        <button class="btn btn-primary" type="submit" name="create">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
