<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>博客-个人管理后台</title>
    <link rel="shortcut icon" href="/static/admin/img/logo.jpg" type="image/x-icon">
    <link href="/static/admin/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/static/admin/css/font-awesome.min.css" rel="stylesheet" />
    <link href="/static/admin/css/weather-icons.min.css" rel="stylesheet" />
    <link id="beyond-link" href="/static/admin/css/beyond.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="login-container">
        <form action="" onsubmit="return checkForm()">
        	<div class="loginbox bg-white">
	            <div class="loginbox-title">博客-个人管理后台</div>
	            
	            <div class="loginbox-or">
	                <div class="or-line"></div>
	            </div>
	            <div class="loginbox-textbox">
	                <input type="text" class="form-control" name="username" placeholder="管理员账户" />
	            </div>
	            <div class="loginbox-textbox">
	                <input type="password" class="form-control" name="password" placeholder="管理员密码" />
	            </div>
	            <div class="loginbox-forgot">
	                <a href="{{url('admin/forget')}}">忘记密码?</a>
	            </div>
	            <div class="loginbox-submit">
	                <input type="submit" class="btn btn-primary btn-block" value="登录">
	            </div>
	            <div class="loginbox-signup">
	                <a href="{{url('admin/register')}}">注册账户</a>
	            </div>
	        </div>
        </form>
    </div>

    <script src="/static/admin/js/skins.min.js"></script>
    <!--Basic Scripts-->
    <script src="/static/admin/js/jquery.min.js"></script>
    <script src="/static/admin/js/bootstrap.min.js"></script>
    <script src="/static/admin/js/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="/static/lib/layer/layer.js"></script>
    <!--Beyond Scripts-->
    <script src="/static/admin/js/beyond.js"></script>
    <script>
        $(window).bind("load", function () {

            /*Sets Themed Colors Based on Themes*/
            themeprimary = getThemeColorFromCss('themeprimary');
            themesecondary = getThemeColorFromCss('themesecondary');
            themethirdcolor = getThemeColorFromCss('themethirdcolor');
            themefourthcolor = getThemeColorFromCss('themefourthcolor');
            themefifthcolor = getThemeColorFromCss('themefifthcolor');

        });

        //登录AJAX
        function checkForm(){
        	$.ajax({
        		url:"{{url('admin/login_ins')}}",
        		type:'post',
        		data:$('form').serialize(),
        		dataType:'json',
        		success:function(data){
        			if(data.code == 1){
        				layer.msg(data.msg,{
        					icon:6,
        					time:2000
        				},function(){
        					location.href = data.url;
        				});
        			}else{
        				layer.open({
        					title:'登录失败',
        					content:data.msg,
        					icon:5,
        					anim:6
        				});
        			}
        		}
        	});

        	return false;
        }
    </script>
</body>
<!--  /Body -->
</html>
