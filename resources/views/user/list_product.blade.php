@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row ">
        <div class="col-lg-12 col-md-8">
            <div class="row">

                @foreach($products as $p)
                    <div class="col-3 text-center">
                        @if(count($p->images)===0)
                        <a href="products/{{$p->id}}">
                            <img class="img-fluid" style="height: 150px"  src="{{URL::asset('/img/defaultProductImage.jpg')}}" alt=""><br>
                        </a>
                        @else
                        <a href="products/{{$p->id}}">
                            <img class="img-fluid" src="{{URL::asset('storage/'. $p->images['0']->image_url)}}"> <br>
                        </a>
                        @endif

                        <a href="products/{{$p->id}}">
                            {{$p->name}}
                        </a>
                        <p class="number">The current price: {{number_format($p->auction->auctionDetail->bid_price??$p->start_price)}}</p>
                        <p class="number">Step Price: {{(int)$p->minimum_bid}}</p>
                    </div>
                @endforeach
            </div>
            <div class=" row justify-center">{{ $products->links() }}</div>
            <div class="row"><div>{{ $warning['warning'] ?? '' }}</div></div>
            </div>
        </div>
    </div>
</div>
@endsection
