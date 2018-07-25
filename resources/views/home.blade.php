
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="Ma'ruf Shidiq">

	<title>Smart Home Dashboard</title>

	<!-- Bootstrap CSS with custom theme variables + Additional styles for this template -->
	<link href="assets/css/iot-theme-bundle.min.css" rel="stylesheet">

</head>

<body>

	<!-- Preloader -->
	<div id="iot-preloader">
		<div class="center-preloader d-flex align-items-center">
			<div class="spinners">
				<div class="spinner01"></div>
				<div class="spinner02"></div>
			</div>
		</div>
	</div>

	<!-- Alerts Modal -->
	<div class="modal modal-nobg centered fade" id="alertsModal" tabindex="-1" role="dialog" aria-label="Alerts" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-body">
					<div class="alert alert-danger alert-dismissible fade show border-0" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button> Security SW update available
					</div>
					<div class="alert alert-warning alert-dismissible fade show border-0" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button> New device recognized
					</div>
					<div class="alert alert-warning alert-dismissible fade show border-0" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button> User profile is not complete
					</div>
				</div>
			</div>
		</div>
		<button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
	</div>

	<!-- Arming Modal -->
	<div class="modal modal-warning centered fade" id="armModal" tabindex="-1" role="dialog" aria-label="Arming" aria-hidden="true">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-body">
					<div id="armTimer">
						<h3 class="font-weight-bold">EXIT NOW! <span class="timer font-weight-normal"></span></h3>
					</div>
				</div>
			</div>
		</div>
		<button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>

	<!-- Alarm Modal -->
	<div class="modal modal-danger centered fade" id="alarmModal" tabindex="-1" role="dialog" aria-label="ALARM" aria-hidden="true" data-backdrop="static">
		<div class="modal-dialog" role="document">
			<div class="modal-content" data-dismiss="modal">
				<div class="modal-body d-flex">
					<svg class="icon-sprite icon-2x icon-pulse"><use xlink:href="assets/images/icons-sprite.svg#alarm"/></svg>
					<h3 class="text-right font-weight-bold ml-auto align-self-center">MOTION DETECTED!</h3>
				</div>
			</div>
			<p class="mt-2 text-center text-danger">Click the red area to accept/close message</p>
		</div>
	</div>

	<!-- Wrapper START -->
	<div id="wrapper" class="hidden">
		<!-- Top navbar START -->
		<nav class="navbar navbar-expand fixed-top d-flex flex-row justify-content-start">
			<div class="d-none d-lg-block">
				<form>
					<div id="menu-minifier">
						<label>
							<svg width="32" height="32" viewBox="0 0 32 32">
								<rect x="2" y="8" width="4" height="3" class="menu-dots"></rect>
								<rect x="2" y="15" width="4" height="3" class="menu-dots"></rect>
								<rect x="2" y="22" width="4" height="3" class="menu-dots"></rect>
								<rect x="8" y="8" width="21" height="3" class="menu-lines"></rect>
								<rect x="8" y="15" width="21" height="3" class="menu-lines"></rect>
								<rect x="8" y="22" width="21" height="3" class="menu-lines"></rect>
							</svg>
							<input id="minifier" type="checkbox"> 
						</label>
						<div class="info-holder info-rb">
							<div data-toggle="popover-all" data-content="Checkbox element using localStorage to remember the last status." data-original-title="Side menu narrowing" data-placement="right"></div>
						</div>
					</div>
				</form>
			</div>
			<a class="navbar-brand px-lg-3 px-1 mr-0" href="#">Smart Home</a>
			<div class="ml-auto">
				<div class="navbar-nav flex-row navbar-icons">
					<div class="nav-item">
						<button id="alerts-toggler" class="btn btn-link nav-link" title="Alerts" type="button" data-alerts="3" data-toggle="modal" data-target="#alertsModal">
							<svg class="icon-sprite">
								<use xlink:href="assets/images/icons-sprite.svg#alert"/>
								<svg class="text-danger"><use class="icon-dot" xlink:href="assets/images/icons-sprite.svg#icon-dot"/></svg>
							</svg>
						</button>
					</div>
					<div id="user-menu" class="nav-item dropdown">
						<button class="btn btn-link nav-link dropdown-toggle" title="User" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<svg class="icon-sprite"><use xlink:href="assets/images/icons-sprite.svg#user"/></svg>
						</button>
						<div class="dropdown-menu dropdown-menu-right">
							<a class="dropdown-item" href="profile.html">Profile</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="login.html">Logout</a>
						</div>
					</div>
					<div class="nav-item d-lg-none">
						<button id="sidebar-toggler" type="button" class="btn btn-link nav-link" data-toggle="offcanvas">
						  <svg class="icon-sprite"><use xlink:href="assets/images/icons-sprite.svg#menu"/></svg>
						</button>
					</div>
				</div>
			</div>
		</nav>
		<!-- Top navbar END -->
		<!-- wrapper-offcanvas START -->
		<div class="wrapper-offcanvas">
			<!-- row-offcanvas START -->
			<div class="row-offcanvas row-offcanvas-left">
				<!-- Side menu START -->
				<div id="sidebar" class="sidebar-offcanvas">
					<ul class="nav flex-column nav-sidebar">
						<li class="nav-item active">
							<a class="nav-link active" href="home">
								<svg class="icon-sprite"><use xlink:href="assets/images/icons-sprite.svg#home"/></svg> Dashboard
							</a>
						</li>						
						<li class="nav-item">
							<a class="nav-link disabled" href="#">
								<svg class="icon-sprite"><use xlink:href="assets/images/icons-sprite.svg#settings"/></svg> Settings
							</a>
						</li>
					</ul>
				</div>
				<!-- Side menu END -->
				<!-- Main content START -->
				<div id="main">
					<div class="container-fluid">						
						<div class="row">
							<div class="col-sm-12 col-md-6">
								<!-- Security system START -->
								<div class="card lock" data-unit="switch-house-lock">
									<div class="card-body d-flex flex-wrap">
										<svg class="icon-sprite icon-2x">
										  <use xlink:href="assets/images/icons-sprite.svg#home"/>
										  <use class="subicon-unlocked" xlink:href="assets/images/icons-sprite.svg#subicon-unlocked"/>
										  <use class="subicon-locked" xlink:href="assets/images/icons-sprite.svg#subicon-locked"/>
										</svg>
										<div class="title-status">
											<h4>Security system</h4>
											<p class="status"><span class="arm"></span></p>
										</div>
										<label class="switch ml-auto">
											<input type="checkbox" id="switch-house-lock">
										</label>
									</div>
								</div>
								<!-- Security system END -->
							</div>
							<div class="col-sm-12 col-md-6">
								<!-- Garage-doors START -->
								<div class="card" data-unit="garage-doors-1">
									<div class="card-body">
										<div class="d-flex flex-wrap mb-2">
											<svg class="icon-sprite icon-1x">
												<use class="glow" fill="url(#radial-glow)" xlink:href="assets/images/icons-sprite.svg#glow"/>
												<use xlink:href="assets/images/icons-sprite.svg#garage"/>
											</svg>
											<div class="title-status">
												<h5>Garage doors</h5>
												@if(\App\Topic::where('topic', '/room/4/door')->first()['message'] == 0)
												<p class="status text-danger">Close</p>
												@elseif(\App\Topic::where('topic', '/room/4/door')->first()['message'] == 1)
												<p class="status text-success">Open</p>
												@endif
											</div>
											<div class="ml-auto timer-controls" data-controls="garage-doors-1">
												<form action="/change/garage" method="get">
												@if(\App\Topic::where('topic', '/room/4/door')->first()['message'] == 1)
												<button data-action="open" type="submit" class="btn btn-secondary doors-control">Close</button>
												@elseif(\App\Topic::where('topic', '/room/4/door')->first()['message'] == 0)
												<button data-action="open" type="submit" class="btn btn-secondary doors-control">Open</button>
												@endif										
												</form>		
											</div>
										</div>
										<div class="progress">
											<div class="progress-bar progress-tiny timer" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="12"></div>
										</div>
										<div class="info-holder info-cb">
											<div data-toggle="popover-all" data-content="Element driven by javascript (countdown timer)." data-original-title="Progress indicator" data-placement="top" data-offset="0,-12"></div>
										</div>
									</div>
								</div>
								<!-- Garage-doors END -->
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 col-md-6 col-xl-4">
								<!-- Interior lights  START -->
								<div class="card" data-unit-group="switch-lights-1">
									<div class="card-body">
										<h3 class="card-title">Device 1</h3>
									</div>
									<ul class="list-group list-group-flush">										
										<li class="list-group-item d-flex" data-unit="switch-light-1">
											<svg class="icon-sprite">
												<use class="glow" fill="url(#radial-glow)" xlink:href="assets/images/icons-sprite.svg#glow"/>
												<use xlink:href="assets/images/icons-sprite.svg#bulb-eco"/>
											</svg>
											<h5>Lampu 1</h5>
											<label class="switch ml-auto">
												<input type="checkbox" id="switch-light-1">
											</label>											
										</li>	
                                        <li class="list-group-item d-flex" data-unit="switch-light-2">
											<svg class="icon-sprite">
												<use class="glow" fill="url(#radial-glow)" xlink:href="assets/images/icons-sprite.svg#glow"/>
												<use xlink:href="assets/images/icons-sprite.svg#bulb-eco"/>
											</svg>
											<h5>Lampu 2</h5>
											<label class="switch ml-auto">
												<input type="checkbox" id="switch-light-2">
											</label>
										</li>                                        
										<li class="list-group-item d-flex" data-unit="switch-light-3">
											<svg class="icon-sprite">
												<use class="glow" fill="url(#radial-glow)" xlink:href="assets/images/icons-sprite.svg#glow"/>
												<use xlink:href="assets/images/icons-sprite.svg#appliances"/>
											</svg>
											<h5>Terminal 1</h5>
											<label class="switch ml-auto">
												<input type="checkbox" id="switch-light-3">
											</label>											
										</li>	
                                        <li class="list-group-item d-flex" data-unit="switch-light-4">
											<svg class="icon-sprite">
												<use class="glow" fill="url(#radial-glow)" xlink:href="assets/images/icons-sprite.svg#glow"/>
												<use xlink:href="assets/images/icons-sprite.svg#appliances"/>
											</svg>
											<h5>Terminal 2</h5>
											<label class="switch ml-auto">
												<input type="checkbox" id="switch-light-4">
											</label>
										</li>
                                        <li class="list-group-item d-flex" data-unit="switch-light-5">
											<svg class="icon-sprite">
												<use class="glow" fill="url(#radial-glow)" xlink:href="assets/images/icons-sprite.svg#glow"/>
												<use xlink:href="assets/images/icons-sprite.svg#appliances"/>
											</svg>
											<h5>Terminal 3</h5>
											<label class="switch ml-auto">
												<input type="checkbox" id="switch-light-5">
											</label>
										</li>                                                                        																		
									</ul>
									<div class="card-body">
										<div class="lights-controls" data-controls="switch-lights-1">
											<button data-action="all-on" type="button" class="btn btn-primary lights-control">All <strong>ON</strong></button>
											<button data-action="all-off" type="button" class="btn btn-secondary lights-control">All <strong>OFF</strong></button>
										</div>
									</div>
								</div>								
							</div>                          						
                        </div>
						<div class="row">
							<div class="col-sm-12 col-md-6">
								<!-- Fridge  START -->
								<div class="card active" data-unit="home-fridge">
								<ul class="list-group borderless">
									<li class="list-group-item align-items-center">
									<svg class="icon-sprite icon-1x">
										<use class="glow" fill="url(#radial-glow)" xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="assets/images/icons-sprite.svg#glow"></use>
										<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="assets/images/icons-sprite.svg#settings"></use>
									</svg>
									<h5>Air Conditioner</h5>
									<p class="ml-auto status">ON</p>
									</li>
								</ul>
								<hr class="my-0">
								<div class="d-flex justify-content-between" data-rangeslider="fridge-temp">
									<ul class="list-group borderless px-1 align-items-stretch">
									<li class="list-group-item">
										<p class="specs mr-auto mb-auto">Temperature</p>
									</li>
									<li class="list-group-item d-flex flex-column pb-4">
										<p class="mr-auto mt-2 mb-0 display-5">
										<span id="fridge-temp-F">{{\App\Topic::where('topic', '/room/11/ac/1/temp')->first()['message']/10}}</span><sup>°C</sup>
										</p>										
									</li>
									</ul>
									<div class="p-4" style="position:relative;">
									<input id="fridge-temp" type="range" min="16.0" max="32.0" step="0.1" value="{{\App\Topic::where('topic', '/room/11/ac/1/temp')->first()['message']/10}}" data-orientation="vertical">									
									</div>
								</div>
								</div>
								<!-- Fridge  END -->
							</div>
						</div>												
					</div>
					<!-- Main content overlay when side menu appears  -->
					<div class="cover-offcanvas" data-toggle="offcanvas"></div>
				</div>
				<!-- Main content END -->
			</div>
			<!-- row-offcanvas END -->
		</div>
		<!-- wrapper-offcanvas END -->
	</div>
	<!-- Wrapper END -->
		

	<!-- SVG assets - not visible -->
	<svg id="svg-tool" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <defs>
      <style type="text/css">
          .glow circle {fill:url(#radial-glow)}
      </style>
      <filter id="blur" x="-25%" y="-25%" width="150%" height="150%">
          <feGaussianBlur in="SourceGraphic" stdDeviation="3"/>
      </filter>
      <radialGradient id="radial-glow" fx="50%" fy="50%" r="50%">
          <stop offset="0" stop-color="#0F9CE6" stop-opacity="1"/>
          <stop offset="1" stop-color="#0F9CE6" stop-opacity="0" />
      </radialGradient>
    </defs>
  </svg>

	<!-- jQuery -->
	<script src="assets/js/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

	<!-- Bootstrap bundle -->
	<script src="assets/js/bootstrap.bundle.min.js"></script>

	<!-- Cross browser support for SVG icon sprites -->
	<script src="assets/js/svg4everybody.min.js"></script>

	<!-- jQuery countdown timer plugin (Exit modal, Garage doors, Washing machine) -->
	<script src="assets/js/iot-timer.min.js"></script>

	<!-- Basic theme functionality (arming, garage doors, switches ...) - using jQuery -->
	<script src="assets/js/iot-functions.min.js"></script>

	<script>		
		$(document).ready(function() {
			setInterval(function(){ 
				changeSwitchView();
			}, 2000);			
			changeSwitchView();
			$('.switch input[type="checkbox"]').click(function() {				
				console.log($(this).attr('id')+' ditekan');
				changeSwitchState($(this).attr('id'));
				changeSwitchView();
			});

			$('.lights-control').click(function() {

				var target = $(this).closest('.lights-controls').data('controls');
				var action = $(this).data('action');

				console.log(target+" "+action);
				changeMultiSwitchState(target, action);
				changeSwitchView();
			});

			$(document).on('input', 'input[type="range"]#fridge-temp', function() {
				var temperature = this.value;								
				$('[data-rangeslider="' + this.id + '"] #fridge-temp-F').html(temperature);
			});

			$(document).on('change', 'input[type="range"]#fridge-temp', function() {
				var temperature = this.value;
				console.log('suhu = '+temperature*10);
				changeTemp(temperature*10);
			});
		});

		function changeTemp(temp) {        
			var request = $.ajax({
				url: "/api/change/temp",          
				type: "POST",          
				data: {                     
					temp : temp              
					},
				dataType: "html"
			});

			request.done(function(JSONString) {
				// var JSONObject = JSON.parse(JSONString);
				// console.log(JSONObject);		
				console.log(JSONString);		
			});

			request.fail(function(jqXHR, textStatus) {
				// alert( "Request failed: " + textStatus + " Please Reload the Page");
			});
		};

		function changeSwitchState(devid) {        
			var request = $.ajax({
				url: "/api/change/switch",          
				type: "POST",          
				data: {                     
					id : devid              
					},
				dataType: "html"
			});

			request.done(function(JSONString) {
				// var JSONObject = JSON.parse(JSONString);
				// console.log(JSONObject);		
				console.log(JSONString);		
			});

			request.fail(function(jqXHR, textStatus) {
				// alert( "Request failed: " + textStatus + " Please Reload the Page");
			});
		};

		function changeMultiSwitchState(roomid, action) {        
			var request = $.ajax({
				url: "/api/change/multiswitch",          
				type: "POST",          
				data: {                     
					roomid : roomid,
					action: action
				},
				dataType: "html"
			});

			request.done(function(JSONString) {
				// var JSONObject = JSON.parse(JSONString);
				// console.log(JSONObject);		
				console.log(JSONString);		
			});

			request.fail(function(jqXHR, textStatus) {
				// alert( "Request failed: " + textStatus + " Please Reload the Page");
			});
		};

		function changeSwitchView() {        
			var request = $.ajax({
				url: "/api/get/switch",          
				type: "POST",          				
				dataType: "html"
			});

			request.done(function(JSONString) {
				var JSONObject = JSON.parse(JSONString);
            	console.log(JSONObject);
				for (var key in JSONObject) {
					if (JSONObject.hasOwnProperty(key)) {
						// console.log(JSONObject[key]["id"] + ", " + JSONObject[key]["state"]);
						if(JSONObject[key]["state"] == 1){
							$('[data-unit="' + JSONObject[key]["id"] + '"]').addClass('active');
							$('[data-unit="' + JSONObject[key]["id"] + '"] label').addClass('checked');
						}
						if(JSONObject[key]["state"] == 0){
							$('[data-unit="' + JSONObject[key]["id"] + '"]').removeClass('active');
							$('[data-unit="' + JSONObject[key]["id"] + '"] label').removeClass('checked');
						}						
					}
				}		
			});

			request.fail(function(jqXHR, textStatus) {
				// alert( "Request failed: " + textStatus + " Please Reload the Page");
			});
		};

		// Apply necessary changes, functionality when content is loaded
		$(window).on('load', function() {

			// This script is necessary for cross browsers icon sprite support (IE9+, ...) 
			svg4everybody();			

			// "Timeout" function is not neccessary - important is to hide the preloader overlay
			setTimeout(function() {

				// Hide preloader overlay when content is loaded
				$('#iot-preloader,.card-preloader').fadeOut();
				$("#wrapper").removeClass("hidden");

				// Check for Main contents scrollbar visibility and set right position for FAB button
				iot.positionFab();

			}, 800);

		});

		// Apply necessary changes if window resized
		$(window).on('resize', function() {

			// Modal reposition when the window is resized
			$('.modal.centered:visible').each(iot.centerModal);

			// Check for Main contents scrollbar visibility and set right position for FAB button
			iot.positionFab();
		});

	</script>

</html>
