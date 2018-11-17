<?php
$sidebarLink = array(
	array('link'=>'', 'icon'=>'dashboard', 'label'=>'Dashboard'), 
	array('link'=>'invoice', 'icon'=>'file-text', 'label'=>'Invoice'), 
	array('link'=>'company', 'icon'=>'building', 'label'=>'Company'), 
	array('link'=>'product', 'icon'=>'truck', 'label'=>'Product'), 
	array('link'=>'bank', 'icon'=>'university', 'label'=>'Bank'), 
	array('link'=>'setting', 'icon'=>'gear', 'label'=>'Settings'), 
	array('link'=>'report', 'icon'=>'file-archive-o', 'label'=>'Reports'), 
	array('link'=>'auth', 'icon'=>'users', 'label'=>'Users'), 
	array('link'=>'logout', 'icon'=>'sign-out text-danger', 'label'=>'Logout'), 
);
?>
<div class="navbar-default sidebar" role="navigation">
	<div class="sidebar-nav navbar-collapse">
		<ul class="nav" id="side-menu">
		<?php foreach($sidebarLink as $link){
			$active_class = (uri_string()==$link['link'] || explode('/', uri_string())[0]==$link['link'] ) ?'active':'';
			echo '<li><a href="'.base_url($link['link']).'" class="'.$active_class.'"><i class="fa fa-'.$link['icon'].'"></i> &nbsp; '.$link['label'].'</a></li>';
		}
		?>
		</ul>
	</div>
</div>