{project}
<div class="" id="project-main">
    <img class="fullsize" src={image} alt=""/>
    <h1>{title}</h1>
    <time>{date}</time>
    <p>
        {description}
    </p>
    {source_container}
    <h4>Sample Source Code</h4>
    <div class="bootstrap-demo">
        <pre>{source}</pre>
    </div>
    {/source_container}
</div>
<div id="project-sidebar" class="well">
    <h3>Overview</h3>
    {short_description}
    {demo_container}<a class="btn btn-primary btn-lg  btn-block" href={demo}>Demo</a>{/demo_container}
    {github_container}<a class="btn btn-default btn-lg  btn-block" href={demo}>GitHub</a>{/github_container}
    <h3>Tags</h3>
    <ul>
    {tags}
        <li>{tag}</li>
    {/tags}
    </ul>
</div>
{/project}