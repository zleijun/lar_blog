	<div class="footer">
		<p>Copyright 2018 <a href="http://www.zljun.cn">{{$systeminfo->copyright}}</a> All Rights Reserved</p>
	</div>
	
	<script src="/static/home/js/jquery-3.3.1.min.js"></script>
	<script src="/static/home/js/bootstrap.min.js"></script>
	<script src="/static/lib/layer/layer.js"></script>
	<!--Beyond Scripts-->
	<script type="text/javascript">
		$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});
	</script>
</body>
</html>