<?php
    require_once("connections.php");
    require_once("function.php");
    require_once("candidate.php");
if (isset($_GET['cls'])) {
    $offjudge=$_GET['judge'];
    $offjudgechat=$_GET['judge_chat'];
    $sqloffchat1="UPDATE chat SET off_me='1' WHERE jme='{$offjudge}' AND jfrnd='{$offjudgechat}'";
    $sqloffchat2="UPDATE chat SET off_frnd='1' WHERE jme='{$offjudgechat}' AND jfrnd='{$offjudge}'";
    $queryoffchat1=mysqli_query($GLOBALS['connection'], $sqloffchat1);
    $queryoffchat2=mysqli_query($GLOBALS['connection'], $sqloffchat2);
    //echo $queryoffchat?"<h1>SUCCESS!</h1>":"<h1>FAILED!</h1>";
    //if($queryoffchat2&&$queryoffchat1){ header("location:{$link}"); exit; }
} elseif (isset($_GET['notify'])) {
    $unread="SELECT * FROM chat WHERE read_msg='0' AND jme='".$_GET['judge_chat']."' AND jfrnd='".$_GET['judge']."' ";
    $query_unread=mysqli_query($GLOBALS['connection'], $unread);
    echo mysqli_num_rows($query_unread)!='0'?"<font color='green'>":"<font color='red'>";
    echo mysqli_num_rows($query_unread)." unread </font>";
} elseif (isset($_GET['notify_outside'])) {
    $unread="SELECT * FROM chat WHERE read_msg='0' AND jfrnd='".$_GET['judge']."'";
    $query_unread=mysqli_query($GLOBALS['connection'], $unread);
    echo mysqli_num_rows($query_unread);
    //echo "39";
} elseif (isset($_GET['chat_submit'])) {
    $me1=$_GET['me'];
    $frnd1=$_GET['frnd'];
    $msg1=$_GET['msg'];
    $read1=0;
    $sort_time1=time();
    $sql="INSERT INTO chat(jme, jfrnd, chat_msg, read_msg, sort_time)VALUES('{$me1}', '{$frnd1}', '{$msg1}', '{$read1}', '{$sort_time1}')";
    $chat=mysqli_query($GLOBALS['connection'], $sql);
} else {
    $frnd=$_GET['judge_chat'];
    $me=$_GET['judge'];
    $link="index.php?judge=".$_GET['judge'];
    if (isset($_GET['category'])) {
        $link.="&category=".$_GET['category'];
    }
    if (isset($_GET['award'])) {
        $link.="&award=".$_GET['award'];
    }
    if (isset($_GET['points'])) {
        $link.="&points=".$_GET['points'];
    }
    if (isset($_GET['judge_chat'])) {
        $link.="&judge_chat=".$_GET['judge_chat'];
    }
    //echo "me: ".$_GET['judge']."<br />";
    //echo "({$frnd}): hey";
    $find_msg=select("chat WHERE (jme='{$me}' OR jme='{$frnd}') AND (jfrnd='{$frnd}' OR jfrnd='{$me}') ORDER BY sort_time DESC");
    if (mysqli_num_rows($find_msg)!=0) {
        $x=1;
        while ($msg=mysqli_fetch_array($find_msg)) {
            if ($msg['off_me']==0&&$msg['off_frnd']==0) {
            }
            if ($x==1) {
                $message="<font color='#000000'>".$msg['chat_msg']."</font>";
            } else {
                $message=$msg['chat_msg'];
            }
            if ($msg['jme']==$me&&$msg['off_me']==0) {
                echo "<div style='text-align: right; margin: 5px 2px -25px 0px;'><span style='border-radius: #333 100px solid; background: #eee; padding: 2px 4px;'><font color='red'>You:</font> <font color='#666666'>".$message."</font></span></div><br />";
            }
            if ($msg['jfrnd']==$me&&$msg['off_frnd']==0) {
                echo "<div style='margin: 5px 2px -25px 0px;'><font color='green'>".$config['judge'][$msg['jme']]['name'].": </font> <font color='#666666'>".$message."</font></div><br />";
                $sql_read="UPDATE chat SET read_msg='1' WHERE jme='{$frnd}' AND jfrnd='{$me}'";
                $query_read=mysqli_query($GLOBALS['connection'], $sql_read);
                //echo $query_read?"<h1>SUCCESS!</h1>":"<h1>FAILED!</h1>";
            }
            $x++;
        }
    }
}
