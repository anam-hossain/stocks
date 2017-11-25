<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StockPortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! session()->exists('username')) {
            return redirect()->to('/users/create');
        }

        $stocks = session('stocks', []);

        return view('stock-portfolio.index', compact('stocks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $totalAmount = $request->price * $request->quantity;
        $currentBalance = session('amount');

        if ($request->filled('buy')) {
            if ($totalAmount > $currentBalance) {
                return redirect()->to('/')->withError('Sorry! You do not have sufficient balance');
            }

            add_stock($request->ticket, $request->price, $request->quantity);

            session(['amount' => $currentBalance - $totalAmount]);

            return redirect()->to('/')->withSuccess("Stocks added successfully");
        }


        if (! isset(session('stocks')[$request->ticket])) {
            return redirect()->to('/')->withError('Sorry! You do not have stock to sale');
        }

        $stocks = session('stocks')[$request->ticket];

        if ($stocks['quantity'] < $request->quantity) {
            return redirect()->to('/')->withError('Sorry! You do not have enough stock to sale');
        }

        sell_stock($request->ticket, $request->price, $request->quantity);

        return redirect()->to('/')->withSuccess("Stocks sold successfully");            
    }
}
