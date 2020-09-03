<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuctionUpdateRequest;
use App\Models\Auction;
use Carbon\Carbon;
use Exception;

class AuctionController extends Controller
{
    protected $auctionModel;

    public function __construct(Auction $model)
    {
        $this->auctionModel = $model;
    }

    public function update(AuctionUpdateRequest $request)
    {
        try {
            $model = $this->auctionModel->find($request->id);

            $data = $request->only('end_date', );

            if ($data['end_date'] !== $model->end_date) {
                $data['start_date'] = Carbon::now();
            }

            $mode = $request['mode'];

            switch ($mode) {
                case 'restart':{
                        $product = $model->product;
                        $product->update(['is_bidding'=>'1']);
                        
                        break;
                    }
                case 'update':{
                        
                    }
                case 'start':{
                        $product = $model->product;
                        $product->update(['is_bidding'=>'1']);
                    }
            }

            $model->update($data);
            return redirect()->back()->withInput();
            dd($request['restart']);

        } catch (Exception $e) {
            $mess = $e->getMessage();
            return redirect()->route('products.index')->withErrors($mess)->withInput();
        }
    }
}
