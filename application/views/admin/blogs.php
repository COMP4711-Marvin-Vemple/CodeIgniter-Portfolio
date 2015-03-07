<table>
    <tr>
        <td>ID</td>
        <td>Title</td>
        <td colspan="2">Actions</td>
    </tr>
    {entry}
    <tr>
        
        <td>{id}</td>
        <td>{title}</td>
        <td>{edit}</td>
        <td>
            <a href={edit_link} class="btn btn-default" type="button">{edit}</a>
        </td>
        <td>
            <a href={delete_link} class="btn btn-default" type="button">{delete}</a>
        <td>
    </tr>
    {/entry}
</table>