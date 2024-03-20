<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "ecommerce";
$conn = mysqli_connect($servername, $username, $password, $database) or die("Connection Failed!");

$BASE_URL = "http://localhost/ecommerce";

function ENC($string, $action = 'encrypt'){
  $encrypt_method = "AES-256-CBC";
  $secret_key = 'ZvOLdaDY4222yxiAVQuD3xg9bjbJ'; // user define private key
  $secret_iv = 'B7hm482C0zj'; // user define secret key
  $key = hash('sha256', $secret_key);
  $iv = substr(hash('sha256', $secret_iv), 0, 16); // sha256 is hash_hmac_algo
  if ($action == 'encrypt') {
    $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
    $output = base64_encode($output);
  } else if ($action == 'decrypt') {
    $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
  }
  return $output;
}