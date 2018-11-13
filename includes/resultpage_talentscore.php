<?php
require_once("../includes/connections.php");
require_once("../includes/function.php");
include("../includes/candidate.php");
echo "<h2>Talent Competition</h2><br>";	
?>

<div class="cat_score_area" id="major" align="center">
  <div id="exit"><a href="index.php"><img src="../includes/images/cross.png" /> close</a></div>
  <br />
  <br />
  <table width="600">
    <tr>
      <th width="125" bgcolor="#06C" scope="col">&nbsp;</th>
      <?php for($jn=1; $jn<=$judge; $jn++){ ?>
        <th width="50" <?php 
		$mjrCat=select("talentcategories ORDER BY  `talentcategories`.`sort` ASC");
        echo mysqli_num_rows(findData('talent_result','judge',$jn))==($canNumMs+$canNumMr)*mysqli_num_rows($mjrCat)?"bgcolor='#06C'":"bgcolor='#F33'"; 
      ?> scope="col">
		<a href="../?judge=<?=$jn?>&award=Talent+Competition" 
			onclick="window.open(this.href, 'Print', 'left=20,top=20,width=900,height=600,toolbar=1,resizeble=0'); return false;" 
			style="font-size:9pt; font-weight:normal; color:#fff;">
			<?php echo $config['judge'][$jn]['name']; ?>
		</a></th> <?php } ?>
      <th width="50" scope="col" bgcolor="#06C">TOTAL</th>
      <th width="50" scope="col" bgcolor="#06C">RANK</th>
    </tr>
    <?php
	if(isset($canNumMs)&&$canNumMs!=0){ echo "<tr><td align='center'>Female</td></tr>";
	for($y=1; $y<=$canNumMs; $y++){
		$score{$y}=0;
		for($x=1; $x<=$judge; $x++){
			$s{$x}{$y}=0;
			$mjrCat=select("talentcategories ORDER BY  `talentcategories`.`sort` ASC");
			while($mjr=mysqli_fetch_array($mjrCat)){
				$s{$x}{$y}+=score($mjr[1], $x, $y, "talent_result");
			}
			$score{$y}+=$s{$x}{$y};
		}
	}
	require_once("../includes/ranking/byscore_ranking_ms.php");
    for($i=1; $i<=$canNumMs; $i++){
	?>
    <tr>
      <td><i><font size="+1">Candidate #</font><font size="+2"><b><?php echo $i; ?></b></font></i></td>
      <?php for($x=1; $x<=$judge; $x++){ 
	  echo "<td align='center'><font size='+2'>"; echo $s{$x}{$i}==0?"<font color='#999999'>". 0 ."</font>":$s{$x}{$i}; echo "</font></td>"; } ?>
      <td align="center"><font size="+2"><?php echo $score{$i}==0?"<font color='#999999'>". 0 ."</font>":$score{$i}; ?> </font></td>
      <td align="center"><font size="+2">
      <?php echo $score{$i} == ""?"<font color='#999999'>". 0 ."</font>":$rankscoreMs{$i}; ?> </font></td>
    </tr>
    <?php
	 } 
	 }
	 //------------------------------------------------------------------------------
	 if(isset($canNumMr)&&$canNumMr!=0){ echo "<tr><td align='center'>Male</td></tr>";
	 for($y=$canNumMs+1; $y<=$canNumMs+$canNumMr; $y++){
		$scoreMr{$y}=0;
		for($x=1; $x<=$judge; $x++){
			$s{$x}{$y}=0;
			$mjrCat=select("talentcategories ORDER BY  `talentcategories`.`sort` ASC");
			while($mjr=mysqli_fetch_array($mjrCat)){
				$s{$x}{$y}+=score($mjr[1], $x, $y, "talent_result");
			}
			$scoreMr{$y}+=$s{$x}{$y};
		}
	}
	require_once("../includes/ranking/byscore_ranking_mr.php");
    for($i=$canNumMs+1; $i<=$canNumMs+$canNumMr; $i++){
    	$i2 = $i;
        if ($i>$canNumMs) {
            $i2 = $i-$canNumMs;
        }
	?>
    <tr>
      <td><i><font size="+1">Candidate #</font><font size="+2"><b><?php echo $i2; ?></b></font></i></td>
      <?php for($x=1; $x<=$judge; $x++){ 
	  echo "<td align='center'><font size='+2'>"; echo $s{$x}{$i}==0?"<font color='#999999'>". 0 ."</font>":$s{$x}{$i}; echo "</font></td>"; } ?>
      <td align="center"><font size="+2"><?php echo $scoreMr{$i}==0?"<font color='#999999'>". 0 ."</font>":$scoreMr{$i}; ?> </font></td>
      <td align="center"><font size="+2">
      <?php echo $scoreMr{$i} == ""?"<font color='#999999'>". 0 ."</font>":$rankscoreMr{$i}; ?> </font></td>
    </tr>
    <?php
	 } 
	 }
 ?>
  </table>
</div>
<br />
<br />
<br />
<div align="center"> ______________________________<br />
  <font size="-1"><b>Tabulation Committee</b></font><br />
  <br />
  <br />
</div>
