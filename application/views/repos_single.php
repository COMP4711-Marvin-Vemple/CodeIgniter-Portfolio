<div class="">
    {repo}
    <h1>{title}</h1>
    <p>{description}</p>
    <h3>Recent Commit History</h3>
    <table class="table">
        <tr>
            <th>Message</th>
            <th>Date</th>
            <th><span class="pull-right">View</span></th>
        </tr>
        {commits}
        <tr>
            <td>{message}</td>
            <td>{date}</td>
            <td><a class="btn btn-primary pull-right" href={url}>View Commit</a></td>
        </tr>
        {/commits}
    </table>
    {/repo}
</div>