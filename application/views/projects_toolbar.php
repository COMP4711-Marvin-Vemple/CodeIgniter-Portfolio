<!-- TAG SELECTION -->
    <div class="btn-group project-toolbar" role="group">
        <div class="btn-group">
            <button type="button" name="filter" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                {activeTag} <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
                {tags}
                    <li><a href="/project/{viewmode}/{page}/{sort}/{sortOrder}/{filter}" title="{tag}">{tag}</a></li>
                {/tags}
            </ul>
        </div>
    </div>

    <!-- SORT SELECTION -->
    <div class="btn-group project-toolbar" role="group">
        
        <!-- SORT PARAMETERS -->
        <div class="btn-group">
            <button type="button" name="filter" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                {sort} <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
                {sortList}
                    <li><a href="/project/{viewmode}/1/{value}/{sortOrder}/{filter}" title="{value}">{value}</a></li>
                {/sortList}
            </ul>
        </div>
        
        <!-- SORT ORDER -->
        <div class="btn-group ">
            <button type="button" name="sort" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                {sortOrder} <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
                {sortOrderList}
                    <li><a href="/project/{viewmode}/1/{sort}/{value}/{filter}" title="{value}">{value}</a></li>
                {/sortOrderList}
            </ul>
        </div>
    </div>