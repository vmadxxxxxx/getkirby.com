<?php snippet('header') ?>

<main class="main" role="main">

  <form class="search-form" role="search">
    <input type="search" autofocus data-limit="10" data-fuzzy="true" data-template="#autocomplete-template" data-fuzzy="false" data-field="title" data-url="<?php echo url('docs.json') ?>" class="searchword" name="q" id="q" placeholder="Search the docs…" value="<?php echo html($query, false) ?>">
    <script id="autocomplete-template" type="text/html">
      <strong>{{title}}</strong>
      <small>{{uri}}</small>
    </script>
  </form>

  <?php if($results): ?>

  <ul class="search-list">
  <?php foreach($results as $result): ?>
    <li>
      <h2 class="delta"><a href="<?php echo $result->url() ?>"><?php echo html($result->title()) ?></a></h2>
      <?php if($result->description() != ''): ?>
      <p class="search-list-excerpt"><?php echo html($result->description()) ?></p>
      <?php elseif($result->excerpt() != ''): ?>
      <p class="search-list-excerpt"><?php echo html($result->excerpt()) ?></p>
      <?php else: ?>
      <p class="search-list-excerpt"><?php echo excerpt($result->text()) ?></p>
      <?php endif ?>

      <p class="search-list-crumb">
        <?php foreach($result->parents()->flip() as $parent): ?><!--
     --><a data-separator="&rsaquo;" href="<?php echo $parent->url() ?>"><?php echo html($parent->title()) ?></a><!--
     --><?php endforeach ?><!--
     --><a href="<?php echo $result->url() ?>"><?php echo html($result->title()) ?></a>
      </p>

    </li>
  <?php endforeach ?>
  </ul>

  <?php else: ?>
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
  <?php endif; ?>

</main>

<?php snippet('footer') ?>