<x-layout>
@auth
    <div class="container py-md-5 container--narrow">
    <div class="text-center">
        <h2>Hello <strong>{{ auth()->user()->email }}</strong>, your feed is empty.</h2>
        <p class="lead text-muted">Your feed displays the latest posts from the people you follow. If you don't have any friends to follow that's okay; you can use the "Search" feature in the top menu bar to find content written by people with similar interests and then follow them.</p>
        
        <!-- Sign out button -->
        <form action="/logout" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Sign Out</button>
        </form>
    </div>
</div>
@endauth
</x-layout>

