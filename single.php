<?php get_header(); ?>
<div class="mh-wrapper clearfix">
	<header class="post-header">
        <div class="subject"><?php mh_subheading(); ?></div>
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header>
	<div id="main-content" class="mh-content"><?php
		mh_before_post_content();
		if (have_posts()) :
			while (have_posts()) : the_post();
				if (is_attachment()) {
					get_template_part('content', 'attachment');
				} else {
					get_template_part('content', get_post_format());
				}
			endwhile;
			mh_after_post_content();
			comments_template();
		endif; ?>
	</div>
	<?php get_sidebar(); ?>
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
     <div class="center-items"><p class="header-headline"><?php the_title(); ?></p></div>
     <div class="right-items">
          <a href="#ult-fs-search"><i class="fa fa-search" aria-hidden="true"></i></a>
     </div>
</div>

<?php get_footer(); ?>
