<?php
	for($j=1; $j<=$judge; $j++){ 
		for($x=$canNumMs+1; $x<=$canNumMs+$canNumMr; $x++){
			$less = 0;
			$great = 0;
			$equal = 0;
			for($i=$canNumMs+1; $i<=$canNumMs+$canNumMr; $i++){
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
			for($y=1; $y<=$canNumMr; $y++){
				$rank=$y;
				for($a=1; $a<=$y; $a++){
					if($great == ($canNumMr-$y) && $equal == $a){
						$rankcanMr{$x}{$j} = $rank;
					}
					$rank = ($rank - 0.5);
				}
			}

		}
	}

?>