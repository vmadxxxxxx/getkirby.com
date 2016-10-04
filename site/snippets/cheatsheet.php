<main class="main" role="main">

  <h1 class="alpha"><?php echo html($page->title()) ?></h1>

  <section class="text">
    <h2 class="beta">Table of contents</h2>
    <div class="cheatsheet-grid">
      <?php foreach($page->children()->visible() as $child): ?>
      <div class="cheatsheet-grid-item">
        <h3 class="gamma">
          <a href="#<?php echo $child->uid() ?>">
            <?php echo html($child->title()) ?>
          </a>
        </h3>
      </div>
      <?php endforeach ?>
    </div>
  </section>

  <?php foreach($page->children()->visible() as $child): ?>
  <section class="text" id="<?php echo $child->uid() ?>">
    <h2 class="beta no-margin-bottom"><?php echo html($child->title()) ?></h2>
    <?php if($extendingMode = $child->extendingModeLink()): ?>
      <div class="zeta subtitle"><?php echo $extendingMode ?></div>
    <?php endif ?>
    <?php echo $child->text()->kt() ?>

    <div class="cheatsheet-grid">
      <?php foreach($child->inheritedChildren() as $doc): ?>
      <div class="cheatsheet-grid-item<?php e($doc->since()->future(), ' future'); ?>">
        <a href="<?php echo $doc->url($child) ?>">
          <h3 class="gamma"><?php echo html($doc->title($child)) ?></h3>
          <?php echo $doc->excerpt()->kt() ?>
        </a>
        <?php if($doc->since()->isNotEmpty()): ?>
        <?php endif ?>
      </div>
      <?php endforeach ?>
    </div>

  </section>
  <?php endforeach ?>

</main>