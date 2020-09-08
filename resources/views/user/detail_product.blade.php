@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3">
                @if (count($product->images) === 0)

                    <img class="img-fluid" style="height: 150px"
                        src="{{URL::asset('/img/defaultProductImage.jpg')}}"
                        alt="">

                @else

                    @foreach ($product->images as $item)

                        <img class="img-fluid" src="{{ asset('storage/' . $item->image_url) }}" alt="">
                    @endforeach

                @endif
            </div>

            <div class="col-3">
                <div class="row">
                    <h3>{{ $product->name }}</h3>
                </div>
                <div class="row">
                    <p class="number">Description: {{ $product->description }}</p>
                </div>
                <div class="row">
                    <p class="number">Public: {{ $product->is_bidding ?'Open':'Non-public' }}</p>
                </div>
                <div class="row">
                    <p class="number">Start Price: {{ number_format($product->start_price) }}</p>
                </div>
                <div class="row">
                    <p class="number">Status: {{ $product->status ? '': 'Opening auction' }}</p>
                </div>
                <div class="row">
                    <p class="number">Step Price: {{ (int)$product->minimum_bid }}</p>
                </div>
            </div>
            <div class="col-4">
                <div class="row">
                    <p class="number">The current highest price:
                        {{ number_format($auctionDetail->bid_price ?? $product->start_price) }}</p>
                </div>
                <div class="row">
                    <p class="number">Time auction: {{ $auctionDetail->bid_time ?? 'N/A' }}
                    </p>
                </div>
                <div class="row">
                    <p class="number">Opening auction date: {{ $auction->start_date }}</p>
                </div>
                <div class="row">
                    <p class="number">End date auction: {{ $auction->end_date }}</p>
                </div>

                <div class="row">

                    @if ($product->is_bidding == 1)
                        <form method="post" enctype="multipart/form-data" action="{{ $product->id }}">
                            @csrf
                            @method('PATCH')
                            <input type="text" name="bid_price" placeholder="Insert price"><br><br>
                            <!-- @error('bid_price')

                            <strong>{{ $message }}</strong><br>

                            @enderror -->
                            
                            <button class="btn btn-primary" type="submit">Start Auction</button>
                        </form>
                    @endif
                </div>
                <br>
                <div class="row">
                    @if ($errors->any())
                        <div class="alert alert-danger text-center">{{ $errors->first() }}</div>
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection