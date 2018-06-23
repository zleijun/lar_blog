@include('home.public.head')

<div class="container">
	<div class="jumbotron">
		<h1 class="animated fadeInDown">Geeker程序员！</h1>
		<p class="animated shake">此系统是一个教学级博客系统，目前使用Laravel5.6框架开发一个，网站暂时只提供博文浏览功能，视频功能、留言功能、投稿功能、收益功能、推荐功能稍后开放。</p>
	</div>
	<div class="row">
		<div class="col-sm-12 col-md-8">
			<div class="page-header h3">{{$searchs?$searchs:'列表'}}</div>
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
				{{$articlesl->links()}}
			</nav>
		</div>
		@include('home.public.toparticle')
	</div>
</div>
@include('home.public.footer')