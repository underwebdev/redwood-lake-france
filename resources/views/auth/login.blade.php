@extends('app')

@section('content')

<div class="grid-container">
<div class="grid-x grid-padding-x align-center-middle"> 
    <div class="cell small-12 medium-8">
        <div class="center-border">
            <div class="center-border-header text-center">
                <img src="/" width="200px">
            </div>
            <div class="center-border-content">
            	<h1 class="text-center">Customer Login</h1>
            	@if(count($errors) > 0)
			    <div class="cell small-12">
			        <div class="callout alert">
			            <ul>
			                @foreach ($errors->all() as $error)
			                    <li>{{ $error }}</li>
			                @endforeach
			            </ul>
			        </div>
			    </div>
			    @endif
			    @include('layout.alerts')
                <p><span class="error">If you have not yet created an account you will need to create one to manage your booking by clicking <a href="">here</a></span></p>
                <form method="POST" action="/login">
                @csrf
                    <label for="email">Email</label>
                    <input type="text" name="email">
                    <label for="password">Password</label>
                    <input type="password" name="password">
                    
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <div class="button-group">
                        <button class="button success expanded radius">Login</button>
                        <a href="/forgot-password" class="button expanded hollow radius">Forgot Password</a>
                        <a href="/create-account" class="button expanded hollow radius">Create Account</a>
                    </div>
                </form>
		  		
            </div>  
  	   </div>
    </div><!-- End of cell-->
</div><!--end of grid-x -->
</div><!--End of grid container-->
@endsection