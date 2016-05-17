
    <?php snippet('footer.menu') ?>

    <div class="sponsors">
      <a class="sponsors-imgix" href="https://www.imgix.com/?utm_source=kirby">
        Image hosting by 
        <img src="<?php echo url('assets/images/imgix.svg') ?>" alt="imgIX">
      </a>

      <a class="sponsors-keycdn" href="https://www.keycdn.com/?a=5715">
        CDN by 
        <img src="<?php echo url('assets/images/keycdn.svg') ?>" alt="KeyCDN">
      </a>

      <a class="sponsors-codetree" href="https://codetree.com">
        Issue tracking by 
        <img src="<?php echo url('assets/images/codetree.svg') ?>" alt="Codetree">
      </a>
    </div>

  </div><!-- [.site] end -->

  <a href="#top" class="to-top">Top</a>

  <?php echo js('assets/js/site.min.js') ?>
  <?php echo js('@auto') ?>

</body>
</html>