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
        
        // Load dropzone
        $this->data['styles'][] = array('style'=>'/assets/css/dropzone.css');
        $this->data['scripts'][] = array('script'=>"/assets/js/dropzone.js");
        $this->data['scripts'][] = array('script'=>"/assets/js/dropzoneconfig.js");
        
        // Load MCE
        $this->data['scripts'][] = array('script'=>"//tinymce.cachefly.net/4.1/tinymce.min.js");
        $this->data['components'][] = array('component'=>$this->parser->parse('components/tinymce', array('selector'=>'.editor'), true));
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
        $this->data['action'] == 'edit/' . $id;
        
        $project = $this->projects()->getById($id);
        $this->data['id'] = $project['id'];
        $this->data['title'] = $project['title'];
        $this->data['description'] = $project['description'];
        $this->data['short_description'] = $project['short_description'];
        $this->data['featured'] = $project['featured'];
        $this->data['source'] = $project['github'];
        $this->data['demo'] = $project['demo'];
        
        $this->presentForm();
        $this->submit();
        $this->render();
    }
    
    
    /**
     * Validate input data and create or edit a project.
     */
    public function submit()
    {
        if($this->input->post('Save', TRUE) != false)
        {
            $images = $this->input->post('image', true);
            
            $this->data['id'] = $this->input->post('id', true);
            $this->data['title'] = $this->post('title', true);
            $this->data['short_description'] = $this->post('short_description', true);
            $this->data['description'] = $this->post('description', true);
            $this->data['source'] = $this->post('source', true);
            $this->data['github'] = $this->post('github', true);
            $this->data['demo']  = $this->post('demo', true);
            $this->data['images'] = $this->post('images', true);
            $this->data['image'] = $this->data['images'][0];
            $this->data['tags'] = array();
        }
        
        // make sure there's images to save before it tries to save any.
        if(count($images) > 0)
        {
            
        }
        
        
        if($this->data['id'] == '')
        {
            $this->project->create
                    (
                        $this->data['title'],
                        $this->data['description'],
                        $this->data['short_description'],
                        $this->data['image'],
                        $this->data['thumb'],
                        $this->data['featured'],
                        date("Y-m-d H:i:s"),
                        $this->data['source'],
                        $this->data['github'],
                        $this->data['demo'],
                        $this->data['tags'],
                        $this->data['images']
                    );
            $this->load->helper('url');
            redirect('Admin/Project');
        }
        else
        {
            $this->project->edit
        }
        
        
    }
}
