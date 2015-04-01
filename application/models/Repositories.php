<?php

/**
 * This is a model for GitHub repos. It provides access
 * to a users repositories and their recent commits.
 * 
 * @author Calvin Rempel
 */
class Repositories extends CI_Model {
    
    /**
     * Construct the base CI_Model
     */
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Get the Repository Commits for the given repo
     * 
     * @param string $username the owner of the repo
     * @param string $repo the name of the repo
     * @param int $count the maximum number of commits to return
     * @return Repo data
     */
    public function getCommits($username, $repo, $count) {
        $this->load->library('GitHub/GitHubClient', '', 'github');
        $commits = (array) $this->github->repos->commits->listCommitsOnRepository($username,
                                                                                  $repo,
                                                                                  null,
                                                                                  null,
                                                                                  $username);
        
        $retval = array();
        $numAdded = 0;
        
        // Add up to $count of the most recent commits to the output array
        for ($i = 0; $i < count($commits) && $numAdded < $count; $i++) {
            $commit = $commits[$i];
            $data = array();
            
            // Get the Author name
            $data['author'] = 'Anonymous';
            if ($commit->getAuthor() != null) {
                $data['author'] = $commit->getAuthor()->getLogin();
            }
            
            $data['message'] = $commit->getCommit()->getMessage();
            $data['owner'] = $username;
            $data['repo'] = $repo;
            $data['sha'] = $commit->getSha();
            $retval[] = $data;
            
            $numAdded++;
        }
        
        return $retval;
    }
    
    /**
     * Get Repositories from user.
     * 
     * @param $username the username of the users whose repositories to retreive
     * @param $type the type of repos to get ('all', 'owner', 'member')
     * @return Repositories formatted in an array
     */
    public function getRepositories($username, $type) {
        $this->load->library('GitHub/GitHubClient', '', 'github');
        $repos = (array) $this->github->repos->listUserRepositories($username, $type, 'updated');
        
        $retval = array();
        foreach($repos as $repo) {
            $data = array();
            $data['id'] = $repo->getId();
            $data['title'] = $repo->getName();
            $data['description'] = $repo->getDescription();
            $data['url'] = $repo->getHtmlUrl();
            $retval[] = $data;
        }
        
        return $retval;
    }
}