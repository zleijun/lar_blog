@include('admin.public.head')
    <!-- Page Content -->
	<div class="page-content">
        <!-- Page Breadcrumb -->
        <div class="page-breadcrumbs">
            <ul class="breadcrumb">
                <li class="active">
                    <i class="fa fa-home"></i>&nbsp;评论管理
                </li>
                <li>评论列表</li>
            </ul>
        </div>
        <!-- /Page Breadcrumb -->
        <!-- Page Body -->
        <div class="page-body">
        	<a href="javascript:;" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>&nbsp;添加评论</a>
        	<div class="row">
        		<div class="col-xs-12">
        			<div class="widget">
        				<div class="widget-header">
        					<span class="widget-caption">评论列表</span>
        					<div class="widget-buttons">
        						{!!strTostr($commentslists->links())!!}
        					</div>
        				</div>
        				<div class="widget-body">
        					<table class="table table-hover table-bordered">
        						<thead>
        							<tr>
        								<th>ID</th>
        								<th>所属文章</th>
        								<th>评论人</th>
        								<th>评论内容</th>
        								<th>操作</th>
        							</tr>
        						</thead>
        						<tbody>
        							@foreach($commentslists as $vo)
        							<tr userData="{{$vo->id}}">
        								<td>{{$vo->id}}</td>
        								<td>{{$vo->articles->title}}</td>
        								<td>{{$vo->members->username}}</td>
        								<td>{{$vo->content}}</td>
        								<td>
        									<a href="javascript:;" class="btn btn-danger btn-xs comment-del">删除</a>
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
        //删除操作
        $('.comment-del').click(function(){
            var thisss = $(this);
            var userid = thisss.parents('tr').attr('userData');

            layer.confirm('是否删除',{
                title:'确认此操作',
                icon:'3',

            },function(index){
                layer.close(index);

                $.ajax({
                    url:"{{url('admin/commentdel')}}",
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