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
    private static $REPOS_PER_PAGE = 5;
    
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
        $this->generatePaginationInterface(1);
        $this->data['pagebody'] = Repository::$TEMPLATE_MULTIPLE;
        $this->render();
    }
    
    /**
     * Display a page of Repositories.
     * 
     * @param int $page the page number to display (1-n).
     */
    public function page($page) {
        $this->data['repos'] = $this->repositories->getPaginated($page, Repository::$REPOS_PER_PAGE);
        $this->generatePaginationInterface($page);
        $this->data['pagebody'] = Repository::$TEMPLATE_MULTIPLE;
        $this->render();
    }
    
    /**
     * Display the recent commit history of the given repository.
     * 
     * @param int $id the ID of the repository to display.
     */
    public function id($id) {
        $this->data['repo'] = $this->repositories->getById($id);
        $this->data['pagebody'] = Repository::$TEMPLATE_SINGLE;
        $this->render();
    }
    
    /**
     * Generate a Pagination HTML element.
     * 
     * Pagination Buttons are templated with _pagination_button
     * with the variables: "link" and "text". The Pagination element is templated with the variables
     * "prev" and "next which are the templated buttons, and "currentPage" and "pageCount" which
     * are integers.
     * 
     * If the "prev" or "next" buttons are not required, they are set to empty strings.
     * 
     * @param int $pageNumber the current page.
     */
    private function generatePaginationInterface($pageNumber) {
        $pageCount = $this->repositories->getPageCount(Repository::$REPOS_PER_PAGE);
        $paginationData = array();
        $paginationData['prev'] = '';
        $paginationData['next'] = '';
        $pagination['currentPage'] = $pageNumber;
        $pagination['pageCount'] = $pageCount;

        // Create "Prev" page link
        if ($pageNumber > 1) {
            $btnData = array('link' => '/repository/page/' . ($pageNumber - 1), 'text' => 'Previous');
            $paginationData['prev'] = $this->parser->parse('_pagination_button', $btnData, true);
        }
        
        // Create "Next" page link
        if ($pageNumber < $pageCount) {
            $btnData = array('link' => '/repository/page/' . ($pageNumber + 1), 'text' => 'Next');
            $paginationData['next'] = $this->parser->parse('_pagination_button', $btnData, true);
        }
        
        // Generate Pagination Data
        $this->data['pagination'] = $this->parser->parse('_pagination', $paginationData, true);
    }
}
