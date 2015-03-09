<form action="/admin/post/addimage"
      class="dropzone"
      id="psdropzone"></form>

<form action="/admin/project/{action}" id="edit" method="POST">
    <div>
        <div id="imageview" class="row">
            
        </div>
        <label for="id">ID</label>
        <input type="text" name="id" id="id" class="form-control" value="{id}" disabled="true">
        
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
       <input type="url" class="form-control" value="{github}">
       
       <label for="demo">Demo</label>
       <input type="url" class="form-control" value="{demo}">
    
       <label for="tags">Tags</label>
       <input name="tags" class="form-control" value="{tags}">
        <input name="Save" class="btn btn-default" type="submit" value="Save" />
    </div>
    
    
    
</form>

