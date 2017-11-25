<?php

function add_stock($name, $price, $quantity)
{
    $stocks = session('stocks', []);

    if (isset($stocks[$name])) {
        return update_stock($stocks, $name, $price, $quantity);
    }

    return new_stock($stocks, $name, $price, $quantity);
}

function sell_stock($name, $price, $quantity)
{
    $stocks = session('stocks', []);

    if (! isset($stocks[$name])) return;

    $stock = $stocks[$name];

    $stock['quantity'] = $stock['quantity'] - $quantity;
    $stock['price'] = $price;

    $currentAmount = session('amount');

    session(['amount' => $currentAmount + ($price * $quantity)]);
   
    $stocks[$name] = $stock;

    session(['stocks' => $stocks]);

    return session('stocks');
}

function new_stock($stocks, $name, $price, $quantity)
{
    $stocks[$name] = [
        'price' => $price,
        'quantity' => $quantity
    ];

    session(['stocks' => $stocks]);

    return session('stocks');
}

function update_stock($stocks, $name, $price, $quantity)
{
    $stock = $stocks[$name];

    $stock['price'] = $price;
    $stock['quantity'] += $quantity;

    $stocks[$name] = $stock;

    session(['stocks' => $stocks]);
    
    return session('stocks');
}

function total_stocks()
{
    $stocks = session('stocks');

    $count = 0;

    foreach ($stocks as $stock) {
        $count += $stock['quantity'];
    }

    return $count;
}

function total_asset_value()
{
    $stocks = session('stocks', []);

    $amount = 0;

    foreach ($stocks as $stock) {
        $amount += $stock['price'] * $stock['quantity'];
    }

    return $amount;
}
