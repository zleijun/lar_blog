@include('admin.public.head')

    <!-- Page Content -->
	<div class="page-content">
        <!-- Page Breadcrumb -->
        <div class="page-breadcrumbs">
            <ul class="breadcrumb">
                <li class="active">
                    <i class="fa fa-home"></i>&nbsp;栏目管理
                </li>
                <li>栏目列表</li>
            </ul>
        </div>
        <!-- /Page Breadcrumb -->
        <!-- Page Body -->
        <div class="page-body">
        	<a href="{{url('admin/addcoulmn')}}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>&nbsp;添加栏目</a>
        	<div class="row">
        		<div class="col-xs-12">
        			<div class="widget">
        				<div class="widget-header">
        					<span class="widget-caption">栏目列表</span>
        					<div class="widget-buttons">
        						{!!strTostr($catelists->links())!!}
        					</div>
        				</div>
        				<div class="widget-body">
        					<table class="table table-hover table-bordered">
        						<thead>
        							<tr>
        								<th>序号</th>
        								<th>栏目名称</th>
        								<th>操作</th>
        							</tr>
        						</thead>
        						<tbody>
        							@foreach($catelists as $vo)
        							<tr userData="{{$vo->id}}">
        								<td>{{$vo->sort}}</td>
        								<td>{{$vo->catename}}</td>
        								<td>
        									<a href="{{url('admin/cateedit',['ids'=>$vo->id])}}" class="btn btn-azure btn-xs">编辑</a>
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

@include('admin.public.footer');

<script type="text/javascript">
	$(function(){
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
                    url:"{{url('admin/catedel')}}",
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