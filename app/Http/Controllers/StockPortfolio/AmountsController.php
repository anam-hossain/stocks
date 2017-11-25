<?php

namespace App\Http\Controllers\StockPortfolio;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AmountsController extends Controller
{
    /**
     * GET /stocks-portfolio/amounts/edit
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('stock-portfolio.amounts.edit');
    }

    /**
     * PUT /stocks-portfolio/amounts
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {   
        $amount = session('amount', 0);

        if ($request->option == 'add') {
            session(['amount' => $amount + $request->amount]);
            return redirect()->to('/');
        }

        if ($amount < $request->amount) {
            session(['amount' => 0]);
            return redirect()->to('/');
        }

        session(['amount' => $amount - $request->amount]);

        return redirect()->to('/');
    }
}
