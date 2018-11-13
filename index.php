<?php
	
	require_once("includes/connections.php");
	require_once("includes/function.php");
	require_once("includes/candidate.php");
	$link="index.php?judge=".$_GET['judge'];
	if(isset($_GET['category'])){ $link.="&category=".$_GET['category']; }
	if(isset($_GET['award'])){ $link.="&award=".$_GET['award']; }
	if(isset($_GET['points'])){ $link.="&points=".$_GET['points']; }
	if(isset($_GET['judge_chat'])){ $link.="&judge_chat=".$_GET['judge_chat']; }
	$link2="index.php?judge=".$_GET['judge'];
	if(isset($_GET['category'])){ $link2.="&category=".$_GET['category']; }
	if(isset($_GET['award'])){ $link2.="&award=".$_GET['award']; } 
	if(isset($_GET['points'])){ $link2.="&points=".$_GET['points']; } 
	
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pageant eT</title>
<link href="includes/images/icon.ico" rel="icon" />
<link href="includes/style.css" rel="stylesheet" type="text/css" />
<script src="includes/upgrade/jquery.js"></script>
<script src="includes/upgrade/ajax.js"></script>
</head>

<body>

<!--div id="main_head">
  <div id="header"> <img src="includes/images/header3.png" /> </div>
</div--><br>
<!--<div id="wrapper">-->

<div align="center">
  <?php 
	if(isset($_GET['category'])){ 
		include("includes/judgepage_category.php");
	}elseif(isset($_GET['award']) && $_GET['award'] == "Major Awards"){
		include("includes/judgepage_awards.php");
  }elseif(isset($_GET['award']) && $_GET['award'] == "Talent Competition"){
    include("includes/judgepage_talent.php");  
	}else{ 
	?>
  <div align="center">
    <h2><b>
      <?php if(isset($_GET['judge'])){ echo $config['judge'][$_GET['judge']]['name']; }else{ $_GET['judge'] = ""; } ?>
      </b></h2>
    <br />
    <h3>Categories:</h3>
    <br />
    <div id="category"> <br />
      <?php
		$category = getCategory();
		while($data = fetch($category)){
		?>
      <a <?php 
	  $find = find($data['category'], $_GET['judge'], "save_result");
	  $num = num($find);
	  ?>href="?judge=<?php echo $_GET['judge']; ?>&category=<?php echo urlencode($data['category']); ?>&points=<?php echo urlencode($data['points']); ?>" />
      <div class="cat">
        <div class="category_data">
          <div style="float:left">
            <?php echo $num==($canNumMs+$canNumMr)?"&radic;":"";?>  
          </div>
          <?php echo " ".$data['category']." "; ?></div>
      </div>
      </a>
      <?php } ?>
      <a <?php
    $find = find("", $_GET['judge'], "talent_result");
    $num = num($find);
    $mCatNum = select("talentcategories");
    $numMjr = num($mCatNum);
    ?>href="?judge=<?php echo $_GET['judge']; ?>&award=Talent+Competition" />
      <div class="cat">
        <div class="category_data">
          <div style="float:left" >
            <?php echo $num==(($canNumMs+$canNumMr)*$numMjr)?"&radic;":""; ?>
          </div>
           Talent Competition  </div>
      </div>
      </a>
      <a <?php
	  $find = find("", $_GET['judge'], "major_result");
	  $num = num($find);
	  $mCatNum = select("majorcategories");
	  $numMjr = num($mCatNum);
	  ?>href="?judge=<?php echo $_GET['judge']; ?>&award=Major+Awards" />
      <div class="cat">
        <div class="category_data">
          <div style="float:left" >
            <?php echo $num==(($canNumMs+$canNumMr)*$numMjr)?"&radic;":""; ?>
          </div>
           Major Awards  </div>
      </div>
      </a> 
     </div>
  </div>
  
  <?php
	}
?>
<!--</div>-->
<div id="chatbox">
  	<div class="inside_chat">
    	<div class="inside_chat2" align="left">
        	<div class="header1"><font size="-1">Chat (<?php echo $judge-1; ?>) 
            <div class="notify_outside">0
            </div></font></div>
            <input type="hidden" name="judge" class="judge" value="<?php echo $_GET['judge']; ?>" />
			<script> 
				var judge=$('.judge').val();
				var auto_refresh = setInterval(
					function(){
						$('.notify_outside').load('includes/chat.php?notify_outside=1&judge='+judge);
					}, 1000
				);
			</script>
			<div class="judges_chat">
			<?php 
				for($x=1;$x<=$judge;$x++){
					if($_GET['judge']!=$x){
						echo "<a href='{$link}&judge_chat={$x}'>";
					?>
                    <span class="judges">
                    <div class="judge"><div class="circle"></div><?php echo $config['judge'][$x]['name']; ?>
                    <div id='notify<?php echo $x; ?>' style='float:right; font-size:9px'><font color="#FF0000">0 unread</font></div></div>
                    </span></a>
					<script> 
						var judge=$('.judge').val();
						var auto_refresh = setInterval(
							function(){
								$('#notify<?php echo $x; ?>').load('includes/chat.php?notify=1&judge='+judge+'&judge_chat=<?php echo $x; ?>');
							}, 5000
						);
					</script>
					<?php
					}
				}
			?>
            </div>
        </div>
    </div> 
    <?php
		if(isset($_GET['judge_chat'])){
	?>
    <div class="inside_chat">
    	<div class="inside_chat3" align="left">
        	<div class="header_chat">
                <div class="circle"></div><font size="-1"><?php echo $config['judge'][$_GET['judge_chat']]['name']; ?></font>
                <div style="float:right; padding-right:5px;">
                <span onclick="clearwindow('includes/chat.php?cls=1');">clear</span> | 
                <span class="close_btn" style="font-size:11px">x </span></div>
            </div>
            <div class="chat_area"><font color="#999999"> &nbsp; Connecting...</font>
            </div>
            <div class="under_chatbox">
            	<form method="post" id="chat_post">
                <input type="hidden" name="me" value="<?php echo $_GET['judge']; ?>" class="me" />
                <input type="hidden" name="frnd" value="<?php echo $_GET['judge_chat']; ?>" class="frnd" />
                <input type="text" class="msg_txt" name="msg" placeholder="Write Message" />
                <input type="submit" name="msg_btn" value="send" style="display:none" />
                </form>
            </div>
        </div>
    </div>
    <?php
		}
	?>
  </div>
</body>
</html>