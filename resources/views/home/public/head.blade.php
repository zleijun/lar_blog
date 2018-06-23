<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge" />
	<title>博客-程序员学习</title>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
	<link rel="stylesheet" href="/static/home/css/bootstrap.min.css" />
	<link rel="stylesheet" href="/static/home/css/animate.css" />
	<link rel="stylesheet" href="/static/home/css/index.css" />
</head>
<body>
	<nav class="navbar navbar-inverse navbar-static-top">
		<div class="container">
			<div class="navbar-header">
				<button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-menu">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="{{url('index')}}" class="navbar-brand">{{$systeminfo->webname}}
			</div>
			<div class="navbar-menu collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-left">
					<li><a href="{{url('index')}}">首页</a></li>
					@foreach($catalists as $ko)
						<li><a href="{{url('index',['id'=>$ko->id])}}">{{$ko->catename}}</a></li>
					@endforeach
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#">登录</a></li>
					<li><a href="#">注册</a></li>
					<li><a href="#">投稿</a></li>
				</ul>
				<form action="#" class="navbar-form navbar-right">
					<div class="form-group">
						<input type="text" class="form-control input-sm" id="search" name="search" placeholder="搜索" />
					</div>
					<div class="form-group">
						<button class="btn btn-default btn-sm">搜索</button>
					</div>
				</form>
			</div>
		</div>
	</nav>