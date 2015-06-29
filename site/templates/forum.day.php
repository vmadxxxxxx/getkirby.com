<?php snippet('forum.header') ?>

<ul class="article-list">

  <?php foreach($topics as $topic): ?>
  <li>
    <h2 class="alpha"><a href="<?php echo $topic->url() ?>"><?php echo $topic->title()->html(false) ?></a></h2>
    <time class="article-date" datetime="<?php echo $topic->date('c') ?>">
      <span class="month"><?php echo $topic->date('M d') ?></span>
      <span class="year"><?php echo $topic->date('Y') ?></span>
    </time>
  </li>
  <?php endforeach ?>

</ul>

<?php if($pagination->hasPages()): ?>
<nav class="pagination cf">
  <?php if($pagination->hasPrevPage()): ?>
  <a class="prev" href="<?php echo $pagination->prevPageURL() ?>">&larr; newer topics</a>
  <?php endif ?>
  <?php if($pagination->hasNextPage()): ?>
  <a class="next" href="<?php echo $pagination->nextPageURL() ?>">older topics &rarr;</a>
  <?php endif ?>
</nav>
<?php endif ?>

<?php snippet('forum.footer') ?>
<?php snippet('footer') ?>