<?php
/**
 * Options for the oauth plugin
 *
 * @author Andreas Gohr <andi@splitbrain.org>
 */

class setting_plugin_oauthatlauncher extends setting {

    function update($input) {
        return true;
    }

    public function html(&$plugin, $echo = false) {
        /** @var helper_plugin_oauthatlauncher $hlp */
        $hlp = plugin_load('helper', 'oauthatlauncher');

        $key   = htmlspecialchars($this->_key);
        $value = '<code>'.$hlp->redirectURI().'</code>';

        $label = '<label for="config___'.$key.'">'.$this->prompt($plugin).'</label>';
        $input = '<div>'.$value.'</div>';
        return array($label, $input);
    }

}

$meta['info']                = array('plugin_oauthatlauncher');
$meta['client-key']           = array('string');
$meta['client-secret']       = array('string');
$meta['register-on-auth']    = array('onoff','_caution' => 'security');
