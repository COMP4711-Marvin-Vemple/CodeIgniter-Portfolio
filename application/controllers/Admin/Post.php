<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin/Post is the Controller that is executed by accessing "/Admin/Post".
 * 
 * @author Calvin Rempel
 */
class Post extends Application {

    /**
     * Controller for "Admin/Post" page.
     */
    public function index() {
        $this->data['mode'] = 'admin';
        $this->data['pagebody'] = 'admin/post';
        $this->render();
    }
    
    public function create() {
        $this->data['mode'] = 'admin';
        $this->data['pagebody'] = 'admin/post-edit';
        $this->render();
    }
    
    public function edit($id) {
        $this->data['mode'] = 'admin';
        $this->data['pagebody'] = 'admin/post-edit';
        $this->render();
    }
    
}
