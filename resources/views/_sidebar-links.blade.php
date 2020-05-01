<ul>
    <li>
        <a
            class="font-bold text-lg mb-4 block"
            href="{{ route('home') }}"
        >
            Home
        </a>
    </li>

    <li>
        <a
            class="font-bold text-lg mb-4 block"
            href="/explore"
        >
            Explore
        </a>
    </li>

    @auth
        <li>
            <a
                class="font-bold text-lg mb-4 block"
                href="{{ current_user()->path() }}"
            >
                Profile
            </a>
        </li>

        <li>
            <a
                    class="font-bold text-lg mb-4 block"
                    href="{{ current_user()->path('notifications') }}"
            >
                Notifications
                @if(current_user()->unreadNotifications()->count())
                    <span style="width:25px" class="bg-blue-500 text-white text-center p-1 rounded-lg text-xs inline-block">
                    {{ current_user()->unreadNotifications()->count() }}
                    </span>
                @endif
            </a>
        </li>

        <li>
            <form method="POST" action="/logout">
                @csrf

                <button class="font-bold text-lg">Logout</button>
            </form>
        </li>
    @endauth
</ul>
