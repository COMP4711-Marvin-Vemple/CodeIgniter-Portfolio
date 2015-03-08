<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin/GitHub is the Controller that is executed by accessing "/Admin/GitHub".
 * 
 * @author Calvin Rempel
 */
class GitHub extends Application {

    /**
     * Controller for "Admin/GitHub" page.
     */
    public function index() {
        $this->data['username'] = $this->settings->getValue('github_username');
        $this->data['repoType'] = $this->settings->getValue('github_repo_type');
        if ($this->data['repoType'] == '')
            $this->data['repoType'] = 'all';
        $this->data['numCommits'] = $this->settings->getValue('github_num_commits');
        
        $this->data['success'] = array();
        $this->data['errors'] = array();
        
        $this->saveData();
        $this->presentForm();
        
        $this->data['mode'] = 'admin';
        $this->data['pagebody'] = 'admin/github';
        $this->render();
    }
    
    /**
     * Save Data input from user
     */
    private function saveData() {
        // Check if the form was submitted
        if ($this->input->post('username', true) != false)
        {
            $this->data['username'] = $this->input->post('username', true);
            $this->data['repoType'] = $this->input->post('repo-type', true);
            $this->data['numCommits'] = $this->input->post('num-commits', true);
            
            // Error Check
            if (intval($this->input->post('num-commits')) <= 0)
            {
                $this->data['errors'][] = array('message' => 'Number of commits must be greater than 0.');
                return;
            }
            
            $this->settings->setValue('github_num_commits', $this->data['numCommits']);
            $this->settings->setValue('github_repo_type', $this->data['repoType']);
            $this->settings->setValue('github_username', $this->data['username']);
            $this->data['success'][] = array('message' => "Settings Updated!");
        }
    }
    
    private function presentForm() {
        $this->load->helper('formfields');
        
        $typeOptions = array(
            'all'       => 'All',
            'owner'     => 'Owner',
            'member'    => 'Member'
        );
        
        $this->data['f_username'] = makeTextField('Username', 'username', $this->data['username']);
        $this->data['f_repoType'] = makeComboField('Repo Type', 'repo-type', $this->data['repoType'], $typeOptions);
        $this->data['f_numCommits'] = makeTextField('Number of Commits', 'num-commits', $this->data['numCommits']);
        $this->data['f_submit'] = makeSubmitButton('Save Settings', 'Click to Save Settings', 'btn-success');
    }
}
