    <footer>
      <?php if (is_active_sidebar('footer')) { ?>
         <div class="col-1-4 mq-footer">
            <?php dynamic_sidebar('footer'); ?>
         </div>
    <?php } ?>
    </footer>

    <div class="copyright-wrapper">
      <p class="copyright">
        <?php echo '<a href="http://www.thekzooindex.com/about/">&copy The Index</a>'; ?></p>
          <p class="site-credit">
            Designed by <a href="https://www.linkedin.com/in/graham-key-06776399/" target="blank">Graham Key '16.</a>
            Built by <a href="https://www.linkedin.com/in/andrewfparsons/" target="blank">Andrew Parsons '19.</a></p></p>
    </div>

  <?php wp_footer(); ?>
  </body>
</html>
