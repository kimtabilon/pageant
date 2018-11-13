<h4 id="title"><i><?php echo $_GET['category']; ?></i></h4>
<br />
<div id="divId"></div><div id="divId2"></div>
<div class="cat_score_area">
  <div id="exit"><a href="?judge=<?php echo $_GET['judge']; ?>"><img src="includes/images/cross.png" /> close</a></div>
  <div id="print" style="float:left; margin-left:10px;"><button onclick="window.print()" style="padding:1px 2px;"> print</button></div>
  <br />
  <br />
  <table width="400">
    <tr>
      <td><p align="center"> <b><font size="-1">CANDIDATES</font></b></p></td>
      <td><p align="center"><b><font size="-1">SCORE</font></b></p></td>
    </tr>
    <?php
    echo $canNumMs!=0?"<tr><td align='center'><em>Female</em></td></tr>":"";
    for ($i=1; $i<=($canNumMs+$canNumMr); $i++) {
        $i2 = $i;
        if ($i==($canNumMs+1)) {
            echo "<tr><td align='center'><em>Male</em></td></tr>";
        }
        if ($i>$canNumMs) {
            $i2 = $i-$canNumMs;
        }
        ?>
    <tr>
      <td><i><font size="+1">Candidate #</font><font size="+2"><b><?php echo $i2; ?></b></font></i>
      <td width="80" align="center">
        <input type="text" name="<?php echo $i; ?>"
            <?php
                $findScore=findData("save_result", "category", $_GET['category'], "judge", $_GET['judge'], "candidate", $i);
            if (mysqli_num_rows($findScore)!=0) {
                $val = mysqli_fetch_array($findScore);
                echo " value='";
                echo $val['score'];
                echo "' ";
            }
            ?> class="textfield" placeholder="<?php echo $_GET['points']; ?>pts" 
                    onchange="ajaxScore('includes/upgrade/processor.php?type=minorCategory&judge=<?php echo $_GET['judge']; ?>&candidate=<?php echo $i; ?>&category=<?php echo $_GET['category']; ?>');" 
                    onkeyup="checkValue(this, <?php echo $_GET['points']; ?>);" onfocus="id='sel'" onblur="id=''" /></td>
    </tr>
    <?php
    }
    ?>
  </table>
  <br />
</div>
<br />
<br />
<br />
______________________________<br />
<font size="-1"><b><?php echo $config['judge'][$_GET['judge']]['name']; ?></b></font><br />
<br />
<br />
</div>
