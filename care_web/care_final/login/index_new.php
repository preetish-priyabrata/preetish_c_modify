<?php 
session_start();
require 'FlashMessages.php';
$msg = new \Preetish\FlashMessages\FlashMessages();
?>
<!DOCTYPE html>
<html>
<head>
	<title>LOGIN Page</title>
		 <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
	
</head>
<body>
	<!-- <div class="container" style="margin: 25px auto; position: relative;">
		<div class="row"></div>
	</div> -->
	<div class="auth-container">
        <div class="center-block">
            <div class="auth-module">
                <div class="toggle">
                    <!-- <i class="icon-user-lock"></i> -->
                    <!-- <div class="tip">Click here to register</div> -->
                </div>
                <!-- Login form -->
                <div class="form">
                    <!-- <h1 class="text-light">Login to your account</h1>
                    <br> -->
						<div class="container">
						<div id="login-box" style="background-image: url(img/care-logo.jpg);background-size: 384px 298px;  background-repeat: no-repeat;">
							<div class="logo">
								<!-- <img src="http://lorempixel.com/output/people-q-c-100-100-1.jpg" class="img img-responsive img-circle center-block"/> -->
								<h1 class="logo-caption"><span class="tweak"><b>L</b></span><b>ogin</b></h1>
						  </div><!-- /.logo -->
						<h5 class="text-light"><?php $msg->display(); ?></h5>
              <form class="form-horizontal"  action="login_process.php" method="POST" onsubmit="return check_location();" autocomplete="off">
								<div class="controls">
									<input type="text" name="username" placeholder="Username" class="form-control" required="" />
									<br>
									<input type="password" name="user_password" placeholder="Password" class="form-control"  required="" />
									<input type="hidden" name="lat2" value="" id="user_browser_lat2" required="true">
									<input type="hidden" name="lat" value="" id="user_browser_lat" required="true">
									<input type="hidden" name="long2" value="" id="user_browser_long2" required="true">
									<input type="hidden" name="long" value="" id="user_browser_long" required="true">
									<button type="Submit" id="submit" class="btn btn-default btn-block btn-custom">Login</button>
                  <br>
                  <p id="demo" class="text-center" style="padding-top: 1pc; color: red; font-weight: 600; font-size: 2ch; font-family: Helvetica;   display: none;  background: black;   padding-bottom: 1pc;"></p>

								</div><!-- /.controls -->
							</form>
						</div><!-- /#login-box -->
					</div><!-- /.container -->
				</div>

			</div>
		</div>
	</div>
<div id="particles-js"></div>
<!--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/particles.js/2.0.0/particles.min.js"></script>-->
<script src="custom.js"></script>
<script>
$(document).ready(function() {
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
});
$( document ).ready(function() {
  var x = document.getElementById("demo");
// function getLocation() {
    if (navigator.geolocation) {
       navigator.geolocation.getCurrentPosition(showPosition);
         navigator.geolocation.watchPosition(showPosition, showError);
    } else { 
        navigator.geolocation.watchPosition(showPosition, showError);
       alert("Geolocation is not supported by this browser.");
    }
// }

navigator.geolocation.watchPosition(function(location) {
  console.log(location.coords.latitude);
  console.log(location.coords.longitude);
  console.log(location.coords.accuracy);
  $('#user_browser_lat2').val(location.coords.latitude);
     $('#user_browser_long2').val(location.coords.longitude);
});
function showPosition(position) {
    // x.innerHTML = "Latitude: " + position.coords.latitude + 

    // "<br>Longitude: " + position.coords.longitude;
     // var ips_lat=position.coords.latitude;
     // var ips_long=position.coords.longitude;
      var ips_lat = position.coords.latitude;
    var ips_long = position.coords.longitude;
    //alert(ips_lat);
    //alert(ips_long);

     if((ips_lat!="") && (ips_long!="")){

     $('#user_browser_lat').val(ips_lat);
     $('#user_browser_long').val(ips_long);
      $("#submit").show();
   }else{
  //  alert(ips_lat);
    //alert(ips_long);
    $("#submit").hide();
   }
}
// function showPosition(position) {
//     x.innerHTML = "Latitude: " + position.coords.latitude + 
//     "<br>Longitude: " + position.coords.longitude;
// }

function showError(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
            $("#submit").hide();
              document.getElementById("demo").style.display = "block";
            x.innerHTML = "User denied the request for Geolocation."
            break;
        case error.POSITION_UNAVAILABLE:
          $("#submit").hide();
           document.getElementById("demo").style.display = "block";
            x.innerHTML = "Location information is unavailable."
            break;
        case error.TIMEOUT:
            $("#submit").hide();
             document.getElementById("demo").style.display = "block";
            x.innerHTML = "The request to get user location timed out."
            break;
        case error.UNKNOWN_ERROR:
            $("#submit").hide();
             document.getElementById("demo").style.display = "block";
            x.innerHTML = "An unknown error occurred."
            break;
    }
    }
    navigator.geolocation.getCurrentPosition(showPosition, error);
// $.getJSON('http://gd.geobytes.com/GetCityDetails?callback=?', function(data) {
//   console.log(JSON.stringify(data, null, 2));
//   var obj = JSON.parse(JSON.stringify(data, null, 2));
//     var ips_lat1=obj.geobyteslatitude;
//     var ips_long2=obj.geobyteslongitude;
//   $('#long3').val(ips_lat1);
//   $('#lat3').val(ips_long2);
// });
// // geobyteslatitude
});
function check_location() {
  var user_browser_lat2=$('#user_browser_lat2').val();
  var user_browser_lat=$('#user_browser_lat').val();
  var user_browser_long2=$('#user_browser_long2').val();
  var user_browser_long=$('#user_browser_long').val();
  ///alert(user_browser_lat2);
  //alert(user_browser_lat);
  //alert(user_browser_long2);
  //alert(user_browser_long);

  if((user_browser_lat2!="") && (user_browser_lat!="") && (user_browser_long2!="") &&(user_browser_long!="")){
     $("#submit").show();
     return true;
  }else{
    alert("Please Allow to know your Location");
    $("#submit").hide();
    return false;
  }
}
</script>
</body>
</html>