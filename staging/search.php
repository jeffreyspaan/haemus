<?php
include("connection.php");

$end_result = array("error"=>"0", "errortext"=>"", "ids"=>"");
// error: 0 > no error, error: 1 > no data, error: 2 > minimum lenght

$query = $_GET['query'];
const MIN_QUERY_LENGTH = 1;

if(strlen($query) >= MIN_QUERY_LENGTH){ // if query length is more or equal minimum length then

        $query = htmlspecialchars($query);
        // changes characters used in html to their equivalents, for example: < to &gt;

        $query = mysqli_real_escape_string($con, $query);
        // makes sure nobody uses SQL injection

        $raw_results = mysqli_query($con, "SELECT * FROM `movies`
             WHERE (`title` LIKE '%".$query."%')") or die(mysql_error());
            // WHERE `title` = `test` ") or die(mysql_error());



        // * means that it selects all fields, you can also write: `id`, `title`, `text`
        // articles is the name of our table

        // '%$query%' is what we're looking for, % means anything, for example if $query is Hello
        // it will match "hello", "Hello man", "gogohello", if you want exact match use `title`='$query'
        // or if you want to match just full word so "gogohello" is out use '% $query %' ...OR ... '$query %' ... OR ... '% $query'

        if(mysqli_num_rows($raw_results) > 0){ // if one or more rows are returned do following

            $ids = array();

            while($results = mysqli_fetch_array($raw_results)){
            // $results = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop

                array_push($ids, $results['id']);
                // posts results gotten from database(title and text) you can also show id ($results['id'])
            }

            $json_ids = "&ids[]=" . implode("&ids[]=",$ids);
            $end_result['ids'] = $json_ids;

            echo json_encode($end_result);


        }
        else{ // if there is no matching rows do following
            $end_result['error'] = 1;
            $end_result['errortext'] = "Er zijn geen resultaten.";
            echo json_encode($end_result);
        }

    }
    else{ // if query length is less than minimum
        $end_result['error'] = 2;
        $end_result['errortext'] = "Vul minimaal " . MIN_QUERY_LENGTH . " karakters in.";
        echo json_encode($end_result);
    }

?>
