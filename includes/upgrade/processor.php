<?php
    require_once("../connections.php");
    require_once("../function.php");
    
if (isset($_GET['type'])) {
    if ($_GET['type']=="minorCategory") {
        $sqlTable="save_result";
    }
    if ($_GET['type']=="majorCategory") {
        $sqlTable="major_result";
    }

    if ($_GET['type']=="talentCategory") {
        $sqlTable="talent_result";
    }
    
    $findScore=findData($sqlTable, "category", $_GET['category'], "judge", $_GET['judge'], "candidate", $_GET['candidate']);
    if (mysqli_num_rows($findScore)!=0) {
        updateScore($_GET['score'], $_GET['category'], $_GET['judge'], $_GET['candidate'], $sqlTable);
    } else {
        saveScore($_GET['category'], $_GET['judge'], $_GET['candidate'], $_GET['score'], $sqlTable);
    }
}
?>
<a onclick="window.print();" href="?judge=<?php echo $_GET['judge']; ?>"><img src="includes/images/cross.png" /> close</a>


