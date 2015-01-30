<?php

/**
 * Application is the base controller for the Portfolio
 * CodeIgniter Project.
 * 
 * @author Calvin Rempel
 */
class Application extends CI_Controller {

    /**
     * $menu defines the links in the main navigation menu.
     */
    protected $menu = array (
        array('name' => 'Home', 'link' => '/'),
        array('name' => 'Projects', 'link' => '/project'),
        array('name' => 'Repositories', 'link' => '/repo'),
        array('name' => 'Blog', 'link' => '/blog'),
        array('name' => 'About', 'link' => '/about'),
    );
    
    /**
     * $data is an array to hold view template parameters in.
     */
    protected $data = array();

    /**
     * Constructor for Application.
     */
    function __construct() {
        parent::__construct();
        $this->data = array();
        $this->load->library('parser');
    }

    /**
     * Render this page
     */
    function render() {
        // Create the Menu Bar
        $this->data['menubar'] = $this->parser->parse('_menubar', $this->menu, true);
        
        // Load the page content
        $this->data['content'] = $this->parser->parse($this->data['pagebody'], $this->data, true);

        // Render the Page
        $this->data['data'] = &$this->data;
        $this->parser->parse('_template', $this->data);
    }

}