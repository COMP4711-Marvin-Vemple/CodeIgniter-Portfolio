<h3>Post</h3>

{success}
<div class="alert alert-success">
    {message}
</div>
{/success}

{errors}
<div class="alert alert-danger">
    {message}
</div>
{/errors}

<form action="/admin/post/addimage"
      class="dropzone"
      id="psdropzone"></form>


<form action="/admin/post" id="edit" method="POST">
    <div>
        <label for="id">ID</label>
        <input type="text" name="id" id="id" class="form-control" value="{id}" readonly="true">

        <label for="title">Title</label>
        <input type="text" name="title" id="title" class="form-control" value="{title}">
        
        <label for="description">Description ( optional: 128 char max )</label>
        <textarea name="description" class="editor">
            {description}
        </textarea>
        
        <label for="post">Content</label>
        <textarea name="post" class="editor">
            {post}
        </textarea>
    
        <input name="Save" class="btn btn-focus" type="submit" value="Save" />
    </div>
    
</form>
