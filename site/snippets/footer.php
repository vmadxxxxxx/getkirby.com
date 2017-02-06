
    <?php snippet('footer.menu') ?>

    <div class="sponsors">
      <p class="sponsors-headline">Our partners</p>
      <p class="sponsors-logos">
        <a class="sponsors-keycdn" href="https://www.keycdn.com/?a=5715">        
          <img src="<?php echo url('assets/images/keycdn.svg') ?>" alt="CDN by KeyCDN">
        </a>
        <a class="sponsors-imgix" href="https://www.imgix.com/?utm_source=kirby">    
          <img src="<?php echo url('assets/images/imgix.svg') ?>" alt="Image hosting by imgIX">
        </a>
        <a class="sponsors-algolia" href="https://algolia.com">
          <img src="<?php echo url('assets/images/algolia.svg') ?>" alt="Search by Algolia">
        </a>
      </p>
    </div>

  </div><!-- [.site] end -->

  <a href="#top" class="to-top">Top</a>

  <?php echo js('assets/js/site.min.js') ?>
  <?php echo js('@auto') ?>

</body>
</html>