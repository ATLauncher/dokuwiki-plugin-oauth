<?php

namespace OAuth\Plugin;

use OAuth\OAuth2\Service\ATLauncher;

class ATLauncherAdapter extends AbstractAdapter {

    /**
     * Retrieve the user's data
     *
     * The array needs to contain at least 'user', 'email', 'name' and optional 'grps'
     *
     * @return array
     */
    public function getUser() {
        $JSON = new \JSON(JSON_LOOSE_TYPE);
        $data = array();

        $response = $this->oAuth->request('https://atlauncher.com/oauth/me');
        $result = $JSON->decode($response);

        if( !empty($result['username']) )
        {
            $data['user'] = $result['username'];
        }
        else
        {
            $data['user'] = isset($result['name']) ? $result['name'] : $result['email'];
        }
        $data['name'] = isset($result['name']) ? $result['name'] : $result['email'];
        $data['mail'] = $result['email'];
        $data['grps'] = $result['grps'];

        return $data;
    }

    /**
     * Access to user and his email addresses
     *
     * @return array
     */
    public function getScope() {
        return array(ATLauncher::SCOPE_ID);
    }

}
