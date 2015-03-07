<?php

/**
 * This is a model for "posts". It provides access
 * to blog posts information, currently with bogus data.
 * 
 * @author Calvin Rempel
 */
class Posts extends CI_Model {
    
    /**
     * Construct the base CI_Model
     */
    public function __construct() {
        parent::__construct();
    }
    
    public function create($title, $description, $content, $image, $thumbnail, $date) {
        $data = array (
          'title'       => $title,
          'description' => $description,
          'content'     => $content,
          'image'       => $image,
          'thumbnail'   => $thumbnail,
          'date'        => $date
        );
        
        $this->db->insert('posts', $data);
    }
    
    public function edit($id, $description, $content, $image, $thumbnail, $date) {
        $data = array (
          'title'       => $title,
          'description' => $description,
          'content'     => $content,
          'image'       => $image,
          'thumbnail'   => $thumbnail,
          'date'        => $date
        );
        
        $this->db->where('id', $id);
        $this->db->update('posts', $data);
    }
    
    /**
     * Get the Post with the given ID
     * 
     * @param int $id the ID of the Post to get
     * @return Post data
     */
    public function getById($id) {
        $this->db->where('id', $id);
        return (array) $this->db->get('posts')->row();
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
        $this->db->limit($perPage, ($page * $perPage) - $perPage);
        $data = $this->db->get('posts')->result();
        
        return (array) $data;
    }
    
    /**
     * Get the number of pages required to show all Posts with the given number of
     * Posts per page.
     * 
     * @param int $perPage the number of posts per page
     * @return int the number of pages required to show all posts.
     */
    public function getPageCount($perPage)
    {
        return ceil($this->db->count_all('posts') / $perPage);
    }
}