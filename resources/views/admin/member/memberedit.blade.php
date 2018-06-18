@include('admin.public.head')

<div class="page-content">
    <!-- Page Breadcrumb -->
    <div class="page-breadcrumbs">
        <ul class="breadcrumb">
            <li class="active">
                <i class="fa fa-home"></i>&nbsp;会员管理
            </li>
            <li>
            	会员修改
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
    					<span class="widget-caption">会员修改</span>
    				</div>
    				<div class="widget-body">
                        <form class="form-horizontal">
                            <input type="hidden" name="id" value="{{$memberinfo->id}}">
                            <div class="form-group">
                                <label for="catename" class="col-sm-2 control-label no-padding-right">名称</label>
                                <div class="col-sm-6">
                                    <input type="text" readonly class="form-control" value="{{$memberinfo->username}}" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="catename" class="col-sm-2 control-label no-padding-right">昵称</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="nickname" value="{{$memberinfo->nickname}}" placeholder="请输入昵称" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="catename" class="col-sm-2 control-label no-padding-right">邮箱</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" disabled value="{{$memberinfo->email}}" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="catename" class="col-sm-2 control-label no-padding-right">旧密码</label>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control" name='oldpwd' placeholder="请输入旧密码" />
                                </div>
                            </div><div class="form-group">
                                <label for="catename" class="col-sm-2 control-label no-padding-right">新密码</label>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control" name="password" placeholder="请输入新密码" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="button" class="btn btn-primary" id="admin_add">修改</button>
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
        		url:"{{url('admin/memberedit')}}",
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
        					location.href = data.url;
        				});
        			}else{
        				layer.open({
        					title:'修改失败',
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