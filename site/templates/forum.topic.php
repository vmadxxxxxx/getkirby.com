<?php snippet('forum.header') ?>

<article class="topic topic-details<?php e($page->isSolved(), ' topic-is-solved') ?>">

  <header class="topic-header cf">
    <h1 class="topic-headline alpha"><?php echo widont(html($page->title(), false)) ?></h1>
    <div class="topic-meta">
      <time class="date topic-date"><?php echo $page->date('d.m.Y - H:i') ?></time>
      <a class="user" href="https://twitter.com/<?php echo $page->user() ?>">by <?php echo $page->user() ?></a>
    </div>
  </header>

  <div class="topic-body">

    <div class="text topic-body-text">
      <?php echo $page->text()->kirbytext() ?>
    </div>

  </div>

  <section class="replies">

    <header class="replies-header">
      <h2 class="replies-headline beta"><?php echo $page->children()->count() ?> Replies</h2>
    </header>

    <?php foreach($page->children() as $reply): ?>
    <article class="reply" id="<?php echo $reply->uid() ?>">
      <header class="reply-header">
        <time class="date reply-date">
          <a href="<?php echo $reply->parent()->url() . '/#' . $reply->uid() ?>"><?php echo $reply->date('d.m.Y - H:i') ?></a>
        </time>
        <a class="user" href="https://twitter.com/<?php echo $reply->user() ?>">by <?php echo $reply->user() ?></a>
      </header>
      <div class="reply-body">
        <div class="text reply-body-text">
          <?php echo $reply->text()->kirbytext() ?>
        </div>      
      </div>
    </article>
    <?php endforeach ?>

  </section>

</article>

<?php snippet('forum.footer') ?>
<?php snippet('footer') ?>