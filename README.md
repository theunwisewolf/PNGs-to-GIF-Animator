# PNGs/JPEGs to GIFAnimator
A simple app that converts a given set of PNGs and JPEGs to a single animated GIF.

## Usage
All you need to do is edit the configuration file, config.php. It has three settings:

<pre>
// Site url without trailing slash
define( 'SITE_URL', 'http://127.0.0.1/imagerotator' );

// Maximum allowed urls to be animated
define( 'MAX_URLS', '5' );

// Animation delay between any two frames
define( 'ANIMATION_DELAY', '100' );
</pre>

Simply upload it to your server after editing the config and you are done. Visit the index.php, paste some urls and it will generate a link to the aniamted gif.

Have fun.
