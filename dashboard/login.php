<?php
    session_start();
    session_destroy();
    session_start();
    require_once("../includes/connections.php");
    require_once("../includes/function.php");
if (isset($_POST['btn'])) {
    $usr=$_POST['usr'];
    $psw=sha1($_POST['psw']);
    //mysqli_query($GLOBALS['connection'], "INSERT INTO admin(usr, psw)VALUES('{$usr}','{$psw}')");
    $sql=mysqli_query($GLOBALS['connection'], "SELECT * FROM admin WHERE psw='{$psw}' AND usr='{$usr}'");
    if (mysqli_num_rows($sql)==1) {
        $_SESSION['usr']=$usr;
        header("location:index.php?login=1");
        exit;
    } else {
        $message="<h3>Access denied!</h3>";
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

<body><br /><br /><br /><br />
<div class="cat_score_area" align="center"><div class="dash"><br /><br />
<h1>Dashboard Security</h1><?php echo isset($message)?$message:""; ?><br /><br />
<form action="#" method="post">
    <input type="text" name="usr" placeholder="USERNAME" class="textfield" style="height:35px; width:150px;" />
    <input type="password" name="psw" placeholder="PASSWORD" class="textfield" style="height:35px; width:150px;"  />
    <input type="submit" name="btn" value="ACCESS" class="btn"  style="height:36px; width:80px;"  />
</form>
</div></div>
</body>
</html>
