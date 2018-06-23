@include('home.public.head')

<div class="container">
	<div class="jumbotron">
		<h1 class="animated fadeInDown">梦中程序员！</h1>
		<p class="animated shake">梦中程序员是一个教学级博客系统，目前使用ThinkPHP5.1和Laravel5.5框架各开发一个，网站暂时只提供博文浏览功能，视频功能、留言功能、投稿功能、收益功能、推荐功能稍后开放。</p>
		<h2 class="animated fadeInUp">拜师QQ: <a href="http://wpa.qq.com/msgrd?v=3&uin=305530751&site=qq&menu=yes" target="_blank">305530751</a></h2>
	</div>
	<div class="row">
		<div class="col-sm-12 col-md-8">
			<div class="page-header h3">{{$catename?$catename:'列表'}}</div>
			<div class="article-list">
				
				@foreach($articlesl as $ao)
					<div class="article-list-item">
						<a href="{{url('artinfo',['id'=>$ao->id])}}" class="title">{{$ao->title}}</a>
						<div class="info">
							<span class="author">作者：{{$ao->members->nickname}}</span>-
							<span class="time">发布时间：{{$ao->created_at}}</span>-
							<span class="read">阅读：{{$ao->click}}</span>-
							<span class="comment">评论：{{$ao->comm_num}}</span>
						</div>
					</div>
				@endforeach

			</div>
			<nav class="">
				<!-- <ul class="pagination">
					<li class="disabled"><a href="#">&laquo;</a></li>
					<li class="active"><a href="#">1</a></li>
					<li><a href="#">2</a></li>
					<li><a href="#">3</a></li>
					<li><a href="#">4</a></li>
					<li><a href="#">5</a></li>
					<li><a href="#">&raquo;</a></li>
				</ul> -->
				{{$articlesl->links()}}
			</nav>
		</div>
		@include('home.public.toparticle')
	</div>
</div>
@include('home.public.footer')