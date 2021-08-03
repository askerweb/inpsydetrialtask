<?php

namespace InpsydeAskerweb;

/**
 * Class InpsydeAskerweb\Requests
 * for working with requests
 *
 * @category WP_Plugin
 * @package  Inspydeaskerweb
 * @author   AskerWeb <askerweb@yandex.by>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/askerweb/inpsydetrialtask/
 */
class Requests
{
    /**
     * Endpoint
     *
     * @var string $_pagename
     */
    private string $_pagename = "users-table";

    /**
     * Response data
     *
     * @var array $_data
     */
    private array $_data = array();

    /**
     * Array of errors
     *
     * @var array $_error
     */
    private array $_error = array();

    /**
     * InpsydeAskerweb constructor.
     */
    public function init($data, $error)
    {
        $this->_data = $data;
        $this->_error = $error;
    }

    /**
     * Create custom endpoints
     *
     * @return void
     */
    public function createLink(): void
    {
        $this->_pagename = (string)apply_filters(
            'inpsydeaskerweb_page_link',
            $this->_pagename
        );
        add_rewrite_rule(
            $this->_pagename . '/?$',
            'index.php?pagename=' . $this->_pagename
        );
    }

    /**
     * If its page $this->._pagename load "userstables.php" template
     *
     * @param $wp WP WordPress environment instance
     *
     * @return void
     */
    public function request($wp): void
    {
        if ($wp->query_vars['pagename'] == $this->_pagename) {
            $args = array(
                'users' => $this->_data,
                'errors' => $this->_error
            );
            $overridden_template = locate_template('inpsyde-askerweb/userstable.php');
            if ($overridden_template) {
                load_template($overridden_template, true, $args);
            } else {
                load_template(__DIR__ . '/templates/userstable.php', true, $args);
            }
            exit();
        }
    }
}
