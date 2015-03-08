<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Welcome is the Controller that is executed by accessing "index". It has only one
 * view which shows the homepage.
 * 
 * @author Calvin Rempel
 */
class Welcome extends Application {

    /**
     * The number of blog posts to show in "Recent Posts"
     */
    private static $NUM_RECENT_POSTS = 5;
    
    /**
     * Controller for "Home" page. Loads "featured" posts
     * and recent blog posts.
     */
    public function index() {
        $this->data['scripts'][] = array( 'script' => '/assets/js/banner.js');
        
        $featured_projects = $this->projects->getFeatured();
        $this->data['first_featured_project'] = array();
        
        if (count($featured_projects) > 0)
            $this->data['first_featured_project'] = array(array_shift($featured_projects));
        
        $this->data['featured_projects'] = $featured_projects;
        $this->data['recent_posts'] = $this->posts->getPaginated(1, Welcome::$NUM_RECENT_POSTS);
        $this->data['pagebody'] = 'homepage';
        
        $this->render();
    }
}
