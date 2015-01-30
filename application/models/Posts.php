<?php

/**
 * This is a model for "posts". It provides access
 * to blog posts information, currently with bogus data.
 * 
 * @author Calvin Rempel
 */
class Posts extends CI_Model {
    
    /** BOGUS DATA **/
    var $data = array(
      array('id' => 1, 'title' => 'Test Post 1', 'description' => 'This is the description', 'content'=>'This is the blog post', 'image' => 'post.png', 'thumbnail' => 'thumb.png', 'data' => 'Jan 1, 1970'),
      array('id' => 2, 'title' => 'Test Post 2', 'description' => 'This is the description', 'content'=>'This is the blog post', 'image' => 'post.png', 'thumbnail' => 'thumb.png', 'data' => 'Jan 1, 1970'),
      array('id' => 3, 'title' => 'Test Post 3', 'description' => 'This is the description', 'content'=>'This is the blog post', 'image' => 'post.png', 'thumbnail' => 'thumb.png', 'data' => 'Jan 1, 1970'),
      array('id' => 4, 'title' => 'Test Post 4', 'description' => 'This is the description', 'content'=>'This is the blog post', 'image' => 'post.png', 'thumbnail' => 'thumb.png', 'data' => 'Jan 1, 1970'),
      array('id' => 5, 'title' => 'Test Post 5', 'description' => 'This is the description', 'content'=>'This is the blog post', 'image' => 'post.png', 'thumbnail' => 'thumb.png', 'data' => 'Jan 1, 1970'),
      array('id' => 6, 'title' => 'Test Post 6', 'description' => 'This is the description', 'content'=>'This is the blog post', 'image' => 'post.png', 'thumbnail' => 'thumb.png', 'data' => 'Jan 1, 1970'),
      array('id' => 7, 'title' => 'Test Post 7', 'description' => 'This is the description', 'content'=>'This is the blog post', 'image' => 'post.png', 'thumbnail' => 'thumb.png', 'data' => 'Jan 1, 1970'),
    );
    
    /**
     * Construct the base CI_Model
     */
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Get the Post with the given ID
     * 
     * @param int $id the ID of the Post to get
     * @return Post data
     */
    public function getById($id) {
        return $this->data[$id];
    }
    
    /**
     * Get Posts on a certain page with the given number
     * of Posts per page.
     * 
     * @param int $page the Page number (1-n) inclusive.
     * @param int $perPage the number of Posts to return per page.
     * @return Post data
     */
    public function getPaginated($page, $perPage) {
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