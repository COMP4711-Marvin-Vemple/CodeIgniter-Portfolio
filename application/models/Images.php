
<?php

/**
 * This is a model for "images". It provides access
 * to image information, and allows images to be retrieved based on the Project they are
 * associated with.
 * 
 * @author Calvin Rempel
 */
class Images extends CI_Model {
    
    /**
     * Construct the base CI_Model
     */
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Add a new image to the database
     * 
     * @param String $filename the name of the image file
     * @param String $alt the alternate text to show for the image
     * @param int $project_id the id of the project to associate the image with
     */
    public function addImage($filename, $alt, $project_id) {
        // Ensure the Image isn't already added to the project
        $this->db->select('*');
        $this->db->from('images');
        $this->db->where('filename', $filename);
        $this->db->where('project', $project_id);
        if ($this->db->count_all_results() != 0)
          return;
        
        // Add the Image to the project
        $data = array( 'filename'   => $filename,
                       'thumbnail'  => $filename,
                       'alt'        => $alt,
                       'project'    => $project_id );
        
        $this->db->insert('images', $data);
    }
    
    /**
     * Remove all images associated with the given project from the database.
     * 
     * @param int $project_id the id of the project
     */
    public function unsetImages($project_id) {
        $this->db->where('project', $project_id);
        $this->db->delete('images');
    }
    
    /**
     * Get the Images associated with the given Project.
     * 
     * @param int $project_id the ID of the Project to associated with the images
     * @return an array of images
     */
    public function getByProject($project_id) {
        $this->db->where('project', $project_id);
        return (array) $this->db->get('images')->result();
    }
}