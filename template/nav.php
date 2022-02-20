<?php defined('BASEPATH') OR exit('no direct script access allowed');
?>
<!-- ======== sidebar-nav start =========== -->
<aside class="sidebar-nav-wrapper">
	<div class="navbar-logo">
		<h1 class="text-light fw-bold">
			<?php echo $webconfig['title']; ?>
		</h1>
	</div>
	<nav class="sidebar-nav">
		<ul>
			<li class="nav-item <?php if(preg_match("/\/[a-zA-Z]+\/$/",$_SERVER['REQUEST_URI']) or $_SERVER['REQUEST_URI'] == '/'){echo "active";}?>">
				<a href="./">
					<span class="icon"><i class="lni lni-dashboard"></i></span>
					<span class="text">Dashboard</span>
				</a>
			</li>

			<li class="nav-item <?php if(isset($_GET['module']) AND $_GET['module'] == 'universaldeep'){echo "active";}?>">
				<a href="./?module=universaldeep">
					<span class="icon"><i class="lni lni-world"></i></span>
					<span class="text">Universal Deep</span>
				</a>
			</li>				

			<li class="nav-item <?php if(isset($_GET['module']) AND $_GET['module'] == 'universalindex'){echo "active";}?>">
				<a href="./?module=universalindex">
					<span class="icon"><i class="lni lni-world"></i></span>
					<span class="text">Universal Index</span>
				</a>
			</li>	

			<li class="nav-item <?php if(isset($_GET['module']) AND $_GET['module'] == 'universalpost'){echo "active";}?>">
				<a href="./?module=universalpost">
					<span class="icon"><i class="lni lni-world"></i></span>
					<span class="text">Universal Post</span>
				</a>
			</li>	

			<span class="divider"><hr></span>

			<li class="nav-item <?php if(isset($_GET['module']) AND $_GET['module'] == 'bloggerindex'){echo "active";}?>">
				<a href="./?module=bloggerindex">
					<span class="icon"><i class="lni lni-blogger"></i></span>
					<span class="text">Blogger Index</span>
				</a>
			</li>	

			<li class="nav-item <?php if(isset($_GET['module']) AND $_GET['module'] == 'bloggerpost'){echo "active";}?>">
				<a href="./?module=bloggerpost">
					<span class="icon"><i class="lni lni-blogger"></i></span>
					<span class="text">Blogger Post</span>
				</a>
			</li>

		</ul>
	</nav>
</aside>
<div class="overlay"></div>
<!-- ======== sidebar-nav end =========== -->