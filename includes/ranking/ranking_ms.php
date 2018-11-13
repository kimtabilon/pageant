<?php
	for($j=1; $j<=$judge; $j++){ 
		for($x=1; $x<=$canNumMs; $x++){
			$less = 0;
			$great = 0;
			$equal = 0;
			for($i=1; $i<=$canNumMs; $i++){
					if($s{$x}{$j} < $s{$i}{$j}){
							$less = $less + 1;
					}
					if($s{$x}{$j} > $s{$i}{$j}){
							$great = $great + 1;
					}
					if($s{$x}{$j} == $s{$i}{$j}){
							$equal = $equal + 1;
					}
			}
			for($y=1; $y<=$canNumMs; $y++){
				$rank=$y;
				for($a=1; $a<=$y; $a++){
					if($great == ($canNumMs-$y) && $equal == $a){
						$rankcanMs{$x}{$j} = $rank;
					}
					$rank = ($rank - 0.5);
				}
			}

		}
	}

?>