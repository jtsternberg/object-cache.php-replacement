# `object-cache.php` Replacement

Handles checking for persistent object cache (in this case, Redis and uses the [WP Redis](https://wordpress.org/plugins/wp-redis/)), and if it is found, loads it. If not, falls back (in a bit of a hacky way) to the WordPress default cache system. This hack will only be necessary until [https://core.trac.wordpress.org/changeset/42723](https://core.trac.wordpress.org/changeset/42723) is released.

To use, ensure you have the WP Redis plugin installed in the plugins folder, and that the directory name is `/wp-content/plugins/wp-redis/`. Then copy the `object-cache.php` file to your `/wp-content/` directory.

Blog post found here: [Loading the Optimal WordPress Object Cache Implementation](https://webdevstudios.com/2015/11/03/loading-the-optimal-wordpress-object-cache-implementation-in-your-production-staging-and-local-development-environments/)
