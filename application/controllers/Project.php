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
    private static $NUM_PROJECTS_PER_PAGE = 10;
    
    /**
     * Templates used for displaying data.
     */
    private static $TEMPLATE_GRIDVIEW           = 'projects_gridview';
    private static $TEMPLATE_LISTVIEW           = 'projects_listview';
    private static $TEMPLATE_GRIDVIEW_SECTION   = '_projects_gridview';
    private static $TEMPLATE_LISTVIEW_SECTION   = '_projects_listview';
    private static $TEMPLATE_SINGLE             = 'projects_single';
    
    /**
     * Filter Arrays for Sorting
     */
    private static $SORT_PARAMS = array('title', 'date');
    private static $SORT_ORDER_PARAMS = array('asc', 'desc');
    
    /**
     * Controller for default "/project" page. Shows the first page of projects in a grid view.
     */
    public function index() {
        $this->gridview(1);
    }
    
    /**
     * Display the selected page of Projects in a Grid View.
     * 
     * @param int $page the page number of Projects to retrieve (1-n)
     * @param string $sort a Project attribute to sort by
     * @param string $sortOrder the order to sort by
     * @param string $filter a tag to filter Projects by
     */
    public function gridview($page, $sort='title', $sortOrder='asc', $filter='') {
        $this->data['page'] = $page;
        $this->data['sort'] = $sort;
        $this->data['sortOrder'] = $sortOrder;
        $this->data['filter'] = $filter;
        $this->data['viewmode'] = 'gridview';
        
        $this->loadGridView($page, $filter, $sort, $sortOrder);
        $this->constructTagFilterList($filter);
        $this->constructSortFilters();
        $this->data['toolbar'] = $this->parser->parse('projects_toolbar', $this->data, true);
        $this->data['pagebody'] = Project::$TEMPLATE_GRIDVIEW;
        
        $pageData = array ('container'  => '#projects',
                           'controller' => '/Project/gridview_ajax',
                           'page'       => $page,
                           'sortVar'    => $sort,
                           'sortOrder'  => $sortOrder,
                           'filter'     => $filter,
                           'button'     => '#loadProjects');
        
        $this->data['scripts'][] = array('script'=>'/assets/js/pagination.js');
        $this->data['components'][] = array('component' => $this->parser->parse('components/ajax-paginator', $pageData, true));
        $this->render();
    }
    
    /**
     * Display the selected page of Projects in a List View.
     * 
     * @param int $page the page number of Projects to retrieve (1-n)
     * @param string $sort a Project attribute to sort by
     * @param string $sortOrder the order to sort by
     * @param string $filter a tag to filter Projects by
     */
    public function listview($page, $sort='title', $sortOrder='asc', $filter='') {
        $this->data['page'] = $page;
        $this->data['sort'] = $sort;
        $this->data['sortOrder'] = $sortOrder;
        $this->data['filter'] = $filter;
        $this->data['viewmode'] = 'listview';
        
        $this->loadListView($page, $filter, $sort, $sortOrder);
        $this->constructTagFilterList($filter);
        $this->constructSortFilters();
        $this->data['toolbar'] = $this->parser->parse('projects_toolbar', $this->data, true);
        $this->data['pagebody'] = Project::$TEMPLATE_LISTVIEW;
        
        $pageData = array ('container'  => '#projects',
                           'controller' => '/Project/listview_ajax',
                           'page'       => $page,
                           'sortVar'    => $sort,
                           'sortOrder'  => $sortOrder,
                           'filter'     => $filter,
                           'button'     => '#loadProjects');
        $this->data['scripts'][] = array('script'=>'/assets/js/pagination.js');
        $this->data['components'][] = array('component' => $this->parser->parse('components/ajax-paginator', $pageData, true));
        $this->render();
    }
    
    /**
     * Display the details of a single project.
     * 
     * @param int $id the ID of the Project to display.
     */
    public function id($id) {
        $this->data['project'] = $this->projects->getById($id);
        $this->hideEmptyFields();
        $this->data['pagebody'] = Project::$TEMPLATE_SINGLE;
        
        $this->data['styles'][] = array('style' => '/assets/css/lightbox.css');
        $this->data['scripts'][] = array('script' => '/assets/js/lightbox.min.js');
        
        $this->render();
    }
    
    /**
     * Output the formatted HTML for additional paginated projects in an existing
     * Grid View layout.
     * 
     * @param int $page the page number of Projects to retrieve (1-n)
     * @param string $sort a Project attribute to sort by
     * @param string $sortOrder the order to sort by
     * @param string $filter a tag to filter Projects by
     */
    public function gridview_ajax($page, $sort='title', $sortOrder='asc', $filter='') {
        $this->loadGridView($page, $filter, $sort, $sortOrder, false);
    }
    
    /**
     * Output the formatted HTML for additional paginated projects in an existing
     * List View layout.
     * 
     * @param int $page the page number of Projects to retrieve (1-n)
     * @param string $sort a Project attribute to sort by
     * @param string $sortOrder the order to sort by
     * @param string $filter a tag to filter Projects by
     */
    public function listview_ajax($page, $sort='title', $sortOrder='asc', $filter='') {
        $this->loadListView($page, $filter, $sort, $sortOrder, false);
    }
    
    /**
     * Load paginated Projects as HTML that can be placed in the 'projects_listview' template
     * into data['projects'].
     * 
     * @param int $page the page number of Projects to retrieve (1-n)
     * @param string $filter a tag to filter Projects by
     * @param string $sort a Project attribute to sort by
     * @param string $sortOrder the order to sort by
     * @param bool   $buffer if true, output is buffered in data['projects']. If false, data is
     *                       written to the browser.
     */
    private function loadListView($page, $filter='', $sort='title', $sortOrder='asc', $buffer=true) {
        $template = Project::$TEMPLATE_LISTVIEW_SECTION;
        $this->data['projects'] = $this->projects->getPaginated($page,
                                                                Project::$NUM_PROJECTS_PER_PAGE,
                                                                $filter,
                                                                $sort,
                                                                $sortOrder);
        $this->data['projects'] = $this->parser->parse($template, $this->data, $buffer);
    }
    
    /**
     * Load paginated Projects as HTML that can be placed in the 'projects_gridview' template
     * into data['projects'].
     * 
     * @param int $page the page number of Projects to retrieve (1-n)
     * @param string $filter a tag to filter Projects by
     * @param string $sort a Project attribute to sort by
     * @param string $sortOrder the order to sort by
     * @param bool   $buffer if true, output is buffered in data['projects']. If false, data is
     *                       written to the browser.
     */
    private function loadGridView($page, $filter='', $sort='title', $sortOrder='asc', $buffer=true) {
        $template = Project::$TEMPLATE_GRIDVIEW_SECTION;
        $this->data['projects'] = $this->projects->getPaginated($page,
                                                                Project::$NUM_PROJECTS_PER_PAGE,
                                                                $filter,
                                                                $sort,
                                                                $sortOrder);
        $this->data['projects'] = $this->parser->parse($template, $this->data, $buffer);
    }
    
    /**
     * Create empty containers for blank data
     * 
     * @param mixed $projectData the project data
     */
    private function hideEmptyFields() {
        // Add Source Container
        $this->data['project'][0]['source_container'] = [];
        if ($this->data['project'][0]['source'] != '')
            $this->data['project'][0]['source_container'][] = array('source' => $this->data['project'][0]['source']);
        
        // Add demo Container
        $this->data['project'][0]['demo_container'] = [];
        if ($this->data['project'][0]['demo'] != '')
            $this->data['project'][0]['demo_container'][] = array('demo' => $this->data['project'][0]['demo']);
        
        // Add Github Container
        $this->data['project'][0]['github_container'] = [];
        if ($this->data['project'][0]['github'] != '')
            $this->data['project'][0]['github_container'][] = array('github' => $this->data['project'][0]['github']);
    }
    
    /**
     * Populate $this->data['tags'] with all tags with the active tag first in the list.
     * 
     * @param string $activeFilter the active filter ('' if no active filter).
     */
    private function constructTagFilterList($activeFilter='') {
        $tags = $this->tags->getAll();
        $retval = array();
        
        // Set the active tag to the active filter or "All"
        if ($activeFilter != '') {
            $this->data['activeTag'] = $activeFilter;
            
            $tagData = array();
            $tagData['tag'] = 'All';
            $tagData['page'] = $this->data['page'];
            $tagData['sort'] = $this->data['sort'];
            $tagData['sortOrder'] = $this->data['sortOrder'];
            $tagData['filter'] = '';
            $tagData['viewmode'] = $this->data['viewmode'];

            $retval[] = $tagData;
        }
        else {
            $this->data['activeTag'] = 'All';
        }
        
        // Add all tags to the list (except the active filter)
        foreach ($tags as $tag) {
            if ($tag->tag != $activeFilter) {
                $tagData = array();
                $tagData['tag'] = $tag->tag;
                $tagData['page'] = $this->data['page'];
                $tagData['sort'] = $this->data['sort'];
                $tagData['sortOrder'] = $this->data['sortOrder'];
                $tagData['filter'] = $tag->tag;
                $tagData['viewmode'] = $this->data['viewmode'];
                
                $retval[] = $tagData;
            }
        }
        
        $this->data['tags'] = $retval;
    }
    
    /**
     * Build sort parameter list for sortable parameters.
     * Store arrays in $this->data['projects']['sortList'] and $this->data['projects']['sortOrderList']
     */
    private function constructSortFilters() {
        $this->data['sortList'] = array();
        $this->data['sortOrderList'] = array();
        
        // Build sort filter
        foreach(Project::$SORT_PARAMS as $param) {
            if ($param != $this->data['sort']) {
                $data = array();
                $data['value'] = $param;
                $data['sortOrder'] = $this->data['sortOrder'];
                $data['filter'] = $this->data['filter'];
                $data['viewmode'] = $this->data['viewmode'];
                
                $this->data['sortList'][] = $data;
            }
        }
        
        // Build sort order filter
        foreach(Project::$SORT_ORDER_PARAMS as $param) {
            if ($param != $this->data['sortOrder']) {
                $data = array();
                $data['value'] = $param;
                $data['sort'] = $this->data['sort'];
                $data['filter'] = $this->data['filter'];
                $data['viewmode'] = $this->data['viewmode'];
                
                $this->data['sortOrderList'][] = $data;
            }
        }
    }
}
