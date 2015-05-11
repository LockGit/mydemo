<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Document</title>
	<?php echo $this->tag->stylesheetLink('css/index.css'); ?>
</head>
<body>
	<p>删除留言!</p>
	<div id="book">
		<ul class="header">
			<li><a href="/PhalconDemo/Index/index">留言</a></li>
			<li><a href="/PhalconDemo/Guest/list">列表</a></li>
			<li><a href="/PhalconDemo/Guest/edit">编辑</a></li>
			<li><a href="/PhalconDemo/Guest/del">删除</a></li>
		</ul>
		<ul class="list">
			<?php foreach($page->items as $v){ ?>
			<li><a href="/PhalconDemo/Guest/del/?id=<?php echo $v->id ?>">删除</a></li>
			<li>留言者:<?php echo $v->username ?></li>
			<li>留言内容:<?php echo $v->content ?></li>
			<li>留言时间:<?php echo date('Y-m-d H:i:s',$v->addtime) ?></li>
			<hr />
			<?php } ?>
			<a href="/PhalconDemo/guest/del">首页</a>
			<a href="/PhalconDemo/guest/del?page=<?= $page->before; ?>">上一页</a>
			<a href="/PhalconDemo/guest/del?page=<?= $page->next; ?>">下一页</a>
			<a href="/PhalconDemo/guest/del?page=<?= $page->last; ?>">尾页</a>

			<?php echo "共 ", $page->current, " / ", $page->total_pages; ?>
		</ul>
	</div>
</body>
</html>