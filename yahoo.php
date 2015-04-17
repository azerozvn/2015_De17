<?php 
require __DIR__.'/vendor/autoload.php';

use OAuth\Common\Consumer\Credentials;
use OAuth\Common\Http\Uri\UriFactory;
use OAuth\OAuth2\Service\Yahoo;
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
        'key'    => 'dj0yJmk9MmFZTVpkRmM4TW9ZJmQ9WVdrOWRHeHJhMlpKTjJFbWNHbzlNQS0tJnM9Y29uc3VtZXJzZWNyZXQmeD00OQ--',
        'secret' => 'c5c91c17419c994dbf6c423a4feefca3781a18a2'
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
$yahooService = $serviceFactory->createService('Yahoo', $credentials, $storage, array());
if (!empty($_GET['code'])) {
    $token = $yahooService->requestAccessToken($_GET['code']);
    // This was a callback request from Yahoo, get the token
    var_dump($token); die();
    // Send a request now that we have access token
    $result = json_decode($yahooService->request('profile'));
    echo 'result: <pre>' . print_r($result, true) . '</pre>';
} elseif (!empty($_GET['go']) && $_GET['go'] === 'go') {
    $url = $yahooService->getAuthorizationUri();
    header('Location: ' . $url);
} else {
    $url = $currentUri->getRelativeUri() . '?go=go';
    echo "<a href='$url'>Login with Yahoo!</a>";
}
