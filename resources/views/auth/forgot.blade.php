@extends('app')

@section('content')

<div class="grid-container">
<div class="grid-x grid-padding-x align-center-middle"> 
    <div class="cell small-12 medium-8">
        <div class="center-border">
            <div class="center-border-header text-center">
                <img src="" width="200px">
            </div>
            <div class="center-border-content">
                <h1 class="text-center">Password Reset</h1>
                @include('layout.alerts')
                <form method="post" action="/forgot-password" class="" accept-charset="UTF-8" enctype="multipart/form-data">
                @csrf
                <label for="">Customer No
                    @error('memberNo')<span class="error">{{ $message }}</span>@enderror 
                </label>
                <input type="text" placeholder="" name="memberNo" class="report-input">

                <label for="">Email
                    @error('email')<span class="error">{{ $message }}</span>@enderror 
                </label>
                <input type="text" placeholder="" name="email" class="report-input">
                <button class="button expanded success radius">Request New Password</button>
                
                </form>
                
            </div>  
       </div>
    </div><!-- End of cell-->
</div><!--end of grid-x -->
</div><!--End of grid container-->
@endsection