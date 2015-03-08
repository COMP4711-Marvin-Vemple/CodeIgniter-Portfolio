<div class="btn-toolbar">
    
    <!-- VIEW SELECTION -->
    <div class="btn-group project-toolbar" role="group">
        <a type="button" class="btn btn-default mode-select active"><span class="glyphicon glyphicon-th"></span></a>
        <a type="button" class="btn btn-default mode-select" href="/project/listview/{page}/{sort}/{sortOrder}/{filter}"><span class="glyphicon glyphicon-th-list"></span></a>
    </div>

    {toolbar}
</div>

<div id="projects" class="row">
    {projects}
</div>

<div class="row">
    <div class="col-md-12 text-center"> 
        <button id="loadProjects" name="loadProjects" class="btn btn-primary" onClick="">Load More Projects</button> 
    </div>
</div>