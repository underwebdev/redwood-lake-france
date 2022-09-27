@extends('app')

@section('url') {{ $page->url }} @endsection
@section('metadescription') {{ $page->metadescription }} @endsection
@section('title') {{ $page->metatitle }} @endsection

@section('content')

<div class="hero content {{ $page->css }}">
	@include('layout.nav')
<div class="grid-container full">
	<div class="grid-x grid-padding-x">
		<div class="cell small-12 text-center">
			<h1>{{ $page->heading }}</h1>
		</div><!-- End of cell-->
	</div><!--end of grid-x -->
</div><!--End of grid container-->
@include('layout.hero-wave')
</div>

<div class="section-one">
<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="cell small-12">
			<p>Welcome to our website. If you continue to browse and use this website you are agreeing to comply with and be bound by the following terms and conditions of use, which together with our privacy policy govern Redwood Lake relationship with you in relation to this website.<br>
			<br>
			The term “Redwood Lake” or “us” or “we” refers to the owner of the website. The term “you” refers to the user or viewer of our website.<br>
			<br>
			The use of this website is subject to the following terms of use:<br>
			<br>
			– The content of the pages of this website is for your general information and use only. It is subject to change without notice.<br>
			<br>
			– Neither we nor any third parties provide any warranty or guarantee as to the accuracy, timeliness, performance, completeness or suitability of the information and materials found or offered on this website for any particular purpose. You acknowledge that such information and materials may contain inaccuracies or errors and we expressly exclude liability for any such inaccuracies or errors to the fullest extent permitted by law.<br>
			<br>
			– Your use of any information or materials on this website is entirely at your own risk, for which we shall not be liable. It shall be your own responsibility to ensure that any products, services or information available through this website meet your specific requirements.<br>
			– This website contains material which is owned by or licensed to us. This material includes, but is not limited to, the design, layout, look, appearance and graphics. Reproduction is prohibited other than in accordance with the copyright notice, which forms part of these terms and conditions.<br>
			<br>
			– All trademarks reproduced in this website, which are not the property of, or licensed to the operator, are acknowledged on the website.<br>
			<br>
			– Unauthorised use of this website may give to a claim for damages and/or be a criminal offence.<br>
			<br>
			– From time to time this website may also include links to other websites. These links are provided for your convenience to provide further information. They do not signify that we endorse the website(s). We have no responsibility for the content of the linked website(s).<br>
			<br>
			– You may not create a link to this website from another website or document without Redwood Lake‘s prior written consent.<br>
			<br>
			– Your use of this website and any dispute arising out of such use of the website is subject to the laws of England and Wales.
			</p>
		        
		</div><!-- End of cell-->  
	</div><!--end of grid-x -->
</div><!--End of grid container-->
</div>
@endsection