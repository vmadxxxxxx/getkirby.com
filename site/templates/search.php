<?php snippet('header') ?>

<main class="main searchpage" role="main">

  <h1 class="alpha">Search</h1>

  <form class="search-form" role="search" action="<?php echo url('search') ?>">
    <input type="search" autofocus class="searchword" name="q" id="q" placeholder="Search…" value="<?php echo $query ?>">
  </form>

  <?php if(empty($query)): ?>
  <div class="searchsuggestions">
    <h2>Suggestions…</h2>
    <ul>
      <li>Search for objects. i.e. <a href="<?php echo url('search') ?>?q=$site->">$site</a>, <a href="<?php echo url('search') ?>?q=$page->">$page</a> or <a href="<?php echo url('search') ?>?q=$file->">$file</a></li>
      <li>All about <a href="<?php echo url('search') ?>?q=blueprint">blueprints</a></li>
      <li>List all <a href="<?php echo url('search') ?>?q=helpers">helper methods</a></li>
      <li><a href="<?php echo url('search') ?>?q=panel-fields">Panel fields</a></li>
    </ul>
  </div>
  <?php endif ?>

  <div class="searchresults">
    <?php foreach($results as $result): ?>
    <article class="searchresult">    
      <a href="<?= url($result->objectID()) ?>">
        <h1 class="searchresult-headline"><?= $result->title() ?></h1>
        <p class="searchresult-meta">
          <?= $result->objectID() ?>
        </p>
      </a>
    </article>
    <?php endforeach ?>
  </div>

  <?php snippet('pagination', ['pagination' => $results->pagination()]) ?>

</main>

<?php snippet('footer') ?>
