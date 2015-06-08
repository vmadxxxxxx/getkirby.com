# Kirby Cachebuster Plugin

This plugin will add modification timestamps to your css and js files, 
as long as they are embedded with the css() and js() helpers.

To make this plugin work you must add the following lines to your 
rewrite rules:

```
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^(.+)\.(\d+)\.(js|css)$ $1.$3 [L]
```

Place them directly after the RewriteBase definition.

## Author
Bastian Allgeier <bastian@getkirby.com>