<div>
{{--    logout form--}}
    <form method="POST" action="/logout">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>

    {{--    dashboard content--}}
    <div class="container">
        <h1>Requester Dashboard</h1>
        <p>Welcome to the Requester Dashboard!</p>
        <p>Here you can manage your requests and view their statuses.</p>
    </div>
</div>
