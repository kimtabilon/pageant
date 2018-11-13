<?php
    require_once("../includes/connections.php");
    require_once("../includes/function.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Mr and Ms Result</title>
<link href="../includes/images/icon.ico" rel="icon" />
<link href="../includes/style.css" rel="stylesheet" type="text/css" />
<script src="../includes/upgrade/jquery.js"></script>
<script src="../includes/upgrade/ajax.js"></script>
</head>

<body>
<!--<div id="wrapper">-->
  <!--div id="header"> <img src="../includes/images/header3.png" /> </div--><br>
  <h1 align="center">Result
    <?php if (isset($_GET['type'])) {
        echo $_GET['type'];
    } else {
    echo "Page";
} ?>
  </h1>
  <br />
  <div align="center">
    <?php
    if (isset($_GET['category_result'])) {
?>
    <input type="hidden" class="catrank_hide" value="<?php echo urlencode($_GET['category_result']); ?>" />
    <script>
        var cat=$('.catrank_hide').val();
        var lnk='../includes/resultpage_category.php?category_result='+cat;
        var auto_refresh = setInterval(
            function(){
                $('.output').load(lnk);
            }, 1000
        );
    </script>
    <div class="output"></div>
    <?php
    } elseif (isset($_GET['major_category'])) {
        ?>
    <script>
        var auto_refresh = setInterval(
            function(){
                $('.output').load('../includes/resultpage_majorcategory.php');
            }, 1000
        );
    </script>
    <div class="output"></div>
    <?php
    } elseif (isset($_GET['talent_competition'])) {
        ?>
    <script>
        var auto_refresh = setInterval(
            function(){
                $('.output').load('../includes/resultpage_talentcategory.php');
            }, 1000
        );
    </script>
    <div class="output"></div>
    <?php
    } elseif (isset($_GET['category_score'])) {
        ?>
    <input type="hidden" class="cat_hide" value="<?php echo urlencode($_GET['category_score']); ?>" />
    <script>
        var cat=$('.cat_hide').val();
        var lnk='../includes/resultpage_categoryscore.php?category_score='+cat;
        var auto_refresh = setInterval(
            function(){
                $('.output').load(lnk);
            }, 1000
        );
    </script>
    <div class="output"></div>
    <?php
    } elseif (isset($_GET['major_score'])) {
            ?>
    <script>
        var auto_refresh = setInterval(
            function(){
                $('.output').load('../includes/resultpage_majorscore.php');
            }, 1000
        );
    </script>
    <div class="output"></div>
    <?php
    } elseif (isset($_GET['talent_score'])) {
            ?>
    <script>
        var auto_refresh = setInterval(
            function(){
                $('.output').load('../includes/resultpage_talentscore.php');
            }, 1000
        );
    </script>
    <div class="output"></div>
    <?php
    } else {
        echo "<div id='category' class=\"result\"> <br />";
        echo "<div id=\"rank\"><h3>View by Rank</h3><br>";
        $category = getCategory();
        while ($data = fetch($category)) {
            echo "<a href='?type=by+Rank&category_result=";
            echo urlencode($data['category']);
            echo "'> <div class='cat'><div class='category_data'>" . $data['category'] . "</div></div></a>";
        }
        echo "<a href='?type=by+Rank&talent_competition=Talent+Competition'><div class='cat'><div class='category_data'>Talent Competition</div></div></a>";
        echo "<a href='?type=by+Rank&major_category=Major+Category'><div class='cat'><div class='category_data'>Major Awards</div></div></a>";
        
        echo "</div>";
        echo "<div id=\"score\"><h3>View by Score</h3><br>";
        $category = getCategory();
        while ($data = fetch($category)) {
            echo "<a href='?type=by+Score&category_score=";
            echo urlencode($data['category']);
            echo "'><div class='cat'><div class='category_data'>" . $data['category'] . "</div></div></a>";
        }
        echo "<a href='?type=by+Score&talent_score=Talent+Competition'><div class='cat'><div class='category_data'>Talent Competition</div></div></a>";
        echo "<a href='?type=by+Score&major_score=Major+Category'><div class='cat'><div class='category_data'>Major Awards</div></div></a>";

        echo "</div></div>";
    }
    
?>
  </div>
<!--</div>-->
</body>
</html>
