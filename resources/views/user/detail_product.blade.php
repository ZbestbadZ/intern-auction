@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3">
                @if (count($product->images) === 0)

                    <img class="img-fluid" style="height: 150px"
                        src="https://vanhoadoanhnghiepvn.vn/wp-content/uploads/2020/08/112815953-stock-vector-no-image-available-icon-flat-vector.jpg"
                        alt="">

                @else

                    @foreach ($product->images as $item)

                        <img class="img-fluid" src="{{ asset('storage/' . $item->image_url) }}" alt="">
                    @endforeach

                @endif
            </div>

            <div class="col-3">
                <div class="row">
                    <h3>{{ $product->name }}</h3>
                </div>
                <div class="row">
                    <p class="number">Description: {{ $product->description }}</p>
                </div>
                <div class="row">
                    <p class="number">is on Auction: {{ $product->is_bidding }}</p>
                </div>
                <div class="row">
                    <p class="number">Giá gốc: {{ $product->start_price }}</p>
                </div>
                <div class="row">
                    <p class="number">Status: {{ $product->status }}</p>
                </div>
                <div class="row">
                    <p class="number">Bước giá: {{ $product->minimum_bid }}</p>
                </div>
            </div>
            <div class="col-3">
                <div class="row">
                    <p class="number">Giá cao nhất hiện tại:
                        {{ $auctionDetail->bid_price ?? $product->start_price }}</p>
                </div>
                <div class="row">
                    <p class="number">Thời gian đấu giá: {{ $auctionDetail->bid_time ?? 'Chua co nguoi dau gia' }}
                    </p>
                </div>
                <div class="row">
                    <p class="number">Ngày mở đấu giá: {{ $auction->start_date }}</p>
                </div>
                <div class="row">
                    <p class="number">Hạn chót ra giá: {{ $auction->end_date }}</p>
                </div>

                <div class="row">

                    @if ($product->is_bidding == 1)
                        <form method="post" enctype="multipart/form-data" action="{{ $product->id }}">
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
                <div class="row">
                    @if ($errors->any())
                        <div class="alert alert-danger text-center">{{ $errors->first() }}</div>
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection