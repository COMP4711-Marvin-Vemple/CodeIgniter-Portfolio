<?php

/**
 * This is a model for GitHub repos. It provides access
 * to a users repositories and their recent commits.
 * 
 * @author Calvin Rempel
 */
class Repositories extends CI_Model {
    
    /** BOGUS DATA **/
    var $data = array(
      array('id' => 0, 'title' => 'Test Repo 1', 'description' => 'This is the description', 'commits' => array( array('message' => 'Test Commit', 'date' => 'Today', 'url' => 'http://www.google.com'), array('message' => 'Test Commit', 'date' => 'Today', 'url' => 'http://www.google.com'))),
      array('id' => 1, 'title' => 'Test Repo 2', 'description' => 'This is the description', 'commits' => array( array('message' => 'Test Commit', 'date' => 'Today', 'url' => 'http://www.google.com'), array('message' => 'Test Commit', 'date' => 'Today', 'url' => 'http://www.google.com'))),
      array('id' => 2, 'title' => 'Test Repo 3', 'description' => 'This is the description', 'commits' => array( array('message' => 'Test Commit', 'date' => 'Today', 'url' => 'http://www.google.com'), array('message' => 'Test Commit', 'date' => 'Today', 'url' => 'http://www.google.com'))),
      array('id' => 3, 'title' => 'Test Repo 4', 'description' => 'This is the description', 'commits' => array( array('message' => 'Test Commit', 'date' => 'Today', 'url' => 'http://www.google.com'), array('message' => 'Test Commit', 'date' => 'Today', 'url' => 'http://www.google.com'))),
      array('id' => 4, 'title' => 'Test Repo 5', 'description' => 'This is the description', 'commits' => array( array('message' => 'Test Commit', 'date' => 'Today', 'url' => 'http://www.google.com'), array('message' => 'Test Commit', 'date' => 'Today', 'url' => 'http://www.google.com'))),
      array('id' => 5, 'title' => 'Test Repo 6', 'description' => 'This is the description', 'commits' => array( array('message' => 'Test Commit', 'date' => 'Today', 'url' => 'http://www.google.com'), array('message' => 'Test Commit', 'date' => 'Today', 'url' => 'http://www.google.com'))),
      array('id' => 6, 'title' => 'Test Repo 7', 'description' => 'This is the description', 'commits' => array( array('message' => 'Test Commit', 'date' => 'Today', 'url' => 'http://www.google.com'), array('message' => 'Test Commit', 'date' => 'Today', 'url' => 'http://www.google.com'))),
      array('id' => 7, 'title' => 'Test Repo 8', 'description' => 'This is the description', 'commits' => array( array('message' => 'Test Commit', 'date' => 'Today', 'url' => 'http://www.google.com'), array('message' => 'Test Commit', 'date' => 'Today', 'url' => 'http://www.google.com')))
    );
    
    /**
     * Construct the base CI_Model
     */
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Get the Repository with the given ID
     * 
     * @param int $id the ID of the Repo to get
     * @return Repo data
     */
    public function getById($id) {
        return array($this->data[$id]);
    }
    
    /**
     * Get Repositories on a certain page with the given number
     * of Repos per page.
     * 
     * @param int $page the Page number (1-n) inclusive.
     * @param int $perPage the number of Repos to return per page.
     * @return Post data
     */
    public function getPaginated($page, $perPage) {
        $retval = array();
        $pages = $this->getPageCount($perPage);
        
        if ($page < 1 || $page > $pages)
            return $retval;
        
        $i = ($page * $perPage) - $perPage;
        while ($i < count($this->data) && count($retval) < $perPage) {
            $retval[] = $this->data[$i];
            $i++;
        }
        
        return $retval;
    }
    
    /**
     * Get the number of pages required to show all Repos with the given number of
     * Repos per page.
     * 
     * @param int $perPage the number of repos per page
     * @return int the number of pages required to show all repos.
     */
    public function getPageCount($perPage)
    {
        return ceil(count($this->data) / $perPage);
    }
}