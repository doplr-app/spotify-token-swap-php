# Spotify Token Swap PHP

## Installation
Simply require it with composer
`composer require emphaz/spotify-token-swap-php`

## Usage
```php
<?php

use emphaz\SpotifyTokenSwapper;

$tokenSwapper = new SpotifyTokenSwapper([
    'client_id' => '5865db6d15f808d916b77bed10993c2e',
    'secret' => '7f5e0e0041afbf6bcda64352f84f121f',
    'callback_url' => 'my-super-callback://callback'
]);

// If we received a token from some SDK, or other service
if(isset($_POST['code']))
{
    $data = $tokenSwapper->swapAuthCode($_POST['code']);
    var_dump($data);
    
    /*
    Outputs:
    (
        [access_token] => RANDOM_ACCESS_TOKEN
        [token_type] => Bearer
        [expires_in] => 3600
        [refresh_token] => RANDOM_REFRESH_TOKEN
        [scope] => user-follow-read user-read-email user-read-private
    )
     */
}
```