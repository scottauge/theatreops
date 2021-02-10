<?php

// $Header: file:///Users/scottauge/Documents/SVN/theatre/incTimeDiff.php 22 2019-07-13 02:04:19Z scottauge $

function TimeDiff ($date1, $date2) {
	
			$datetime1 = new DateTime($date1);
			$datetime2 = new DateTime($date2);
			$interval = $datetime1->diff($datetime2);
			$interval = $interval->format('%R%a');
			return $interval;
}

?>