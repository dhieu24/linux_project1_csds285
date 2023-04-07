<?php 
    $json = file_get_contents('php://input');
    
    // decode the JSON data from front-end
    $data = json_decode($json);

    $q = $data->q;
    $qInTitle = $data->{'qInTitle'};
    $country = $data->{'country'};
    $category = $data->category;
    $language = $data->language;
    $domain = $data->domain;


    // create a map of keys and values for validation
    $arr = array(
        'q' => $q,
        'qInTitle' => $qInTitle,
        'country' => $country,
        'category' => $category,
        'language' => $language,
        'domain' => $domain
    );
    
    // fixed API key from Newsdata.io API provider. This field should come from the user if the application is scaled up
    $apiKey = "pub_19907fa17383b4f8fc3affc20b1e91390713b";
    // prepare the url for sending data
    $url = "https://newsdata.io/api/1/news?apikey=" . $apiKey;
    // loop over the map to validate each keys and values
    foreach ($arr as $key => $value) {
        if (!empty($value)) {
          $url .= "&" . $key . "=" . urlencode($value);
        }
    }

    // retrieve the response from the external API
    $response = file_get_contents($url);

    // convert the data into JSON format and return to the front-end for UI rendering
    $return_data = json_encode($response);
    echo $return_data;
?>