@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @foreach($products as $p)   
                    <div class="col-3 text-center">
                        @if(count($p->images)===0)
                        <a href="products/{{$p->id}}">
                            <img class="img-fluid" style="height: 150px"  src="https://vanhoadoanhnghiepvn.vn/wp-content/uploads/2020/08/112815953-stock-vector-no-image-available-icon-flat-vector.jpg" alt="">
                        </a>
                        @else
                        
                        <a href="products/{{$p->id}}">
                            <img class="img-fluid" src="{{'storage/'. $p->images['0']->image_url}}" alt=""> 
                        </a>
                        @endif
                        <a href="products/{{$p->id}}">
                            {{$p->name}}
                        </a>
                        <p class="number">Giá cao nhất hiện tại: {{$p->start_price}}</p>
                        <p class="number">Bước giá: {{$p->minimum_bid}}</p>
                        <p class="number">Hạn chót ra giá: {{}}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
