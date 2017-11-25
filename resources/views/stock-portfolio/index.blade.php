@extends('app')

@section('title', 'Sign up')

@section('content')
    <div clas="row">
    	<div class="col-sm-12">
    		<h2>Stock portfolio</h2>
    		<p><a href="/stocks-portfolio/amounts/edit">Add/Remove cash amount</a></p>
		</div>

		<div class="col-sm-8 well">
			<buy-sell-stock token="{{ csrf_token() }}"></buy-sell-stock>
		</div>

		<div class="col-sm-12">
			<h4>Stocks:</h4>
			<table class="table table-striped">
				<tr>
					<th>Stock</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>Net assets</th>
				</tr>

				@foreach(session('stocks') as $ticket => $stock)
					<tr>
						<td>{{ $ticket }}</td>
						<td>{{ $stock['price'] }}</td>
						<td>{{ $stock['quantity'] }}</td>
						<td>{{ $stock['price'] * $stock['quantity'] }}</td>
					</tr>
				@endforeach
			</table>
		</div>
	</div>
@endsection