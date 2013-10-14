<?php $this->beginContent('/layouts/main'); ?>
	<div id="container">
		<div id="small_nav">
			<a href="/admin/bulletin">公布欄</a>
			<a href="/admin/programs">節目專區</a>
			<a href="/admin/copyright">版權清單專區</a>
		</div>
		<?php echo $content; ?>
	</div>
<?php $this->endContent(); ?>