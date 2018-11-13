<?php
	require_once("../connections.php");
	require_once("../function.php");
	
	if(isset($_GET['type'])){
		$time=findData('timer','candidate',$_GET['pair']);
		$timer=mysql_fetch_array($time);
		if($_GET['type']=="start"){
			$can=$_GET['pair'];
			$start_t=time();
			$end_t=0;
			if(mysql_num_rows($time)==0){
				$newTime="INSERT INTO timer(candidate,start_t,end_t)VALUES('{$can}','{$start_t}','$end_t')";
				$query=mysql_query($newTime);
			}else{
				$endTime="UPDATE timer SET end_t='0' WHERE candidate='{$can}'";
				$query=mysql_query($endTime);	
			}
		}elseif($_GET['type']=="end" && $timer[3]==0 && mysql_num_rows($time)!=0){
			$end_t=time();
			$can=$_GET['pair'];
			$endTime="UPDATE timer SET end_t='{$end_t}' WHERE candidate='{$can}'";
			$query=mysql_query($endTime);
		}else{
			$sql="DELETE FROM timer";
			$query=mysql_query($sql);
		}
	}
	if(isset($_GET['candidate'])){
		$timer=findData('timer','candidate',$_GET['candidate']);
		if(mysql_num_rows($timer)!=0){
			$time=mysql_fetch_array($timer);
			if($time[3]==0){
				$start_time = gmdate('i:s', time() - $time[2]);
				echo "<font color='red'>".$start_time."</font>";
			}else{ 
				$end_time = gmdate('i:s', $time[3] - $time[2]);
				echo "<b>".$end_time."</b>";
				if($end_time){
					
				}
			}
		}else{
			echo "00:00";	
		}
	}
	
	
?>