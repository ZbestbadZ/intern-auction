<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="{{asset('css/app.css')}}"/>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-3">
                @if(count($product->images)===0)
                    
                <img class="img-fluid" style="height: 150px"  src="https://vanhoadoanhnghiepvn.vn/wp-content/uploads/2020/08/112815953-stock-vector-no-image-available-icon-flat-vector.jpg" alt="">
                
                @else
                
                @foreach ($product->images as $item)
                
                <img class="img-fluid" src="{{asset('storage/'.$item->image_url)}}" alt=""> 
                @endforeach
                
                @endif
            </div>

            <div class="col-3">
                <div class="row">
                    <h3>{{$product->name}}</h3>
                </div>
                <div class="row">
                   Description: {{$product->description}}
                </div>
                <div class="row">
                   is on Auction: {{$product->is_bidding}}
                </div>
                
            </div>
            <div class="col-3">
                <div class="row">
                    <p class="number">Giá gốc: {{$product->start_price}}</p>
                </div>
                <div class="row">
                    <p class="number">Giá cao nhất hiện tại: {{$product->start_price}}</p>
                </div>
                <div class="row">
                    <p class="number">Bước giá: {{$product->minimum_bid}}</p>
                </div>
                <div class="row">
                    <p class="number">Ngày mở đấu giá: {{$product->start_date}}</p>
                </div>
                <div class="row">
                    <p class="number">Hạn chót ra giá: {{$product->end_date}}</p>
                </div>
                <div class="row">
                    @if ($product->is_bidding === 1)
                    <form method="post" enctype="multipart/form-data" action="{{$product->id}}">
                        @csrf
                        @method('PATCH')
                        <input type="text" name="bid_price" placeholder="Nhập giá"><br><br>
                        @error('bid_price')
                                      
                           <strong>{{ $message }}</strong>
                                        
                        @enderror
                        <button class="btn btn-primary" type="submit">Đấu giá sản phẩm</button>
                    </form>
                    @endif 
                </div>
            </div>

        </div>
    </div>
</body>
</html>