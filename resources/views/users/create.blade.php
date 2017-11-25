@extends('app')

@section('title', 'Sign up')

@section('content')
    <div clas="row">
    	<div class="col-sm-8 well">
    		<h2>Sign up for managing stock portfolio</h2>
		    <form method="POST" action="/users">
		    	{{ csrf_field() }}
			  	<div class="form-group">
			    	<label for="username">Username</label>
			    	<input type="username" name="username" class="form-control" placeholder="Username" required>
			  	</div>
			  	<div class="form-group">
			    	<label for="amount">Enter an amount to start trading</label>
			    	<input type="number" name="amount" class="form-control" placeholder="2000" required>
			  	</div>
			  	<button type="submit" class="btn btn-default">Submit</button>
			</form>
		</div>
	</div>
@endsection