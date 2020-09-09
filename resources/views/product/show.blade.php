@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6">
                @if (count($product->images) === 0)

                    <img class="img-fluid" style="height: 150px" src="{{ URL::asset('/img/defaultProductImage.jpg') }}"
                        alt="">

                @else

                    @foreach ($product->images as $item)

                        <img class="img-fluid" src="{{ asset('storage/' . $item->image_url) }}" alt="">
                    @endforeach

                @endif
            </div>

            <div class="col-6">
                <div class="pb-4">
                    <h3>{{ $product->name }}</h3>
                </div>
                <div class="pb-4">
                    Description: {{ $product->description }}
                </div>
                <div class="pb-4">
                    Status: {{ $status ? 'Successful' : 'In Process' }}
                </div>
                <div class="pb-4">
                    Is on Auction: {{ $product->is_bidding ? 'Public' : 'Non Public' }}
                </div>
                <div class="pb-4">

                    <div>Start time:</div>

                    <div>{{ $startDate->format('F j, Y, g:i a') }}</div><br>
                    <div>End time:</div>

                    <div>{{ $endDate ? $endDate->format('F j, Y, g:i a') : $endDate }}</div><br>

                </div>
                @if($bidder)
                <div class="pb-4">
                    Highest bidder: {{ number_format($highestBid)}}
                </div>
                @endif
            </div>

        </div>
    </div>
@endsection
