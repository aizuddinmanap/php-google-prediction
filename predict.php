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

$service = new Google_Service_Prediction($client);

$predictionText = 'How much did you spend on coffee this year?';
$predictionData = new Google_Service_Prediction_InputInput();
$predictionData->setCsvInstance(array($predictionText));

$input = new Google_Service_Prediction_Input();
$input->setInput($predictionData);
$hostedmodels = $service->trainedmodels->predict($project, 'languageidentifier', $input);

var_dump($hostedmodels);