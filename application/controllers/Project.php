<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * index is the Controller that is executed by accessing "/project". It allows the user to
 * view paginated projects in either a list or grid view. It also allows a single project to
 * be loaded by accessing it with it's ID.
 * 
 * It will also be able to filter the projects based on tags and sort them by title or date.
 * 
 * @author Calvin Rempel
 */
class Project extends Application {

    /**
     * The number of Projects to show on a Page.
     */
    private static $NUM_PROJECTS_PER_PAGE = 6;
    
    /**
     * Templates used for displaying data.
     */
    private static $TEMPLATE_GRIDVIEW           = 'projects_gridview';
    private static $TEMPLATE_LISTVIEW           = 'projects_listview';
    private static $TEMPLATE_GRIDVIEW_SECTION   = '_projects_gridview';
    private static $TEMPLATE_LISTVIEW_SECTION   = '_projects_listview';
    private static $TEMPLATE_SINGLE             = 'projects_single';
    
    /**
     * Controller for default "/project" page. Shows the first page of projects in a grid view.
     */
    public function index() {
        $this->loadGridView(1, Project::$NUM_PROJECTS_PER_PAGE);
        $this->data['pagebody'] = Project::$TEMPLATE_GRIDVIEW;
        $this->render();
    }
    
    /**
     * Display the selected page of Projects in a Grid View.
     * 
     * @param int $page the page number of Projects to retrieve (1-n)
     * @param string $filter a tag to filter Projects by        (CURRENTLY IGNORED)
     * @param string $sort a Project attribute to sort by       (CURRENTLY IGNORED)
     * @param string $sortOrder the order to sort by            (CURRENTLY IGNORED)
     */
    public function gridview($page, $filter='', $sort='title', $sortOrder='asc') {
        $this->loadGridView($page, Project::$NUM_PROJECTS_PER_PAGE, $filter, $sort, $sortOrder);
        $this->data['pagebody'] = Project::$TEMPLATE_GRIDVIEW;
        $this->render();
    }
    
    /**
     * Display the selected page of Projects in a List View.
     * 
     * @param int $page the page number of Projects to retrieve (1-n)
     * @param string $filter a tag to filter Projects by        (CURRENTLY IGNORED)
     * @param string $sort a Project attribute to sort by       (CURRENTLY IGNORED)
     * @param string $sortOrder the order to sort by            (CURRENTLY IGNORED)
     */
    public function listview($page, $filter='', $sort='title', $sortOrder='asc') {
        $this->loadListView($page, Project::$NUM_PROJECTS_PER_PAGE, $filter, $sort, $sortOrder);
        $this->data['pagebody'] = Project::$TEMPLATE_LISTVIEW;
        $this->render();
    }
    
    /**
     * Display the details of a single project.
     * 
     * @param int $id the ID of the Project to display.
     */
    public function id($id) {
        $this->data['project'] = $this->projects->getById($id);
        $this->data['pagebody'] = Project::$TEMPLATE_SINGLE;
        $this->render();
    }
    
    /**
     * Output the formatted HTML for additional paginated projects in an existing
     * Grid View layout.
     * 
     * @param int $page the page number of Projects to retrieve (1-n)
     * @param string $filter a tag to filter Projects by        (CURRENTLY IGNORED)
     * @param string $sort a Project attribute to sort by       (CURRENTLY IGNORED)
     * @param string $sortOrder the order to sort by            (CURRENTLY IGNORED)
     */
    public function gridview_ajax($page, $filter='', $sort='title', $sortOrder='asc') {
        $this->loadGridView($page, Project::$NUM_PROJECTS_PER_PAGE, $filter, $sort, $sortOrder, false);
    }
    
    /**
     * Output the formatted HTML for additional paginated projects in an existing
     * List View layout.
     * 
     * @param int $page the page number of Projects to retrieve (1-n)
     * @param string $filter a tag to filter Projects by        (CURRENTLY IGNORED)
     * @param string $sort a Project attribute to sort by       (CURRENTLY IGNORED)
     * @param string $sortOrder the order to sort by            (CURRENTLY IGNORED)
     */
    public function listview_ajax($page, $filter='', $sort='title', $sortOrder='asc') {
        $this->loadListView($page, Project::$NUM_PROJECTS_PER_PAGE, $filter, $sort, $sortOrder, false);
    }
    
    /**
     * Load paginated Projects as HTML that can be placed in the 'projects_listview' template
     * into data['projects'].
     * 
     * @param int $page the page number of Projects to retrieve (1-n)
     * @param string $filter a tag to filter Projects by        (CURRENTLY IGNORED)
     * @param string $sort a Project attribute to sort by       (CURRENTLY IGNORED)
     * @param string $sortOrder the order to sort by            (CURRENTLY IGNORED)
     * @param bool   $buffer if true, output is buffered in data['projects']. If false, data is
     *                       written to the browser.
     */
    private function loadListView($page, $filter='', $sort='title', $sortOrder='asc', $buffer=true) {
        $template = Project::$TEMPLATE_LISTVIEW_SECTION;
        $this->data['projects'] = $this->projects->getPaginated($page, Project::$NUM_PROJECTS_PER_PAGE);
        $this->data['projects'] = $this->parser->parse($template, $this->data, $buffer);
    }
    
    /**
     * Load paginated Projects as HTML that can be placed in the 'projects_gridview' template
     * into data['projects'].
     * 
     * @param int $page the page number of Projects to retrieve (1-n)
     * @param string $filter a tag to filter Projects by        (CURRENTLY IGNORED)
     * @param string $sort a Project attribute to sort by       (CURRENTLY IGNORED)
     * @param string $sortOrder the order to sort by            (CURRENTLY IGNORED)
     * @param bool   $buffer if true, output is buffered in data['projects']. If false, data is
     *                       written to the browser.
     */
    private function loadGridView($page, $filter='', $sort='title', $sortOrder='asc', $buffer=true) {
        $template = Project::$TEMPLATE_GRIDVIEW_SECTION;
        $this->data['projects'] = $this->projects->getPaginated($page, Project::$NUM_PROJECTS_PER_PAGE);
        $this->data['projects'] = $this->parser->parse($template, $this->data, $buffer);
    }
}
