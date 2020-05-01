<x-app>
    <h2 class="font-bold text-lg">Notifications</h2>
    <ul>
    @forelse( $notifications as $notification )
        <li class="p-4 border {{ $loop->last ? '' : 'border-b-0' }}">
            @switch($notification->type)
            @case('App\Notifications\UserMentioned')
                <a href="{{ route('tweet', $notification->data['id'] ) }}">
                    You were mentioned in Tweet: <blockquote class="font-italic text-gray-600">{{ $notification->data['body'] }}</blockquote>
                </a>
                @break

            @case('App\Notifications\UserFollowed')
            <a href="{{ route('profile', $notification->data['username'] ) }}">
                You were followed by {{ '@' . $notification->data['username'] }}
            </a>
            @break
            @endswitch
        </li>
    @empty
        <li>No Notifications</li>
    @endforelse
    </ul>
</x-app>