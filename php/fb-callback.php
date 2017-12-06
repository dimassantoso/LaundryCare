<?php 
  session_start();
  require_once( '../vendor/autoload.php' );
  require_once('db.php');
  require_once('error.php');
  require 'validate.php';
  include 'url.php';
  $appId = '1738020859556393'; //Facebook App ID
  $appSecret = '04e556fbb7cbd239fadf75e0d12741a2'; //Facebook App Secret
  $fb = new Facebook\Facebook([
  'app_id' => $appId,
  'app_secret' => $appSecret,
  'default_graph_version' => 'v2.9',
  ]);

$helper = $fb->getRedirectLoginHelper();

try {
  $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error101: ' . $e->getMessage();
  exit;
}

if (! isset($accessToken)) {
  if ($helper->getError()) {
    header('HTTP/1.0 401 Unauthorized');
    echo "Error: " . $helper->getError() . "\n";
    echo "Error Code: " . $helper->getErrorCode() . "\n";
    echo "Error Reason: " . $helper->getErrorReason() . "\n";
    echo "Error Description: " . $helper->getErrorDescription() . "\n";
  } else {
    header('HTTP/1.0 400 Bad Request');
    echo 'Bad request';
  }
  exit;
}

// Logged in
// echo '<h3>Access Token</h3>';
// var_dump($accessToken->getValue());

// The OAuth 2.0 client handler helps us manage access tokens
$oAuth2Client = $fb->getOAuth2Client();

// Get the access token metadata from /debug_token
$tokenMetadata = $oAuth2Client->debugToken($accessToken);
// echo '<h3>Metadata</h3>';
// var_dump($tokenMetadata);

// Validation (these will throw FacebookSDKException's when they fail)
$tokenMetadata->validateAppId($appId);
// If you know the user ID this access token belongs to, you can validate it here
//$tokenMetadata->validateUserId('123');
$tokenMetadata->validateExpiration();

if (! $accessToken->isLongLived()) {
  // Exchanges a short-lived access token for a long-lived one
  try {
    $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
  } catch (Facebook\Exceptions\FacebookSDKException $e) {
    echo "<p>Error getting long-lived access token: " . $e->getMessage() . "</p>\n\n";
    exit;
  }

  // echo '<h3>Long-lived</h3>';
  // var_dump($accessToken->getValue());
}

$_SESSION['fb_access_token'] = (string) $accessToken;
echo "THIS IS RESS".$_SESSION['fb_access_token'];
try {
  // Returns a `Facebook\FacebookResponse` object
  $response = $fb->get('/me?fields=id,name,email', $_SESSION['fb_access_token']);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

$user = $response->getGraphUser();

$id = $user['id'];
$name = $user['name'];
$email = $user['email'];
// echo 'Name: ' . $name; 
// echo 'Email: ' . $email;

set_error_handler('handleError');
mysqli_select_db($conn,"laundry");
if(cekID($user['id'])){
  $sql = "INSERT INTO customer (id_customer,email, nama, oauth_provider) VALUES ($id,'$email','$name','Facebook')";
  $result = mysqli_query($conn,$sql);
}
$_SESSION['login_user'] = $email;
$_SESSION['id_user'] = $id;
setcookie("user_address", "", time() - 3600);
echo "ok";
header("Location:$home");

// User is logged in with a long-lived access token.
// You can redirect them to a members-only page.
//header('Location: https://example.com/members.php');
?>