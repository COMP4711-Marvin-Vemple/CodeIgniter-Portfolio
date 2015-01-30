<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Welcome is the Controller that is executed by accessing "/repository". It allows the user to
 * view the GitHub repositories, and also view the recent commit history of a single repository.
 * 
 * @author Calvin Rempel
 */
class Repository extends Application {

    /**
     * The number of Repositories to show on a Page.
     */
    private static $REPOS_PER_PAGE = 15;
    
    /**
     * The Templates to use for displaying data.
     */
    private static $TEMPLATE_MULTIPLE   = 'repos_multi';
    private static $TEMPLATE_SINGLE     = 'repos_single';
    
    /**
     * Controller for default "/repository" page. Shows first page of repositories.
     */
    public function index() {
        $this->data['repos'] = $this->repositories->getPaginated(1, Repository::$REPOS_PER_PAGE);
        $this->data['pagebody'] = Project::TEMPLATE_MULTIPLE;
        $this->render();
    }
    
    /**
     * Display a page of Repositories.
     * 
     * @param int $page the page number to display (1-n).
     */
    public function page($page) {
        $this->data['repos'] = $this->repositories->getPaginated($page, Repository::$REPOS_PER_PAGE);
        $this->data['pagebody'] = Project::TEMPLATE_MULTIPLE;
        $this->render();
    }
    
    /**
     * Display the recent commit history of the given repository.
     * 
     * @param int $id the ID of the repository to display.
     */
    public function id($id) {
        $this->data['repo'] = $this->repositories->getById($id);
        $this->data['pagebody'] = Project::TEMPLATE_SINGLE;
        $this->render();
    }
}