# Kebhub-API
A Repository for out Kebhub API utilisation


<code>
    $settings = array(
        'client_id' => "YOUR CLIENT ID",
        'secret_id' => "YOUR SECRET ID",
        'api_key' => "YOUR API KEY"
    );

    $type = 'twitter'; // choices : "twitter", "instagram", "all"
    $fields = 'all'; // choices : "text, picture, date, title, type, link" OR "all"
    $limit = '3'; // choices every number more than "0"

    $kebhub = new KebhubAPIGet($settings); // Launch the API class with your settings

    $access_token = $kebhub->getAccessToken(); // Get your access token 

    $url = 'http://kebhub.com/api/get/'.$type.'/'.$limit.'/'.$fields.'?access_token='.$access_token; 
    // Make the url request with your settings and     access_token

    $json = $kebhub->performRequest($url, true); // ¨Perform the request and it's done !
    $datas = json_decode($json, true);
</code>

