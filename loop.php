<?php /* Loop Template used for index/archive/search */ ?>
<!-- no modifications yet -->

<div class="loop-column-1">
<li class="t-wrap-3 cp-small clearfix">
<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
<div class="cp-thumb-III">
	<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );?>
  <div id="feature-3" style="background-image: url('<?php echo $thumb['0'];?>')">
    <div class="color-layer-3">
      <div class="cp-data">
        <div class="t-2-subject"><?php mh_subheading(); ?></div>
          <p class="t-2-title"><?php the_title(); ?></p>
            <div class="t-2-author">
              <?php $posttags = get_the_tags();
							if ($posttags) {
								/* comma separate the tags */
								$output = array();
								foreach($posttags as $tag)
									$output[] = $tag->name;
								echo implode(', ', $output);
							}?>
            </div>
      </div>
    </div>
  </div>
</a>
</li>
</div>
<div class="drop-menu">
  <div class="left-items-2">
<div class="dropdown">
  <i class="fa fa-bars" onclick="myFunction()" aria-hidden="true"></i>
  <div id="myDropdown2" class="dropdown-content">
	<?php wp_nav_menu(array('theme_location' => 'main_nav')); ?>
    <p class="copyright-2"><p class="c-symbol">&copy;</p><a class="menu-date" href="http://www.thekzooindex.com/about/">The Index</a></p>
  </div>
</div>
  </div>
  <div class="center-items"><a class="header-logo" href="http://www.thekzooindex.com">The Index</a></div>
  <div class="right-items">
    <a href="#ult-fs-search"><i class="fa fa-search" aria-hidden="true"></i></a>
  </div>
</div>
