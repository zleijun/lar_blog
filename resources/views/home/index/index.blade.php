@include('home.public.head')

<div class="container">
	<div class="jumbotron">
		<h1 class="animated fadeInDown">Geeker程序员！</h1>
		<p class="animated shake">此系统是一个教学级博客系统，目前使用Laravel5.6框架开发一个，主要用于学习、练手。Github：https://github.com/zleijun/lar_blog.git。可自行下载源码以及数据库。</p>
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
				{{$articlesl->links()}}
			</nav>
		</div>
		@include('home.public.toparticle')
	</div>
</div>
@include('home.public.footer')