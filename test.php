<?php

require_once('src/SpotifyTokenSwap.php');

$sts = new emphaz\SpotifyTokenSwap([
    'client_id' => 'd38b33a97aec4711815b66944d6ee088',
    'secret' => 'ff3bbb58a0394f06a5ec36fa4c7bafdd',
    'callback_url' => 'emphaz-app-login://callback',
]);

if(isset($_POST['code']))
{
    $response = $sts->swapAuthCode($_POST['code']);
    error_log(print_r($response, true));
}