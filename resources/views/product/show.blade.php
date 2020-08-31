<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="{{asset('css/app.css')}}"/>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-6">
                @if(count($product->images)===0)
                    
                <img class="img-fluid" style="height: 150px"  src="https://vanhoadoanhnghiepvn.vn/wp-content/uploads/2020/08/112815953-stock-vector-no-image-available-icon-flat-vector.jpg" alt="">
                
                @else
                
                @foreach ($product->images as $item)
                
                <img class="img-fluid" src="{{asset('storage/'.$item->image_url)}}" alt=""> 
                @endforeach
                
                @endif
            </div>

            <div class="col-6">
                <div class="row">
                    <h3>{{$product->name}}</h3>
                </div>
                <div class="row">
                   Description: {{$product->description}}
                </div>
                <div class="row">
                   is on Auction: {{$product->is_bidding}}
                </div>
                <div class="row">
                   @if ($product->status === 1)
                       
                   @endif 
                </div>
            </div>

        </div>
    </div>
</body>
</html>