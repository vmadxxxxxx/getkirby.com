<?php if(c::get('stage')) go('docs') ?>
<?php snippet('header') ?>

<main class="main" role="main">

  <section class="features section">
    <h2 class="beta">Features</h2>

    <ul class="feature-list list-3">
      <?php foreach($pages->find('home/features')->children()->limit(6) as $feature): ?><!--
   --><li>
        <?php if($image = $feature->image()): ?>
        <a href="<?php echo $feature->link() ?>">
          <img src="<?php echo imgix($image, array('w' => 300)) ?>" alt="Screenshot: <?php echo $feature->title() ?>" />
        </a>
        <?php endif ?>
        <div class="text smaller">
          <h3 class="gamma"><?php echo html($feature->title()) ?></h3>
          <p>
            <?php echo $feature->text() ?>
            <?php if($feature->link() != ''): ?>
            <a class="read-more" href="<?php echo $feature->link() ?>">Read more →</a>
            <?php endif ?>
          </p>
        </div>
      </li><!--
   --><?php endforeach ?>
    </ul>
  </section>

  <section class="random-refs section">
    <h2 class="beta"><a href="<?php echo url('made-with-kirby-and-love') ?>">Made with Kirby and &#9829;</a></h2>

    <ul class="reference-list list-3">
      <?php foreach($pages->find('made-with-kirby-and-love')->children()->shuffle()->limit(3) as $reference): ?><!--
   --><li class="screenshot">
        <div class="screen-wrap">
          <?php if($image = $reference->image()): ?>
          <img src="<?php echo imgix($image, array('w' => 350, 'h' => 220, 'fit' => 'crop')) ?>" alt="Screenshot: <?php echo $reference->title() ?>" />
          <?php endif ?>
          <div class="screen-refl"><a class="btn-white" href="<?php echo $reference->link() ?>">visit</a></div>
        </div>
        <a href="<?php echo $reference->link() ?>">
          <h2 class="gamma truncate"><?php echo html($reference->title()) ?></h2>
          <p><?php echo url::short($reference->link()) ?></p>
        </a>
      </li><!--
   --><?php endforeach ?>
    </ul>
  </section>

  <section class="latest-posts section">
    <h2 class="beta"><a href="<?php echo url('blog') ?>">Latest blog posts</a></h2>
    <ul class="list-2">
      <?php $latest = $pages->find('blog')->children()->visible()->flip()->limit(2) ?>
      <?php foreach($latest as $post): ?><!--
   --><li class="text smaller">
        <time datetime="<?php echo $post->date('c') ?>"><?php echo $post->date('d M Y') ?></time>
        <h3 class="gamma"><a href="<?php echo $post->url() ?>"><?php echo html($post->title()) ?></a></h3>
        <p><?php echo excerpt($post->text(), 180) ?> <a class="read-more" href="<?php echo $post->url() ?>">read more →</a></p>
      </li><!--
   --><?php endforeach ?>
    </ul>
  </section>

  <section class="section">
    <h2 class="beta">Featured on …</h2>
    <ul class="featured-on-list list-4">
      <?php foreach($page->find('testimonials')->images()->shuffle()->limit(4) as $featured): ?><!--
   --><li><?php if($featured->link() != ''): ?><a href="<?php echo $featured->link() ?>"><?php endif ?><img src="<?php echo $featured->url() ?>" alt="<?php echo $featured->title() ?>" /><?php if($featured->link() != ''): ?></a><?php endif ?></li><!--
   --><?php endforeach ?>
    </ul>
  </section>

  <section class="random-voices section">
    <h2 class="beta"><a href="<?php echo url('voices') ?>">What others say about Kirby</a></h2>

    <ul class="voice-list list-2">
      <?php foreach(page('voices')->children()->visible()->shuffle()->limit(4) as $voice): ?><!--
   --><li>
        <a href="http://twitter.com/<?php echo $voice->username() ?>">
          <?php if($voice->image()): ?>
          <img class="avatar" src="<?php echo imgix($voice->image(), array('w' => 100, 'h' => 100, 'fit' => 'crop')) ?>" alt="Avatar of <?php echo $voice->title() ?>" />
          <?php endif ?>
          <h2 class="gamma"><?php echo $voice->title() ?></h2>
          <p class="zeta">@<?php echo $voice->username() ?></p>
        </a>
        <blockquote>
          <?php echo kirbytext($voice->text()) ?>
        </blockquote>
      </li><!--
   --><?php endforeach ?>
    </ul>
  </section>

  <section class="connect section">
    <h2 class="beta">Connect</h2>
    <ul class="list-2"><!--
   --><li>
        <a class="cf" href="http://twitter.com/getkirby">
          <img src="<?php echo url('assets/images/twitter.svg') ?>" alt="Twitter icon">
          <div>
            <h3 class="gamma">Follow Kirby on Twitter</h3>
            <p class="zeta">@getkirby</p>
          </div>
        </a>
      </li><!--
   --><li>
        <a class="grid" href="http://forum.getkirby.com">
          <img src="<?php echo url('assets/images/forum.svg') ?>" alt="Community icon">
          <div>
            <h3 class="gamma">Visit the Kirby forum</h3>
            <p class="zeta">forum.getkirby.com</p>
          </div>
        </a>
      </li><!--
 --></ul>
  </section>

  <section class="newsletter section last" id="kosmos">
    <h2 class="beta">Kirby Kosmos</h2>

    <p>Get monthly updates about new versions, plugins, themes, community events and more…</p>

    <form action="https://getkirby.createsend.com/t/t/s/xdildi/" method="post" id="subForm">
      <p>
        <label for="fieldEmail">Email</label>
        <input id="fieldEmail" name="cm-xdildi-xdildi" type="email" placeholder="mail@example.com" required />
      </p>
      <p>
        <label for="fieldName">Name</label>
        <input id="fieldName" name="cm-name" type="text" />
      </p>
      <p>
        <button type="submit">Subscribe</button>
      </p>
    </form>

  </section>

</main>

<?php snippet('footer') ?>
