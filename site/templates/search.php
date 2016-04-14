<?php snippet('header') ?>

<main class="main searchpage" role="main">

  <h1 class="alpha">Search</h1>

  <form class="search-form" role="search" action="<?php echo url('search') ?>">
    <input type="search" autofocus class="searchword" name="q" id="q" placeholder="Search…" value="<?php echo $query ?>">
  </form>

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
