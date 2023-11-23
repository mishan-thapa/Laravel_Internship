<h1>hello admin</h1>
<form method="post" action="{{ route('admin.logout') }}">
    @csrf
    <input type="submit" value="logout" />
</form>

<a class="nav-link" href="{{ route('approve-post.index') }}">Approve Post</a>
