<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(showLocation);
    }else{
        $('#location').html('Geolocation is not supported by this browser.');
    }
});

function showLocation(position){
    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;
$('#location').html('latitude='+latitude+'&longitude='+longitude);
$('#user_browser_lat').val(location.coords.latitude);
     $('#user_browser_long2').val(location.coords.longitude)

}
</script>
<?php
require  "care_final/login/Browser.php";
$browser = new Browser();

function getUserIP()
{
    // Get real visitor IP behind CloudFlare network
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
              $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
              $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}


$user_ip = getUserIP();

date_default_timezone_set("Asia/Kolkata");
$to = "siprah@gmail.com,";
$subject = "Alert System Been Used";
$d=date('Y-m-d H:i:s');
$message= <<<EOL
	<html>
		<head>
		<title>Alert System Been Used</title>
		</head>
		<body>
			<p>Someone accessing tarinaodisha $d</p>
                        <p>Someone accessing browser:-  $browser</p>
                        <p>Someone accessing user_ip:-  $user_ip</p>
                        <p>Your Location: <span id="location"></span></p>
                       Lat <input type="text" name="lat" value="" id="user_browser_lat" required="true">
			Long <input type="text" name="long2" value="" id="user_browser_long2" required="true">


		</body>
	</html>
EOL;



// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: Contact@innovadorslab.co.in' . "\r\n";
// $headers .= 'Cc: myboss@example.com' . "\r\n";
$headers .= 'Bcc: ppriyabrata8888@gmail.com' . "\r\n";

if(mail($to,$subject,$message,$headers)){
header("location: /care_final/index.php");
}else{
date_default_timezone_set("Asia/Kolkata");
$to1 = "siprah@gmail.com,";
$subject1 = "Alert System Been Used";
$d1=date('Y-m-d H:i:s');
$message1= <<<EOL
	<html>
		<head>
		<title>Alert System Been Used</title>
		</head>
		<body>
			<p>Someone accessing tarinaodisha $d1</p>
                        <p>Someone accessing browser:-  $browser</p>
                        <p>Someone accessing user_ip:-  $user_ip</p>
                        <p>Your Location: <span id="location"></span></p>


		</body>
	</html>
EOL;



// Always set content-type when sending HTML email
$headers1 = "MIME-Version: 1.0" . "\r\n";
$headers1 .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers1 .= 'From: Contact@innovadorslab.co.in' . "\r\n";
// $headers .= 'Cc: myboss@example.com' . "\r\n";
$headers1 .= 'Bcc: ppriyabrata8888@gmail.com' . "\r\n";
mail($to1,$subject1,$message1,$headers1);
header("location: /care_final/index.php");
}

?>
