<?php
require __DIR__.'/vendor/autoload.php';

use OAuth\Common\Consumer\Credentials;
use OAuth\Common\Http\Uri\UriFactory;
use OAuth\Common\Storage\Session;
use OAuth\OAuth2\Service\Dropbox;
use OAuth\ServiceFactory;

// Show errors when testing
error_reporting(E_ALL);
ini_set('display_errors', 1);

$uriFactory = new UriFactory();
$currentUri = $uriFactory->createFromSuperGlobalArray($_SERVER);
$currentUri->setQuery('');

$servicesCredentials = [
    'dropbox' => [
        'key'    => '12v4ktjzj701vua',
        'secret' => '5zzxpl3qsba5hef'
    ]
];

// Session storage
$storage = new Session();

// Setup the credentials for the requests
$credentials = new Credentials(
    $servicesCredentials['dropbox']['key'],
    $servicesCredentials['dropbox']['secret'],
    $currentUri->getAbsoluteUri()
);


// Instantiate the Dropbox service using the credentials, http client and storage mechanism for the token
/** @var $dropboxService Dropbox */
$serviceFactory = new ServiceFactory();
$dropboxService = $serviceFactory->createService('dropbox', $credentials, $storage, array());

if (!empty($_GET['code'])) {
    // This was a callback request from Dropbox, get the token
    $token = $dropboxService->requestAccessToken($_GET['code']);
    // Send a request with it
    $result = json_decode($dropboxService->request('/account/info'), true);
    // Show some of the resultant data
    session_start();
    $_SESSION['name'] = $result['display_name'];
    $url = 'success.php';
    header('Location: ' . $url);
    exit;
 
} else {
    $url = $dropboxService->getAuthorizationUri();
    header('Location: ' . $url);
}
