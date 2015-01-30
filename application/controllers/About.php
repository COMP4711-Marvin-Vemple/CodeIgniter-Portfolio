<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Welcome is the Controller that is executed by accessing "/about". It has only one
 * view which shows the about page.
 * 
 * @author Calvin Rempel
 */
class About extends Application {

    /**
     * Controller for "/about" page. Loads static 'about' view.
     */
    public function index() {
        $this->data['pagebody'] = 'about';
        $this->render();
    }
}
