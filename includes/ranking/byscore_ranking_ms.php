<?php
	for($x=1; $x<=$canNumMs; $x++){
		$less = 0;
		$great = 0;
		$equal = 0;
		for($i=1; $i<=$canNumMs; $i++){
				if($score{$x} < $score{$i}){
						$less = $less + 1;
				}
				if($score{$x} > $score{$i}){
						$great = $great + 1;
				}
				if($score{$x} == $score{$i}){
						$equal = $equal + 1;
				}
		}
		for($y=1; $y<=$canNumMs; $y++){
			$rank=$y;
			for($a=1; $a<=$y; $a++){
				if($great == ($canNumMs-$y) && $equal == $a){
					$rankscoreMs{$x} = $rank;
				}
				$rank = ($rank - 0.5);
			}
		}
	}

?>