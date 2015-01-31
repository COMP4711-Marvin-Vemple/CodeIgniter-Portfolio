<?php

/**
 * This is a model for "projects". It provides access
 * to project information, currently with bogus data.
 * 
 * @author Calvin Rempel
 */
class Projects extends CI_Model {
    
    /** BOGUS DATA **/
    var $data = array(
      array('id' => 1, 'featured' => 'true', 'title' => 'Test Project 1', 'description' => 'This is the description', 'image' => 'project.png', 'thumbnail' => 'thumb.png', 'data' => 'Jan 1, 1970', 'source' => 'test_code', 'github' => 'www.google.com', 'demo' => 'www.google.com', 'tags' => array('html', 'php')),
      array('id' => 2, 'featured' => 'true', 'title' => 'Test Project 2', 'description' => 'This is the description', 'image' => 'project.png', 'thumbnail' => 'thumb.png', 'data' => 'Jan 1, 1970', 'source' => 'test_code', 'github' => 'www.google.com', 'demo' => 'www.google.com', 'tags' => array('html', 'php')),
      array('id' => 3, 'featured' => 'false', 'title' => 'Test Project 3', 'description' => 'This is the description', 'image' => 'project.png', 'thumbnail' => 'thumb.png', 'data' => 'Jan 1, 1970', 'source' => 'test_code', 'github' => 'www.google.com', 'demo' => 'www.google.com', 'tags' => array('html', 'php')),
      array('id' => 4, 'featured' => 'false', 'title' => 'Test Project 4', 'description' => 'This is the description', 'image' => 'project.png', 'thumbnail' => 'thumb.png', 'data' => 'Jan 1, 1970', 'source' => 'test_code', 'github' => 'www.google.com', 'demo' => 'www.google.com', 'tags' => array('html', 'php')),
      array('id' => 5, 'featured' => 'false', 'title' => 'Test Project 5', 'description' => 'This is the description', 'image' => 'project.png', 'thumbnail' => 'thumb.png', 'data' => 'Jan 1, 1970', 'source' => 'test_code', 'github' => 'www.google.com', 'demo' => 'www.google.com', 'tags' => array('html', 'php')),
      array('id' => 6, 'featured' => 'false', 'title' => 'Test Project 6', 'description' => 'This is the description', 'image' => 'project.png', 'thumbnail' => 'thumb.png', 'data' => 'Jan 1, 1970', 'source' => 'test_code', 'github' => 'www.google.com', 'demo' => 'www.google.com', 'tags' => array('html', 'php')),
      array('id' => 7, 'featured' => 'false', 'title' => 'Test Project 7', 'description' => 'This is the description', 'image' => 'project.png', 'thumbnail' => 'thumb.png', 'data' => 'Jan 1, 1970', 'source' => 'test_code', 'github' => 'www.google.com', 'demo' => 'www.google.com', 'tags' => array('html', 'php')),
      array('id' => 8, 'featured' => 'false', 'title' => 'Test Project 8', 'description' => 'This is the description', 'image' => 'project.png', 'thumbnail' => 'thumb.png', 'data' => 'Jan 1, 1970', 'source' => 'test_code', 'github' => 'www.google.com', 'demo' => 'www.google.com', 'tags' => array('html', 'php')),
    );
    
    /**
     * Construct the base CI_Model
     */
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Get the Project with the given ID.
     * (SHOULD ALSO GET PROJECT TAGS)
     * 
     * @param int $id the ID of the Project to get
     * @return Project data
     */
    public function getById($id) {
        return array($this->data[$id]);
    }
    
    /**
     * Get the Projects marked as "Featured"
     * (SHOULD ALSO GET PROJECT TAGS)
     * 
     * @return Project data
     */
    public function getFeatured() {
        $retval = array();
        
        foreach ($this->data as $project)
            if ($project['featured'] === 'true')
                $retval[] = $project;
            
        return $retval;
    }
    
    /**
     * Get Projects on a certain page with the given number
     * of Projects per page.
     * (SHOULD ALSO GET PROJECT TAGS)
     * 
     * @param int $page the Page number (1-n) inclusive.
     * @param int $perPage the number of Projects to return per page.
     * @param string $filter a tag to filter (CURRENTLY IGNORED)
     * @param string $sort a parameter to sort by (CURRENTLY IGNORED)
     * @param string $sortOrder the order in which Projects are sorted (CURRENTLY IGNORED)
     * @return Project data
     */
    public function getPaginated($page, $perPage, $filter='', $sort='title', $sortOrder='asc') {
        $retval = array();
        $pages = ceil($perPage / count($this->data));
        
        if ($page < 1 || $page > $pages)
            return $retval;
        
        $i = ($page * $perPage) - $perPage;
        while ($i < count($this->data)) {
            $retval[] = $this->data[$i];
            $i++;
        }
        
        return $retval;
    }
}