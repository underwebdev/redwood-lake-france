@extends('app')

@section('content')

@include('layout.nav-plain')
<br>

<div class="grid-container">
<div class="grid-x grid-padding-x align-center-middle"> 
    <div class="cell small-12 medium-8 large-6">
        <div class="center-border">
            <div class="center-border-header text-center">
                <img src="/img/logo/RedwoodLogo.png" width="200px">   
            </div>
            <div class="center-border-content">
            	<h1 class="text-center">Customer Login</h1>
			    @if ($errors->any())
                    <div class="callout alert text-center">
                        @foreach ($errors->all() as $error)
                            <p><strong>{{ $error }}</strong></p>
                        @endforeach
                    </div>
                @endif
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
                        <button class="button success expanded">Login</button>
                        <a href="/forgot-password" class="button expanded alert hollow">Forgot Password</a>
                    </div>
                </form>
		  		
            </div>  
  	   </div>
    </div><!-- End of cell-->
</div><!--end of grid-x -->
</div><!--End of grid container-->
@endsection