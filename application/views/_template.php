<!DOCTYPE html>
<html lang="en">
    <head>
        <Title>{site_title}</Title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="/assets/css/custom.css">
        {styles}
            <link rel="stylesheet" href="{style}"/>
        {/styles}
    </head>
    <body>
        <div id="header" class="container-fluid">
            <img src="{logo}" alt="" class="img-circle" id="my-picture">
            <h1>{site_title}</h1>
            
        </div>
        {menubar}
        <div class="container">
        {content}
        </div>
        <footer class="container-fluid">
            {name} {year} {email}
            <a href="/Admin" title="Admin Panel">Admin Panel</a>
        </footer>
        <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<<<<<<< HEAD
        <script src="/assets/js/banner.js"></script>
        <script src="/assets/js/pagination.js"></script>
=======
        {scripts}
            <script src="{script}"></script>
        {/scripts}
        {components}
            {component}
        {/components}
>>>>>>> 72d6ef72bfa9b7556ba28fe5ff78ea0d1e24c792
    </body>
</html>