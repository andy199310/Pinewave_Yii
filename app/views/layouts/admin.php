<?php $this->beginContent('/layouts/main'); ?>
	<div id="container">
		<div id="small_nav">
			<a href="/index.php/admin/bulletin">留言板</a>
			<a href="/index.php/admin/programs">節目專區</a>
		</div>
		<?php echo $content; ?>
	</div>
<?php $this->endContent(); ?>