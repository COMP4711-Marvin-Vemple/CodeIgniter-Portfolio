<?php

/**
 * This is a model for "tags". It provides access
 * to tag information, and allows tags to be retrieved based on the Project they are
 * associated with.
 * 
 * @author Calvin Rempel
 */
class Tags extends CI_Model {
    
    /**
     * Construct the base CI_Model
     */
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Add new tags to the database
     * 
     * @param mixed $tagData an array of arrays of tags associated with projects.
     */
    public function addTags($tagData) {
        $this->db->insert_batch('tags', $tagData);
    }
    
    /**
     * Remove all tags from a project
     * 
     * @param int $project_id the id of the project to remove all tags from
     */
    public function unsetTags($project_id) {
        $this->db->where('project', $project_id);
        $this->db->delete('tags');
    }
    
    /**
     * Get the Tags associated with the given Project.
     * 
     * @param int $project_id the ID of the Project to associated with the tags
     * @return an array of tags
     */
    public function getByProject($project_id) {
        $this->db->where('project', $project_id);
        return (array) $this->db->get('tags')->result();
    }
    
    /**
     * Get all Tags in the database
     * 
     * @return mixed array of all tags in the database.
     */
    public function getAll() {
        return (array) $this->db->get('tags')->result();
    }
}