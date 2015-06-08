<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0">

  <?php echo css(array(
    'assets/css/kirby.css',
    'assets/css/site.css'
  )) ?>

  <?php if($page->isHomePage()): ?>
  <title><?php echo html($page->headline()) ?> | <?php echo html($site->title()) ?></title>
  <?php else: ?>
  <title><?php echo html($page->title()) ?> | <?php echo html($site->title()) ?></title>
  <?php endif ?>

  <?php if($page->description() != ''): ?>
  <meta name="description" content="<?php echo html($page->description()) ?>" />
  <?php else: ?>
  <meta name="description" content="<?php echo html($site->description()) ?>" />
  <?php endif ?>

  <link rel="icon" href="<?php echo url('assets/images/favicon.png') ?>" type="image/png" />
  <link rel="apple-touch-icon" href="<?php echo url('assets/images/apple-touch-icon.png') ?>" />
  <meta name="apple-mobile-web-app-title" content="<?php echo html($site->title()) ?>">
  <link rel="alternate" type="application/rss+xml" href="<?php echo url('feed') ?>" title="<?php echo html($site->title()) ?> Blog Feed" />

</head>
<body class="<?php e(c::get('stage'), 'stage ') ?><?php echo str_replace('.', '-', $page->template()) ?>" id="top">

  <?php if(server::get('SERVER_NAME') == 'getkirby.com'): ?>
  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-431401-11', 'auto');
    ga('send', 'pageview');

  </script>
  <?php endif ?>

  <!--[if lte IE 9]>
  <div class="browserupdate">
    You are using an obsolete browser which can harm your experience and cause security trouble. Please <a href="http://browsehappy.com/" target="_blank">update your browser!</a>
  </div>
  <![endif]-->

  <?php if(c::get('stage')) snippet('message') ?>

  <?php if($page->isHomePage()): ?>

  <header class="site-header" role="banner">
    <div class="site">
      <a class="logo" href="<?php echo url() ?>">Kirby</a>
      <?php snippet('menu') ?>
      <div class="slider">
        <div class="slider-track">
          <?php foreach($page->children()->find('hero')->images() as $slide): ?>
          <figure title="<?php echo $slide->caption() ?>">
            <img src="<?php echo $slide->url() ?>" alt="Screenshot: <?php echo $slide->caption() ?>">
          </figure>
          <?php endforeach ?>
        </div>
        <nav class="slider-nav">
          <a class="slider-prev" href="#"><span>&lsaquo;</span></a>
          <a class="slider-next" href="#"><span>&rsaquo;</span></a>
        </nav>
      </div>
      <section class="intro">
        <h1 class="alpha with-beta">Kirby is a file&#8209;based&nbsp;CMS</h1>
        <p class="beta">Easy&nbsp;to&nbsp;setup. Easy&nbsp;to&nbsp;use. Flexible&nbsp;as&nbsp;hell.</p>
        <a class="btn-white" href="<?php echo url('try') ?>">Download v2</a>
      </section>
    </div>
  </header>

  <div class="site">

  <?php else: ?>

  <div class="site">

    <header class="site-header" role="banner">
      <a class="logo" href="<?php echo url() ?>">Kirby</a>
      <?php snippet('menu') ?>
    </header>

  <?php endif ?>
