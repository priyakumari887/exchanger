<?php

namespace App\Http\Controllers\ExchangeRate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExchangeRateRequest;
use App\Models\ExchangeRate;

/**
 * ExchangeRateController to handle request related to exchange rates.
 *
 * @since 1.0.0
 * @version 1.0.0
 * @author Priya Kumari <kumaripriya887@gmail.com>
 */

class ExchangeRateController extends Controller
{

    /**
     * Instance of ExchangeRate model class.
     *
     * @var offer
     */
    protected $exchangeRate;

    // -------------------------------------------------------------------------

    /**
     * Constructor
     *
     * @param ExchangeRate $exchangeRate
     */
    public function __construct(ExchangeRate $exchangeRate) 
    {
      
        $this->exchangeRate = $exchangeRate;
    }

    //------------------------------------------------------------------------

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    //-------------------------------------------------------------------------

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    //-------------------------------------------------------------------------

    /**
     * Store a newly created rate details in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExchangeRateRequest $request)
    {
        $data = $request->all();

        $this->exchangeRate->base = $data['base'];
        $this->exchangeRate->date = $data['date'];
        $this->exchangeRate->inr  = $data['inr'];
        $this->exchangeRate->eur  = $data['eur'];

        $this->exchangeRate->save();

        return response()->json(['data' => $this->exchangeRate,
                                'message' => 'Rates added successfully',
                                'status' => 200],200);
    }

    //-------------------------------------------------------------------------

    /**
     * Display the specified rate details.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $rateData = $this->exchangeRate->where('id',$id)->first();

        return response()->json(['data' => $rateData,
                                'message' => 'Success',
                                'status' => 200],200);
    }

    //-------------------------------------------------------------------------

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    //-------------------------------------------------------------------------

    /**
     * Update the rate details in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ExchangeRateRequest $request, $id)
    {
        $rate = $this->exchangeRate->findOrFail($id);
        $data = $request->all();

        $rate->base = $data['base'];
        $rate->date = $data['date'];
        $rate->inr  = $data['inr'];
        $rate->eur  = $data['eur'];

        $rate->save();

        return response()->json(['message' => 'Rates updated successfully',
                                'status' => 200],200);

    }

    //-------------------------------------------------------------------------

    /**
     * Remove the rate from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteRate = $this->exchangeRate->where('id',$id)->delete();
        if ($deleteRate) 
        {
            return response()->json(['message' => 'Rate deleted successfully',
                                'status' => 200],200);
        }
        else
        {
             return response()->json(['message' => 'Something went wrong. Please try again',
                                'status' => 400],400);
        }

    }

    //-------------------------------------------------------------------------

    /**
     * Refresh the latest rates and insert the latest exchange rates into the database.
     *
     * @var 
     */

    public function refreshExchangeRate() 
    {
       $data = getForeignExchangeRate();
       
       $this->exchangeRate->base = $data->base;
       $this->exchangeRate->date = $data->date;
       $this->exchangeRate->inr  = $data->rates->INR ?? 0;
       $this->exchangeRate->eur  = $data->rates->EUR ?? 0;

       $this->exchangeRate->save();

       return response()->json(['data' => $this->exchangeRate,
                                'message' => 'Success',
                                'status' => 200],200);

    }

    //------------------------------------------------------------------------

    /**
     * get all the rates from Wdatabase.
     *
     * @var 
     */

    public function getAllRates() 
    {
        $resData = [];
        $rates = $this->exchangeRate->orderBy('date','DESC')->get();

        foreach ($rates as $key => $rate) 
        {
           $currency = [
                'INR'=> $rate->inr,
                'EUR' => $rate->eur
           ];

           $resData[] =[
                'date' => $rate->date,
                'last_updated_at' => date($rate->updated_at),
                'currency_rate' => $currency,
           ]; 
        }

        return response()->json(['data' => $resData,
                                'message' => 'Success',
                                'status' => 200],200);

    }

}
