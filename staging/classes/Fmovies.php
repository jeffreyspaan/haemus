<?php
require_once 'Watch.php';

class Fmovies extends Watch {

  public function getSearchUrl() {
    return 'https://www7.fmovies.se/search?keyword=';
  }

  public function getSearchRegex() {
    return '/<a\s+(?:[^>]*?\s+)?href=(["\'])(https:\/\/.*?)\1/m';
  }

  public function getMovieBaseUrl() {
    return 'https://www7.fmovies.se';
  }

  public function getMovieEndUrl() {
    return;
  }

}
