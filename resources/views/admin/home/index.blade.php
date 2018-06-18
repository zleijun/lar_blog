@include('admin.public.head')

    <!-- Page Content -->
    <div class="page-content">
        <!-- Page Breadcrumb -->
        <div class="page-breadcrumbs">
            <ul class="breadcrumb">
                <li class="active">
                    <i class="fa fa-home"></i>&nbsp;控制面板
                </li>
            </ul>
        </div>
        <!-- /Page Breadcrumb -->
        <!-- Page Body -->
        <div class="page-body">
        	<div class="row">
        		<div class="col-xs-12">
        			<div class="well bordered-left bordered-themeprimary">
        				<h1 style="font-weight: 900!important;font-style: italic;text-shadow: 5px 5px 5px #ff0000;font-family: '新宋体'">
        					欢迎使用程序员后台管理系统！
        				</h1>
        			</div>
        		</div>
        	</div>
        	<div class="row">
        		<div class="col-xs-12">
        			<div class="well with-header with-footer">
        				<div class="header bg-themeprimary">
        					服务器信息
        				</div>
        				<table class="table table-hover table-bordered">
        					<thead>
        						<tr>
        							<th colspan="2">服务器信息</th>
        						</tr>
        					</thead>
        					<tbody>
        						<tr>
        							<td>服务器域名</td>
        							<td>{{request()->server()['SERVER_NAME']}}</td>
        						</tr>
        						<tr>
        							<td>服务器IP地址</td>
        							<td>{{request()->server()['SERVER_ADDR']}}</td>
        						</tr>
        						<tr>
        							<td>服务器端口</td>
        							<td>{{request()->server()['SERVER_PORT']}}</td>
        						</tr>
        					</tbody>
        				</table>
        				<div class="footer">Laravel5.6 学习者</div>
        			</div>
        		</div>
        	</div>
        </div>
        <!-- /Page Body -->
    </div>
    <!-- /Page Content -->

@include('admin.public.footer');