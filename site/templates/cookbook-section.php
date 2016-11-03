<?php snippet('header') ?>

<main class="main" role="main">

  <div class="col-4-6">

    <article class="text relative">
      <h1><?php echo html($page->title()) ?></h1>

      <?php if($page->text() == ''): /* Check if content is available */ ?>
      <p class="delta">Coming soon...</p>
      <p>At the moment we're working hard to complete and improve the docs. Thanks for your patience! In case you've got an urgent issue with Kirby please send us an email.</p>
      <p><?php echo str::email($site->email()) ?></p>
            <p>In the meantime you might want to check out our <a href="http://getkirby.com/docs">docs</a> where we already collected a whole bunch of stuff.</p>

      <?php else: ?>

      <?php snippet('upcoming') ?>

      <?php echo str_replace('(\\', '(', kirbytext($page->text())) ?>

      <?php if($page->docs() != '' or $page->blogposts() != '' or $page->forumposts() != '' or $page->internals() != '' or $page->externals() != ''): ?>
      <footer class="further-reading">
        <h2 class="beta">Further reading</h2>

        <?php if($page->docs() != ''): ?>
        <h3 class="gamma">Docs</h3>
        <ul>
            <?php $docs = yaml($page->docs()) ?>
            <?php foreach($docs as $doc): ?>
            <li><a href="<?php echo url() ?>/<?php echo $doc['link'] ?>"><?php echo $doc['text'] ?></a></li>
            <?php endforeach ?>
        </ul>
        <?php endif ?>

        <?php if($page->blogposts() != ''): ?>
        <h3 class="gamma">Blogposts</h3>
        <ul>
            <?php $blogposts = yaml($page->blogposts()) ?>
            <?php foreach($blogposts as $blogpost): ?>
            <li><a href="<?php echo url() ?>/<?php echo $blogpost['link'] ?>"><?php echo $blogpost['text'] ?></a></li>
            <?php endforeach ?>
        </ul>
        <?php endif ?>

        <?php if($page->forumposts() != ''): ?>
        <h3 class="gamma">Forumposts</h3>
        <ul>
            <?php $forumposts = yaml($page->forumposts()) ?>
            <?php foreach($forumposts as $forumpost): ?>
            <li><a href="<?php echo url() ?>/<?php echo $forumpost['link'] ?>"><?php echo $forumpost['text'] ?></a></li>
            <?php endforeach ?>
        </ul>
        <?php endif ?>

        <?php if($page->internals() != ''): ?>
        <h3 class="gamma">Internal resources</h3>
        <ul>
            <?php $internals = yaml($page->internals()) ?>
            <?php foreach($internals as $internal): ?>
            <li><a href="<?php echo url() ?>/<?php echo $internal['link'] ?>"><?php echo $internal['text'] ?></a></li>
            <?php endforeach ?>
        </ul>
        <?php endif ?>

        <?php if($page->externals() != ''): ?>
        <h3 class="gamma">External resources</h3>
        <ul>
            <?php $externals = yaml($page->externals()) ?>
            <?php foreach($externals as $external): ?>
            <li><a href="<?php echo $external['link'] ?>"><?php echo $external['text'] ?></a></li>
            <?php endforeach ?>
        </ul>
        <?php endif ?>
      </footer>
      <?php endif ?>

      <?php endif ?>
    </article>

  </div>
  <nav class="sidebar col-2-6 last">
    <?php $overviewPage = $page->parent(); ?>
    <ul>
      <li><a href="<?php echo $overviewPage->url() ?>"><small>&uarr;</small><?php echo $overviewPage->title() ?> overview</a></li>

      <?php if($prev = $page->prevVisible()): ?>
      <li><a href="<?php echo $prev->url($page->inheritingParent()) ?>"><small>&larr;</small> <?php echo html($prev->title()) ?></a></li>
      <?php endif ?>

      <?php if($next = $page->nextVisible()): ?>
      <li><a href="<?php echo $next->url($page->inheritingParent()) ?>"><small>&rarr;</small> <?php echo html($next->title()) ?></a></li>
      <?php endif ?>
    </ul>

    <?php if($page->author()->isNotEmpty() && $author = page('authors/' . $page->author())): ?>
    <figure class="author">
      <a href="<?= $author->link() ?>">
        <?= $author->image() ?>
        <figcaption>
          <strong><?= $author->title()->html() ?></strong><br>
          <i><?= $author->subtitle()->html() ?></i>
        </figcaption>
      </a>
    </figure>
    <?php endif ?>

  </nav>

</main>

<?php snippet('footer') ?>
