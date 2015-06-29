<nav class="breadcrumb" role="navigation">
  <h1 class="vh">Breadcrumb</h1>
  <ul class="cf">
    <?php foreach($site->breadcrumb() AS $crumb): ?>
    <li<?php e($crumb->isActive(), ' class="is-active"') ?>><a href="<?php echo $crumb->url() ?>"><?php echo html($crumb->title(), false) ?></a></li>
    <?php endforeach; ?>
  </ul>
</nav>