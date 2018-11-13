<?php
    session_start();
    require_once("../includes/connections.php");
    require_once("../includes/function.php");
if (!isset($_SESSION['usr'])) {
    header("location:login.php");
    exit;
}
if (isset($_GET['clear'])&&$_GET['clear'] == "all") {
    $clear = clear("save_result");
    $major_clear = clear("major_result");
    if (!$clear && !$major_clear) {
        echo "Restarting Software Failed!";
    }
}
if (isset($_GET['nc_btn'])) {
    if ($_GET['cat']=="Major Category") {
        $majorCat=$_GET['newcat'];
        $points=$_GET['newcatpts'];
        $sort=$_GET['newcatsort'];
        $addnc="INSERT INTO majorcategories(majorCat, points, sort)VALUES('{$majorCat}', '{$points}', '{$sort}')";
        $macat=mysqli_query($GLOBALS['connection'], $addnc);
        if ($macat) {
            header("location:index.php");
            exit;
        }
    }

    if ($_GET['cat']=="Talent Competition") {
        $majorCat=$_GET['newcat'];
        $points=$_GET['newcatpts'];
        $sort=$_GET['newcatsort'];
        $addnc="INSERT INTO talentcategories(majorCat, points, sort)VALUES('{$majorCat}', '{$points}', '{$sort}')";
        $macat=mysqli_query($GLOBALS['connection'], $addnc);
        if ($macat) {
            header("location:index.php");
            exit;
        }
    }

    if ($_GET['cat']=="Minor Category") {
        $majorCat=$_GET['newcat'];
        $points=$_GET['newcatpts'];
        $sort=$_GET['newcatsort'];
        $addnc="INSERT INTO categories(category, points, sort)VALUES('{$majorCat}', '{$points}', '{$sort}')";
        $micat=mysqli_query($GLOBALS['connection'], $addnc);
        if ($micat) {
            header("location:index.php");
            exit;
        }
    }
}
if (isset($_GET['remove'])) {
    $rem=del($_GET['table'], $_GET['id']);
    if ($rem) {
        header("location:index.php");
        exit;
    }
}
if (isset($_GET['config_btn'])) {
    $judgeNum=$_GET['judge'];
    mysqli_query($GLOBALS['connection'], "UPDATE judge SET jdNum='{$judgeNum}'");
    for ($x=1; $x<=2; $x++) {
        $pair="pair{$x}";
        $pair1{$x}=$_GET[$pair];
        mysqli_query($GLOBALS['connection'], "UPDATE pair SET num='{$pair1{$x}}' WHERE id='{$x}'");
    }
    $find5=select("categories");
    $catnum=mysqli_num_rows($find5);
    for ($x=1; $x<=$catnum; $x++) {
        $category="micat{$x}";
        $points="mipoi{$x}";
        $sort="misort{$x}";
        $id="miid{$x}";
        $category1{$x}=$_GET[$category];
        $points1{$x}=$_GET[$points];
        $sort1{$x}=$_GET[$sort];
        $id1{$x}=$_GET[$id];
        mysqli_query($GLOBALS['connection'], "UPDATE categories SET category='{$category1{$x}}',points='{$points1{$x}}',sort='{$sort1{$x}}' WHERE id='{$id1{$x}}'");
    }
        
    $find6=select("majorcategories");
    $catnum1=mysqli_num_rows($find6);
    for ($y=1; $y<=$catnum1; $y++) {
        $category3="macat{$y}";
        $points3="mapoi{$y}";
        $sort3="masort{$y}";
        $id3="maid{$y}";
        $category4{$y}=$_GET[$category3];
        $points4{$y}=$_GET[$points3];
        $sort4{$y}=$_GET[$sort3];
        $id4{$y}=$_GET[$id3];
        mysqli_query($GLOBALS['connection'], "UPDATE majorcategories SET majorCat='{$category4{$y}}',points='{$points4{$y}}',sort='{$sort4{$y}}' WHERE id='{$id4{$y}}'");
    }

    $find7=select("talentcategories");
    $catnum1=mysqli_num_rows($find7);
    for ($y=1; $y<=$catnum1; $y++) {
        $category3="macat{$y}";
        $points3="mapoi{$y}";
        $sort3="masort{$y}";
        $id3="maid{$y}";
        $category4{$y}=$_GET[$category3];
        $points4{$y}=$_GET[$points3];
        $sort4{$y}=$_GET[$sort3];
        $id4{$y}=$_GET[$id3];
        mysqli_query($GLOBALS['connection'], "UPDATE talentcategories SET majorCat='{$category4{$y}}',points='{$points4{$y}}',sort='{$sort4{$y}}' WHERE id='{$id4{$y}}'");
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pageant Dashboard</title>
<link href="../includes/images/icon.ico" rel="icon" />
<link href="../includes/style.css" rel="stylesheet" type="text/css" />
<script src="../includes/upgrade/jquery.js"></script>
<script src="../includes/upgrade/ajax.js"></script>
</head>

<body><br /><br />
<div class="cat_score_area" id="major"><br /><br />
<div class="dash">
<h1>Dashboard</h1><br />

<?php
if (isset($_GET['add'])) {
?>      
        <br /><form action="#" method="get">
        <input type="text" name="newcatsort" placeholder="#" class="textfield" />
        <input type="text" name="newcatpts" placeholder="points" class="textfield" />
        <input type="text" name="newcat" placeholder="Category Name" class="textfield"  style="width:200px;" />
        <select name="cat" class="textfield"  style="width:100px;">
            <option>Minor Category</option>
            <option>Major Category</option>
            <option>Talent Competition</option>
        </select>
        <input type="submit" name="nc_btn" value="add+" class="btn"  style="width:60px; height:27px;" />
        <a href="index.php"><input type="reset" name="reset_btn" value="close" class="btn"  style="width:60px; height:27px;" /></a>
        </form><br />   
<?php
} else {
    echo "<a href='?add=1'>Add new category +</a><br><br>";
}
?>
<form action="#" method="get"><hr />
Numbers of MISS or MR &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
Numbers of Judge<br />
<?php
    $find=select("pair");
while ($pair=mysqli_fetch_array($find)) {
?>
    <input type="text" name="<?php echo "pair".$pair[0]; ?>" value="<?php
        echo $pair[1]; ?>" class="textfield" /> - (<?php echo $pair[2]; ?>)
<?php
}
    $find2=select("judge");
    $judge=mysqli_fetch_array($find2);
?>

     &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
      <input type="text" name="judge" value="<?php echo $judge[1]; ?>" class="textfield" /> - (judge)<br /><br />
<hr />Minor Categories<br />
<?php
    $find3=select("categories");
    $x=1;
while ($micat=mysqli_fetch_array($find3)) {
?>
    <input type="hidden" name="<?php echo "miid".$x; ?>" value="<?php echo $micat[0]; ?>" />
    <input type="text" name="<?php echo "mipoi".$x; ?>" value="<?php echo $micat[2]; ?>" class="textfield" /> - (pts)
    <input type="text" name="<?php echo "misort".$x; ?>" value="<?php echo $micat[3]; ?>" class="textfield" /> - (sort)
    <input type="text" name="<?php echo "micat".$x; ?>" value="<?php echo $micat[1]; ?>" class="textfield" style="width:450px;" /> 
    <a href="?remove=1&table=categories&id=<?php echo $micat[0]; ?>" onclick="return confirm('Do you really want to remove this item?');"> - remove?</a>
        <br /><br />
<?php
$x++;
}
?>
<hr />Major Categories<br />
<?php
    $find4=select("majorcategories");
    $y=1;
while ($macat=mysqli_fetch_array($find4)) {
?>
    <input type="hidden" name="<?php echo "maid".$y; ?>" value="<?php echo $macat[0]; ?>" />
    <input type="text" name="<?php echo "mapoi".$y; ?>" value="<?php echo $macat[2]; ?>" class="textfield" /> - (pts)
    <input type="text" name="<?php echo "masort".$y; ?>" value="<?php echo $macat[3]; ?>" class="textfield" /> - (sort)
    <input type="text" name="<?php echo "macat".$y; ?>" value="<?php echo $macat[1]; ?>" class="textfield" style="width:450px;" />
    <a href="?remove=1&table=majorcategories&id=<?php echo $macat[0]; ?>" onclick="return confirm('Do you really want to remove this item?');"> - remove?</a>
        <br /><br />
<?php
$y++;
}
?>

<hr />Talent Competition<br />
<?php
    $find4=select("talentcategories");
    $y=1;
while ($macat=mysqli_fetch_array($find4)) {
?>
    <input type="hidden" name="<?php echo "maid".$y; ?>" value="<?php echo $macat[0]; ?>" />
    <input type="text" name="<?php echo "mapoi".$y; ?>" value="<?php echo $macat[2]; ?>" class="textfield" /> - (pts)
    <input type="text" name="<?php echo "masort".$y; ?>" value="<?php echo $macat[3]; ?>" class="textfield" /> - (sort)
    <input type="text" name="<?php echo "macat".$y; ?>" value="<?php echo $macat[1]; ?>" class="textfield" style="width:450px;" />
    <a href="?remove=1&table=talentcategories&id=<?php echo $macat[0]; ?>" onclick="return confirm('Do you really want to remove this item?');"> - remove?</a>
        <br /><br />
<?php
$y++;
}
?>
<div class="config_btn">
<a href="index.php?clear=all" class="btn" style="padding:0 5px;"><font color="#FF0000">reset</font></a> &nbsp;  &nbsp;  &nbsp; 
<a href="login.php" class="btn" style="padding:0 5px;"><font color="#FF0000">log off</font></a> &nbsp;  &nbsp;  &nbsp; 
<input type="submit" name="config_btn" value="configure" class="btn" />
</div></form>
</div></div><br /><br />
</body>
</html>
