<?php
	session_start();
	if(!isset($_SESSION['granted'])OR!$_SESSION['granted']){ header('location:request-access.php'); exit; } 
	include("../includes/connections.php");
	include("../includes/candidate.php");
	include("../includes/function.php");
	$judge = $_SESSION['judge'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Pageant Easy Tabulation</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link href="../includes/images/icon.ico" rel="icon" />
	<link href="../includes/upgrade/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="../includes/upgrade/bootstrap/css/responsive.css" rel="stylesheet" type="text/css" />
	<script src="../includes/upgrade/jquery-1.11.1.js" type="text/javascript"></script>
</head>

<body>
		<div class="text-center font-violet">
			<h4>
			Miss Siquijor Tourism <?=date('Y')?>
			</h4>
		</div>
			<?php 
				if($_GET['type']=='minor') { $getList=select("categories"); $field='category'; } 
				if($_GET['type']=='major') { $getList=select("majorcategories"); $field='majorCat'; } 
			?>
		<div>
			<div class="pull-left">
			<select class="form-control btn-danger category-select" style="max-width:230px;">
				<option value="all-<?=$_GET['type']?>">All <?=$_GET['type']?> categories</option>
				<?php if($getList): ?>
					<?php while($list=mysql_fetch_assoc($getList)): ?>
					<option class="<?=$list['points']?>"><?=$list[$field]?></option>
					<?php endwhile; ?>
				<?php endif; ?>
			</select>
			</div>
			<div class="pull-right">
			<a href="?type=minor" class="btn btn-xs btn-<?=$_GET['type']=='minor'?'primary':'default'?>">Minor</a>
			<a href="?type=major" class="btn btn-xs btn-<?=$_GET['type']=='major'?'primary':'default'?>">Major</a>
			</div>
			<div class="clearfix"></div>
		</div>	
			
		<div class="table-responsive candidate-group">
		<table class="table">
			<tr>
			<?php for($x=1; $x<=canNum("ms"); $x++): ?>
			<td class="candidate-img-wrap">
				<p class="candidate-label"># <?=$x?> &nbsp; <span class="badge-score-<?=$x?> badge score-badge" style="display:none;">0</span></p>
				<label>
					<input type="radio" name="candidate" class="candidate-number" value="<?=$x?>">
					<img src="../includes/images/candidates/<?=$config['candidate'][$x]['img']?>" class="candidate-img">
				</label>
			</td>	
			<?php endfor; ?>
			</tr>
		</table>
		</div>
		<div class="container-fluid">
			<div class="candidate-profile alert alert-success"><span class="glyphicon glyphicon-screenshot"></span> Hi <?=$config['judge'][$judge]['name']?>. Scroll images to left or click on it!</div>
			<?php foreach($config['candidate'] as $number => $candidate): ?>
			<h4 class="candidate-profile candidate_<?=$number?>" style="display:none;">
				#<?=$number.' '.$candidate['name']?> <small> / <?=$candidate['age']?></small><br>
				<small><?=$candidate['address']?> / <?=$candidate['vital']?></small><br>
			</h4>
			<?php endforeach; ?>
			
			<div class="display-all-result"></div>
		</div>
		
		<div class="judge-scoreboard" style="display:none; text-align:center;">
			<input type="number" class="select-score form-control btn-danger" style="max-width:200px;">
			<div class="label label-success help-message">Hi <?=$config['judge'][$judge]['name']?>, maximum score must be <span class="score-max">0</span>.</div>
		</div>
		<span class="score-max score-max-hidden" style="display:none;">0</span>
		<span class="hidden-help-message" style="display:none;">Hi <?=$config['judge'][$judge]['name']?>, maximum score must be <span class="score-max">0</span>.</span>
		<span class="active-candidate" style="display:none;">0</span>
		<span class="active-category" style="display:none;">all-<?=$_GET['type']?></span>
		<span class="category-type" style="display:none;"><?=$_GET['type']?></span>
	
	<script src="../includes/upgrade/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script>
		$('document').ready( function(){
					
			function displayAllResult(candidate, type) {
				$('.display-all-result').text('Please wait ...');
				$.ajax({
					url: '../includes/requesthandler.php',
					type: 'post',
					data: { task: 'getAllResult', candidate: candidate, type: type },
					success: function(response) {
						$('.display-all-result').html(response);
					},
					error: function() {
						$('.display-all-result').text('Whoops, result was unable to display!');
					}
				});			
			
			}
			
			function displayCategoryScore(category, type) {
				$.ajax({
					url: '../includes/requesthandler.php',
					type: 'post',
					data: { task: 'getCategoryScore', category: category, type: type },
					success: function(response) {
						response = JSON.parse(response);
						$.each(response, function(key,val){
							$('.badge-score-'+key).text(val);
						});
						
					},
					error: function() {
						$('.display-all-result').text('Whoops, server not found!');
					}
				});
			
			}
			
			function autoSaveScore(candidate, category, type, score) {
				$.ajax({
					url: '../includes/requesthandler.php',
					type: 'post',
					data: { task: 'autoSaveScore', candidate: candidate, category: category, type: type, score: score },
					success: function(response) {
						if(response) { $('.help-message').text('Saved!'); }
						else { $('.help-message').text('Unable to saved! Refresh this page.'); }
					},
					error: function() {
						$('.help-message').text('Server not found!');
					}
				});
			}
						
			$('.candidate-img').on('click', function(){
				var candidate = $(this).parents('label').find('.candidate-number').val();
				var active_category = $('.active-category').text();
				var active_candidate = $('.active-candidate').text();
				var type_category = $('.category-type').text();
				var score = $(this).parents('td').find('.score-badge').text();
				
				$('.candidate-profile').hide();
				$('.candidate_'+candidate).show();
				$('.active-candidate').text(candidate);
				
				if(active_category=='all-minor'||active_category=='all-major') { 
					$('.judge-scoreboard').hide(); 
					$('.score-badge').hide(); 
					displayAllResult(candidate, type_category);
				} 
				else { 
					$('.help-message').html($('.hidden-help-message').html());
					$('.judge-scoreboard').show(); 
					$('.select-score').val(score);  
					$('.score-badge').show();  
				}
			});
			
			$('.category-select').on('change', function(){
				var active_candidate = $('.active-candidate').text();
				var active_category = $('.active-category').text();
				var type_category = $('.category-type').text();
				var score = $(this).parents('body').find('.badge-score-'+active_candidate).text();
				var scoremax = $(this).find('option:selected').attr('class');
				
				$('.score-max').text(scoremax);
				
				$('.active-category').text($(this).val());
				if($(this).val()=='all-minor'||$(this).val()=='all-major') { 
					$('.judge-scoreboard').hide(); 
					$('.score-badge').hide(); 
					displayAllResult(active_candidate, type_category);
				}
				else if(active_candidate!=0) { 
				
					$('.judge-scoreboard').show(); 
					$('.score-badge').show(); 
					$('.display-all-result').html('');
					$('.select-score').val(0);
					$('.select-score').val(score);
					
					displayCategoryScore($(this).val(), type_category);
				} 
				else {
					$('.select-score').val(0);
					$('.score-badge').show(); 
					displayCategoryScore($(this).val(), type_category);
				}
				
				if(active_candidate) {
					
				}
			});
			
			$('.select-score').on('click',function(){ 
				$(this).val('');
			}).on('keyup', function(){
				var candidate = $('.active-candidate').text();
				var active_category = $('.active-category').text();
				var type_category = $('.category-type').text();
				var updateScore =  parseFloat($(this).val());
				var scoremax = parseFloat($(this).parents('body').find('.score-max-hidden').text());
				
				if((scoremax!=0||updateScore!=0||updateScore!='')&&updateScore<=scoremax) {
					$('.badge-score-'+candidate).text(updateScore);
					autoSaveScore(candidate, active_category, type_category, updateScore); 
				}
				if(updateScore>scoremax){
					$(this).val(scoremax);
					$('.badge-score-'+candidate).text(scoremax);
					autoSaveScore(candidate, active_category, type_category, scoremax); 
				}
				
				
			});
			
		});
	</script>
</body>
</html>