{project}
<div class="" id="project-main">
    <img class="fullsize" src={image} alt=""/>
    <h1>{title}</h1>
    <time>{date}</time>
    <p>
        {description}
    </p>
    <h4>Sample Source Code</h4>
    <div class="bootstrap-demo">
    <pre>{source}</pre>

    </div>
</div>
<div id="project-sidebar" class="well">
    <a class="btn btn-primary btn-lg  btn-block" href={demo}>Demo</a>
    <a class="btn btn-default btn-lg  btn-block" href={demo}>GitHub</a>
    <!--
        tags broken?
    -->
</div>
{/project}