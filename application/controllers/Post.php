<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Welcome is the Controller that is executed by accessing "/post". It allows the user to
 * view paginated blog posts and also full individual blog posts.
 * 
 * @author Calvin Rempel
 */
class Post extends Application {

    /**
     * The number of Posts to show on a Page.
     */
    private static $POSTS_PER_PAGE = 15;
    
    /**
     * The Templates to use for displaying data.
     */
    private static $TEMPLATE_MULTIPLE   = 'posts_multi';
    private static $TEMPLATE_SINGLE     = 'posts_single';
    
    /**
     * Controller for default "/post" page. Shows first page of posts.
     */
    public function index() {
        $this->data['posts'] = $this->posts->getPaginated(1, Post::$POSTS_PER_PAGE);
        $this->generatePaginationInterface();
        $this->data['pagebody'] = Post::$TEMPLATE_MULTIPLE;
        $this->render();
    }
    
    /**
     * Display a page of Posts.
     * 
     * @param int $page the page number to display (1-n).
     */
    public function page($page) {
        $this->data['posts'] = $this->posts->getPaginated($page, Post::$POSTS_PER_PAGE);
        $this->generatePaginationInterface();
        $this->data['pagebody'] = Post::$TEMPLATE_MULTIPLE;
        $this->render();
    }
    
    /**
     * Display a full single post.
     * 
     * @param int $id the ID of the post to display.
     */
    public function id($id) {
        $this->data['post'] = $this->posts->getById($id);
        $this->data['pagebody'] = Post::$TEMPLATE_SINGLE;
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
        $pageCount = $this->posts->getPageCount(Post::$POSTS_PER_PAGE);
        $paginationData = array();
        $paginationData['prev'] = '';
        $paginationData['next'] = '';
        $pagination['currentPage'] = $pageNumber;
        $pagination['pageCount'] = $pageCount;
        
        // Create "Prev" page link
        if ($pageNumber > 1) {
            $btnData = array('link' => '/post/page/' . $pageNumber - 1, 'text' => 'Previous');
            $paginationData['prev'] = $this->parser->parse('_pagination_button', $btnData, true);
        }
        
        // Create "Next" page link
        if ($pageNumber < $pageCount) {
            $btnData = array('link' => '/post/page/' . $pageNumber + 1, 'text' => 'Next');
            $paginationData['next'] = $this->parser->parse('_pagination_button', $btnData, true);
        }
        
        // Generate Pagination Data
        $this->data['pagination'] = $this->parser->parse('_pagination', $paginationData, true);
    }
}
