@include('admin.public.head')

<div class="page-content">
    <!-- Page Breadcrumb -->
    <div class="page-breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="fa fa-home"></i>&nbsp;文章管理
            </li>
            <li>文章编辑</li>
        </ul>
    </div>
    <!-- /Page Breadcrumb -->
    <!-- Page Body -->
    <div class="page-body">
    	<div class="row">
    		<div class="col-xs-12">
    			<div class="widget radius-bordered">
    				<div class="widget-header bordered-bottom bordered-themeprimary">
    					<span class="widget-caption">文章编辑</span>
    				</div>
    				<div class="widget-body">
    					<form class="form-horizontal">
    						<div class="form-group">
    							<input type="hidden" name="id" value="{{$articleinfo->id}}">
    							<label for="title" class="control-label col-sm-2">文章标题</label>
    							<div class="col-sm-6">
    								<input type="text" class="form-control" id="title" name="title"l value="{{$articleinfo->title}}" placeholder="文章标题" />
    							</div>
    						</div>
    						<div class="form-group">
    							<label for="title" class="control-label col-sm-2">文章标签</label>
    							<div class="col-sm-6">
    								<input type="text" class="form-control" id="tags" name="tags" value="{{$articleinfo->tags}}" placeholder="文章标签" />
    								<span class="help-block">标签用"|"分割</span>
    							</div>
    						</div>
    						<div class="form-group">
    							<label for="cateid" class="control-label col-sm-2">发布者</label>
    							<div class="col-sm-6">
    								<select name="member_id" class="form-control">
    									<option value="">请选择</option>
    									@foreach($memberlists as $vo)
    										<option value="{{$vo->id}}" @if($vo->id == $articleinfo->member_id) selected @endif >{{$vo->nickname}}</option>
    									@endforeach
    								</select>
    							</div>
    						</div>
    						<div class="form-group">
    							<label for="cateid" class="control-label col-sm-2">所属栏目</label>
    							<div class="col-sm-6">
    								<select name="cate_id" class="form-control">
    									<option value="">请选择</option>
    									@foreach($catelists as $vo)
    										<option value="{{$vo->id}}"  @if($vo->id == $articleinfo->cate_id) selected @endif >{{$vo->catename}}</option>
    									@endforeach
    								</select>
    							</div>
    						</div>
    						<div class="form-group">
    							<label for="content" class="control-label col-sm-2">文章概要</label>
    							<div class="col-sm-6">
    								<textarea name="desc" id="desc" cols="40" rows="5" class="">{{$articleinfo->desc}}</textarea>
    							</div>
    						</div>
    						<div class="form-group">
    							<label for="content" class="control-label col-sm-2">文章内容</label>
    							<div class="col-sm-6">
    								<textarea name="content" id="content" cols="40" rows="10" class="">{{$articleinfo->content}}</textarea>
    							</div>
    						</div>
    						<div class="form-group">
    							<div class="col-sm-offset-2 col-sm-6">
    								<input class="btn btn-primary" type="button" value="提交" id="article_add">
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
<script src="/static/lib/ueditor/ueditor.config.js"></script>
<script src="/static/lib/ueditor/ueditor.all.js"></script>
<script type="text/javascript">
	$(function(){
		UE.getEditor('content');

		$("#article_add").click(function(){
			// console.log($('form').serialize());
			$.ajax({
        		url:"{{url('admin/article')}}",
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