<?php 
require __DIR__.'/vendor/autoload.php';

use OAuth\Common\Consumer\Credentials;
use OAuth\Common\Http\Uri\UriFactory;
use OAuth\OAuth1\Service\Twitter;
use OAuth\Common\Storage\Session;
use OAuth\ServiceFactory;

error_reporting(E_ALL);
ini_set('display_errors', 1);

$uriFactory = new UriFactory();
$currentUri = $uriFactory->createFromSuperGlobalArray($_SERVER);
$currentUri->setQuery('');

$servicesCredentials = [
	'twitter' => [
		'key' => '0qLuqXNiuzxjGcq7vgimkKGYf',
		'secret' => 'JoDzU6KQRNBp8LjSFjEM2UYGEA8JE88xCFvcKE0KoV6JRIht4B'
	]
];

$storage = new Session();
// Setup the credentials for the requests
$credentials = new Credentials(
    $servicesCredentials['twitter']['key'],
    $servicesCredentials['twitter']['secret'],
    $currentUri->getAbsoluteUri()
);

// Instantiate the twitter service using the credentials, http client and storage mechanism for the token
/** @var $twitterService Twitter */
$serviceFactory = new ServiceFactory();
$twitterService = $serviceFactory->createService('twitter', $credentials, $storage);
if (!empty($_GET['oauth_token'])) {
    $token = $storage->retrieveAccessToken('Twitter');
    // This was a callback request from twitter, get the token
    $twitterService->requestAccessToken(
        $_GET['oauth_token'],
        $_GET['oauth_verifier'],
        $token->getRequestTokenSecret()
    );
    // Send a request now that we have access token
    $result = json_decode($twitterService->request('account/verify_credentials.json'));
    $_SESSION['app'] = 'Twitter';
    $_SESSION['data'] = [
        'id' => $result->id,
        'created' => $result->created_at,
        'name' => $result->name,
        'friends' => $result->friends_count,
        'followers' => $result->followers_count
    ];
    setcookie('is_logged_in',1, time() + (86400 * 30), "/");
    $url = 'success.php';
    header('Location: ' . $url);
 
} else {
    $token = $twitterService->requestRequestToken();
    $url = $twitterService->getAuthorizationUri(array('oauth_token' => $token->getRequestToken()));
    header('Location: ' . $url);
}