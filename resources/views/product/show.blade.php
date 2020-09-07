@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6">
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
                    is on Auction: {{ $product->is_bidding ? 'Public' : 'Non Public' }}
                </div>
                <div class="pb-4">
                    @if (!$isBidding)
                        <form method="POST" action="/auctions/{{ $product->auction->id }}">
                            @csrf
                            @method('PATCH')
                            <div>Start time:</div>

                            <div>{{ $startDate->format('F j, Y, g:i a') }}</div><br>

                            @if ($status)
                                <label for="end_date">End time:</label>
                                <input type="datetime-local" name="end_date" id="end_date"
                                    value="{{  $endDate?$endDate->format('Y-m-d\TH:i:s'):$endDate }}"><br>

                                <button name="mode" value="restart" type="submit" class="btn btn-primary">Restart
                                    Auction</button>
                            @elseif ($bidder)
                                <label for="end_date">End time:</label>
                                <input type="datetime-local" name="end_date" id="end_date"
                                    value="{{   $endDate?$endDate->format('Y-m-d\TH:i:s'):$endDate }}"><br>

                                <button name="mode" value="update" type="submit" class="btn btn-primary">Update Close
                                    Date</button>
                            @else
                                <label for="end_date">End time:</label>
                                <input type="datetime-local" name="end_date" id="end_date"
                                    value="{{   $endDate?$endDate->format('Y-m-d\TH:i:s'):$endDate }}"><br>

                                <button name="mode" value="start" type="submit" class="btn btn-primary">Start
                                    Auction</button>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger text-center">{{ $errors->first() }}</div>
                            @endif
                        </form>
                    @else
                        <div>Start time:</div>

                        <div>{{ $startDate->format('F j, Y, g:i a') }}</div><br>
                        <div>End time:</div>

                        <div>{{ $endDate?$endDate->format('F j, Y, g:i a'):$endDate }}</div><br>
                    @endif
                </div>

            </div>

        </div>
    </div>
@endsection
