@extends('app')

@section('title', 'Update amounts')

@section('content')
    <div clas="row">
    	<div class="col-sm-8 well">
    		<h2>Add/Remove amounts</h2>
    		<h3>Current balance: ${{ session('amount') }}</h3>
    		<br>
		    <form method="POST" action="/stocks-portfolio/amounts">
		    	{{ csrf_field() }}
		    	{{ method_field('PUT') }}
			  	<div class="form-group">
			    	<label for="amount">Cash amount</label>
			    	<input type="number" name="amount" class="form-control" required placeholder="$">
			  	</div>
			  	<div class="radio">
				  	<label>
				    	<input type="radio" name="option" value="add" checked>
				    	Add amount
				  	</label>
				</div>
				<div class="radio">
				  	<label>
				    	<input type="radio" name="option" value="remove">
				    	Remove amount
				  	</label>
				</div>
				<br>
			  	<button type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
	</div>
@endsection