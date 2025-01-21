<!DOCTYPE html>
<html class="no-js" lang="en">
  <head>
	    <meta charset="utf-8" />
	    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	    <meta name="description" content="@yield('metadescription')">
	    <meta name="google-site-verification" content=""/>
	    <meta name="robots" content="index, follow">
	    <meta property="og:site_name" content="Underwood Web Services"/>
	    <meta property="og:title" content="Underwood Web Services"/>
	    <meta property="og:type" content="website"/>
	    <meta property="og:image" content=""/>
	    <meta property="og:locale" content="en_UK"/>
	    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
		<link rel="manifest" href="/site.webmanifest">
		<title>@yield('title')</title>
		<link href="/css/app.css" rel="stylesheet" type="text/css">
		@livewireStyles
		<script src="https://js.stripe.com/v3/"></script>
		<link rel="canonical" href="@yield('url')">
		<script src="https://kit.fontawesome.com/0a03567b35.js" crossorigin="anonymous"></script>
		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;600;800&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Expletus+Sans:wght@500&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
		
		<script type="application/ld+json">
	    { "@context" : "http://schema.org",
	      "@type" : "Organization",
	      "name" : "Underwood Web Services",
	      "logo": "https://redwoodlake.co.uk/img/logo/RedwoodLake.png",
	      "url" : "https://redwoodlake.co.uk",
	      "sameAs" : []
	    } 
	    </script>

	    <script type="application/ld+json">
	    	{ 
	    		@yield('schema') 
	    	}
		</script>
	</head>
	<body>
		@include('layout.nav-profile')

			@yield('content')

		@include('layout.footer')
		
		@livewireScripts
		<script src="/js/app.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
		<script>
    		var picker = new Pikaday({ 
    			field: document.getElementById('datepicker'),
    			format: 'D MMM YYYY',
		        onSelect: function() {
		            console.log(this.getMoment().format('Do MMMM YYYY'));
		        }
    		});
		</script>
		<script>
		  window.addEventListener('activate-datepicker', event => {
		      var picker = new Pikaday({ 
		        field: document.getElementById('datepicker'),
		        format: 'D-M-YYYY',
		          onSelect: function() {
		              console.log(this.getMoment().format('Do MMMM YYYY'));
		          }
		      });

		      var picker2 = new Pikaday({ 
		        field: document.getElementById('datepicker2'),
		        format: 'D-M-YYYY',
		          onSelect: function() {
		              console.log(this.getMoment().format('Do MMMM YYYY'));
		          }
		      });
		  })
		</script>
		<script>
		    $(document).foundation(); 
		</script>
	
	</body>
</html>