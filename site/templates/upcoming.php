<?php snippet('header') ?>

<main class="main text" role="main">

  <h1 class="alpha"><?php echo $page->title() ?></h1>

  <div class="text">

    <div class="info">
      This is a collection of all docs and cheatsheet entries for the upcoming release. All docs and features are still under development. We are happy about all beta testers, but please wait for the stable release before you use any of this in production.
    </div>

    <h2>Changelog</h2>
    <p><a href="<?php echo $changelog->url() ?>"><?php echo $changelog->url() ?></a></p>

    <h2>Beta Test</h2>
    <?php echo $page->beta()->kt() ?>

    <h2>Docs</h2>
    <ul>
      <?php foreach($upcoming as $item): ?>
      <li>
        <p>
          <a href="<?php echo $item->url() ?>">
            <strong><?php echo $item->title()->html() ?></strong><br>
            <small><em><?php echo $item->id() ?></em></small>
          </a>
        </p>
      </li>
      <?php endforeach ?>
    </ul>
  </div>

</main>

<?php snippet('footer') ?>
