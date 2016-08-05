<div class="submenu filter col-2-6">
  <h2 class="delta">Filter by</h2>
  <?php if(param('category')): ?>
  <a class="button" href="<?= $page->url() ?>"><span style="color: #999; font-size: 1.1em; top: 2px; position: relative; padding-right: .25em">&times;</span> remove filter</a>
  <?php endif ?>
  <ul>
    <li>
      <a<?php e(param('category') == 'new', ' class="is-active"', '')?> href="<?= $page->url() . '/category:new' ?>"><?= 'new' ?></a>
    </li>
    <?php foreach($categories as $category): ?>
      <li>
        <a<?php e(param('category') == $category, ' class="is-active"', '')?> href="<?= $page->url() . '/category:' . urlencode($category) ?>"><?= $category ?></a>
      </li>
    <?php endforeach ?>
  </ul>
</div>
