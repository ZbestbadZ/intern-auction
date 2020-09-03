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
                   @if (!$isBidding)
                        <form method="POST" action="/auctions/{{$product->auction->id}}" >
                            @csrf
                            @method('PATCH')
                        <div>Start time:</div>

                        <div>{{$formatedStartDate.' '.$formatedStartTime}}</div><br>
                        
                        @if ($status)
                        <label for="end_date">End time:</label>
                        <input type="datetime-local" name="end_date" id="end_date" value="{{$formatedEndDate.'T'.$formatedEndTime}}"><br>
                        
                        <button name="mode" value="restart" type="submit" class="btn btn-primary">Restart Auction</button>
                        @elseif ($hasBidder)
                        <label for="end_date">End time:</label>
                        <input type="datetime-local" name="end_date" id="end_date" value="{{$formatedEndDate.'T'.$formatedEndTime}}"><br>
                        
                        <button name="mode" value="update" type="submit" class="btn btn-primary"  >Update Close Date</button>
                        @else
                        <label for="end_date">End time:</label>
                        <input type="datetime-local" name="end_date" id="end_date" value="{{$formatedEndDate.'T'.$formatedEndTime}}"><br>
                        
                        <button name="mode" value="start" type="submit" class="btn btn-primary"  >Start Auction</button>
                        @endif 
                        
                        </form>
                   @endif 
                </div>
                
            </div>

        </div>
    </div>
</body>
</html>