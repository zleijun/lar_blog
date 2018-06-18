@include('admin.public.head')

	<div class="page-content">
        <!-- Page Breadcrumb -->
        <div class="page-breadcrumbs">
            <ul class="breadcrumb">
                <li class="active">
                    <i class="fa fa-home"></i>&nbsp;会员管理
                </li>
                <li>会员列表</li>
            </ul>
        </div>
        <!-- /Page Breadcrumb -->
        <!-- Page Body -->
        <div class="page-body">
        	<a href="{{url('admin/addmember')}}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>&nbsp;添加会员</a>
        	<div class="row">
        		<div class="col-xs-12">
        			<div class="widget">
        				<div class="widget-header">
        					<span class="widget-caption">会员列表</span>
        					<div class="widget-buttons">
        						{!!strTostr($memberlists->links())!!}
        					</div>
        				</div>
        				<div class="widget-body">
        					<table class="table table-hover table-bordered">
        						<thead>
        							<tr>
        								<th>ID</th>
        								<th>用户名称</th>
        								<th>用户昵称</th>
        								<th>email</th>
        								<th>类型</th>
        								<th>状态</th>
        								<th>操作</th>
        							</tr>
        						</thead>
        						<tbody>
        							@foreach($memberlists as $vo)
        							<tr userData="{{$vo->id}}">
        								<td>{{$vo->id}}</td>
        								<td>{{$vo->username}}</td>
        								<th>{{$vo->nickname}}</th>
        								<th>{{$vo->email}}</th>
        								<th>
        									@if($vo->is_super == 1)
        										会员
        									@else
        										普通
        									@endif
        								</th>
        								<th>
        									@if($vo->status == 1)
        										正常
        									@else
        										禁用
        									@endif
        								</th>
        								<td>
        									@if(session('admin.is_super') == 1 && $vo->is_super != 1)
        										@if($vo->status == 1)
        											<a href="#" class="btn btn-warning btn-xs user_datas" user-status="{{$vo->status}}">禁用</a>
	        									@else
	        										<a href="#" class="btn btn-success btn-xs user_datas" user-status="{{$vo->status}}">启用</a>
	        									@endif
        									@endif
        									<a href="{{url('admin/memberedit',['id'=>$vo->id])}}" class="btn btn-azure btn-xs">编辑</a>
        									<a href="javascript:;" class="btn btn-danger btn-xs admin-del">删除</a>
        								</td>
        							</tr>
        							@endforeach
        						</tbody>
        					</table>
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
		//禁用、启用
		$('.user_datas').click(function(){
			var thisss = $(this);
			var userid = thisss.parents('tr').attr('userData');
			var userStats = thisss.attr('user-status');
			var msgs = userStats?'确定是否禁用?':'确定是否开启';
			layer.confirm(msgs,{
				title:'确认此操作',
				icon:'3',

			},function(index){
				layer.close(index);

				$.ajax({
	        		url:"{{url('admin/memberstatus')}}",
	        		type:'post',
	        		data:{id:userid,status:userStats},
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
	        					title:'操作失败',
	        					content:data.msg,
	        					icon:5,
	        					anim:6
	        				});
	        			}
	        		}
	        	});
			});
		})

        //删除操作
        $('.admin-del').click(function(){
            var thisss = $(this);
            var userid = thisss.parents('tr').attr('userData');

            layer.confirm('是否删除',{
                title:'确认此操作',
                icon:'3',

            },function(index){
                layer.close(index);

                $.ajax({
                    url:"{{url('admin/memberdel')}}",
                    type:'post',
                    data:{id:userid},
                    dataType:'json',
                    success:function(data){
                        if(data.code == 1){
                            layer.msg(data.msg,{
                                icon:6,
                                time:2000
                            },function(){
                                thisss.parents('tr').remove();
                            });
                        }else{
                            layer.open({
                                title:'操作失败',
                                content:data.msg,
                                icon:5,
                                anim:6
                            });
                        }
                    }
                });
            });
        });
	})	
</script>