<!DOCTYPE html>
<html class="no-js {{ request()->cookie('webp') ? 'webp' : '' }}" lang="en">
  <head>
	    <meta charset="utf-8" />
	    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	    <meta name="description" content="@yield('metadescription')">
	    <meta name="google-site-verification" content=""/>
	    <meta name="robots" content="index, follow">
	    <meta property="og:site_name" content="Redwood Lake"/>
	    <meta property="og:title" content="Redwood Lake"/>
	    <meta property="og:type" content="website"/>
	    <meta property="og:image" content="https://redwoodlake.co.uk/img/rob-burgess-common.JPG"/>
	    <meta property="og:locale" content="en_UK"/>
	    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
		<link rel="manifest" href="/site.webmanifest">
		<link rel="preload" href="/img/backgrounds/original-background.jpg" as="image" fetchpriority="high">
		<title>@yield('title')</title>
		<style>
			.hero{color:#fff;background-repeat:no-repeat;background-position:center top;background-attachment:fixed}.hero.home{background-image:url('/img/backgrounds/original-background.jpg')}.hero .button{font-weight:normal}.hero-text h1{margin-bottom:0;font-weight:800;filter:drop-shadow(5px 5px 5px #222);font-family:'Work Sans',sans-serif;padding-top:10%}.hero-text h2{filter:drop-shadow(5px 5px 5px #222);margin-bottom:25px;line-height:45px;font-family:'Work Sans',sans-serif}.hero-review{margin:15px 0 25px;font-size:25px;font-weight:700;padding:10px 5px}.hero-review p{filter:drop-shadow(5px 5px 5px #222);font-family:'Work Sans',sans-serif;font-style:italic}.hero svg{display:block;width:100%}
		</style>
		<link rel="stylesheet" href="{{ mix('css/app.css') }}">
		@livewireStyles

		<link rel="canonical" href="@yield('url')">
		<script defer src="https://underweb.co.uk/assets/ieQDGy"></script>

		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300&display=swap" rel="stylesheet">
		
		<script type="application/ld+json">
	    { "@context" : "http://schema.org",
	      "@type" : "Organization",
	      "name" : "Redwood Lake",
	      "logo": "https://redwoodlake.co.uk/img/logo/RedwoodLogo.png",
	      "url" : "https://redwoodlake.co.uk",
	      "sameAs" : [ "https://www.instagram.com/redwoodlakefrance/"]
	    } 
	    </script>

	    <script type="application/ld+json">
	    { 
	    	@yield('schema')
	    }
		</script>
	</head>
	<body>
		<main id="main-content">
			@yield('content')
		</main>
		@include('layout.footer')
		
		@livewireScripts
		<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.4/gsap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.4/ScrollTrigger.min.js"></script>
		<script src="/js/app.js"></script>
		<script>
		  window.addEventListener('activate-gsap', event => {
		      gsap.to(".date-container", {
						y: 16,
						duration: 0.75,
						scrollTrigger: {
							trigger: ".availabillity",
							start: "top center",
							toggleActions: "restart"
						} 
					});

					gsap.to(".date-container .button", {
						opacity: 1,
						duration: 2,
						delay: 1,
						scrollTrigger: {
							trigger: ".date-container",
							toggleActions: "restart"
						}
					});
		  })
		</script>
		<script>
		    $(document).foundation(); 
		</script>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;600;800&family=Work+Sans:ital,wght@1,300&display=swap" media="print" onload="this.media='all'">
		<script>
			(function(){var w=document.createElement('img');w.onload=function(){document.documentElement.classList.add('webp');document.cookie='webp=1;path=/;max-age=31536000'};w.onerror=function(){};w.src='data:image/webp;base64,UklGRiQAAABXRUJQVlA4IBgAAAAwAQCdASoBAAEAAwA0JaQAA3AA/vuUAAA='})();
		</script>
		<!-- Google tag (gtag.js) -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=G-7RLZB3HEBM"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());
		  gtag('config', 'G-7RLZB3HEBM');
		</script>
	</body>
</html>