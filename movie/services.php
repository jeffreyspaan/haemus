<?php

// https://www.moviemeter.nl/film/1115890

echo json_encode(@getServicesURL());


function getServicesURL()
{
    $id = $_POST['id'];
    $title = $_POST['title'];
    $titleCleaned = stringWithoutDashes($title);
    $query = urlencode($title);

    $servicesURL = array('netflix' => false, 'ziggo' => false, 'videoland' => false, 'amazonPrime' => false, 'patheThuis' => false, 'film1' => false, 'ziggoGo' => false, 'googlePlay' => false, 'patheCinema' => false);

    $moviemeterURL = 'https://www.moviemeter.nl/film/' . $id . '/info';
    $moviemeterContent = getPage($moviemeterURL);

    // Netflix

    $netflixResult;
    $netflixRegex = '/<a\s+(?:[^>]*?\s+)?href=(["\'])https:\/\/www\.netflix\.com(.*?)\1/m';
    preg_match_all($netflixRegex, $moviemeterContent, $netflixResult, PREG_SET_ORDER, 0);
    if ($netflixResult) {
        $servicesURL['netflix'] = 'https://www.netflix.com' . $netflixResult[0][2];
    }

    // Ziggo Movies & Series

    $ziggoResult;
    $ziggoRegex = '/<a\s+(?:[^>]*?\s+)?href=(["\'])https:\/\/www\.ziggo\.nl(.*?)\1/m';
    preg_match_all($ziggoRegex, $moviemeterContent, $ziggoResult, PREG_SET_ORDER, 0);
    if ($ziggoResult) {
        $servicesURL['ziggo'] = 'https://www.ziggo.nl' . $ziggoResult[0][2];
    }

    // Videoland

    $videolandResult;
    $videolandRegex = '/<a\s+(?:[^>]*?\s+)?href=(["\'])https:\/\/www\.videoland\.com(.*?)\1/m';
    preg_match_all($videolandRegex, $moviemeterContent, $videolandResult, PREG_SET_ORDER, 0);
    if ($videolandResult) {
        $servicesURL['videoland'] = 'https://www.videoland.com' . $videolandResult[0][2];
    }

    // Amazon prime

    $amazonPrimeResult;
    $amazonPrimeRegex = '/<a\s+(?:[^>]*?\s+)?href=(["\'])https:\/\/www\.primevideo\.com(.*?)\1/m';
    preg_match_all($amazonPrimeRegex, $moviemeterContent, $amazonPrimeResult, PREG_SET_ORDER, 0);
    if ($amazonPrimeResult) {
        $servicesURL['amazonPrime'] = 'https://www.primevideo.com' . $amazonPrimeResult[0][2];
    }

    // Pathé Thuis

    $patheThuisResult;
    $patheThuisRegex = '/<a\s+(?:[^>]*?\s+)?href=(["\'])https:\/\/www\.pathe-thuis\.nl\/film(.*?)\1/m';
    preg_match_all($patheThuisRegex, $moviemeterContent, $patheThuisResult, PREG_SET_ORDER, 0);
    if ($patheThuisResult) {
        $servicesURL['patheThuis'] = 'https://www.pathe-thuis.nl/film' . $patheThuisResult[0][2];
    }

    // Film 1

    $film1SearchURL = 'https://www.film1.nl/zoek/?q=' . $query;
    $film1Content = getPage($film1SearchURL);

    $film1Result;
    $film1Regex = '/<a\s+(?:[^>]*?\s+)?href=(["\'])\/films(.*?)\1/m';
    preg_match_all($film1Regex, $film1Content, $film1Result, PREG_SET_ORDER, 0);
    if ($film1Result) {
        $film1Title = explode("-", $film1Result[0][2], 2); // cut off '/title/'
        $film1Title = explode(".", $film1Title[1], 2); // cut off '.html'
        $film1TitleCleaned = stringWithoutDashes($film1Title[0]); // make ready for comparison
        if ($film1TitleCleaned == $titleCleaned) {
            $servicesURL['film1'] = 'https://www.film1.nl/films' . $film1Result[0][2];
        }
    }

    // ZiggoGo Movies & Series XL

    $ziggoGoSearchURL = 'https://web-api-pepper.horizon.tv/oesp/v2/NL/nld/web/search/content?byCatalog=providers%2CtvPrograms%2CmoviesAndSeries&numItems=96&personalised=false&q=' . $query;
    $ZiggoGoRawResult = file_get_contents($ziggoGoSearchURL);
    $ziggoGoResult = json_decode($ZiggoGoRawResult, true);

    if ($ziggoGoResult['moviesAndSeries']['entries']) {
        $ziggoGoId = urlencode($ziggoGoResult['moviesAndSeries']['entries'][0]['id']);
        $ziggoGoTitle = $ziggoGoResult['moviesAndSeries']['entries'][0]['title'];
        $ziggoGoTitleCleaned = stringWithoutDashes($ziggoGoTitle);
        $ziggoGoTitleCleanedWithDashes = stringWithDashes($ziggoGoTitle);

        if ($ziggoGoTitleCleaned == $titleCleaned || $ziggoGoTitleCleaned == $titleCleaned . ' nl' || $ziggoGoTitleCleaned == $titleCleaned . ' ov') {
            $ziggoGoURL = 'https://www.ziggogo.tv/nl/movies-series-xl/vod-asset.html/' . $ziggoGoId . '/' . $ziggoGoTitleCleanedWithDashes . '.html';
            $servicesURL['ziggoGo'] = $ziggoGoURL;
        } else if ($ziggoGoResult['moviesAndSeries']['entries'][1]) {

            $ziggoGoId2 = urlencode($ziggoGoResult['moviesAndSeries']['entries'][1]['id']);
            $ziggoGoTitle2 = $ziggoGoResult['moviesAndSeries']['entries'][1]['title'];
            $ziggoGoTitle2Cleaned = stringWithoutDashes($ziggoGoTitle2);
            $ziggoGoTitle2CleanedWithDashes = stringWithDashes($ziggoGoTitle2);

            if ($ziggoGoTitle2Cleaned == $titleCleaned || $ziggoGoTitle2Cleaned == $titleCleaned . ' nl' || $ziggoGoTitle2Cleaned == $titleCleaned . ' ov') {
                $ziggoGoURL = 'https://www.ziggogo.tv/nl/movies-series-xl/vod-asset.html/' . $ziggoGoId2 . '/' . $ziggoGoTitle2CleanedWithDashes . '.html';
                $servicesURL['ziggoGo'] = $ziggoGoURL;
            }
        }
    }

    // Google play

    $googlePlaySearchURL = 'https://play.google.com/store/search?q=' . $query . '&c=movies';
    $googlePlayContent = getPage($googlePlaySearchURL);

    $googlePlayResult;
    $googlePlayRegex = '/<a\s+(?:[^>]*?\s+)?href=(["\'])\/store\/movies\/details\/(.*?)\1/m';
    preg_match_all($googlePlayRegex, $googlePlayContent, $googlePlayResult, PREG_SET_ORDER, 0);
    if ($googlePlayResult) {
        $googlePlayPartialUrl = $googlePlayResult[0][2]; // e.g. /Tomb_Raider?id=Lyr-0MdFibU
        $googlePlayTitle = explode("?", $googlePlayPartialUrl, 2)[0]; // cut off '?id=Lyr-0MdFibU'
        $googlePlayTitleCleaned = stringWithoutDashes($googlePlayTitle); // make ready for comparison

        if ($googlePlayTitleCleaned == $titleCleaned) {
            $servicesURL['googlePlay'] = 'https://play.google.com/store/movies/details/' . $googlePlayPartialUrl;
        }
    }

    // Pathé bioscooop

    $patheCinemaSearchURL = 'https://www.pathe.nl/Search/QuickSearch?q=' . $query;
    $patheCinemaContent = getPage($patheCinemaSearchURL);

    $patheCinemaResult;
    $patheCinemaRegex = '/<a\s+(?:[^>]*?\s+)?href=(["\'])https:\/\/www\.pathe\.nl\/film\/(.*?)\1/m';
    preg_match_all($patheCinemaRegex, $patheCinemaContent, $patheCinemaResult, PREG_SET_ORDER, 0);
    if ($patheCinemaResult) {
        $patheCinemaPartialUrl = $patheCinemaResult[0][2]; // e.g. 22697/mission-impossible-fallout
        $patheCinemaTitle = explode("/", $patheCinemaPartialUrl, 2)[1]; // cut off '22697'
        $patheCinemaTitleCleaned = stringWithoutDashes($patheCinemaTitle); // make ready for comparison

        if ($patheCinemaTitleCleaned == $titleCleaned) {
            $servicesURL['patheCinema'] = 'https://www.pathe.nl/film/' . $patheCinemaPartialUrl;
        }
    }


    return $servicesURL;

}

function getPage($url)
{
    $options = array(
        CURLOPT_RETURNTRANSFER => true,     // return web page
        CURLOPT_HEADER => false,    // don't return headers
        CURLOPT_FOLLOWLOCATION => true,     // follow redirects
        CURLOPT_ENCODING => "",       // handle all encodings
        CURLOPT_USERAGENT => "spider", // who am i
        CURLOPT_AUTOREFERER => true,     // set referer on redirect
        CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
        CURLOPT_TIMEOUT => 120,      // timeout on response
        CURLOPT_MAXREDIRS => 10,       // stop after 10 redirects
        CURLOPT_SSL_VERIFYPEER => false     // Disabled SSL Cert checks
    );

    $ch = curl_init($url);
    curl_setopt_array($ch, $options);
    $content = curl_exec($ch);
    $err = curl_errno($ch);
    $errmsg = curl_error($ch);
    $header = curl_getinfo($ch);
    curl_close($ch);

    $header['errno'] = $err;
    $header['errmsg'] = $errmsg;
    $header['content'] = $content;
    return $header['content'];
}

function stringWithoutDashes($string)
{
    //Lower case everything
    $string = strtolower($string);
    //Make alphanumeric (removes all other characters)
    $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
    //Clean up multiple dashes or whitespaces
    $string = preg_replace("/[\s-]+/", " ", $string);
    //Convert underscores to whitespaces
    $string = preg_replace("/[_]/", " ", $string);
    return $string;
}

function stringWithDashes($string)
{
    //Lower case everything
    $string = strtolower($string);
    //Make alphanumeric (removes all other characters)
    $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
    //Clean up multiple dashes or whitespaces
    $string = preg_replace("/[\s-]+/", " ", $string);
    //Convert whitespaces and underscore to dash
    $string = preg_replace("/[\s_]/", "-", $string);
    return $string;
}


?>
