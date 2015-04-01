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
        $this->data['id'] = '';
        $this->data['title'] = '';
        $this->data['short_description'] = '';
        $this->data['description'] = '';
        $this->data['source'] = '';
        $this->data['github'] = '';
        $this->data['demo'] = '';
        $this->data['tags'] = '';
        $this->data['action'] = 'create';
        $this->data['images'] = array();
        $this->data['saved_images'] = array();
        
        $this->presentForm();
        $this->submit();
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
        $this->data['action'] = 'edit/' . $id;
        
        $project = $this->projects->getById($id);
        $this->data['id'] = $id;
        $this->data['title'] = $project[0]['title'];
        $this->data['description'] = $project[0]['description'];
        $this->data['image'] = $project[0]['image'];
        $this->data['short_description'] = $project[0]['short_description'];
        $this->data['featured'] = $project[0]['featured'];
        $this->data['source'] = $project[0]['source'];
        $this->data['github'] = $project[0]['github'];
        $this->data['demo'] = $project[0]['demo'];
        $this->data['tags'] = $this->tagArrayToString($project[0]['tags']);
        $this->data['images'] = array();
        $this->data['saved_images'] = array();
        
        // Display images that have been saved already
        $images = $this->images->getByProject($id);
        foreach ($images as $image)
        {
            $this->data['saved_images'][] = array('image'=>$image->filename);
        }
        
        $this->presentForm();
        $this->submit();
        $this->render();
    }
    
    
    /**
     * Validate input data and create or edit a project.
     */
    public function submit()
    {
        // only proceed if the form as been submitted.
        if($this->input->post('Save', TRUE) != false )
        {   
            $this->data['id'] = $this->input->post('id', true);
            $this->data['title'] = $this->input->post('title', true);
            $this->data['short_description'] = $this->input->post('short_description', true);
            $this->data['description'] = $this->input->post('description', true);
            $this->data['source'] = $this->input->post('source', true);
            $this->data['github'] = $this->input->post('github', true);
            $this->data['demo']  = $this->input->post('demo', true);
            $this->data['tags'] = $this->input->post('tags', true);
            $this->data['images'] = $this->input->post('image', true);

            if ($this->data['images'] != FALSE)
            {
                $newImageArray = array();
                
                foreach($this->data['images'] as $image)
                {
                    $newImageArray[] = array('image'=>$image);
                }
                
                $this->data['images'] = $newImageArray;
            }
            else
            {
                $this->data['images'] = array();
            }
            
            if(!$this->validateInput())
            {
                return true;
            }
            
            if($this->data['id'] == null)
            {
                $id = $this->projects->create
                        (
                            $this->data['title'],
                            $this->data['description'],
                            $this->data['short_description'],
                            $this->data['images'][0]['image'],
                            $this->data['images'][0]['image'],
                            'f',
                            date("Y-m-d H:i:s"),
                            $this->data['source'],
                            isset($this->data['github'])?$this->data['github']:'',
                            isset($this->data['demo'])?$this->data['github']:'',
                            $this->data['images']
                        );
                
                $this->saveTags($id, $this->data['tags']);
                $this->load->helper('url');
                redirect('Admin/Project');
            }
            else
            {
                $this->projects->edit(
                            $this->data['id'],
                            $this->data['title'],
                            $this->data['description'],
                            $this->data['short_description'],
                            $this->data['image'],
                            $this->data['image'],
                            $this->data['featured'],
                            date("Y-m-d H:i:s"),
                            $this->data['source'],
                            $this->data['github'],
                            $this->data['demo'],
                            $this->data['images']
                        );
                $this->saveTags($this->data['id'], $this->data['tags']);
                $this->data['success'][] = array('message'=>'Project Edited');
            }
        }   
    }
    
    /*
     * validates the form to be submitted.
     */
    private function validateInput()
    {
        // Validate Input
        if (strlen($this->data['title']) == 0)
            $this->data['errors'][] = array('message'=>'Title must not be emtpy.');

        if (strlen($this->data['short_description']) > 128)
            $this->data['errors'][] = array('message'=>'Description must be <= 128 characters.');

        if (strlen($this->data['description']) == 0)
            $this->data['errors'][] = array('message'=>'Post must not be emtpy.');

        
        // Return false if there are errors
        if (count($this->data['errors']) > 0)
            return false;
        
        // Return true if there are no errors
        return true;
    }
    
    private function presentForm()
    {
        $this->data['success'] = array();
        $this->data['errors'] = array();

        // Load dropzone
        $this->data['styles'][] = array('style'=>'/assets/css/dropzone.css');
        $this->data['scripts'][] = array('script'=>"/assets/js/dropzone.js");
        $this->data['scripts'][] = array('script'=>"/assets/js/dropzonepjdrop.js");

        // Load MCE
        $this->data['scripts'][] = array('script'=>"//tinymce.cachefly.net/4.1/tinymce.min.js");
        $this->data['components'][] = array('component'=>$this->parser->parse('components/tinymce', array('selector'=>'.editor'), true));
    }
    
    private function saveTags($projectId, $tagString)
    {
        $seperated = explode(',', $tagString);
        $tags = array();
        
        // Build saveabled tags array
        foreach ($seperated as $tag)
        {
            $tags[] = array(
                'tag'       => trim($tag),
                'project'   => $projectId
            );
        }
        
        // Remove existing tags from the project
        $this->tags->unsetTags($projectId);
        
        // Add the new tags to the project
        $this->tags->addTags($tags);
    }
    
    private function tagArrayToString($tags)
    {
        $tagNames = array();
        
        foreach ($tags as $tag)
        {
            $tagNames[] = $tag->tag;
        }
        
        return implode(',', $tagNames);
    }
}
