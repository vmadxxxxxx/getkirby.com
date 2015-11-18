  <ul class="list-4">
    <?php foreach(page('support')->children()->visible() as $item): ?><!--
 --><li>
      <a href="<?php echo $item->link() ?>"><img src="<?php echo $item->image()->url() ?>" alt="<?php echo $item->title() ?>"></a>
      <div class="text">
        <h2 class="beta"><?php echo $item->title() ?></h2>
        <?php echo $item->text()->kt() ?>
      </div>
      <a class="btn" href="<?php echo $item->link() ?>"><?php echo $item->linktext() ?></a>
    </li><!--
 --><?php endforeach ?>
  </ul>