<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Welcome is the Controller that is executed by accessing "/repository". It allows the user to
 * view the GitHub repositories, and also view the recent commit history of a single repository.
 * 
 * @author Calvin Rempel
 */
class Repository extends Application {
    
    private static $GITHUB_CACHE_LENGTH_MINUTES = 0;        // DISABLE CACHING DURING DEVELOPMENT
    private static $DEFAULT_NUM_COMMITS_TO_SHOW = 15;
    private static $DEFAULT_USERNAME            = 'calvinrempel';
    
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
        
        // Get Username from Settings (or set to default if not set)
        $username = $this->settings->getValue('github_username');
        if ($username == '')
            $username = Repository::$DEFAULT_USERNAME;
        
        // Get repo type from settings (or use 'all' if not set)
        $repoType = $this->settings->getValue('github_repo_type');
        if ($repoType == '')
            $repoType = 'all';
        
        // Get the users repositories
        $this->data['repos'] = $this->repositories->getRepositories($username,
                                                                    $repoType);
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
        
        // Get Username from Settings (or set to default if not set)
        $username = $this->settings->getValue('github_username');
        if ($username == '')
            $username = Repository::$DEFAULT_USERNAME;
        
        // Get Number of Commits to show from Settings (or use default if not set)
        $numCommits = intval($this->settings->getValue('github_num_commits'));
        if ($numCommits == '')
            $numCommits = Repository::$DEFAULT_NUM_COMMITS_TO_SHOW;
        
        // Get the Commits from the Repo
        $this->data['repo'] = $repo;
        $this->data['commits'] = $this->repositories->getCommits($username, $repo, $numCommits);
        $this->data['pagebody'] = Repository::$TEMPLATE_SINGLE;
        $this->render();
    }
}
