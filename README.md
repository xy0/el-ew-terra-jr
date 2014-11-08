##The Terra Jr Theme

This theme is a child theme of Hyperspatial Design's [Terra Theme](https://github.com/hyptx/terra). It cannot be used by itself and is dependent on it's parent theme.

* [Latest Terra Release](https://github.com/hyptx/terra/releases/latest)
* [Latest Terra Jr Release](https://github.com/hyptx/terra-jr/releases/latest)

####Additional Features of Child Theme

* Parent theme functions are all overwritable
* Enhanced menu styling, pre style nav by overwriting bootstrap defaults
* Custom post type factory class

##Installaton

1. Get a copy of [Terra](https://github.com/hyptx/terra/releases/latest) and upload it to your themes directory
2. Get a copy of [Terra Jr](https://github.com/hyptx/terra-jr/releases/latest) and upload it to your themes directory
3. Activate Terra Jr
4. Rock and Roll

##CloudFlare

If you want to use the theme with CloudFlare's flexible SSL, it's easy, and free. You will need to secure your wordpress admin area so that the wp admin bar stays secure on the front end. Add the following two lines toward the top of your *wp-config.php* file. 

```php
define('FORCE_SSL_ADMIN',true);
if($_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') $_SERVER['HTTPS'] = 'on';
```

* [CloudFlare SSL Info](https://support.cloudflare.com/hc/en-us/articles/200170416-What-do-the-SSL-options-Off-Flexible-SSL-Full-SSL-Full-SSL-Strict-mean-)
* [CloudFlare SSL Redirects](https://support.cloudflare.com/hc/en-us/articles/200170536-How-do-I-redirect-HTTPS-traffic-with-Flexible-SSL-and-Apache-)
* [Wordpress Codex Source](http://codex.wordpress.org/Administration_Over_SSL)
