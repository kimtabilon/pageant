$('document').ready(function(e) {
	$('#category').hide().fadeIn(900);
	$('.cat_score_area').hide().fadeIn(900);
	$('#exit').hover( function(e){
		$('#chatbox').hide();
		$('body').css('color','rgba(0,0,0,1)');
	});
	$('#exit').mouseleave( function(e){
		$('#chatbox').fadeIn(2000);
		$('body').css('color','rgba(255,255,255,1)');
	});
	$('#print').hover( function(e){
		$('#chatbox').hide();
		$('body').css('color','rgba(0,0,0,1)');
	});
	$('#print').mouseleave( function(e){
		$('#chatbox').fadeIn(2000);
		$('body').css('color','rgba(255,255,255,1)');
	});
	$('.close_btn').click(function(){
		$('.inside_chat3').hide();
	});
	$('.msg_txt').attr('autocomplete','off');
	var me=$('.me').val();
	var frnd=$('.frnd').val();
	var lnk='includes/chat.php?chat=1&judge='+me+'&judge_chat='+frnd;
	var auto_refresh = setInterval(
		function(){
			$('.chat_area').load(lnk);
		}, 1000
	);
	
	$('#chat_post').submit(function(e){
		var me=$('.me').val();
		var frnd=$('.frnd').val();
		var msg_txt=$('.msg_txt').val();
		if(!(me==''||frnd==''||msg_txt=='')){
			
			var request=false;
			if(window.XMLHttpRequest){
				request=new XMLHttpRequest();
			}else if(window.ActiveXObject){
				request=new ActiveXObject("Microsoft.XMLHTTP");
			}
			
			var nurl='includes/chat.php?me='+me+'&frnd='+frnd+'&msg='+msg_txt+'&chat_submit=1';
			request.open("GET", nurl);
			
			request.onreadystatechange=function() {
				if(request.readyState==4 && request.status==200){
					return true;
				}
			}
			request.send(null);
			
			$('.msg_txt').val('');
		}
		e.preventDefault();
	});
});
function ajaxScore(lnk){
	var request=false;
	if(window.XMLHttpRequest){
		request=new XMLHttpRequest();
	}else if(window.ActiveXObject){
		request=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	var obj=document.getElementById('exit')
	var nurl=lnk + '&score=' + $('#sel').val();
	request.open("GET", nurl);
	
	request.onreadystatechange=function() {
		if(request.readyState==4 && request.status==200){
			obj.innerHTML=request.responseText;
		}
	}
	request.send(null);
}

function clearwindow(lnk){
	var request=false;
	if(window.XMLHttpRequest){
		request=new XMLHttpRequest();
	}else if(window.ActiveXObject){
		request=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	var obj=document.getElementById('divId')
	var lnk2=lnk+"&judge="+$('.me').val()+"&judge_chat="+$('.frnd').val();
	request.open("GET", lnk2);
	
	request.onreadystatechange=function() {
		if(request.readyState==4 && request.status==200){
			obj.innerHTML=request.responseText;
		}
	}
	request.send(null);
}

function checkValue(field, points){
	if (field.value > points || !int(field.value)) 
		//alert("Maximum score is only " + points + ".");
		$('#sel').val(points);
	else if (field.value < 1) 
		//alert("Minimum score must be 1.");
		$('#sel').val('');
}


