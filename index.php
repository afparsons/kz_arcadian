<?php get_header(); ?>
<div class="wrapper clearfix">
  <div class="content-fullwidth">
	<?php if (category_description()) { ?>
		<section class="cat-desc">
			<?php echo category_description(); ?>
		</section>
	<?php } ?>
	</div>
<div class="pagination-container"><?php kz_arcadian_pagination(); ?></div>
</div>
<?php get_footer(); ?>

<!-- some lines were removed, consult original MH file -->
