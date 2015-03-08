<form action="/admin/post/addimage"
      class="dropzone"
      id="psdropzone"></form>

<form action="/admin/post" method="POST">
    <div>
        <label for="id">ID</label>
        <input type="text" name="id" id="id" class="form-control">
        
        <!-- Image upload stuff -->
        <label for="id">Title</label>
        <input type="text" name="id" id="id" class="form-control">
        
         <label for="id">Short Description</label>
        <textarea name="short-description" class="form-control">
            {source}
        </textarea>
        
        <label for="id">ID</label>
        <input type="text" name="id" id="id" class="form-control">
        
        
        
        <label for="post">Description</label>
        <textarea name="description" class="editor">
            {description}
        </textarea>
        
       <label for="source">Source</label>
        <textarea name="source" class="form-control">
            {source}
        </textarea>
       
       <label for="github">GitHub</label>
       <input type="url" class="form-control">
       
       <label for="demo">Demo</label>
       <input type="url" class="form-control">
    
        <input name="Save" class="btn btn-focus" type="submit" value="Save" />
    </div>
    
    
    
</form>

