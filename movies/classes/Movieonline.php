<?php
require_once 'Watch.php';

class Movieonline extends Watch {

  public function getSearchUrl() {
    return 'https://www2.movieonline.tv/movie/search.html?keyword=';
  }

  public function getSearchRegex() {
    return '/<a\s+(?:[^>]*?\s+)?href=(["\'])(\/movies.*)\1/m';
  }

  public function getMovieBaseUrl() {
    return 'https://www2.movieonline.tv';
  }

  public function getMovieEndUrl() {
    return;
  }

}
