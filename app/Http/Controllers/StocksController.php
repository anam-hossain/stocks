<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StocksController extends Controller
{  
    /**
     * GET /stocks/lookup
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \GuzzleHttp\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function lookup(Request $request, Client $client)
    {
        $ticket = strtoupper($request->ticket);

        try {
            $response = $client->request(
                'GET',
                "https://www.quandl.com/api/v3/datasets/WIKI/{$ticket}/data.json?limit=1&api_key=9upPxb2sVvQyuz6hJeeM"
            );

            $data = json_decode($response->getBody());
            $data = $data->dataset_data;

            $price = $data->data[0][array_search('Close', $data->column_names)];
            $volume = $data->data[0][array_search('Volume', $data->column_names)];

            return response()->json([
                'ticket' => $ticket,
                'price' => $price,
                'volume' => $volume
            ]);

        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_NOT_FOUND);
        }
    }
}
