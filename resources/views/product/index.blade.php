<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="{{asset('css/app.css')}}"/>
</head>

<body>
    
    <div class="container">
        
        <div class="justify-content-center">
                

                
                <div class="">
                    <a href="/products/create">Add a new product</a>
                </div>
               
                
                @foreach ($products as $item)
               <div class="row">
                    
                <div class="col-3 text-center">
                    @if(count($item->images)===0)
                    <a href="products/{{$item->id}}">
                        <img class="img-fluid" style="height: 150px"  src="{{URL::asset('/img/defaultProductImage.jpg')}}" alt="">
                    </a>
                    @else
                    
                    <a href="products/{{$item->id}}">
                        <img class="img-fluid" src="{{'storage/'. $item->images['0']->image_url}}" alt=""> 
                    </a>
                    @endif
                    
                    </div>
                    <div class="col-5 ">
                        <form method="GET" action="{{url("/products/{$item->id}/edit")}}">
                            <button type="submit" >Edit</button>
                        </form>
                        <form method="POST" action="{{url("/products/{$item->id}")}}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" >Deletee</button>
                        </form>
                </div>
                </div>
                
                
                @endforeach
                
            
        </div>
        <div class=" row justify-center">{{ $products->links() }}</div>
        <div class="row" style="t">
            @if ($errors->any())
                <div class="alert alert-danger text-center">{{ $errors->first() }}</div>
            @endif
        </div>
    </div>
   
</body>

</html>
