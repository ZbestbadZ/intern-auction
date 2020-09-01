<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuctionUpdateRequest;
use Illuminate\Http\Request;
use App\Models\Auction;
use Exception;

class AuctionController extends Controller
{
    protected $auctionModel;

    public function __construct(Auction $model)
    {
        $this->auctionModel = $model;
    }

    public function update(AuctionUpdateRequest $request) {
        try{
            $data = $request->only('start_date','end_date');
        
            $model = $this->auctionModel->find($request->id);
            $model->update($data);
            return  redirect()->back()->withInput();
        } catch(Exception $e) {
            $mess = $e->getMessage() ;
            return redirect()->route('products.index')->withErrors($mess)->withInput();
        }
    }
}
