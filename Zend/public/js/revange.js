function reply_click(clicked_id)
{
   var  x= document.forms[0];
   if (x.choice1)
	   x.choice1.value=clicked_id;
   else
	   x.choice2.value=clicked_id;
  }

var Revange={
		result:function(data,container){
			$.post('/Zend/public/game/resultJSON',{hash:data}, function(data) {
					$(container+ " *").remove();
					$(container).append('<div id="succes"></div>');
					$(container).append('<form id="Game" name="Game" method="post" action="" onsubmit="return Revange.submit()"></form>');
					var ffd=$(container+" form");
					$(container+" form").append('<input type="hidden" value="dsfsf" name="user1"></input>');
					$(container+" form").append('<input type="hidden" value="'+data.game.user2+'" name="user2"></input>');
					$(container+" form").append('<input type="hidden" value="'+data.game.email1+'" name="email1"></input>');
					$(container+" form").append('<input type="hidden" value="'+data.game.email1+'" name="email2"></input>');
					$(container+" form").append('<label><span>Send a message to your opponent</span><textarea name="msg1" cols="50" rows="4"></textarea></label>');
					$(container+" form").append('<div id = "weapons"></div><div class="control-group"><div class="btn-group" data-toggle="buttons-radio"></div></div>');
					$("div.btn-group").append('<img id="1" class="btn btn-primary" onclick="reply_click(this.id)" name="Stein" src="../../img/Zend/Stein.png"></img>');
					$("div.btn-group").append('<img id="2" class="btn btn-primary" onclick="reply_click(this.id)" name="Papier" src="../../img/Zend/Papier.png"></img>');
					$("div.btn-group").append('<img id="3" class="btn btn-primary" onclick="reply_click(this.id)" name="Schere" src="../../img/Zend/Schere.png"></img>');
					$("div.btn-group").append('<img id="4" class="btn btn-primary" onclick="reply_click(this.id)" name="Spock" src="../../img/Zend/spock.png"></img>');
					$("div.btn-group").append('<img id="5" class="btn btn-primary" onclick="reply_click(this.id)" name="Echse" src="../../img/Zend/Echse.png"></img>');
					$(container+" form").append('<input type="hidden" value="" name="choice1"></input>');
					$(container+" form").append('<input id="submitbutton" type="submit" value="New Game" name="submit"></input>');
			
			}, "json");
		},
		submit:function(){
			var returnval=true;
			var  form = document.forms[0];
		  	if(form.user1.value===''){
				returnval=false;
				form.user1.parentNode.parentNode.setAttribute('class','control-group error');
				var s=form.user1.parentNode.parentNode.childNodes[0];
				s.innerHTML='Your username is missing';
			}else{
				form.user1.parentNode.parentNode.setAttribute('class','');
				var s=form.user1.parentNode.parentNode.childNodes[0];
				s.innerHTML="";
			}
			if(form.user2.value===''){
				returnval=false;
				form.user2.parentNode.parentNode.setAttribute('class','control-group error');
				var s=form.user2.parentNode.parentNode.childNodes[0];
				s.innerHTML='Your opponents username missing';
			}else{
				form.user2.parentNode.setAttribute('class','');
				var s=form.user2.parentNode.parentNode.childNodes[0];
				s.innerHTML="";
			}
		  	if(form.email1.value==='' || !checkEmailFormat(form.email1.value)){
				returnval=false;
			   	form.email1.parentNode.parentNode.setAttribute('class','control-group error');
			   	var s=form.email1.parentNode.parentNode.childNodes[0];
			   	s.innerHTML='Your email is missing';
			}else{
				form.email1.parentNode.setAttribute('class','');
				var s=form.email1.parentNode.parentNode.childNodes[0];
				s.innerHTML="";
			}
			if(form.email2.value===''  || !checkEmailFormat(form.email2.value)){
				returnval=false;
				form.email2.parentNode.parentNode.setAttribute('class','control-group error');
				var s=form.email2.parentNode.parentNode.childNodes[0];
				s.innerHTML='Your opponents email is missing';
			}else{
				form.email2.parentNode.setAttribute('class','');
				form.email2.parentNode.parentNode.childNodes[0]='';
				var s=form.email2.parentNode.parentNode.childNodes[0];
				s.innerHTML=""
			}
		  	if(form.choice1.value==='' || form.choice1.value === null || form.choice1.value === undefined){
				returnval=false;
				var el = document.getElementById('weapons');
				el.innerHTML='Please select a weapon!';
			}else{
				var el = document.getElementById('weapons');
				el.innerHTML='';
			}
			if( returnval){
				$('input[type="submit"]').hide();
				$.post('/Zend/public/game/newJSON',{choice1: form.choice1.value,
						email1:form.email1.value,
						email2:form.email2.value,
						submit:	"New GAME",
						user1: form.user1.value,
						user2: form.user2.value	},
						function(data) {
						if(data.data==='sucess'){
								$('#succes *').remove();
								$('#succes').append("<h1>Email sand</h1>");
								$('input[type="submit"]').show();
						}
					}, "json");
				}
			return false;
		}
		


}

