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
        
        // Load current contents of about page into template var 'about'
        $this->data['about'] = file_get_contents('application\views\about.php');
        
        $this->render();
    }
}
