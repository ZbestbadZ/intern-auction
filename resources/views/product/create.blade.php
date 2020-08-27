<!DOCTYPE html>
<html>

<head>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class=" col-5">
            <form method="POST" enctype="multipart/form-data" action="/product">
                <div class="form-group">
                    @csrf
                <label for="name">Name: </label>
                <input class="form-control" type="text" name="name" id="name" value="">
                @error('name')
                              
                   <strong>{{ $message }}</strong>
                                
                @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description: </label>
                    <input class="form-control" type="text" name="description" id="description" value="">
                @error('description')
                              
                   <strong>{{ $message }}</strong>
                                
                @enderror
                </div>

                <div class="form-group">
                    <label for="startprice">Start price: </label>
                    <input class="form-control" type="text" name="startprice" id="startprice" value="0">
                @error('startprice')
                              
                   <strong>{{ $message }}</strong>
                                
                @enderror
                </div>

                <div class="form-group">
                    <label for="minimumbid">Minimum Bid: </label>
                    <input class="form-control" type="text" name="minimumbid" id="minimumbid" value="0">
                @error('minimumbid')
                              
                   <strong>{{ $message }}</strong>
                                
                @enderror
                </div>
                
                <div class="form-group">
                    <label for="ispublic">On auction: </label>
                    <input type="checkbox"  name="ispublic" id="ispublic" >    
                </div>
                <div class="form-group">
                    <input type="file" class="form-control-file" id="image" name="image">
                    @error('image')                       
                   <strong>{{ $message }}</strong>         
                    @enderror
                </div>
                <button class="btn btn-primary" type="submit" name="create" >Create</button>
            </form>
            </div>
        </div>
    </div>
</body>

</html>
