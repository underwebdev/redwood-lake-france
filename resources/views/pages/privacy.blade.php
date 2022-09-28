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
			<p>This privacy policy sets out how Redwood Lake uses and protects any information that you give Redwood Lake when you use this website.<br>
				<br>
			Redwood Lake is committed to ensuring that your privacy is protected. Should I ask you to provide certain information by which you can be identified when using this website, then you can be assured that it will only be used in accordance with this privacy statement.<br>
<br>
			Redwood Lake may change this policy from time to time by updating this page. You should check this page from time to time to ensure that you are happy with any changes. This policy is effective from 26th May 2018.<br>
<br>		 
			<strong>What I collect</strong><br>
			I may collect the following information:<br>
			name and contact information including email address<br>
			demographic information such as postcode, preferences and interests<br>
			other information relevant to customer surveys and/or offers<br>
			What I do with the information I gather<br>
			I require this information to understand your needs and provide you with a better service, and in particular for the following reasons:<br>
<br>
			<strong>Internal record keeping.</strong><br>
			I may use the information to improve our products and services.
			I may periodically send promotional emailsabout new products, special offers or other information which I think you may find interesting using the email address which you have provided.
			From time to time, I may also use your information to contact you for market research purposes. I may contact you by email, phone, fax or mail. I may use the information to customise the website according to your interests.<br>
			 <br>
			<strong>Security</strong><br>
			I are committed to ensuring that your information is secure. In order to prevent unauthorised access or disclosure, I have put in place suitable physical, electronic and managerial procedures to safeguard and secure the information I collect online.<br>
<br>
			<strong>How I use cookies</strong><br>
			A cookie is a small file which asks permission to be placed on your computer’s hard drive. Once you agree, the file is added and the cookie helps analyse web traffic or lets you know when you visit a particular site. Cookies allow web applications to respond to you as an individual. The web application can tailor its operations to your needs, likes and dislikes by gathering and remembering information about your preferences.<br>
<br>
			I use traffic log cookies to identify which pages are being used. This helps us analyse data about web page traffic and improve our website in order to tailor it to customer needs. I only use this information for statistical analysis purposes and then the data is removed from the system.
			Overall, cookies help us provide you with a better website, by enabling us to monitor which pages you find useful and which you do not. A cookie in no way gives us access to your computer or any information about you, other than the data you choose to share with us.<br>
<br>
			You can choose to accept or decline cookies. Most web browsers automatically accept cookies, but you can usually modify your browser setting to decline cookies if you prefer. This may prevent you from taking full advantage of the website.<br>
<br>
			<strong>Links to other websites</strong><br>
			Our website may contain links to other websites of interest. However, once you have used these links to leave our site, you should note that I do not have any control over that other website. Therefore, I cannot be responsible for the protection and privacy of any information which you provide whilst visiting such sites and such sites are not governed by this privacy statement. You should exercise caution and look at the privacy statement applicable to the website in question.<br>
<br>
			<strong>Controlling your personal information</strong><br>
			You may choose to restrict the collection or use of your personal information in the following ways:<br>
			whenever you are asked to fill in a form on the website, look for the box that you can click to indicate that you do not want the information to be used by anybody for direct marketing purposes
			if you have previously agreed to us using your personal information for direct marketing purposes, you may change your mind at any time by writing to or emailing us at info@redwoodlake.co.uk I will not sell, distribute or lease your personal information to third parties unless I have your permission or are required by law to do so. I may use your personal information to send you promotional information about third parties which I think you may find interesting if you tell us that you wish this to happen.<br>
<br>
			You may request details of personal information which I hold about you under the Data Protection Act 1998. A small fee will be payable. If you would like a copy of the information held on you please emailing us at info@redwoodlake.co.uk <br>
<br>
			If you believe that any information I are holding on you is incorrect or incomplete, please email us as soon as possible, at the above email address. I will promptly correct any information found to be incorrect.</p>        
		</div><!-- End of cell-->  
	</div><!--end of grid-x -->
</div><!--End of grid container-->
</div>
@endsection