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
        $this->data['posts'] = $this->posts->getPaginated(1, PHP_INT_MAX);
        $this->render();
    }
    
    /**
     * Controller for creating a new Post
     */
    public function create() {
        $this->data['mode'] = 'admin';
        $this->data['pagebody'] = 'admin/post-edit';
        $this->render();
    }
    
    /**
     * Controller for editting an existing Post
     * 
     * @param int $id the id of the post to edit
     */
    public function edit($id) {
        $this->data['mode'] = 'admin';
        $this->data['pagebody'] = 'admin/post-edit';
        $this->render();
    }
    
}
