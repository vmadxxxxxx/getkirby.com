<?php snippet('header') ?>

<main class="main" role="main">

  <h1 class="alpha">Downloads</h1>

  <section class="section">
    <h2 class="beta">Kirby Starterkit</h2>
    <ul class="download-list"><!--
   --><li>
        <a href="http://download.getkirby.com">
          <h3 class="gamma">kirby-<?php echo kirby::version() ?>-starterkit.zip</h3>
          <p>Download the latest version of Kirby's Starterkit</p>
        </a>
      </li><!--
 --></ul>

  </section>

  <?php foreach($page->children()->visible() as $category): ?>

  <section class="section">

    <h2 class="beta"><?php echo $category->title()->html() ?></h2>

    <ul class="download-list list-2"><!--
      <?php foreach($category->children()->visible() as $download): ?><!--
   --><li>
        <a href="<?php echo $download->url() ?>">
          <h3 class="gamma"><?php echo $download->title()->html() ?></h3>
          <p><?php echo $download->subtitle()->html() ?></p>
        </a>
      </li><!--
   --><?php endforeach ?>
    </ul>

  </section>

  <?php endforeach ?>

  <section class="section grid">
    <ul class="list-2">
      <li>
        <h2 class="beta">Kirby Plugins</h2>
        <div class="text">
          A comprehensive list of available 3rd-party plugins for Kirby can be found on <a href="http://getkirby-plugins.com"><strong>getkirby-plugins.com</strong></a>
        </div>
      </li><!--
   --><li>
        <h2 class="beta">Kirby Themes</h2>
        <div class="text">
          Check out <a href="http://getkirby-themes.com"><strong>getkirby-themes.com</strong></a> for a great collection of themes for Kirby.
        </div>
      </li>
    </ul>
  </section>

</main>

<?php snippet('footer') ?>