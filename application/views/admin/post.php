<a href="/admin/post/create" class="btn btn-default">New Post</a>
<table class="table">
    <tr>
        <td>ID</td>
        <td>Title</td>
        <td colspan="2">Actions</td>
    </tr>
    {posts}
    <tr>
        
        <td>{id}</td>
        <td>{title}</td>
        <td>
            <a href="/admin/post/edit/{id}" class="btn btn-default" type="button">Edit</a>
        </td>
        <td>
            <a href="/admin/post/edit/{id}" class="btn btn-default" type="button">Delete</a>
        <td>
    </tr>
    {/posts}
</table>