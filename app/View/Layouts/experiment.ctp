<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>
		<?php echo __('もりけん｜実験システム'); ?>
		<?php //echo $title_for_layout; ?>
	</title>
	<?php echo $this->Html->meta ('favicon.ico','./../../webroot/favicon.ico', array ('type' => 'icon')); ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Le styles -->
	<?php echo $this->Html->css('bootstrap'); ?>
	<?php echo $this->Html->css('buttuns'); ?>
	<style>
	body {
		padding-top: 60px;  /*60px to make the container go all the way to the bottom of the topbar */
	}
	</style>
	<?php echo $this->Html->css('jquery.treegrid'); ?>
	<?php echo $this->Html->css('mycss'); ?>
	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<!-- Le fav and touch icons -->
	<!--
	<link rel="shortcut icon" href="/ico/favicon.ico">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="/ico/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/ico/apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="/ico/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="/ico/apple-touch-icon-57-precomposed.png">
	-->
	<?php
	echo $this->fetch('meta');
	echo $this->fetch('css');
	?>
</head>





<body>
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-header">
			<?php 
                echo $this->Html->link('実験システム',array(
                    'controller' => 'users','action' => 'top',),array(
                        'class' => 'navbar-brand'
                )); 
            ?>
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#gnavi">
                <span class="sr-only">メニュー</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span> 
			</button>
		</div>
		
		<div id="gnavi" class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
            <li>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</li>
			<li><?php echo $this->Html->link('HOME',array('controller' => 'users','action' => 'top'));?></li>
			<li><?php echo $this->Html->link('問題解答',array('controller' => 'past_problems','action' => 'answer'));?></li>
			<li><?php echo $this->Html->link('問題作成/履歴',array('controller' => 'makes','action' => 'showMadeQuestions'));?></li>
			<li><?php echo $this->Html->link('過去問題',array('controller' => 'makes','action' => 'showMadeQuestions'));?></li>
			<li><?php echo $this->Html->link('アンケート','https://fksktest');?></li>
            <li>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</li>
			<li><?php echo $this->Html->link('ログアウト',array('controller' => 'users','action' => 'logout'));?></li>
		</div>
	</nav>

	<div class="container">
			<br />
			<br />
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
	</div> <!-- /container -->

	<!-- Le javascript
    ================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<?php echo $this->Html->script('bootstrap.min'); ?>
	<?php echo $this->fetch('script'); ?>

</body>
</html>
