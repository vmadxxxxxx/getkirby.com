<?php if($page->since()->future()): ?>
<div class="info">
This is an upcoming feature for version <?php echo $page->since()->version() ?>. The feature and this docs might still be under active development.
Don't rely on it in a public project so far.
</div>
<?php endif ?>