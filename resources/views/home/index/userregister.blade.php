@include('home.public.head')
	<div class="container">
		<div class="content center-block animated fadeInDown">
			<div class="page-header h1">用户注册</div>
			<form action="#">
				<div class="form-group">
					<label for="username" class="control-label">用户名</label>
					<input type="text" class="form-control" id="username" name="username" placeholder="填写用户名" />
				</div>
				<div class="form-group">
					<label for="nickname" class="control-label">用户昵称</label>
					<input type="text" class="form-control" id="nickname" name="nickname" placeholder="填写用户昵称" />
				</div>
				<div class="form-group">
					<label for="email" class="control-label">邮箱</label>
					<input type="text" class="form-control" id="email" name="email" placeholder="填写邮箱" />
				</div>
				<div class="form-group">
					<label for="password" class="control-label">密码</label>
					<input type="password" class="form-control" id="password" name="password" placeholder="填写密码" />
				</div>
				<div class="form-group">
					<label for="conpass" class="control-label">确认密码</label>
					<input type="password" class="form-control" id="conpass" name="compassword" placeholder="确认密码" />
				</div>
				<div class="form-group">
					<label for="verify" class="control-label">验证码</label>
					<div class="input-group">
						<input type="text" class="form-control" id="verify" name="verify" placeholder="验证码" />
						<span class="input-group-addon">@captcha</span>
					</div>
				</div>
				<div class="form-group">
					<input class="btn btn-primary btn-block" id="user_register" type="button" value="注册">
				</div>
				@csrf
			</form>
		</div>
		<div class="bottom center-block animated fadeInUp">
			Copyright 2018 <a href="http://www.zljun.cn">{{$systeminfo->copyright}}</a> All Rights Reserved
		</div>
	</div>
	<script src="/static/home/js/jquery-3.3.1.min.js"></script>
	<script src="/static/home/js/bootstrap.min.js"></script>
	<script src="/static/lib/layer/layer.js"></script>
	<script type="text/javascript">
		$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});
		$(function(){
			$("#user_register").click(function(){
				$.ajax({
	        		url:"{{url('registers')}}",
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
	        					title:'注册失败',
	        					content:data.msg,
	        					icon:5,
	        					anim:6
	        				});
	        			}
	        		}
	        	});
			});
		});
</script>
</body>
</html>