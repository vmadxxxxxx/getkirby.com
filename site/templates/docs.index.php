<?php snippet('header') ?>

<main class="main" role="main">

  <ul class="docs-index-list list-4">
    <?php foreach($page->children()->visible() as $item): ?><!--
 --><li>
      <div class="text">
        <h2 class="delta docs-icon"><a href="<?php echo $item->url() ?>"><?php echo html($item->title()) ?></a></h2>
        <?php echo kirbytext($item->description()) ?>
      </div>
      <a class="btn" href="<?php echo $item->url() ?>">Learn more</a>
    </li><!--
 --><?php endforeach ?>
  </ul>

</main>

<?php snippet('footer') ?>