<?php

namespace InpsydeAskerweb;

/**
 * Class InpsydeAskerweb\StylesScripts
 * for working with styles and scripts
 *
 * @category WP_Plugin
 * @package  Inspydeaskerweb
 * @author   AskerWeb <askerweb@yandex.by>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/askerweb/inpsydetrialtask/
 */
class StylesScripts
{
    /**
     * Connects all needed styles and scripts
     *
     * @return void
     */
    public function enqueue(): void
    {
        wp_enqueue_script(
            'main',
            plugins_url('assets/js/main.min.js', __FILE__),
            [],
            '',
            true
        );
        wp_enqueue_style(
            'main',
            plugins_url('assets/css/main.min.css', __FILE__)
        );
    }
}
