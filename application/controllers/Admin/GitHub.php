<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin/GitHub is the Controller that is executed by accessing "/Admin/GitHub".
 * 
 * @author Calvin Rempel
 */
class GitHub extends Application {

    /**
     * Controller for "Admin/GitHub" page.
     */
    public function index() {
        $this->data['mode'] = 'admin';
        $this->data['pagebody'] = 'admin/github';
        $this->render();
    }
}
