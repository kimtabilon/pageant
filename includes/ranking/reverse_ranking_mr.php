<?php
	for($x=$canNumMs+1; $x<=$canNumMs+$canNumMr; $x++){
		$less = 0;
		$great = 0;
		$equal = 0;
		for($i=$canNumMs+1; $i<=$canNumMs+$canNumMr; $i++){
				if($score_rank{$x} < $score_rank{$i}){
						$less = $less + 1;
				}
				if($score_rank{$x} > $score_rank{$i}){
						$great = $great + 1;
				}
				if($score_rank{$x} == $score_rank{$i}){
						$equal = $equal + 1;
				}
		}
		for($y=1; $y<=$canNumMr; $y++){
			$rank=$y;
			for($a=1; $a<=$y; $a++){
				if($less == ($canNumMr-$y) && $equal == $a){
					$rankMr{$x} = $rank;
				}
				$rank = ($rank - 0.5);
			}
		}
	}

?>