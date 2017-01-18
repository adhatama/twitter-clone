@if(session('message'))
    <h4>{{ session('message') }}</h4>
@endif

<form method="POST" action="{{ route('tweet.store') }}">
    {{ csrf_field() }}
    Tweet
    <input type="text" name="tweet">
</form>