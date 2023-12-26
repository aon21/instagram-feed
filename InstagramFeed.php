<?php
/**
 * Plugin Name: Instagram Feed
 * Plugin URI: https://github.com/aon21/instagram-feed
 * Description: Gets instagram feed.
 * Author: aon
 * Author URI: https://github.com/aon21/
 * Version: 0.1.0
 */

namespace Aon\InstagramFeed;

class InstagramFeed
{
    public function __construct()
    {
        $this->constants();
        $this->autoloader();
    }

    private function constants()
    {
        $this->define('IFEED_DIR', plugin_dir_path(__FILE__));
    }

    private function define($name, $value = true)
    {
        if (! defined($name)) {
            define($name, $value);
        }
    }

    private function autoloader()
    {
        if (file_exists(IFEED_DIR . '/vendor/autoload.php'))
        {
            require_once IFEED_DIR . '/vendor/autoload.php';
        } else {
            spl_autoload_register([$this, 'autoload']);
        }
    }

    private function autoload($class)
    {
        $prefix = __NAMESPACE__;

        $base_dir = __DIR__ . '/src/';

        $len = strlen($prefix);
        if (strncmp($prefix, $class, $len) !== 0) {
            return;
        }

        $relative_class = substr($class, $len);
        $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

        if (file_exists($file)) {
            require $file;
        }
    }
}

new InstagramFeed();