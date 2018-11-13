<?php
	session_start();
	include("connections.php");
	include("function.php");
	
	if(isset($_POST['task'])AND$_POST['task']){
		switch($_POST['task']) {
			case 'getAllResult':
				$type=$_POST['type'];
				$candidate=$_POST['candidate'];
				if($type=='minor') {
					$getList=select("categories"); $field='category'; $table='save_result';
				}
				
				if($type=='major') {
					$getList=select("majorcategories"); $field='majorCat'; $table='major_result';
				}
				 
				echo "
					<script>
						$('.chosen-category, .category-points').on('click', function(){
							var textbox = $(this).parents('.each-category').find('.each-score');
							if(parseFloat(textbox.val())==0||textbox.val()=='') {
								textbox.val('').focus();
							}
							else { textbox.focus(); } 
						});
					
						$('.each-score')
						.on('click', function(){
							var category = $(this).parents('.each-category').find('.chosen-category').text();
							var score = $(this).val();
							
							if(score==0) {
								$(this).val('');
							}
						})
						.on('keyup', function(){
							var category = $(this).parents('.each-category').find('.chosen-category').text();
							var maximumPts = parseFloat($(this).parents('.each-category').find('.category-points').text());
							var score = parseFloat($(this).val());
							var notifier = $(this).parents('.each-category').find('.alert-notification');
							
							$(this).parents('.each-category').find('.category-points').hide();
							
							if((score!=''||score!=0)&&score<=maximumPts) {
								$.ajax({
									url: '../includes/requesthandler.php',
									type: 'post',
									data: { task: 'autoSaveScore', candidate: '".$candidate."', category: category, type: '".$type."', score: score },
									success: function(response) {
										if(response) { notifier.html('<div class=\"btn btn-xs btn-success\"><div class=\"glyphicon glyphicon-thumbs-up\"></div></div>'); }
										else { notifier.html('<div class=\"btn btn-xs btn-danger\"><div class=\"glyphicon glyphicon-thumbs-down\"></div></div>'); }
										
									},
									error: function() {
										notifier.html('<div class=\"btn btn-xs btn-danger\">Server not found!</div>'); 
									}
								});
							}
							else if(score>maximumPts){
								$(this).val(maximumPts);
								$.ajax({
									url: '../includes/requesthandler.php',
									type: 'post',
									data: { task: 'autoSaveScore', candidate: '".$candidate."', category: category, type: '".$type."', score: maximumPts },
									success: function(response) {
										if(response) { notifier.html('<div class=\"btn btn-xs btn-success\"><div class=\"glyphicon glyphicon-thumbs-up\"></div></div>'); }
										else { notifier.html('<div class=\"btn btn-xs btn-danger\"><div class=\"glyphicon glyphicon-thumbs-down\"></div></div>'); }
										
									},
									error: function() {
										notifier.html('<div class=\"btn btn-xs btn-danger\">Server not found!</div>'); 
									}
								});
							}
							
							
						});
					</script>
				"; 
				while($list=mysql_fetch_assoc($getList)) {
					echo '<div class="each-category" style="margin-bottom:2px;">
							<span>
							<input class="form-control btn-danger each-score" type="number" value="'.getScore($table, $_SESSION['judge'], $candidate, $list[$field], 'category').'" style="width:50px; float:left; height:30px; text-align:center;">
						</span>
						<span class="btn btn-sm btn-default chosen-category">'.$list[$field].'</span>
						<span class="btn btn-sm btn-default category-points">'.$list['points'].'</span>
						<span class="alert-notification"></span>
						</div>';
				}
				break;
				
			case 'getCategoryScore':
				$type=$_POST['type'];
				$category=$_POST['category'];
				if($type=='minor') {
					$field='category'; $table='save_result';
				}
				
				if($type=='major') {
					$field='majorCat'; $table='major_result';
				}
				echo "{";
				for($x=1; $x<=$canNumMs+$canNumMr; $x++){
					echo '"'.$x.'":"'.getScore($table, $_SESSION['judge'], $x, $category, 'category').'"';
					if($x!=($canNumMs+$canNumMr)) { echo ','; } 
				}
				echo "}";
				break;
				
			case 'autoSaveScore':
				$type=$_POST['type'];
				$category=$_POST['category'];
				$candidate=$_POST['candidate'];
				$score=$_POST['score'];
				
				
				if($type=='minor') {
					$field='category'; $table='save_result';
				}
				
				if($type=='major') {
					$field='majorCat'; $table='major_result';
				}
				
				if(autoSaveScore($table, $candidate, $category, $score, $_SESSION['judge'])) { echo 1; }
				else { echo 0; }
				
				break;
		}
	}
	
	
?>	