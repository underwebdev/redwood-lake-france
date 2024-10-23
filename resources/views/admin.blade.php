<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
	    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	    <meta name="keywords" content="">
	    <meta name="description" content="">
	    <meta name="google-site-verification" content="Redwood Lake" />
	    <meta name="robots" content="noindex">
	    <meta property="og:site_name" content=""/>
	    <meta property="og:title" content="Redwood Lake"/>
	    <meta property="og:type" content="website"/>
	    <meta property="og:image" content=""/>
	    <meta property="og:locale" content="en_UK"/>
		<title>Redwood Lake - Admin Dashboard</title>
		<link href="/css/admin.css" rel="stylesheet" type="text/css">
		@livewireStyles
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/motion-ui@1.2.3/dist/motion-ui.min.css" />
		<script defer src="https://underweb.co.uk/assets/ieQDGy"></script>
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Archivo:ital,wght@0,300;0,500;0,700;0,900;1,900&family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
		<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js" defer></script>
		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">
	</head>
	<body>
		<div data-sticky-container>
		<div class="grid-x grid-padding-x hide-for-large title-bar sticky" data-sticky data-options="marginTop:0;" data-sticky-on="small">				
			    <button type="button" data-toggle="adminMenu" class="menu-button-left"><i class="fas fa-bars"></i> </button>
				<div class="title-bar-title"><a data-open="adminMenu"> Menu</a></div>
			</div><!-- End of cell-->
		</div>
		</div>

		<div class="grid-container full">
			<div class="grid-x">
				<div class="cell small-12 large-2 cptitle">
					<div class="side-nav-title text-center show-for-large">
						<img src="/img/logo/RedwoodLogo.png" width="220px" class="admin-logo">
					</div>
					<div class="off-canvas position-left cpmenu" id="adminMenu" data-off-canvas data-options="inCanvasOn:large;">
						<div class="side-nav">
							@livewire('layout.admin-menu')
						</div>
					</div>
				</div><!-- End of cell-->
				<div class="cell small-12 large-10 top">
				    @yield('content')
				</div><!-- End of cell-->
			  
			</div><!--end of grid-x -->

		</div>
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
	      window.addEventListener('activate-foundation', event => {
	        $(document).foundation();  
	      })
	    </script>
		<script>
		    $(document).foundation();  
		</script>
	</body>
</html>