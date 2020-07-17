	<div class="footer">
		 <a target="_blank" href="{{url('admin/login_ins')}}">管理员后台登录
	</div>
	<div class="footer">
		Copyright 2018 <p><a target="_blank" href="http://www.miitbeian.gov.cn">{{$systeminfo->copyright}}</a></p> All Rights Reserved
	</div>
	
	<script src="/static/home/js/jquery-3.3.1.min.js"></script>
	<script src="/static/home/js/bootstrap.min.js"></script>
	<script src="/static/lib/layer/layer.js"></script>
	<!--Beyond Scripts-->
	<script type="text/javascript">
		//全局加Token//
		$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});
	</script>
</body>
</html>