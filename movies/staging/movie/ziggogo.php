<?php


// function getZiggoGoURL() {
//   $title = $_POST['title'];
//   $query = urlencode($title);
//
//   $json_string = 'https://web-api-pepper.horizon.tv/oesp/v2/NL/nld/web/search/content?byCatalog=providers%2CtvPrograms%2CmoviesAndSeries&numItems=96&personalised=false&q=' . $query;
//
//   $jsondata = file_get_contents($json_string);
//   $obj = json_decode($jsondata, true);
//   if ($obj['moviesAndSeries']['entries'][0]['title']) {
//     $ziggoTitle =  $obj['moviesAndSeries']['entries'][0]['title'];
//     $ziggoTitle2 =  $obj['moviesAndSeries']['entries'][1]['title'];
//   } else {
//     return false;
//   }
//
//
//   if ($ziggoTitle == $title || $ziggoTitle == $title . ' (NL)' || $ziggoTitle == $title . ' (OV)') {
//     $ziggoTitle = str_replace(' ', '-', $ziggoTitle);
//     $ziggoTitle = preg_replace('/[^A-Za-z0-9\-]/', '', $ziggoTitle);
//     return 'https://www.ziggogo.tv/nl/movies-series-xl/vod-asset.html/' . urlencode($obj['moviesAndSeries']['entries'][0]['id']) . '/' . $ziggoTitle . '.html';
//   } else if ($ziggoTitle2 == $title || $ziggoTitle2 == $title . ' (NL)' || $ziggoTitle2 == $title . ' (OV)') {
//     $ziggoTitle2 = str_replace(' ', '-', $ziggoTitle2);
//     $ziggoTitle2 = preg_replace('/[^A-Za-z0-9\-]/', '', $ziggoTitle2);
//     return 'https://www.ziggogo.tv/nl/movies-series-xl/vod-asset.html/' . urlencode($obj['moviesAndSeries']['entries'][1]['id']) . '/' . $ziggoTitle2 . '.html';
//   } else {
//     return false;
//   }
//
//
// }
//
// echo @getZiggoGoURL();

// echo  $_POST['title'];


?>
