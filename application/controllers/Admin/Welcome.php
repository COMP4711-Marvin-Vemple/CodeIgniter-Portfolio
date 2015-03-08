<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Welcome is the Controller that enables the user to login to the admin panel.
 * Currently just redirects to Project panel.
 * 
 * @author Calvin Rempel
 */
class Welcome extends Application {
    
    /**
     * Allow the user to login. (Currently just redirects to Admin/Project).
     */
    public function index() {
        $this->load->helper('url');
        redirect('/Admin/Project');
    }
}
