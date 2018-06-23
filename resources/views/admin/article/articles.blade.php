@include('admin.public.head')
    <!-- Page Content -->
	<div class="page-content">
        <!-- Page Breadcrumb -->
        <div class="page-breadcrumbs">
            <ul class="breadcrumb">
                <li class="active">
                    <i class="fa fa-home"></i>&nbsp;文章管理
                </li>
                <li>文章列表</li>
            </ul>
        </div>
        <!-- /Page Breadcrumb -->
        <!-- Page Body -->
        <div class="page-body">
        	<a href="{{url('admin/addarticle')}}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>&nbsp;添加文章</a>
        	<div class="row">
        		<div class="col-xs-12">
        			<div class="widget">
        				<div class="widget-header">
        					<span class="widget-caption">文章列表</span>
        					<div class="widget-buttons">
        						{!!strTostr($articleslists->links())!!}
        					</div>
        				</div>
        				<div class="widget-body">
        					<table class="table table-hover table-bordered">
        						<thead>
        							<tr>
        								<th>ID</th>
        								<th>文章标题</th>
        								<th>发布人</th>
        								<th>所属栏目</th>
        								<th>是否推荐</th>
        								<th>是否展示</th>
        								<th>操作</th>
        							</tr>
        						</thead>
        						<tbody>
        							@forelse($articleslists as $vo)
        							<tr userData="{{$vo->id}}">
        								<td>{{$vo->id}}</td>
        								<td>{{$vo->title}}</td>
        								<th>{{$vo->members->username}}</th>
        								<th>{{$vo->cates->catename}}</th>
        								<th>
        									@if($vo->is_top == 1)
        										推荐
        									@else
        										不推荐
        									@endif
        								</th>
        								<th>
        									@if($vo->status == 1)
        										上架
        									@else
        										下架
        									@endif
        								</th>
        								<td>
        									@if($vo->is_top == 1)
    											<a href="#" class="btn btn-warning btn-xs user_datas" state-type='1' user-status="{{$vo->is_top}}">取消推荐</a>
        									@else
        										<a href="#" class="btn btn-success btn-xs user_datas" state-type='1' user-status="{{$vo->is_top}}">推荐</a>
        									@endif

    										@if($vo->status == 1)
    											<a href="#" class="btn btn-warning btn-xs user_datas" state-type='2' user-status="{{$vo->status}}">下架</a>
        									@else
        										<a href="#" class="btn btn-success btn-xs user_datas" state-type='2' user-status="{{$vo->status}}">上架</a>
        									@endif

        									<a href="{{url('admin/article',['id'=>$vo->id])}}" class="btn btn-azure btn-xs">编辑</a>
        									<a href="javascript:;" class="btn btn-danger btn-xs article-del">删除</a>
        								</td>
        							</tr>
        							@empty
        								<tr><td colspan="7">暂无文章</td></tr>
        							@endforelse
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
		//上下架|是否推荐修改
		$('.user_datas').click(function(){
			var thisss = $(this);
			var userid = thisss.parents('tr').attr('userData');
			var userStats = thisss.attr('user-status');
            var statestype = thisss.attr('state-type');
			var msgs = '是否确认';
			layer.confirm(msgs,{
				title:'确认此操作',
				icon:'3',

			},function(index){
				layer.close(index);
                if(statestype==1){
                    var datas = "id="+userid+"&is_top="+userStats;
                }else{
                    var datas = "id="+userid+"&status="+userStats;
                }
				$.ajax({
	        		url:"{{url('admin/article')}}",
	        		type:'post',
	        		data:datas,
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
        $('.article-del').click(function(){
            var thisss = $(this);
            var userid = thisss.parents('tr').attr('userData');

            layer.confirm('是否删除',{
                title:'确认此操作',
                icon:'3',

            },function(index){
                layer.close(index);

                $.ajax({
                    url:"{{url('admin/articledel')}}",
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