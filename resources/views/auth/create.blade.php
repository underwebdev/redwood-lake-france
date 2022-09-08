@extends('app')

@section('content')

@include('layout.nav-plain')
<br>

<div class="grid-container">
<div class="grid-x grid-padding-x"> 
    <div class="cell small-12 medium-8 large-6 medium-offset-2 large-offset-3">
        <div class="center-border">
            <div class="center-border-header text-center">
                <img src="/img/logo/RedwoodLogo.png" width="200px">   
            </div>
            <div class="center-border-content">
                <h1 class="text-center">Register Account</h1>
            	@include('layout.alerts')
            	<form method="post" action="/create-account" accept-charset="UTF-8" enctype="multipart/form-data" >
            	@csrf
                <label for="">Booking Ref or Customer No @error('ref')<span class="error">{{ $message }}</span> @enderror</label>
                <input type="text" name="ref" value="{{ old('ref') }}">
                <label for="">First Name @error('firstName')<span class="error">{{ $message }} </span>@enderror</label>
                <input type="text" name="firstName" value="{{ old('firstName') }}">
                <label for="">Last Name @error('lastName')<span class="error">{{ $message }} </span>@enderror</label>
                <input type="text" name="lastName" value="{{ old('lastName') }}">

                <div class="grid-x grid-padding-x">
                    <div class="cell small-12">
                        <label for="">DOB 
                            @error('dd')<span class="error">Day field is required</span>@enderror 
                            @error('mm')<span class="error">Month field is required</span>@enderror 
                            @error('yy')<span class="error">Year field is required</span>@enderror
                        </label>      
                    </div><!-- End of cell-->
                    <div class="cell small-4">
                        <select id="" name="dd">
                            <option>DD</option>
                            <option value="01">01 </option>
                            <option value="02">02 </option> 
                            <option value="03">03</option> 
                            <option value="04">04 </option> 
                            <option value="05">05 </option> 
                            <option value="06">06 </option> 
                            <option value="07">07 </option> 
                            <option value="08">08 </option> 
                            <option value="09">09 </option> 
                            <option value="10">10 </option> 
                            <option value="11">11 </option> 
                            <option value="12">12 </option> 
                            <option value="13">13 </option> 
                            <option value="14">14 </option> 
                            <option value="15">15 </option>
                            <option value="16">16 </option>
                            <option value="17">17 </option> 
                            <option value="18">18 </option> 
                            <option value="19">19 </option> 
                            <option value="19">19 </option> 
                            <option value="20">20 </option> 
                            <option value="21">21 </option> 
                            <option value="22">22 </option> 
                            <option value="23">23 </option> 
                            <option value="24">24 </option> 
                            <option value="25">25 </option> 
                            <option value="26">26 </option> 
                            <option value="27">27 </option> 
                            <option value="28">28 </option> 
                            <option value="29">29 </option>
                            <option value="30">30 </option>  
                            <option value="31">31 </option>  
                        </select>
                          
                    </div><!-- End of cell-->
                    <div class="cell small-4">
                        <select id="" name="mm">
                            <option>MM</option>
                            <option value="01">Jan</option>
                            <option value="02">Feb</option> 
                            <option value="03">Mar</option> 
                            <option value="04">Apr</option>  
                            <option value="05">May</option>  
                            <option value="06">Jun</option>  
                            <option value="07">Jul</option>
                            <option value="08">Aug</option>  
                            <option value="09">Sep</option>  
                            <option value="10">Oct</option>  
                            <option value="11">Nov</option>  
                            <option value="12">Dec</option> 
                        </select>
                          
                    </div><!-- End of cell-->
                    <div class="cell small-4">
                        <select id="" name="yy">
                            <option>YYYY</option>
                            @foreach($years as $year)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>
                          
                    </div><!-- End of cell-->
                </div><!--end of grid-x -->
         
                <label for="">Email @error('email')<span class="error">{{ $message }} </span>@enderror</label>
                <input type="text" name="email" value="{{ old('email') }}">
                <label for="">Password @error('password')<span class="error">{{ $message }} </span>@enderror</label>
                <input type="password" name="password" class="report-input">
                <label for="">Confirm Password</label>
                <input type="password" name="password_confirmation" class="report-input">
                <div class="grid-x">
                    <div class="cell small-2 medium-1">
                        <input type="checkbox" name="consent">      
                    </div><!-- End of cell-->
                    <div class="cell small-10 medium-11">
                        <p><small>@error('consent')<span class="error">{{ $message }} </span>@enderror I consent to the Redwood Lake storing my information for the purpose of my booking. </small></p>  
                    </div><!-- End of cell-->
                </div><!--end of grid-x -->   

                <p>I would like to hear about latest offers and discounted bookings for Redwood Lake.</p>
                <label for=""></label>
                <select id="" name="">
                    <option value="">Please select</option>
                    <option value="1">Notify Me</option>
                    <option value="2">I am not interested</option> 
                </select>

                <div class="button-group">
                    <button class="button expanded success">Create Account</button>
                    <a href="/login" class="button expanded success hollow">Back To Login</a>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
</div><!--End of grid container-->
@endsection