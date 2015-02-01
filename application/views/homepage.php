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
<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <!--ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol-->

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    {first_featured_project}
      <div class="item active">
      <a href="/project/id/{id}"><img src={image} alt="...">
        <div class="carousel-caption">
            <h3>{title}</h3>
            <p>{description}</p>
        </div></a>
      </div>
    {/first_featured_project}
    {featured_projects}
      <div class="item">
        <a href="/project/id/{id}"><img src={image} alt="...">
        <div class="carousel-caption">
            <h3>{title}</h3>
            <p>{description}</p>
        </div></a>
      </div>
    {/featured_projects}
    
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
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
                <img class="media-object recent-blog-thumb" src={thumbnail} alt="no image">
            </a>
        </div>
        <div class="media-body">
            <h4 class="media-heading"><a href="/post/id/{id}">{title}</a></h4>
            {description}
        </div>
    </div>
    <hr>
    {/recent_posts}
</div>