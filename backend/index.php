<?php 
    $json = file_get_contents('php://input');
    // echo $json;
    $data = json_decode($json);

    $q = $data->q;
    $qInTitle = $data->{'qInTitle'};
    $country = $data->{'country'};
    $category = $data->category;
    $language = $data->language;
    $domain = $data->domain;

    $arr = array(
        'q' => $q,
        'qInTitle' => $qInTitle,
        'country' => $country,
        'category' => $category,
        'language' => $language,
        'domain' => $domain
    );
    
    $apiKey = "pub_19907fa17383b4f8fc3affc20b1e91390713b";
    $url = "https://newsdata.io/api/1/news?apikey=" . $apiKey;
    foreach ($arr as $key => $value) {
        if (!empty($value)) {
          $url .= "&" . $key . "=" . urlencode($value);
        }
    }

    // echo $url;
    $response = file_get_contents($url);


    // header('Content-Type: application/json');
    $return_data = json_encode($response);
    echo $return_data;


    // header('Location: .././result.html', json_encode($response));
    // echo $response;
?>