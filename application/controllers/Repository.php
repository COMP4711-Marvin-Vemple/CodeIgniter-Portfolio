<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Welcome is the Controller that is executed by accessing "/repository". It allows the user to
 * view the GitHub repositories, and also view the recent commit history of a single repository.
 * 
 * @author Calvin Rempel
 */
class Repository extends Application {
    
    private static $GITHUB_CACHE_LENGTH_MINUTES = 1440;     // 24 hours
    
    /**
     * The Templates to use for displaying data.
     */
    private static $TEMPLATE_MULTIPLE   = 'repos_multi';
    private static $TEMPLATE_SINGLE     = 'repos_single';
    
    /**
     * Controller for default "/repository" page. Shows first page of repositories.
     */
    public function index() {
        $this->output->cache(Repository::$GITHUB_CACHE_LENGTH_MINUTES);
        $this->data['repos'] = $this->repositories->getRepositories('calvinrempel', 'owner');
        $this->data['pagebody'] = Repository::$TEMPLATE_MULTIPLE;
        $this->render();
    }
    
    /**
     * Display the recent commit history of the given repository.
     * 
     * @param int $id the ID of the repository to display.
     */
    public function commits($repo) {
        $this->output->cache(Repository::$GITHUB_CACHE_LENGTH_MINUTES);
        $this->data['repo'] = $repo;
        $this->data['commits'] = $this->repositories->getCommits('calvinrempel', $repo, 10);
        $this->data['pagebody'] = Repository::$TEMPLATE_SINGLE;
        $this->render();
    }
}
