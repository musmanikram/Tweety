@auth
@can ('delete', $tweet)
    <form method="POST"
          action="{{ route('delete-tweet', $tweet->id ) }}"
    >
        @csrf
        @method('DELETE')

        <button type="submit"
                class="bg-red-500 rounded-full shadow py-2 px-4 text-white text-xs"
        >
            Delete
        </button>
    </form>
@endcan
@endauth