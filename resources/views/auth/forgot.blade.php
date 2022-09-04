@extends('app')

@section('content')

@include('layout.nav-plain')
<br>

<div class="grid-container">
<div class="grid-x grid-padding-x align-center-middle"> 
    <div class="cell small-12 medium-8 large-6">
        <div class="center-border">
            <div class="center-border-header text-center">
        
            </div>
            <div class="center-border-content">
                <h1 class="text-center">Password Reset</h1>
                @include('layout.alerts')
                <form method="post" action="/forgot-password" class="" accept-charset="UTF-8" enctype="multipart/form-data">
                @csrf
                <label for="">Email
                    @error('email')<span class="error">{{ $message }}</span>@enderror 
                </label>
                <input type="text" placeholder="" name="email" class="report-input">

                <div class="button-group">
                    <button class="button expanded success radius">Request New Password</button>
                    <a href="/login" class="button expanded success hollow">Back To Login</a>
                </div>
                
                </form>
                
            </div>  
       </div>
    </div><!-- End of cell-->
</div><!--end of grid-x -->
</div><!--End of grid container-->
@endsection