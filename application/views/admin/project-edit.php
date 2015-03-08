<form action="/admin/post" method="POST">
    <div>
        <label for="id">ID</label>
        <input type="text" name="id" id="id" class="form-control">
        
        <!-- Image upload stuff -->
       
        
        <label for="post">Description</label>
        <textarea name="post" class="editor">
            {post}
        </textarea>
    
        <input name="Save" class="btn btn-focus" type="submit" value="Save" />
    </div>
    
</form>
<form action="/admin/post/addimage"
      class="dropzone"
      id="psdropzone"></form>
