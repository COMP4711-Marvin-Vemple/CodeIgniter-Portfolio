<div class="btn-toolbar">

    <!-- VIEW MODE SELECTION -->
    <div class="btn-group project-toolbar" role="group" aria-label="...">
        <a href="/project/gridview/{page}/{sort}/{sortOrder}/{filter}" type="button" class="btn btn-default mode-select"><span class="glyphicon glyphicon-th"></span></a>
        <a type="button" class="btn btn-default active mode-select"><span class="glyphicon glyphicon-th-list"></span></a>
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