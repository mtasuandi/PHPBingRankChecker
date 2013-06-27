<?php
include("BingRankChecker.class.php");
$RankChecker 	= new BingRankChecker(100);
$run			= $RankChecker->bingFind('id', 'mtasuandi');
var_dump($run);
?>