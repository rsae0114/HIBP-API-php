<?php # -*- coding: utf-8 -*-
/*
Name: HaveIBeenPwned Account
Author: rsae
*/

// API url
$HIBP_BASE_URI = 'https://haveibeenpwned.com/api/v3/breachedaccount/';

$email = 'foo@bar.com';
$key = 'yourkey';

$encoded = urlencode($email);

$truncateResponse = '?truncateResponse=false';

// Complete url
$url = $HIBP_BASE_URI . $encoded . $truncateResponse;

$list = array("hibp-api-key: $key", "user-agent: Beyond the Frame");

$client = curl_init();
curl_setopt($client, CURLOPT_URL, $url);
curl_setopt($client, CURLOPT_HTTPHEADER, $list);
curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
$allData = curl_exec($client);
curl_close($client);

echo $allData;
?>
