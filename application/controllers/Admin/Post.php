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
        
        
        $this->data['id'] = '';
        $this->data['title'] = '';
        $this->data['description'] = '';
        $this->data['post'] = '';
        
        $this->presentForm();
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
        
        $this->data['id'] = $this->Post->getById($id);
        
        $this->data['id'] = '';
        $this->data['title'] = '';
        $this->data['description'] = '';
        $this->data['post'] = '';
        
        $this->render();
    }
    
    public function addimage()
    {
        
        
        $file_name = hash("sha256", time() . rand());
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        
        $config['file_name'] = $file_name;
        
        $this->load->library('upload', $config);
        
        if($this->upload->do_upload("file"))
        {
            echo($this->upload->data()['file_name']);
        }
        else 
        {
            echo('failed');
        }
        
        return true;
    }
    
    public function submit()
    {
        if($this->input->post('id', TRUE) != false )
        {
            // If this is a new post.
            if($this->input->post('id', TRUE) == '')
            {
                $this->Post->create
                        (
                            $this->input->post('title', true),
                            $this->input->post('description', true),
                            $this->input->post('content', true),
                            $this->input->post('image', true)[0],
                            '',
                            time()
                        );
            }
            else 
            {
                $this->Post->edit
                        (
                            $this->input->post('id', true),
                            $this->input->post('title', true),
                            $this->input->post('description', true),
                            $this->input->post('content', true),
                            $this->input->post('image', true),
                            '',
                            time()
                        );
            }
        }
    }
    
    private function presentForm()
    {
        $this->data['success'] = array();
        $this->data['errors'] = array();
        
        // Load dropzone
        $this->data['scripts'][] = array('script'=>"/assets/js/dropzone.js");
        $this->data['scripts'][] = array('script'=>"/assets/js/dropzoneconfig.js");
        
        // Load MCE
        $this->data['scripts'][] = array('script'=>"//tinymce.cachefly.net/4.1/tinymce.min.js");
        $this->data['components'][] = array('component'=>$this->parser->parse('components/tinymce', array('selector'=>'.editor'), true));
        
    }
}
