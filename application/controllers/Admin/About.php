<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin/About is the Controller that is executed by accessing "/Admin/About".
 * 
 * @author Calvin Rempel
 */
class About extends Application {
    
    private static $ABOUT_FILE   = 'application/views/about.php';

    /**
     * Controller for "Admin/About" page.
     */
    public function index() {
        // Check if the form was submitted and if so, save the data
        $this->saveData();
        
        // Setup the rendering configuration
        $this->data['mode'] = 'admin';
        $this->data['pagebody'] = 'admin/about';
        
        // Load current contents of about page into template var 'about'
        $this->data['about'] = file_get_contents(About::$ABOUT_FILE);
        
        // Load TinyMCE
        $this->data['scripts'][] = array('script'=>"//tinymce.cachefly.net/4.1/tinymce.min.js");
        $this->data['components'][] = array('component'=>$this->parser->parse('components/tinymce', array('selector'=>'.editor')));
        
        $this->render();
    }
    
    /**
     * Save the Submitted data if the form was submitted.
     */
    private function saveData() {
        $newData = '';
        
        // If the data was submitted, write it to the file
        if (($newData = $this->input->post('about', true)) != false) {
            file_put_contents(About::$ABOUT_FILE, $newData);
        }
    }
}
