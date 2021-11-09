<?php # -*- coding: utf-8 -*-
/*
Plugin Name: HaveIBeenPwned Password
Author: rsae
*/

// API url
$HIBP_BASE_URI = 'https://api.pwnedpasswords.com';

// Define password
$password = "a";

// Hashed password
$hashedPassword = strtoupper(sha1($password));
$firstFiveCharacters = substr($hashedPassword, 0, 5);

// Complete url
$url = $HIBP_BASE_URI . "/range/" . $firstFiveCharacters;

// Start curl for request
$client = curl_init();
curl_setopt($client, CURLOPT_URL, $url);
curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
$allHashes = curl_exec($client);
curl_close($client);

$lines=explode("\n", $allHashes);

// Check all the results
foreach ($lines as $line) {
    [$hash, $count] = explode(':', $line);
// Find password hash and count compromised times
    if ($firstFiveCharacters . strtoupper($hash) === $hashedPassword) {
        echo "Password has been compromised " . $count . " times";
    }
}
?>
