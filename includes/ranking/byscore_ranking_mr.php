<?php
	for($x=$canNumMs+1; $x<=$canNumMs+$canNumMr; $x++){
		$less = 0;
		$great = 0;
		$equal = 0;
		for($i=$canNumMs+1; $i<=$canNumMs+$canNumMr; $i++){
				if($scoreMr{$x} < $scoreMr{$i}){
						$less = $less + 1;
				}
				if($scoreMr{$x} > $scoreMr{$i}){
						$great = $great + 1;
				}
				if($scoreMr{$x} == $scoreMr{$i}){
						$equal = $equal + 1;
				}
		}
		for($y=1; $y<=$canNumMr; $y++){
			$rank=$y;
			for($a=1; $a<=$y; $a++){
				if($great == ($canNumMr-$y) && $equal == $a){
					$rankscoreMr{$x} = $rank;
				}
				$rank = ($rank - 0.5);
			}
		}
	}

?>