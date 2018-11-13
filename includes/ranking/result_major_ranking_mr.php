<?php
	for($z=1; $z<=$judge; $z++){
	for($x=$canNumMs+1; $x<=$canNumMs+$canNumMr; $x++){
		$less = 0;
		$great = 0;
		$equal = 0;
		for($i=$canNumMs+1; $i<=$canNumMs+$canNumMr; $i++){
				if($s{$z}{$x} < $s{$z}{$i}){
						$less = $less + 1;
				}
				if($s{$z}{$x} > $s{$z}{$i}){
						$great = $great + 1;
				}
				if($s{$z}{$x} == $s{$z}{$i}){
						$equal = $equal + 1;
				}
		}
		for($y=1; $y<=$canNumMr; $y++){
			$rank=$y;
			for($a=1; $a<=$y; $a++){
				if($great == ($canNumMr-$y) && $equal == $a){
					$rankcanMr{$z}{$x} = $rank;
				}
				$rank = ($rank - 0.5);
			}
		}
	}
	}

?>