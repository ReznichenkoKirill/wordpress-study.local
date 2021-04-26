<?php

namespace App\Helpers;

/**
 * Class ConfigHelper
 * @package App\Helpers
 */
class ConfigHelper {

    /**
     * Get config.
     *
     * @param string $name
     *
     * @return array|null
     */
    static public function getConfig( $name ) {
        $filepath = get_template_directory() . '/app/config/' . $name . '.php';

        if ( file_exists( $filepath ) ) {
            return require $filepath;
        } else {
            return null;
        }
    }
}
