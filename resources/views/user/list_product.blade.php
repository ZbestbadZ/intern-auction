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
                            <img class="img-fluid" style="height: 150px"  src="https://vanhoadoanhnghiepvn.vn/wp-content/uploads/2020/08/112815953-stock-vector-no-image-available-icon-flat-vector.jpg" alt=""><br>
                        </a>
                        @else
                        <a href="products/{{$p->id}}">
                            <img class="img-fluid" src="{{asset('storage/'. $p->images['0']->image_url)}}" alt=""> <br>
                        </a>
                        @endif
                       
                        <a href="products/{{$p->id}}">
                            {{$p->name}}
                        </a>
                        <p class="number">Giá gốc sản phẩm: {{$p->start_price}}</p>
                        <p class="number">Bước giá: {{$p->minimum_bid}}</p> 
                    </div>
                @endforeach
            </div>
            <div class="row"><div>{{ $warning['warning'] ?? '' }}</div></div>
            </div>
        </div>
    </div>
</div>
@endsection
