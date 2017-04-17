<?php
/**
 * Render Plugin for XHTML output,
 * with preserved line break between non-ASCII characters removed,
 * which may otherwise result in a blank between two characters unexpectedly.
 *
 * @author Huizhe Wang <huizhewang@outlook.com>
 */

if(!defined('DOKU_INC')) die();
if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN', DOKU_INC . 'lib/plugins/');

require_once DOKU_INC . 'inc/parser/xhtml.php';

/**
 * The Renderer
 */
class renderer_plugin_nonblank extends Doku_Renderer_xhtml {
    /**
     * Render plain text data, and remove the single line break
     * if the previous and following characters are both full-width characters,
     * especially CJK.
     *
     * @param $text
     */
    function cdata($text) {
        $esc = $this->_xmlEntities($text);
        $this->doc .= preg_replace('/(?<=[^\x00-\xFF])\n(?=[^\x00-\xFF])/um', '', $esc);
    }
}
