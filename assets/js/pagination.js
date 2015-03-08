var paginationContainer;
var paginationController;
var paginationPage;
var paginationFilter;
var paginationSortVar;
var paginationSortOrder;
var paginationLoadButton;
var noDataReceived;
var waitingForData;

/**
 * Initialize the Ajax Pagination
 * 
 * @param container String the element selector that will have the new data appended
 * @param controller String the url of controller to request data from
 * @param currentPage int the starting page
 * @param filter String a tag being filtered on
 * @param sortVar the variable being sorted by
 * @param sortOrder the order in which Projects are sorted
 * @param loadButton the selector of the button used to load more (in the event scrolling fails)
 */
function initPagination(container, controller, currentPage, filter, sortVar, sortOrder, loadButton) {
    paginationContainer = container;
    paginationController = controller;
    paginationPage = currentPage;
    paginationFilter = filter;
    paginationSortVar = sortVar;
    paginationSortOrder = sortOrder;
    paginationLoadButton = loadButton;
    
    noDataReceived = false;
    waitingForData = false;
    
    $(paginationLoadButton).click(makePaginationRequest);
}

/**
 * This triggers a pagination event when the user is near the bottom of the page.
 * 
 * @author Marc Vouve
 * 
 */
$(window).scroll(function() {
    if($(window).scrollTop() + $(window).height() > $(document).height() - 200) {
        makePaginationRequest();
    }
});

/**
 * Request the next page of projects from the server
 */
function makePaginationRequest() {
    // Do not request multiple pages at once. Do not request pages after no data is returned.
    if (!waitingForData && !noDataReceived) {
        waitingForData = true;

        var url = paginationController;
        url += "/" + ++paginationPage;
        url += "/" + paginationSortVar;
        url += "/" + paginationSortOrder;
        url += "/" + paginationFilter;

        // Request the next page
        $.get( url, function( data ) {
            data = data.trim();
            waitingForData = false;

            // If there are no results, disable future requests
            if (data.length === 0) {
                noDataReceived = true;
                $(paginationLoadButton).hide();
            }
            // If there are results, add them to the page
            else {
                $( paginationContainer ).append( data );
            }
        });
    }
}