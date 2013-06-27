<?php
/***
	@package	: Bing Rank Checker
	@author 	: M Teguh A Suandi
	@email 		: teguh.andro@gmail.com
	@license	: Creative Common License (http://creativecommons.org/licenses/by/3.0/)
*/
if(!class_exists('BingRankChecker'))
{
	class BingRankChecker
	{
		public $end;
		
		public function __construct($end=100)
		{
			$this->end		= $end;
		}

		public function bingFind($bingcountrycode="", $keyword)
		{			
			$i 	= 1;
			for($end=($this->end/$this->end);$end<=$this->end-9;$end+=10)
			{
				if(empty($bingcountrycode))
				{
					$cc 	= "";
				}
				else
				{
					$cc 	= "cc=".$bingcountrycode."&";
				}

				$keyword		= str_replace(" ","+",trim($keyword));
				$url			= "http://www.bing.com/search?".$cc."q=".$keyword."&first=".$end."";
				set_time_limit(900);
				$data			= file_get_contents($url);
				$j				= -1;
				
				while( ($j = stripos($data,"<cite>",$j+1)) !== false )
				{
					$k 			= stripos($data,"</cite>",$j);
					$link 		= strip_tags(substr($data,$j,$k-$j));
					$rank 		= $i++;
					$results[]	= array("rank" => $rank, "url" => $link);
				}
			}
			return $results;
		}
	}
}
?>