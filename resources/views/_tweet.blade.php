<div class="flex p-4 relative {{ $loop->last ? '' : 'border-b border-b-gray-400' }}">
    <div class="mr-2 flex-shrink-0">
        <a href="{{ $tweet->user->path() }}">
            <img
                src="{{ $tweet->user->avatar }}"
                alt=""
                class="rounded-full mr-2"
                width="50"
                height="50"
            >
        </a>
    </div>

    <div class="absolute" style="right: 1rem;top:1rem;">
    <x-delete-tweet-button :tweet="$tweet"></x-delete-tweet-button>
    </div>
    <div class="w-full">
        <h5 class="font-bold mb-2">
            <a href="{{ $tweet->user->path() }}">
                {{ $tweet->user->name }}
            </a>
        </h5>

        <p class="text-sm mb-3">
            {{ $tweet->body }}
        </p>

        @if($tweet->image)
            <img src="{{ $tweet->image }}"  class="block mx-auto" />
        @endif

        @auth
            <x-like-buttons :tweet="$tweet" />
        @endauth
    </div>
</div>
