<?php
require_once 'Watch.php';

class Gomovies extends Watch
{

    public function getSearchUrl()
    {
        return 'https://www.gomovieshub.se/search?kw=';
    }

    public function getSearchRegex()
    {
        return '/<a\s+(?:[^>]*?\s+)?class=(?:["])afterglow\spost-thumb\sml-mask(?:["])(?:\s)(href=)(?:["])(.*?)(?:["])/m';
    }

    public function getMovieBaseUrl()
    {
        return;
    }

    public function getMovieEndUrl()
    {
        return '/streamin.html';
    }

}
