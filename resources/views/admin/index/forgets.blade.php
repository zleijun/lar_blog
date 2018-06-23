<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>程序员管理后台</title>
    <link rel="shortcut icon" href="/static/admin/img/logo.jpg" type="image/x-icon">
    <link href="/static/admin/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/static/admin/css/font-awesome.min.css" rel="stylesheet" />
    <link href="/static/admin/css/weather-icons.min.css" rel="stylesheet" />
    <link id="beyond-link" href="/static/admin/css/beyond.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="login-container">
        <form action="">
        	<div class="loginbox bg-white">
	            <div class="loginbox-title">忘记密码</div>
	            
	            <div class="loginbox-or">
	                <div class="or-line"></div>
	            </div>
	            <div class="loginbox-textbox">
	                <input type="text" class="form-control" name="email" placeholder="请输入邮箱" />
	            </div>
	            <div class="loginbox-textbox" hidden>
	                <input type="text" class="form-control" name="codes" placeholder="请输入验证码" />
	            </div>
	            <div class="loginbox-textbox" hidden>
	                <input type="password" class="form-control" name="password" placeholder="请输入新密码" />
	            </div>
	            <div class="loginbox-textbox" hidden>
	                <input type="password" class="form-control" name="compassword" placeholder="请确认新密码" />
	            </div>
	            <div class="loginbox-submit">
	                <input type="button" class="btn btn-primary btn-block" id="getCodes" value="获取验证码">
	            </div>
	            <div class="loginbox-submit" hidden>
	                <input type="button" class="btn btn-primary btn-block" id="uppwds" name="subsets" value="重置密码">
	            </div>
	            <div class="loginbox-signup">
	                <a href="{{url('admin/login_ins')}}">返回登录</a>
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //获取验证码
        $('#getCodes').click(function(){
        	$.ajax({
        		url:"{{url('admin/forget')}}",
        		type:'post',
        		data:$('form').serialize(),
        		dataType:'json',
        		success:function(data){
        			// console.log(data);
        			if(data.code == 1){
        				layer.msg(data.msg,{
        					icon:6,
        					time:2000
        				},function(){
        					$('input[name=email]').parent().addClass('hidden');
        					$('#getCodes').parent().addClass('hidden');
        					$('input[name=password]').parent().removeAttr('hidden');
        					$('input[name=compassword]').parent().removeAttr('hidden');
        					$('input[name=codes]').parent().removeAttr('hidden');
                            $('input[name=subsets]').parent().removeAttr('hidden');
        				});
        			}else{
        				layer.open({
        					title:'发送失败',
        					content:data.msg,
        					icon:5,
        					anim:6
        				});
        			}
        		}
        	});

        	return false;
        });

        //更改密码
        $("#uppwds").click(function(){
            $.ajax({
                url:"{{url('admin/updpwd')}}",
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
                            title:'更改失败',
                            content:data.msg,
                            icon:5,
                            anim:6
                        });
                    }
                }
            });

            return false;
        });
    </script>
</body>
<!--  /Body -->
</html>
