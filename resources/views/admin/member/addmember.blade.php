@include('admin.public.head')

<div class="page-content">
    <!-- Page Breadcrumb -->
    <div class="page-breadcrumbs">
        <ul class="breadcrumb">
            <li class="active">
                <i class="fa fa-home"></i>&nbsp;会员管理
            </li>
            <li>
            	会员添加
            </li>
        </ul>
    </div>
    <!-- /Page Breadcrumb -->
    <!-- Page Body -->
    <div class="page-body">
    	<div class="row">
    		<div class="col-xs-12">
    			<div class="widget radius-bordered">
    				<div class="widget-header bordered-bottom bordered-themeprimary">
    					<span class="widget-caption">会员添加</span>
    				</div>
    				<div class="widget-body">
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label for="catename" class="col-sm-2 control-label no-padding-right">账户</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="username" placeholder="请输入账户" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="catename" class="col-sm-2 control-label no-padding-right">昵称</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="nickname" placeholder="请输入昵称" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="catename" class="col-sm-2 control-label no-padding-right">邮箱</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="email" placeholder="请输入邮箱" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="catename" class="col-sm-2 control-label no-padding-right">登录密码</label>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control" name='password' placeholder="请输入登录密码" />
                                </div>
                            </div><div class="form-group">
                                <label for="catename" class="col-sm-2 control-label no-padding-right">确认密码</label>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control" name="compassword" placeholder="请再次确认密码" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="button" class="btn btn-primary" id="admin_add">添加</button>
                                </div>
                            </div>
                        </form>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
    <!-- /Page Body -->
</div>
<!-- /Page Content -->

@include('admin.public.footer')
<script type="text/javascript">
	$(function(){
		$("#admin_add").click(function(){
			$.ajax({
        		url:"{{url('admin/addmember')}}",
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
        					title:'添加失败',
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