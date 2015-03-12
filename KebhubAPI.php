<?php

namespace APIKebhub\kebhub;

/**
 * Kebhub-API-PHP : Simple PHP calls to use Kebuhb API
 * 
 * PHP version 5.3.10
 * 
 * @category Awesomeness
 * @package  Kebhub-API-PHP
 * @author   Kebhub <contact@kebhub.com>
 * @license  MIT License
 * @link     https://github.com/guillaumebarranco/Kebhub-API
 */
class KebhubAPIGet
{
    private $client_id;
    private $secret_id;
    private $api_key;
    private $access_token;
    public $url;

    /**
     * Create the API access object. Requires an array of settings::
     * client_id, secret_id, api_key
     * These are all available by creating your own account on kebhub.com
     * Requires the cURL library
     * 
     * @param array $settings
     */
    public function __construct(array $settings) {

        if (!in_array('curl', get_loaded_extensions())) {
            return 'You need to install cURL, see: http://curl.haxx.se/docs/install.html';
        }
        
        if (!isset($settings['client_id']) && !isset($settings['secret_id']) && !isset($settings['api_key'])) {
            return 'Make sure you are passing in the correct parameters';
        }

        $this->client_id = $settings['client_id'];
        $this->secret_id = $settings['secret_id'];
        $this->api_key = $settings['api_key'];
    }
    
    public function getAccessToken() {

        $client_id = $this->client_id;
        $secret_id = $this->secret_id;
        $api_key = $this->api_key;

        $url_token = 'http://kebhub.com/oauth/v2/token?grant_type=http://kebhub.local/grants/api_key&client_id='.$client_id.'&client_secret='.$secret_id.'&api_key='.$api_key;

        $ch = curl_init($url_token);

        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $json = curl_exec($ch);

        curl_close($ch);

        $get_json = json_decode($json);
        
        $this->access_token = $get_json->access_token;

        return $this->access_token;
    }
    
    /**
     * Perform the actual data retrieval from the API
     * 
     * @param boolean $return If true, returns data.
     * 
     * @return string json If $return param is true, returns json data.
     */
    public function performRequest($url, $return = true) {

        if (!is_bool($return)) { 
            return 'performRequest parameter must be true or false'; 
        }

        $this->url = $url;

         $ch = curl_init($this->url);

        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $json = curl_exec($ch);

        curl_close($ch);

        if($return) { 
            return $json;
        }
    }
}
