<?php 
require __DIR__.'/vendor/autoload.php';

use OAuth\Common\Consumer\Credentials;
use OAuth\Common\Http\Uri\UriFactory;
use OAuth\OAuth1\Service\Yahoo;
use OAuth\Common\Storage\Session;
use OAuth\ServiceFactory;

// Show errors when testing
error_reporting(E_ALL);
ini_set('display_errors', 1);

$uriFactory = new UriFactory();
$currentUri = $uriFactory->createFromSuperGlobalArray($_SERVER);
$currentUri->setQuery('');

$servicesCredentials = [
    'yahoo' => [
        'key'    => 'dj0yJmk9Q0J2cW5jdVViMjNJJmQ9WVdrOWRHeHJhMlpKTjJFbWNHbzlNQS0tJnM9Y29uc3VtZXJzZWNyZXQmeD01MA--',
        'secret' => 'b850496cb97f48d9d39c2b26383557379114049c'
    ]
];

// Session storage
$storage = new Session();
// Setup the credentials for the requests
$credentials = new Credentials(
	$servicesCredentials['yahoo']['key'],
	$servicesCredentials['yahoo']['secret'],
	$currentUri->getAbsoluteUri()
);
// Instantiate the Yahoo service using the credentials, http client and storage mechanism for the token
$serviceFactory = new ServiceFactory();
$yahooService = $serviceFactory->createService('Yahoo', $credentials, $storage);
if (!empty($_GET['oauth_token'])) {
    $token = $storage->retrieveAccessToken('Yahoo');
    // This was a callback request from Yahoo, get the token
    $yahooService->requestAccessToken(
        $_GET['oauth_token'],
        $_GET['oauth_verifier'],
        $token->getRequestTokenSecret()
    );
    // Send a request now that we have access token
    $result = json_decode($yahooService->request('profile'));
    echo 'result: <pre>' . print_r($result, true) . '</pre>';
} elseif (!empty($_GET['go']) && $_GET['go'] === 'go') {
    // extra request needed for oauth1 to request a request token :-)
    $token = $yahooService->requestRequestToken();
    $url = $yahooService->getAuthorizationUri(array('oauth_token' => $token->getRequestToken()));
    header('Location: ' . $url);
} else {
    $url = $currentUri->getRelativeUri() . '?go=go';
    echo "<a href='$url'>Login with Yahoo!</a>";
}
