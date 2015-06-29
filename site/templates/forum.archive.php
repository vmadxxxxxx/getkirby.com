<?php snippet('forum.header') ?>

<ul class="article-list">

  <?php foreach($page->children()->visible() as $thread): ?>
  <li>
    <h2 class="alpha"><a href="<?php echo $thread->url() ?>"><?php echo $thread->title()->html(false) ?></a></h2>
    <span class="article-date">
      <span class="month"><?php echo $thread->children()->count() ?></span>
      <span class="year">Topics</span>
    </span>
  </li>
  <?php endforeach ?>

</ul>

<?php snippet('forum.footer') ?>
<?php snippet('footer') ?>