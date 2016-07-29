<?php snippet('header') ?>

<main class="main" role="main">

  <ul class="docs-index-list list-3">
    <?php foreach($page->children()->visible() as $item): ?><!--
 --><li>
      <div class="text">
        <h2 class="delta"><a href="<?php echo $item->url() ?>"><?php echo html($item->title()) ?></a></h2>
        <p class="text small"><? e($item->category()->isNotEmpty(), 'Category: '. $item->category()->html(), '') ?></p>

        <?php echo kirbytext($item->description()) ?>
      </div>
    </li><!--
 --><?php endforeach ?>
</ul>

</main>

<?php snippet('footer') ?>
