<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Document</title>
	<?php echo $this->tag->stylesheetLink('css/index.css'); ?>
	<?php echo $this->tag->javascriptInclude('js/index.js'); ?>
	<script>
		window.onload=function(){
			var sub=document.getElementById('sub');
			sub.onclick=function(){
				ajax();
				return false;
			}
		}
	</script>
</head>
<body>
	<p><h3>编辑留言!</h3></p>
	<div id="book">
		<ul class="header">
			<li><a href="/PhalconDemo/Index/index">留言</a></li>
			<li><a href="/PhalconDemo/Guest/list">列表</a></li>
			<li><a href="/PhalconDemo/Guest/edit">编辑</a></li>
			<li><a href="/PhalconDemo/Guest/del">删除</a></li>
		</ul>
		<ul class="main">
			<?php foreach ($page->items as $v) { ?>
			<form action="/PhalconDemo/Guest/edit" method="post">
			<input type="hidden" name="id" value="<?php echo $v->id ?>" />
			<p>姓名:<input type="text" name="username" value="<?php echo $v->username ?>"/></p>
			<p class="content">内容:<textarea name="content"><?php echo $v->content ?></textarea></p>
			<p><input type="submit" name="sub" value="修改" class="sub"/></p>
			</form>
			<hr />
			<?php } ?>
			<a href="/PhalconDemo/guest/edit">首页</a>
			<a href="/PhalconDemo/guest/edit?page=<?= $page->before; ?>">上一页</a>
			<a href="/PhalconDemo/guest/edit?page=<?= $page->next; ?>">下一页</a>
			<a href="/PhalconDemo/guest/edit?page=<?= $page->last; ?>">尾页</a>

			<?php echo "共 ", $page->current, " / ", $page->total_pages; ?>
		</ul>
	</div>
</body>
</html>