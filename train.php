<?php
require 'vendor/autoload.php';

$client_id = 'YOUR_CLIENT_ID';
$service_account_name = 'YOUR_SERVICE_ACCOUNT_NAME';
$key_file_location = 'LOCATION_OF_YOUR_P12_KEY_FILE_WITH_P12_EXTENSION';
$project = 'YOUR_PROJECT_NAME';

$client = new Google_Client();
$service = new Google_Service_Prediction($client);

$key = file_get_contents($key_file_location);
$cred = new Google_Auth_AssertionCredentials(
	$service_account_name, array('https://www.googleapis.com/auth/devstorage.full_control',
		'https://www.googleapis.com/auth/devstorage.read_only',
		'https://www.googleapis.com/auth/devstorage.read_write',
		'https://www.googleapis.com/auth/prediction'   
		),
	$key
);

$client->setAssertionCredentials($cred);

if($client->getAuth()->isAccessTokenExpired()) {
	$client->getAuth()->refreshTokenWithAssertion($cred);
}

$insert = new Google_Service_Prediction_Insert($client);

$insert->setId('languageidentifier');
$insert->setStorageDataLocation('mybucket/language_id.txt'); // A file in Cloud Storage, must be upload first
$result = $service->trainedmodels->insert($project, $insert);

var_dump($result);