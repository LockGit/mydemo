<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Document</title>
	<?php echo $this->tag->stylesheetLink('css/index.css'); ?>
	<?php echo $this->tag->javascriptInclude('js/index.js'); ?>
	<?php echo $this->tag->javascriptInclude('js/jquery.js'); ?>
	<script>
		$(function(){
			$("#ajaxSub").click(function(){
				// var one=document.getElementById('one').value;
				// var two=document.getElementById('two').value;
				// var opera=document.getElementsByName('type');
				// for(i=0;i<opera.length;i++){
				// 	if(opera[i].checked){
				// 		var option=opera[i].value;
				// 	}
				// }
				var one=$("#one").val();
				var two=$("#two").val();
				var option=$("input[name='type']:checked").val();
				$.ajax({
                    type: "POST",
                    url: "http://localhost/PhalconDemo/Index/calc",
                    data: {
                    	one:one,
                    	two:two,
                    	type:option
                    },
                    success: function(msg){
                      $("#myDiv").html(msg);
                    }
                 });
				return false;
			});
		});
	</script>
</head>
<body>
	<p><h3>1.使用Phalcon打印hello world</h3></p>
	<p>hello world !!!</p>
	<p><h3>2.使用Phalcon实现一个计算器程序！</h1></p>
	<div id="main">
		<?php echo $this->tag->form(array('index/calc')); ?>
			<p>数字1：<?php echo $this->tag->textField(array('one')); ?></p>
			<?php $num = array('+', '-', 'x', '/'); ?>
			<p>选择运算类型：
				<?php foreach ($num as $index => $v) { ?>
					<?php echo $v; ?><?php echo $this->tag->radioField(array('type', 'value' => $v)); ?> 
				<?php } ?>
			</p>
			<p>数字2：<?php echo $this->tag->textField(array('two')); ?></p>
			<p><button id="ajaxSub">计算</button></p>
		</form>
		<div id="myDiv">
		</div>
	</div>
	<p><h3>3.使用Phalcon实现一个留言本！</h3></p>
	<div id="book">
		<ul class="header">
			<li><a href="/PhalconDemo/Index/index">留言</a></li>
			<li><a href="/PhalconDemo/Guest/list">列表</a></li>
			<li><a href="/PhalconDemo/Guest/edit">编辑</a></li>
			<li><a href="/PhalconDemo/Guest/del">删除</a></li>
		</ul>
		<ul class="main">
			<form action="/PhalconDemo/Guest/add" method="post">
			<p>姓名:<input type="text" name="username"/></p>
			<p class="content">内容:<textarea name="content"></textarea></p>
			<p><input type="submit" name="sub" value="留言" class="sub"/></p>
			</form>
		</ul>
	</div>
	<p><a href="./backend/Index/index">后台</a></p>
</body>
</html>