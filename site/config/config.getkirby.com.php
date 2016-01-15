<?php

header('X-Frame-Options: SAMEORIGIN');
header('X-XSS-Protection: 1; mode=block');
header('X-Content-Type-Options: nosniff');
header('Content-Security-Policy: default-src https: \'unsafe-inline\' \'unsafe-eval\'');

c::set('cdn.assets', 'https://assets.getkirby.com/assets');
c::set('cdn.content', 'https://assets.getkirby.com/content');
c::set('cdn.thumbs', 'https://assets.getkirby.com/thumbs');
c::set('cachebuster', true);

c::set('cache.cheatsheet', true);