<div class="submenu filter col-2-6">
  <h2 class="delta">Filter by:</h2>
  <a class="button" href="<?= $page->url() ?>">x Remove filter</a>
  <ul>
    <?php foreach($categories as $category): ?>
      <li>
        <a<?php e(param('category') == $category, ' class="is-active"', '')?> href="<?= $page->url() . '/category:' . urlencode($category) ?>"><?= $category ?></a>
      </li>
    <?php endforeach ?>
  </ul>
</div>
