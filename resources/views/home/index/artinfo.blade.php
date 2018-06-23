@include('home.public.head')

<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-8">
				<h1 class="article-title">{{$articlesinfos->title}}</h1>
				<div class="status">{{$articlesinfos->click}}阅读-{{$articlesinfos->comm_num}}评论-作者：{{$articlesinfos->members->nickname}}
					@foreach(explode(',',$articlesinfos->tags) as $vos)
						<span class="label label-default">{{$vos}}</span>
					@endforeach
				</div>
				<div class="article-content">
					<blockquote>
						{{$articlesinfos->desc}}
					</blockquote>
					{!!$articlesinfos->content!!}
				</div>
				<div class="article-comment">
					<div class="page-header"><b>相关评论</b></div>
					<div class="comment-content">
						<form action="#">
							<div class="form-group">
								<textarea class="form-control" id="comment" name="comment" rows="5" cols=""></textarea>
							</div>
							<div class="form-group pull-right">
								<button class="btn btn-primary">评论（请认真评论）</button>
							</div>
						</form>
					</div>
					<div class="clearfix"></div>

					@foreach($articlesinfos->comments as $cos)
						<div class="comment-list">
							<div class="comment-list-item">
								<div class="info">{{$cos->members->nickname}}<small>{{$cos->created_at}}</small></div>
								<div class="content">{{$cos->content}}</div>
							</div>
						</div>
					@endforeach
				</div>
			</div>
			@include('home.public.toparticle')
		</div>
	</div>

@include('home.public.footer')