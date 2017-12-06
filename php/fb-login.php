<?php 
	session_start();
	require_once( '../vendor/autoload.php' );
	include('url.php');
	$appId = '1738020859556393'; //Facebook App ID
	$appSecret = '04e556fbb7cbd239fadf75e0d12741a2'; //Facebook App Secret
	
	
	$fb = new Facebook\Facebook([
	  'app_id' => $appId,
	  'app_secret' => $appSecret,
	  'default_graph_version' => 'v2.9',
	 ]);

	$helper = $fb->getRedirectLoginHelper();

	$permissions = ['email']; // Optional permissions
	$loginUrl = $helper->getLoginUrl($callback, $permissions);
	header('Location: '.$loginUrl);

	// echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
?>