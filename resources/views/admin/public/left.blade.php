<!-- Page Sidebar -->
<div class="page-sidebar" id="sidebar">
    <ul class="nav sidebar-menu">
    	<li class="active">
    		<a href="{{url('admin/index')}}">
    			<i class="menu-icon glyphicon glyphicon-home"></i>
    			<span class="menu-text">后台首页</span>
    		</a>
    	</li>
    	<li>
    		<a href="index.html" class="menu-dropdown">
    			<i class="menu-icon glyphicon glyphicon glyphicon-th"></i>
    			<span class="menu-text">栏目管理</span>
    			<i class="menu-expand"></i>
    		</a>
    		<ul class="submenu">
    			<li>
    				<a href="{{url('admin/coulmns')}}">
    					<span class="menu-text">栏目列表</span>
    				</a>
    			</li>
    			<li>
    				<a href="{{url('admin/addcoulmn')}}">
    					<span class="menu-text">栏目添加</span>
    				</a>
    			</li>
    		</ul>
    	</li>
    	<li>
    		<a href="#" class="menu-dropdown">
    			<i class="menu-icon glyphicon glyphicon glyphicon-book"></i>
    			<span class="menu-text">文章管理</span>
    			<i class="menu-expand"></i>
    		</a>
    		<ul class="submenu">
    			<li>
    				<a href="{{url('admin/articles')}}">
    					<span class="menu-text">文章列表</span>
    				</a>
    			</li>
    			<li>
    				<a href="{{url('admin/addarticle')}}">
    					<span class="menu-text">文章添加</span>
    				</a>
    			</li>
    		</ul>
    	</li>
        <li>
            <a href="{{url('admin/commentlists')}}">
                <i class="menu-icon glyphicon glyphicon-pencil"></i>
                <span class="menu-text">评论管理</span>
            </a>
        </li>
    	<li>
    		<a href="#" class="menu-dropdown">
    			<i class="menu-icon glyphicon glyphicon glyphicon-user"></i>
    			<span class="menu-text">会员管理</span>
    			<i class="menu-expand"></i>
    		</a>
    		<ul class="submenu">
    			<li>
    				<a href="{{url('admin/memberlists')}}">
    					<span class="menu-text">会员列表</span>
    				</a>
    			</li>
    			<li>
    				<a href="{{url('admin/addmember')}}">
    					<span class="menu-text">会员添加</span>
    				</a>
    			</li>
    		</ul>
    	</li>
    	<li>
    		<a href="#" class="menu-dropdown">
    			<i class="menu-icon glyphicon glyphicon glyphicon-send"></i>
    			<span class="menu-text">管理员管理</span>
    			<i class="menu-expand"></i>
    		</a>
    		<ul class="submenu">
    			<li>
    				<a href="{{url('admin/adminlist')}}">
    					<span class="menu-text">管理员列表</span>
    				</a>
    			</li>
    			<li>
    				<a href="{{url('admin/addadmin')}}">
    					<span class="menu-text">管理员添加</span>
    				</a>
    			</li>
    		</ul>
    	</li>
    	<li>
    		<a href="{{url('admin/systeminfo')}}">
    			<i class="menu-icon glyphicon glyphicon-cog"></i>
    			<span class="menu-text">系统设置</span>
    		</a>
    	</li>
    </ul>
</div>