<?php 
require __DIR__.'/vendor/autoload.php';

use OAuth\Common\Consumer\Credentials;
use OAuth\Common\Http\Uri\UriFactory;
use OAuth\OAuth2\Service\Foursquare;
use OAuth\Common\Storage\Session;
use OAuth\ServiceFactory;

error_reporting(E_ALL);
ini_set('display_errors', 1);

$uriFactory = new UriFactory();
$currentUri = $uriFactory->createFromSuperGlobalArray($_SERVER);
$currentUri->setQuery('');

$servicesCredentials = [
	'foursquare' => [
		'key' => 'RR2N1B2TMGLVSO4RDB0R0R3OPVDOFLUGNSW5KGX2KOLTXYDS',
		'secret' => 'IQW3BNF41RRE1JARFHMBVFKVKDVLY5JDMXN3QC3UU2MXLKEW'
	]
];

$storage = new Session();
// Setup the credentials for the requests
$credentials = new Credentials(
    $servicesCredentials['foursquare']['key'],
    $servicesCredentials['foursquare']['secret'],
    $currentUri->getAbsoluteUri()
);
// Instantiate the Foursquare service using the credentials, http client and storage mechanism for the token
/** @var $foursquareService Foursquare */
$serviceFactory = new ServiceFactory();
$foursquareService = $serviceFactory->createService('foursquare', $credentials, $storage);
if (!empty($_GET['code'])) {
    // This was a callback request from foursquare, get the token
    $foursquareService->requestAccessToken($_GET['code']);
    // Send a request with it
    $result = json_decode($foursquareService->request('users/self'), true);
    // Show some of the resultant data
    echo 'Your unique foursquare user id is: ' . $result['response']['user']['id'] . ' and your name is ' . $result['response']['user']['firstName'] . $result['response']['user']['lastName'];
} elseif (!empty($_GET['go']) && $_GET['go'] === 'go') {
    $url = $foursquareService->getAuthorizationUri();
    header('Location: ' . $url);
} else {
    $url = $currentUri->getRelativeUri() . '?go=go';
    echo "<a href='$url'>Login with Foursquare!</a>";
}