<?php 
require __DIR__.'/vendor/autoload.php';

use OAuth\Common\Consumer\Credentials;
use OAuth\Common\Http\Uri\UriFactory;
use OAuth\OAuth2\Service\GitHub;
use OAuth\Common\Storage\Session;
use OAuth\ServiceFactory;

error_reporting(E_ALL);
ini_set('display_errors', 1);

$uriFactory = new UriFactory();
$currentUri = $uriFactory->createFromSuperGlobalArray($_SERVER);
$currentUri->setQuery('');

$servicesCredentials = [
	'github' => [
		'key' => '49c7754e5230272fc775',
		'secret' => 'f2ca2b8cacf0261f86989667a3cebc24ecf6d2c8'
	]
];

$storage = new Session();
// Setup the credentials for the requests
$credentials = new Credentials(
    $servicesCredentials['github']['key'],
    $servicesCredentials['github']['secret'],
    $currentUri->getAbsoluteUri()
);
// Instantiate the GitHub service using the credentials, http client and storage mechanism for the token
/** @var $gitHub GitHub */
$serviceFactory = new ServiceFactory();
$gitHub = $serviceFactory->createService('GitHub', $credentials, $storage, array('user'));
if (!empty($_GET['code'])) {
    // This was a callback request from github, get the token
    $gitHub->requestAccessToken($_GET['code']);
    $result = json_decode($gitHub->request('user'), true);
    $_SESSION['app'] = 'Github';
    $_SESSION['data'] = [
        'id' => $result['id'],
        'name' => $result['name'],
        'login_name' => $result['login'],
        'email' => $result['email'],
        'followers' => $result['followers']
    ];
    setcookie('is_logged_in',1, time() + (86400 * 30), "/");
    $url = 'success.php';
    header('Location: ' . $url);
} else {
    $url = $gitHub->getAuthorizationUri();
    header('Location: ' . $url);
}