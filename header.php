<!DOCTYPE html>

<!-- ABOUT
Theme: KZ Arcadian
File: header.php
Author: Andrew Parsons
Email: parsonsandrew1@gmail.com
Version: 1.0.0
Date: 26 March 2018
Latest change: initialization
-->

<!-- INTRODUCTION
This file has been prepared with the expectation that any future maintainer has
little experience with HTML, PHP, and JS. As such, comments are explicit and excessive.
Future maintainers should only modify comments for clarity.
Comments are only to be removed in cases where false information is provided.
Otherwise, comments are NOT to be removed regardless of how excessive they may seem.

# Read: bloginfo() on Wordpress Codex.
# Read:
# Read:
-->

<html>
  <head>

    <!-- CHARSET (site default). Prevents unknown characters -->
    <meta charset="<?php bloginfo('charset'); ?>">

    <!-- VIEWPORT size. Removes/resets any default zoom of a mobile device.
    Very useful for a responsive layout.-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- PINGBACK (site default).
    Read more: https://wordpress.stackexchange.com/questions/116079/what-is-rel-pingback-and-what-is-the-use-of-this-in-my-website -->
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>

    <!-- SHORTCUT ICON defines the favicon -->
    <link rel="shortcut icon" href="<?php echo THEME_DIR; ?>/path/favicon.ico" />

    <!-- PHP function (required). -->
    <?php wp_head(); ?>

    <!-- TODO: Google Fonts, Typekit, FontAwesome, etc. (see KZ Index) -->
    <link href="https://fonts.googleapis.com/css?family=Alfa+Slab+One|Catamaran:300,400,700,800|Cormorant+Garamond:300i,400,400i,700i|Source+Serif+Pro" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amiri:400,400i" rel="stylesheet">
  </head>

  <!-- TODO: class and id name conventions
  TODO: hidden vs aria-hidden
  -->

  <!-- "TOP-BAR" contains elements displayed at the very top of the site. -->
  <div class="top-bar">

    <!-- "TOP-BAR_LEFT-ITEMS" contains elements displayed on the left side of "TOP" -->
    <div class="top-bar_left-items">
      <a class="top-bar_left-items_location" href="http://www.kzoo.edu/" target="blank">Kalamazoo, MI</a>
    </div>

    <!--"TOP-BAR_CENTER-ITEMS" contains elements displayed in the center of "TOP" -->
    <div class="top-bar_center-items">
      <!-- "TOP-BAR_CENTER-ITEMS_SLOGAN" displays functionally generated slogan.
      (eg: One-Hundred-Forty-One Years of Service to the Student)-->
      <a class="top-bar_center-items_slogan" href="https://cache.kzoo.edu/handle/10920/17694" target="blank">
        <!-- PHP function. Calculates number of years of publication (current minus 1877).-->
        <?php $first_number = date("Y");
        $second_number = 1877;
        $sum = $first_number - $second_number;
        $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
        $string = $f->format($sum);
        $string_with_dashes = str_replace(' ','-',$string);
        echo $string_with_dashes; ?>
        <!-- Appends space ('&#160') and phrase to number generated by PHP-->
        &#160;Years of Service to the Student</a>
    </div>

    <!--"TOP-BAR_RIGHT-ITEMS" contains elements displayed on the right side of "TOP" -->
    <div class="top-bar_right-items">
      <div class="top-bar_right-items_item"><a href="http://www.thekzooindex.com/about/">About</a></div>
      <div class="top-bar_right-items_item"><a href="http://www.thekzooindex.com/subscribe/"><i class="fa fa-envelope-o" aria-hidden="true" style="font-size: 18px;"></i></a></div>
      <!-- TODO: clearer class names here -->
      <a href="#ult-fs-search"><i class="fa fa-search" aria-hidden="true"></i></a>
    </div>
</div>

<!-- BODY (required) -->
<body <?php body_class(); ?>>

<!-- TODO: fix names/understand
A note on naming conventions: CONTAINERs and WRAPPERs are dummy divs which provide
added functionality to their child divs. WRAPPERS hold one element whereas CONTAINERs hold two or more.
Confer: https://stackoverflow.com/questions/4059163/css-language-speak-container-vs-wrapper
-->
  <div class="container">
    <header class="header-wrapper">
      <div class="main-menu">
        <!-- TODO: why is this clearfix?-->
        <nav class="main-nav clearfix">
    	<?php wp_nav_menu(array('theme_location' => 'main_nav')); ?></nav>
    	</div>

      <!-- SIDE-NAVIGATION-MENU provides site navigation functionality.
      (1) sticky: fixed to top on scroll, nav menu under "hamburger" bars icon.
      (2) mobile: fixed to top on scroll, nav menu under "hamburger" bars icon.-->
      <div class="side-navigation">
        <!-- SUPERFLUOUS?

        <div class="left-items-2">

        -->
        <div class="side-navigation_dropdown-menu">
          <!-- icon for side menu. showDropdownMenu() displays menu on click. -->
          <i class="side-navigation_dropdown-menu_icon" onclick="showDropdownMenu()" aria-hidden="true"></i>
          <div id="id_dropdown-menu" class="side-navigation_dropdown-menu_content">
            <!-- populates dropdown-menu -->
            <?php wp_nav_menu(array('theme_location' => 'main_nav')); ?>

            <!-- TODO: review usage of side-navigation-dropdown-menu-copyright -->
            <!-- <p class="side-navigation_dropdown-menu_copyright"> -->
            <!-- copyright symbol -->
            <p class="c-symbol">&copy;</p>

            <a class="side-navigation_dropdown-menu_site-name" href="http://www.thekzooindex.com/about/">The Index</a></p>
          </div>
        </div>
        <!-- SUPERFLUOUS? </div> -->
        <div class="top-bar_center-items"><a class="header-logo" href="http://www.thekzooindex.com">The Index</a></div>
          <div class="top-bar_right-items">
            <a href="#ult-fs-search"><i class="fa fa-search" aria-hidden="true"></i></a>
          </div>
      </div>

      <!-- JAVASCRIPT controls functionality of side-navigation_dropdown-menu
      TODO: Perhaps move all JS to scripts file...?
      Pure CSS alternatives: https://medium.com/@heyoka/responsive-pure-css-off-canvas-hamburger-menu-aebc8d11d793
      https://premium.wpmudev.org/blog/create-custom-animated-burger-menu/

      -->
      <script>

        /* toggles show/hide side-navigation_dropdown-menu with button click */
        function showDropdownMenu() {
          document.getElementById("id_dropdown-menu").classList.toggle("show");
        }

        /* hides side-navigation_dropdown-menu when user clicks outside of menu */
        // 'event' is a user click within the browser window
        window.onclick = function(event) {
          // if the click is NOT the icon
          // TODO: check matches
          // TODO: is the first IF even needed?
          if (!event.target.matches('side-navigation_dropdown-menu_icon')) {
            var openDropdown = document.getElementByID("id_dropdown-menu");
            if (openDropdown.classList.contains('show')) {
              openDropdown.classList.remove('show');
            }
          }
        }

        /* Close the dropdown menu if the user clicks outside of it */
        /* !!! loop is SUPERFLUOUS since we have only one dropdown. Keep for functionality */
        /* Replacement is probably negligably faster but less versatile */
        /*
        window.onclick = function(event) {
          if (!event.target.matches('i.fa.fa-bars')) {
            var dropdowns = document.getElementsByClassName("side-navigation_dropdown-menu_content");
            for (var i = 0; i < dropdowns.length; i++) {
              var openDropdown = dropdowns[i];
              if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
              }
            }
          }
        }
        */

      </script>

    </header>
