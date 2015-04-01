<div class="">
    <h1>{repo}</h1>
    <table class="table">
        <tr>
            <th>Message</th>
            <th>Author</th>
            <th><span class="pull-right">View</span></th>
        </tr>
        {commits}
        <tr>
            <td>{message}</td>
            <td>{author}</td>
            <td><a class="btn btn-primary pull-right" href="https://github.com/{owner}/{repo}/commit/{sha}" target="_blank">View Commit</a></td>
        </tr>
        {/commits}
    </table>
</div>