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
        $this->data['action'] = 'create';
        
        $this->data['id'] = '';
        $this->data['title'] = '';
        $this->data['description'] = '';
        $this->data['post'] = '';
        $this->data['images'] = array();
        
        $this->presentForm();
        $this->submit();
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
        $this->data['action'] = 'edit/' . $id;
        
        $post = $this->posts->getById($id);
        $this->data['id'] = $post['id'];
        $this->data['title'] = $post['title'];
        $this->data['description'] = $post['description'];
        $this->data['post'] = $post['content'];
        $this->data['images'] = array( array('image' => $post['image']) );
        
        $this->presentForm();
        $this->submit();
        $this->render();
    }
    
    /**
     * Save an uploaded file this is an AJAX like operation, it designed to work
     * with dropspace, drop space must handle adding the name of the file to the form.
     * 
     * @return boolean true.
     */
    public function addimage()
    {
        $file_name = hash("sha256", time() . rand());
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        
        $config['file_name'] = $file_name;
        
        $this->load->library('upload', $config);
        
        // Return the image url or "failed" to the uploading browser
        if($this->upload->do_upload("file"))
        {
            $uploadData = $this->upload->data();
            echo($uploadData['file_name']);
        }
        else 
        {
            echo('failed');
        }
        
        return true;
    }
    
    /**
     * Validate input data and either create a new Post or edit and existing post.
     */
    public function submit()
    {
        // Only do anything if the form has been submitted
        if($this->input->post('Save', TRUE) != false )
        {
            $images = $this->input->post('image', true);
            
            // Populate template variables with input values
            $this->data['id'] = $this->input->post('id', true);
            $this->data['title'] = $this->input->post('title', true);
            $this->data['description'] = $this->input->post('description', true);
            $this->data['post'] = $this->input->post('post', true);
            
            if (count($images) > 0)
                $this->data['images'][0]  = array('image' => $images[0]);
            
            // If data is invalid, return immediately.
            if (!$this->validateInput())
                return;
            
            // Create a new Post if the ID is not set
            if($this->data['id'] == '')
            {
                $this->posts->create
                        (
                            $this->data['title'],
                            $this->data['description'],
                            $this->data['post'],
                            $this->data['images'][0]['image'],
                            '',
                            date("Y-m-d H:i:s")
                        );
                
                // Redirect to /Admin/Post
                $this->load->helper('url');
                redirect('/Admin/Post');
            }
            // Edit the post if the ID is set
            else 
            {
                $this->posts->edit
                        (
                            $this->data['id'],
                            $this->data['title'],
                            $this->data['description'],
                            $this->data['post'],
                            $this->data['images'][0]['image'],
                            '',
                            date("Y-m-d H:i:s")
                        );
                
                // Show a success message
                $this->data['success'][] = array('message'=>'Post Editted!');
            }
        }
    }
    
    /**
     * Prepare the Form for rendering
     */
    private function presentForm()
    {
        $this->data['success'] = array();
        $this->data['errors'] = array();
        
        // Load dropzone
        $this->data['styles'][] = array('style'=>'/assets/css/dropzone.css');
        $this->data['scripts'][] = array('script'=>"/assets/js/dropzone.js");
        $this->data['scripts'][] = array('script'=>"/assets/js/dropzoneconfig.js");
        
        // Load MCE
        $this->data['scripts'][] = array('script'=>"//tinymce.cachefly.net/4.1/tinymce.min.js");
        $this->data['components'][] = array('component'=>$this->parser->parse('components/tinymce', array('selector'=>'.editor'), true));
    }
    
    /**
     * Validate form input
     * 
     * @return boolean false if input is invalid / true if input is valid
     */
    private function validateInput()
    {
        // Validate Input
        if (strlen($this->data['title']) == 0)
            $this->data['errors'][] = array('message'=>'Title must not be emtpy.');

        if (strlen($this->data['description']) > 128)
            $this->data['errors'][] = array('message'=>'Description must be <= 128 characters.');

        if (strlen($this->data['post']) == 0)
            $this->data['errors'][] = array('message'=>'Post must not be emtpy.');

        if (count($this->data['images']) == 0)
            $this->data['errors'][] = array('message'=>'Please submit an image.');
        
        // Return false if there are errors
        if (count($this->data['errors']) > 0)
            return false;
        
        // Return true if there are no errors
        return true;
    }
}
