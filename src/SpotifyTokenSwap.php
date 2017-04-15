<?php

namespace emphaz;

class SpotifyTokenSwap
{
    private $spotifyClientID;
    private $spotifySecret;
    private $spotifyCallbackURL;

    /**
     * Constructs the Spotify Token Swapper
     * @param {Array} $config An array containing the 'client_id', 'secret' and 'callback_url' fields
     */
    public function __construct($config)
    {
        // If one of the configuration item is missing, throw an error
        if(!isset($config['client_id']) || !isset($config['secret']) || !isset($config['callback_url']))
            throw new InvalidArgumentException("The 'client_id', 'secret' and 'callback_url' are required in the configuration array");

        $this->spotifyClientID = $config['client_id'];
        $this->spotifySecret = $config['secret'];
        $this->spotifyCallbackURL = $config['callback_url'];
    }

    /**
     * Swap an auth code for an access token & a refresh token
     * @param  {String} $authCode The auth code as provided by the Spotify API
     * 
     * @return {Array} An array containing the 'access_token', 'token_type', 
     *                 'expires_in', 'refresh_token' and 'scope' fields
     */
    public function swapAuthCode($authCode)
    {
        $ch = curl_init("https://accounts.spotify.com/api/token");
        
        // Uses POST verb
        curl_setopt($ch, CURLOPT_POST, 1);

        // Binds the right parameters
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
            'grant_type' => 'authorization_code',
            'client_id' => $this->spotifyClientID,
            'client_secret' => $this->spotifySecret,
            'redirect_uri' => $this->spotifyCallbackURL,
            'code' => $authCode,
        ]));

        // Prevents output (to check)
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // Executes the request
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response);
    }
}