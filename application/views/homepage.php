<!--
Cool banner thing goes here
-->

<div id="welcome-flair">
    <div id="lhs">Software</div>
    <div id="rhs"> Developer</div>
</div>

<!--
Gallery Goes here
-->
<div id="gallery" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#gallery" data-slide-to="0"></li>
    <li data-target="#gallery" data-slide-to="1"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    
    {featured_projects}
    <div class="itemx">
    <img src="..." alt="...">
        <div class="carousel-caption">
            <h3>{title}</h3>
            <p>...</p>
        </div>
    </div>
    {/featured_projects}
  </div>
  
    

  <!-- Controls -->
  <a class="left carousel-control" href="#gallery" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="false"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#gallery" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="false"></span>
    <span class="sr-only">Next</span>
  </a>
</div>


<!--
Blog posts go here 
-->
<div id="blog-preview" class="well">
    {recent_posts}
    <div class="media">
        <div class="media-left media-middle">
            <a href="/post/id/{id}">
                <img class="media-object" src={thumbnail} alt="no image">
            </a>
        </div>
        <div class="media-body">
            <h4 class="media-heading"><a href="/post/id/{id}">{title}</a></h4>
            {description}
        </div>
    </div>
    <hr>
    {/recent_posts}
    <div>
        
        
        
    </div>
</div>