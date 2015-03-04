<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin/About is the Controller that is executed by accessing "/Admin/About".
 * 
 * @author Calvin Rempel
 */
class About extends Application {

    /**
     * Controller for "Admin/About" page.
     */
    public function index() {
        $this->data['mode'] = 'admin';
        $this->data['pagebody'] = 'admin/about';
        $this->render();
    }
}
