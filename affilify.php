<?php 

require_once('GoingupApi.php');
require_once('config.php');

$redirect = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] .'/affilify.php';

?>

<a href="<?php echo $api->getLoginUrl('code', 'cde', 'eticket', 'yes', '2', $redirect); ?>">Login</a>

<?php 
$authCode = isset($_REQUEST['code']) ? $_REQUEST['code'] : null;
$refreshToken = isset($_REQUEST['refreshToken']) ? $_REQUEST['refreshToken'] : null;
$state = isset($_REQUEST['state']) ? $_REQUEST['state'] : null;
if ($authCode) {
?>

<h1>API REQUEST RESULT</h1>

<?php 

	$response = $api->getToken($authCode, $_REQUEST['state']);
	echo '<h5>HEADER</h5><pre>';
	print_r($api->header);
	echo '</pre>';
	echo '<hr />';

	$r = json_decode($response);

	if (!isset($r->access_token)){
		echo '<pre>';

		var_dump($response);
		echo '</pre>';
		die("error");
	} else {
		echo '<pre>';
		print_r($r);
		echo '</pre>';
		echo "I have an access token : ". $r->access_token . "<br />";
		echo '<a href="affilify_post_request.php?access_token='.$r->access_token.'&refresh_token='.$r->refresh_token.'&state='.$state.'">Make request</a>';
		die;
	}	

?>
<?php } ?>
