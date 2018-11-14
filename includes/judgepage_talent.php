<h4 id="title"><i>Talent Competition</i></h4>
<br />
<div class="cat_score_area" id="major">
  <div id="exit"><a href="?judge=<?php echo $_GET['judge']; ?>"><img src="includes/images/cross.png" /> close</a></div>
  <div id="print" style="float:left; margin-left:10px;"><button onclick="window.print()" style="padding:1px 2px;"> print</button></div>
  <br />
  <br />
  <table>
    <tr>
      <td><p align="center"> <b><font size="-1">CANDIDATES</font></b></p></td>
        <?php
        $mjrCat=select("talentcategories ORDER BY  `sort` ASC");
        while ($mjr=mysqli_fetch_array($mjrCat)) {
            echo "<td width='15%'><p align='center'><b><font size='-1'>".$mjr[1]."<br>".$mjr[2]."%</font></b></p></td>";
        }
        ?>
    </tr>
    <?php
    echo $canNumMs!=0?"<tr><td align='center'><em>Female</em></td></tr>":"";
    for ($i=1; $i<=($canNumMs+$canNumMr); $i++) {
        $i2 = $i;
        if ($i==($canNumMs+1)) {
            echo "<tr><td align='center'><em>Male</em></td></tr>";
        }
        if ($i>$canNumMs) {
            // $i2 = $i-$canNumMs;
        }
        
    ?>
    <tr>
      <td><i><font size="+1">Candidate #</font><font size="+2"><b><?php echo $i2; ?></b></font></i></td>
        <?php
        $mjrCat=select("talentcategories ORDER BY  `talentcategories`.`sort` ASC");
        while ($mjr=mysqli_fetch_array($mjrCat)) {
        ?>
      <td align="center">
        <input type="text" class="textfield" placeholder="+<?php echo $mjr[2]; ?>%" onkeyup="checkValue(this, <?php echo $mjr[2]; ?>);"
            <?php
                $findScore=findData("talent_result", "category", $mjr[1], "judge", $_GET['judge'], "candidate", $i);
            if (mysqli_num_rows($findScore)!=0) {
                $val = mysqli_fetch_array($findScore);
                echo " value='";
                echo $val['score'];
                echo "' ";
            }
            ?>  onchange="ajaxScore('includes/upgrade/processor.php?type=talentCategory&judge=<?php echo $_GET['judge']; ?>&candidate=<?php echo $i; ?>&category=<?php echo $mjr[1]; ?>');" 
                  onfocus="id='sel'" onblur="id=''" /></td>
        <?php
        }
        ?>
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
</div>
