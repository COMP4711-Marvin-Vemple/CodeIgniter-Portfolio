
<?php

/**
 * This is a model for "projects". It provides access
 * to project information, currently with bogus data.
 * 
 * @author Calvin Rempel
 */
class Projects extends CI_Model {
    
    /**
     * Construct the base CI_Model
     */
    public function __construct() {
        parent::__construct();
    }
    
    public function create($title, $description, $short_description, $image, $thumb, $featured, $date, $source, $github, $demo, $images) {
        $data = array('title' => $title,
                      'description' => $description, 
                      'short_description' => $short_description, 
                      'image' => $image, 
                      'thumb' => $thumb, 
                      'featured' => $featured, 
                      'date' => $date, 
                      'source' => $source, 
                      'github' => $github, 
                      'demo' => $demo );
        
        $this->db->insert('projects', $data);
        $id = $this->db->insert_id();
        foreach( $images as $i )
        {
            $this->images->addImage($i, 'image', $i, $id);
        }
        
        return $id;
    }
    
    public function edit($id, $title, $description, $short_description, $image, $thumb, $featured, $date, $source, $github, $demo, $images) {
        
        $data = array('title' => $title,
                      'description' => $description, 
                      'short_description' => $short_description, 
                      'image' => $image, 
                      'thumb' => $thumb, 
                      'featured' => $featured, 
                      'date' => $date, 
                      'source' => $source, 
                      'github' => $github, 
                      'demo' => $demo );
        
        $this->db->where('id', $id);
        $this->db->update('projects', $data);
        
        $id = $this->db->insert_id();
        foreach( $images as $i )
        {
            $data = array($i, 'project image', $id, $i );
            
            $this->db->insert('images', $data);
        }
    }
    
    public function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('projects');
        
        $this->images->unsetImages($id);
        $this->tags->unsetTags($id);
    }
    
    /**
     * Get the Project with the given ID.
     * (SHOULD ALSO GET PROJECT TAGS)
     * 
     * @param int $id the ID of the Project to get
     * @return Project data
     */
    public function getById($id) {
        $this->db->select('*');
        $this->db->from('projects');
        $this->db->where('id', $id);

        $data = (array) $this->db->get()->row();
        $data = $this->compileArrayData(array($data));
        
        return $data;
    }
    
    /**
     * Get the Projects marked as "Featured"
     * (SHOULD ALSO GET PROJECT TAGS)
     * 
     * @return Project data
     */
    public function getFeatured() {
        $this->db->select('*');
        $this->db->from('projects');
        $this->db->where('featured', 't');
        
        $data = (array) $this->db->get()->result();
        $data = $this->compileArrayData($data);
        
        return $data;
    }
    
    /**
     * Get Projects on a certain page with the given number
     * of Projects per page.
     * (SHOULD ALSO GET PROJECT TAGS)
     * 
     * @param int $page the Page number (1-n) inclusive.
     * @param int $perPage the number of Projects to return per page.
     * @param string $filter a tag to filter
     * @param string $sort a parameter to sort by
     * @param string $sortOrder the order in which Projects are sorted
     * @return Project data
     */
    public function getPaginated($page, $perPage, $filter='', $sort='title', $sortOrder='asc') {
        // Set the filter if the filter has been set
        if ($filter != '')
        {
            $this->db->join('tags', 'projects.id=tags.project', 'left');
            $this->db->where('tags.tag', $filter);
            $this->db->group_by('projects.id');
        }
        
        // Build the Query
        $this->db->select('*');
        $this->db->from('projects');
        $this->db->order_by($sort, $sortOrder);
        $this->db->limit($perPage, ($page * $perPage) - $perPage);
        
        // Get the Data
        $data = (array) $this->db->get()->result();
        $data = $this->compileArrayData($data);
        
        return $data;
    }
    
    /**
     * Pack retreived tags and images into returned project data sets.
     * 
     * @param mixed $sqlResults sql results from requesting projects
     * @return mixed repacked project data with images and tags
     */
    private function compileArrayData($sqlResults) {
        $retval = array();
        
        foreach ($sqlResults as $result) {
            $result = (array) $result;
            $result['images'] = $this->images->getByProject($result['id']);
            $result['tags'] = $this->tags->getByProject($result['id']);
            $retval[] = $result;
        }
        
        return $retval;
    }
}