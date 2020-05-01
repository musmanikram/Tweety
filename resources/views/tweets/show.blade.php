<x-app>
    <div>
        <div class="border border-gray-300 rounded-lg">
            @forelse ($tweets as $tweet)
                @include('_tweet')
            @empty
                <p class="p-4">This Tweet does not exist anymore.</p>
            @endforelse
        </div>
    </div>
</x-app>
