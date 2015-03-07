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
        
        $this->data['entry'] = $this->projects->getPaginated(1,
                                                             PHP_INT_MAX,
                                                             '',
                                                             'title',
                                                             'asc');
        
        $this->render();
    }
    
    /**
     * Controller for creating a new Project
     */
    public function create() {
        $this->data['mode'] = 'admin';
        $this->data['pagebody'] = 'admin/project-edit';
        $this->render();
    }
    
    /**
     * Controller for editting an existing Project
     * 
     * @param int $id the id of the existing project
     */
    public function edit($id) {
        $this->data['mode'] = 'admin';
        $this->data['pagebody'] = 'admin/project-edit';
        $this->render();
    }
}
