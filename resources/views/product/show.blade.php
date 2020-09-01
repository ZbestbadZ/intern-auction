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
                <div class="">
                    <h3>{{$product->name}}</h3>
                </div>
                <div class="">
                   Description: {{$product->description}}
                </div>
                <div class="">
                   is on Auction: {{$product->is_bidding?'Public':'Non Public'}}
                </div>
                <div class="">
                   @if ($product->is_bidding && $product->auction)
                        <form method="POST" action="/auctions/{{$product->auction->id}}" >
                            @csrf
                            @method('PATCH')
                        <label for="start_date">Start time:</label>
                        <input type="datetime-local" name="start_date" id="start_date" value="{{$formatedStartDate.'T'.$formatedStartTime}}"><br>
                        <label for="end_date">End time:</label>
                        <input type="datetime-local" name="end_date" id="end_date" value="{{$formatedEndDate.'T'.$formatedEndTime}}"><br>
                        <button class="btn btn-primary" href="" >Edit</button>
                        </form>
                   @endif 
                </div>
                
            </div>

        </div>
    </div>
</body>
</html>