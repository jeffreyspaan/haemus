<?php

require_once 'CurlClient.php';

abstract class Watch
{
    private $movie_title;

    abstract function getSearchUrl();

    abstract function getSearchRegex();

    abstract function getMovieBaseUrl();

    abstract function getMovieEndUrl();

    public function __construct($movie_title)
    {
        $this->movie_title = $movie_title;
    }

    public function getMovieTitle()
    {
        return urlencode($this->movie_title);
    }

    public function getPartialUrl()
    {
        $result = [];
        preg_match_all($this->getSearchRegex(), $this->getPageContent(), $result, PREG_SET_ORDER, 0);
        return $result[0][2];
    }

    public function getFullMovieUrl()
    {
        return $this->getMovieBaseUrl() . $this->getPartialUrl() . $this->getMovieEndUrl();
    }

    public function getPageContent()
    {
        $url = $this->getSearchUrl() . $this->getMovieTitle();
        return CurlClient::get($url);
    }
}


// $movie_online = new Watch($_GET['title'], 'https://www2.movieonline.tv/movie/search.html?keyword=', '/<a\s+(?:[^>]*?\s+)?href=(["\'])(\/movies.*)\1/m', 'https://www2.movieonline.tv' );

// echo $movie_online->redirect();


?>
