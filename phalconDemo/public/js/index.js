function ajax(){
	var one=document.getElementById('one').value;
	var two=document.getElementById('two').value;
	var opera=document.getElementsByName('type');
	for(i=0;i<opera.length;i++){
		if(opera[i].checked){
			var option=opera[i].value;
		}
	}
	var xmlhttp;
	if(window.XMLHttpRequest){
		xmlhttp=new XMLHttpRequest();
	}else{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}

	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
		}
	}
	var fm=document.form[0];
	xmlhttp.open('POST','/PhalconDemo/Index/calc');
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send('one='+one+'&two='+two+'&type='+option);
	return false;
}