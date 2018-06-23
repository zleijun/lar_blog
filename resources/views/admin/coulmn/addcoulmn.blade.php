@include('admin.public.head')

<div class="page-content">
    <!-- Page Breadcrumb -->
    <div class="page-breadcrumbs">
        <ul class="breadcrumb">
            <li class="active">
                <i class="fa fa-home"></i>&nbsp;栏目管理
            </li>
            <li>
            	栏目添加
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
    					<span class="widget-caption">栏目添加</span>
    				</div>
    				<div class="widget-body">
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label for="catename" class="col-sm-2 control-label no-padding-right">栏目名称</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="catename" placeholder="请输入栏目名称" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="catename" class="col-sm-2 control-label no-padding-right">栏目排序</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="sort" placeholder="请输入栏目排序" />
                                    <span class="help-block">数字越小越靠后</span>
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

@include('admin.public.footer');

<script type="text/javascript">
	$(function(){
		$("#admin_add").click(function(){
			$.ajax({
        		url:"{{url('admin/addcoulmn')}}",
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