<!DOCTYPE html>
<html>
<head>
	<title>@yield('page_title')</title>
	<style>
		* {
			margin: 0;
			padding: 0;
		}

		.top, .footer {
			width: 100%;
			background: #000;
			height: 50px;
		}

		.left {
			width: 200px;
			background: #ccc;
			min-height: 600px;
			float: left;
		}

		.right {
			float: left;
			width: 700px;
		}

		.footer {
			clear: both;
		}

		ul {
			list-style-type: none;
		}

		ul li a {
			text-decoration: none;
			border-bottom: 1px solid #f1f1f1;
			display: block;
			line-height: 28px;
			padding-left: 10px;
			color: #000;
		}
	</style>
</head>
<body>
	<div class="top"></div>
	<div class="left">
		<ul>
			<li><a href="{{ route('backend.dashboard.index') }}">Dashboard</a></li>
			<li><a href="{{ route('backend.product.index') }}">Product management</a></li>
			<li><a href="{{ route('backend.category.index') }}">Category management</a></li>
			<li><a href="{{ route('backend.news.index') }}">News management</a></li>
			<li><a href="{{ route('backend.user.index') }}">User management</a></li>
		</ul>
	</div>
	<div class="right">
		@yield('main')
	</div>
	<div class="footer"></div>
</body>
</html>