<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin/Project is the Controller that is executed by accessing "/Admin/Project".
 * 
 * @author Calvin Rempel
 */
class Project extends Application {

    /**
     * Controller for "Admin/Project" page.
     */
    public function index() {
        $this->data['mode'] = 'admin';
        $this->data['pagebody'] = 'admin/project';
        $this->render();
    }
    
    public function create() {
        $this->data['mode'] = 'admin';
        $this->data['pagebody'] = 'admin/project-edit';
        $this->render();
    }
    
    public function edit($id) {
        $this->data['mode'] = 'admin';
        $this->data['pagebody'] = 'admin/project-edit';
        $this->render();
    }
}
