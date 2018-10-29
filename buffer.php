<?php
	$t_no = $_GET['t_no'];
	$date = $_GET['date'];
	echo $t_no."<br>";
	echo $date;
	$y = substr($date, 0,4);
	$m = substr($date, 5,2);
	$d = substr($date, 8,2);
	$new_date = $d."-".$m."-".$y;
	echo "<br>".$new_date;
	$url = "https://api.railwayapi.com/v2/live/train/".$t_no."/date/".$new_date."/apikey/4dx4jey0hh/";
	$data = file_get_contents($url);
	$json = json_decode($data,true);
	$res = $json['response_code'];
	echo "<br>".$res;
	echo "<br> Current Position : ".$json['position'];
	echo "<br>".$json['current_station']['name'];
	$i = 0;

	echo "<table border=2><tr><td>S.No.</td><td>Station Name</td><td>Late / early</td><td>Arrived/ Not</td></tr>";
	while(isset($json['route'][$i]['station']['name'])){
		$num = $i +1;
		echo "<tr><td>".$num."</td>";
		echo "<td>".$json['route'][$i]['station']['name']."</td>";
		echo "<td>".$json['route'][$i]['latemin']."</td>";
		if($json['route'][$i]['has_arrived']){
			echo "<td> Arrived </td>";
		}
		else{
			echo "<td>Not Arrived Yet</td>";
		}

		$i++;
		
	}
	echo "</table>";


?>