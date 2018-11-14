<?php
	require_once("../includes/connections.php");
	require_once("../includes/function.php");
	include("../includes/candidate.php");
	echo "<h2>" . $_GET['category_score'] . "</h2><br>"; 
?>
<div class="cat_score_area" id="major" align="center">
<div id="exit"><a href="index.php"><img src="../includes/images/cross.png" /> close</a></div>
<br /><br /><table width="600">
  <tr>
    <th width="125" bgcolor="#06C" scope="col">&nbsp;</th>
    <?php 
	for($jn=1; $jn<=$judge; $jn++){ ?><th width="50" <?php 
		echo mysqli_num_rows(findData('save_result','judge',$jn,'category',$_GET['category_score']))==$canNumMs+$canNumMr?
		"bgcolor='#06C'":"bgcolor='#F33'"; 
	?> scope="col">
		<a href="../?judge=<?=$jn?>&category=<?=urlencode($_GET['category_score'])?>&points=10" 
			onclick="window.open(this.href, 'Print', 'left=20,top=20,width=900,height=600,toolbar=1,resizeble=0'); return false;" 
			style="font-size:9pt; font-weight:normal; color:#fff;">
			<?php echo $config['judge'][$jn]['name']; ?>
		</a></th>
    <?php 
	} 
	?>	
    <th width="50" scope="col" bgcolor="#06C">TOTAL</th>
    <th width="50" scope="col" bgcolor="#06C">RANK</th>
  </tr>
  <?php
	if(isset($canNumMs)&&$canNumMs!=0){ echo "<tr><td align='center'>Female</td></tr>";
	for($x=1; $x<=$canNumMs; $x++){ $score{$x} = 0;
	for($jn=1; $jn<=$judge; $jn++){ $score{$x} = $score{$x} + score($_GET['category_score'], $jn, $x, "save_result"); } }
	require_once("../includes/ranking/byscore_ranking_ms.php");
	for($i=1; $i<=$canNumMs; $i++){
	for($jn=1; $jn<=$judge; $jn++){ $j{$jn} = score($_GET['category_score'], $jn, $i, "save_result"); }
	?>
    <tr>
        <td width="180"><i><font size="+1">Candidate # </font><font size="+2"><b><?php echo $i; ?></b></font></i></td>
        <?php for($jn=1; $jn<=$judge; $jn++){ ?><td align="center"><font size="+2"><?php echo $j{$jn} == ""?"<font color='#999999'>". 0 ."</font>":$j{$jn}; ?></font></td><?php } ?>
        <td align="center"><font size="+2">
        <?php $totalscore=0; for($jn2=1; $jn2<=$judge; $jn2++){ $totalscore = $totalscore + score($_GET['category_score'], $jn2, $i, "save_result"); } echo $totalscore == 0?"<font color='#999999'>". 0 ."</font>":$totalscore; ?></font></td>
        <td align="center"><font size="+2"><?php echo $totalscore == 0?"<font color='#999999'>". 0 ."</font>":$rankscoreMs{$i}; ?></font></td>
    </tr>
	<?php 
	}
	}
	if(isset($canNumMr)&&$canNumMr!=0){ echo "<tr><td align='center'>Male</td></tr>";
	for($x=$canNumMs+1; $x<=$canNumMs+$canNumMr; $x++){ $scoreMr{$x} = 0;
	for($jn=1; $jn<=$judge; $jn++){ $scoreMr{$x} = $scoreMr{$x} + score($_GET['category_score'], $jn, $x, "save_result"); } }
	require_once("../includes/ranking/byscore_ranking_mr.php");
	for($i=$canNumMs+1; $i<=$canNumMs+$canNumMr; $i++){
		$i2 = $i;
        if ($i>$canNumMs) {
            // $i2 = $i-$canNumMs;
        }
	for($jn=1; $jn<=$judge; $jn++){ $j{$jn} = score($_GET['category_score'], $jn, $i, "save_result"); }
	?>
    <tr>
        <td width="180"><i><font size="+1">Candidate # </font><font size="+2"><b><?php echo $i2; ?></b></font></i></td>
        <?php for($jn=1; $jn<=$judge; $jn++){ ?> <td align="center"><font size="+2"><?php echo $j{$jn} == ""?"<font color='#999999'>". 0 ."</font>":$j{$jn}; ?></font></td><?php } ?>
        <td align="center"><font size="+2">
        <?php $totalscore=0; for($jn=1; $jn<=$judge; $jn++){ $totalscore = $totalscore + score($_GET['category_score'], $jn, $i, "save_result"); } if($totalscore == 0){ echo "<font color='#999999'>". 0 ."</font>"; }else{ echo $totalscore; } ?> </font></td>
        <td align="center"><font size="+2"><?php echo $totalscore == 0?"<font color='#999999'>". 0 ."</font>":$rankscoreMr{$i}; ?></font></td>
    </tr>
	<?php 
	}
	}
	 ?>
</table>
</div><br /><br /><br />
<div align="center">
______________________________<br />
<font size="-1"><b>Tabulation Committee</b></font><br /><br /><br /> </div>