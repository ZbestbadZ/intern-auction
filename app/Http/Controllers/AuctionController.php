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

    public function update(AuctionUpdateRequest $request,$id)
    {
        try {
            $model = $this->auctionModel->find($id);
            $product = $model->product;
            $data = $request->only(['end_date', ]);
            $mode = $request->only(['mode',]);

            if ($data['end_date'] !== $model->end_date) {
                $data['start_date'] = Carbon::now();
            }
            
            switch ($mode) {
                case 'restart':{
                       
                        $product->update(['is_bidding'=>'1']);
                        
                        break;
                    }
                case 'update':{
                        
                    }
                case 'start':{
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
