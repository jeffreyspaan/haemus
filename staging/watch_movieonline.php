<?php

// get Movieonline.tv watch link

function get_web_page($movie_title)
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

    $url = 'https://www2.movieonline.tv/movie/search.html?keyword=' . $movie_title;
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
    return $header;
}

$movie_title = $_GET['title'];

$page_content = get_web_page($movie_title)['content'];

$get_movie_href_regex = '/<a\s+(?:[^>]*?\s+)?href=(["\'])(\/movies.*)\1/m';
preg_match_all($get_movie_href_regex, $page_content, $matches, PREG_SET_ORDER, 0);
$movie_link = $matches[0][2];

$full_movie_link = 'https://www2.movieonline.tv' . $movie_link;

header("Location: " . $full_movie_link);

?>
