<form action="/admin/post/addimage"
      class="dropzone"
      id="psdropzone"></form>

<form action="/admin/project/{action}" id="edit" method="POST">
    <div>
        <!-- Show Existing Images -->
        <div id="image-gallery" class="clearfix">
            {saved_images}
            <img src="/uploads/{image}" alt="{image}" />
            {/saved_images}
        </div>
        
        <!-- Show Already Uploaded Images -->
        <div id="image-gallery" class="clearfix">
            {images}
            <img src="/uploads/{image}" alt="{image}" />
            <input type="hidden" name="image[]" value="{image}" />
            {/images}
        </div>
        
        <input type="hidden" name="id" class="form-control" value="{id}">
        
        <!-- Image upload stuff -->
        <label for="title">Title</label>
        <input type="text" name="title" id="title" class="form-control" value="{title}">
        
         <label for="short_description">Short Description</label>
        <textarea name="short_description" class="form-control">{short_description}</textarea>
        
        <label for="post">Description</label>
        <textarea name="description" class="editor">{description}</textarea>
        
       <label for="source">Source</label>
        <textarea name="source" class="form-control">{source}</textarea>
       
       <label for="github">GitHub</label>
       <input type="url" name="github" class="form-control" value="{github}">
       
       <label for="demo">Demo</label>
       <input type="url" name="demo" class="form-control" value="{demo}">
    
       <label for="tags">Tags (comma delimited)</label>
       <input name="tags" class="form-control" value="{tags}">
        <input name="Save" class="btn btn-default" type="submit" value="Save" />
    </div>
</form>

