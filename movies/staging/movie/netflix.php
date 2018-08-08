<?php

function stringWithDashes($string) {
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

function getPage($url) {
  $options = array(
      CURLOPT_RETURNTRANSFER => true,     // return web page
      CURLOPT_HEADER         => false,    // don't return headers
      CURLOPT_FOLLOWLOCATION => true,     // follow redirects
      CURLOPT_ENCODING       => "",       // handle all encodings
      CURLOPT_USERAGENT      => "spider", // who am i
      CURLOPT_AUTOREFERER    => true,     // set referer on redirect
      CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
      CURLOPT_TIMEOUT        => 120,      // timeout on response
      CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
      CURLOPT_SSL_VERIFYPEER => false     // Disabled SSL Cert checks
  );

  $ch = curl_init( $url );
  curl_setopt_array( $ch, $options );
  $content = curl_exec( $ch );
  $err     = curl_errno( $ch );
  $errmsg  = curl_error( $ch );
  $header  = curl_getinfo( $ch );
  curl_close( $ch );

  $header['errno']   = $err;
  $header['errmsg']  = $errmsg;
  $header['content'] = $content;
  return $header['content'];
}

function getHrefInPage($base_url) {
  $title = $_POST['title'];
  $year = $_POST['year'];

  $url = $base_url . stringWithDashes($title) . '-' . $year;
  $pageContent = getPage($url);

  $result = '';
  $regex = '/<a\s+(?:[^>]*?\s+)?href=(["\'])https:\/\/www\.netflix\.com(.*?)\1/m';
  preg_match_all($regex, $pageContent, $result, PREG_SET_ORDER, 0);

  return $result;
}

function getNetflixURl() {
  $result1 = getHrefInPage('https://www.netflix-nederland.nl/netflix-originals/');
  $result2 = getHrefInPage('https://www.netflix-nederland.nl/aanbod-netflix-nederland/');
  if ($result1) {
    return array('url' => 'https://www.netflix.com' . $result1[0][2]);
  } else if ($result2) {
    return array('url' => 'https://www.netflix.com' . $result2[0][2]);
  } else {
    return false;
  }

}



echo json_encode(getNetflixURl());
















?>
