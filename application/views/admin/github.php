<h3>GitHub Settings:</h3>

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

<div class="row">
    <form method="POST">
        {f_username}
        {f_repoType}
        {f_numCommits}
        {f_submit}
    </form>
</div>