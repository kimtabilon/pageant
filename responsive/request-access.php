<?php
	session_start();
	session_destroy();
	session_start();
	
	require_once("../includes/connections.php");
	require_once("../includes/function.php");
	include("../includes/candidate.php");
	
	if(isset($_POST['go'])&&isset($_POST['judge'])&&isset($_POST['key'])&&sha1($_POST['key'])==='1e0ea7b7f5f6739b850cf19eb83880c21b9a3037') {
		$_SESSION['judge']=$_POST['judge'];
		$_SESSION['granted']=true;
		header('location:index.php?type=minor');
		exit;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Pageant eT</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link href="../includes/images/icon.ico" rel="icon" />
	<link href="../includes/upgrade/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="../includes/upgrade/bootstrap/css/responsive.css" rel="stylesheet" type="text/css" />
</head>

<body class="container-fluid">
		<div class="text-center">
			<h4>
			Miss Siquijor Tourism <?=date('Y')?> <br><small>Easy Tabulation</small></h4>
		</div>
		<form action="request-access.php" method="post">
		<div class="row">
			<div class="col-xs-6">
				<select name="judge" class="select-score form-control btn-danger"  style="font-size:20pt;">
					<?php for($x=1; $x<=$judge; $x++): ?>
					<option value="<?=$x?>"><?=$config['judge'][$x]['name'];?></option>
					<?php endfor; ?>
				</select>
			</div>
			<div class="col-xs-6">
				<input name="key" class="select-score form-control btn-danger" type="password" placeholder="Security" style="font-size:20pt;">
			</div>
		</div><br><br>
		<div class="text-center">
			<button name="go" class="select-score btn btn-danger"  style="font-size:20pt;">Go!</button>
		</div>	
		</form>
</body>
</html>