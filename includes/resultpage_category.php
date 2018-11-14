<h2>
  <?php
    require_once("../includes/connections.php");
    require_once("../includes/function.php");
    include("../includes/candidate.php");
    echo isset($_GET['category_result'])?$_GET['category_result']:"";
    ?>
</h2>
<br />
<div class="cat_score_area" id="major" align="center">
  <div id="exit"><a href="index.php"><img src="../includes/images/cross.png" /> close</a></div>
  <br />
  <br />
  <table width="600">
    <tr>
      <th width="135" bgcolor="#06C" scope="col">&nbsp;</th>
        <?php for ($jn=1; $jn<=$judge; $jn++) { ?>
        <th width="50" 
        <?php echo mysqli_num_rows(findData('save_result', 'judge', $jn, 'category', $_GET['category_result']))==$canNumMs+$canNumMr?"bgcolor='#06C'":"bgcolor='#F33'"; ?> 
        scope="col">
        <a href="../?judge=<?=$jn?>&category=<?=urlencode($_GET['category_result'])?>&points=10" 
            onclick="window.open(this.href, 'Print', 'left=20,top=20,width=900,height=600,toolbar=1,resizeble=0'); return false;" 
            style="font-size:9pt; font-weight:normal; color:#fff;"><?php echo $config['judge'][$jn]['name']; ?></a></th>
        <?php } ?>  
        <th width="50" scope="col" bgcolor="#06C">TOTAL</th>
        <th width="50" scope="col" bgcolor="#06C">RANK</th>
      </tr>
    <?php
    if (isset($canNumMs)&&$canNumMs!=0) {
        echo "<tr><td align='center'>Female</td></tr>";
        for ($m=1; $m<=$canNumMs; $m++) {
            for ($n=1; $n<=$judge; $n++) {
                $s{$m}{$n} = score($_GET['category_result'], $n, $m, "save_result");
            }
        }
        require_once("../includes/ranking/ranking_ms.php");
        for ($z=1; $z<=$canNumMs; $z++) {
            $score_rank{$z}=0; for ($j=1; $j<=$judge; $j++) {
                if ($s{$z}{$j} == "") {
                    $rankcanMs{$z}{$j} = 0;
                } $score_rank{$z}+=$rankcanMs{$z}{$j};
            }
        }
        require_once("../includes/ranking/reverse_ranking_ms.php");
        for ($a=1; $a<=$canNumMs; $a++) { ?>
    <tr>
          <td><i><font size="+1">Candidate # </font><font size="+2"><b><?php echo $a; ?></b></font></i></td>
            <?php for ($jn=1; $jn<=$judge; $jn++) {
?><td align="center"><font size="+2">
        <?php echo $rankcanMs{$a}{$jn}==0?"<font color='#999999'>". 0 ."</font>":$rankcanMs{$a}{$jn}; ?></font></td><?php
} ?>
      <td align="center"><font size="+2">
            <?php $totalInRank=0; for ($jn=1; $jn<=$judge; $jn++) {
                $totalInRank+=$rankcanMs{$a}{$jn};
} echo $score_rank{$a} == 0?"<font color='#999999'>". 0 ."</font>":$totalInRank; ?></font></td>
      <td align="center"><font size="+2">
            <?php echo $score_rank{$a} == 0?"<font color='#999999'>". 0 ."</font>":$rankMs{$a}; ?></font></td>
    </tr>
        <?php
        }
    }
    if (isset($canNumMr)&&$canNumMr!=0) {
        echo "<tr><td align='center'>Male</td></tr>";
        for ($m=$canNumMs+1; $m<=$canNumMs+$canNumMr; $m++) {
            for ($n=1; $n<=$judge; $n++) {
                $s{$m}{$n} = score($_GET['category_result'], $n, $m, "save_result");
            }
        }
        require_once("../includes/ranking/ranking_mr.php");
        for ($z=$canNumMs+1; $z<=$canNumMs+$canNumMr; $z++) {
            $score_rank{$z}=0;
            for ($j=1; $j<=$judge; $j++) {
                if ($s{$z}{$j} == "") {
                    $rankcanMr{$z}{$j} = 0;
                } $score_rank{$z}+=$rankcanMr{$z}{$j};
            }
        }
        require_once("../includes/ranking/reverse_ranking_mr.php");
        for ($a=$canNumMs+1; $a<=$canNumMs+$canNumMr; $a++) { 
        	$a2 = $a;
	        if ($a>$canNumMs) {
	            // $a2 = $a-$canNumMs;
	        }
        	?>
    <tr>
          <td><i><font size="+1">Candidate # </font><font size="+2"><b><?php echo $a2; ?></b></font></i></td>
            <?php for ($jn=1; $jn<=$judge; $jn++) {
?><td align="center"><font size="+2">
        <?php echo $rankcanMr{$a}{$jn}==0?"<font color='#999999'>". 0 ."</font>":$rankcanMr{$a}{$jn}; ?></font></td><?php
} ?>
      <td align="center"><font size="+2">
            <?php $totalInRank=0; for ($jn=1; $jn<=$judge; $jn++) {
                $totalInRank+=$rankcanMr{$a}{$jn};
} echo $totalInRank==0?"<font color='#999999'>". 0 ."</font>":$totalInRank; ?></font></td>
      <td align="center"><font size="+2">
            <?php echo $score_rank{$a}==0?"<font color='#999999'>". 0 ."</font>":$rankMr{$a}; ?></font></td>
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
<br />
<div align="center"> ______________________________<br />
  <font size="-1"><b>Tabulation Committee</b></font><br />
  <br />
  <br />
</div>
