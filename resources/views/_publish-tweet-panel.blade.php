<div class="border border-blue-400 rounded-lg px-8 py-6 mb-8">
    <form method="POST" action="/tweets" enctype="multipart/form-data">
        @csrf

        <textarea
            name="body"
            class="w-full"
            placeholder="What's up doc?"
            required
            autofocus
            maxlength="255"
            v-on:keyup="updateTweetLeftChars"
        ></textarea>


        <div v-show="showPreview" class="flex">
            <img v-bind:src="imagePreview"/>
            <button type="button" v-on:click="clearTweetImage">Remove Image</button>
        </div>

        <hr class="my-4">

        <footer class="flex justify-between items-center">
            <div class="flex justify-between items-center">
                <img
                    src="{{ current_user()->avatar }}"
                    alt="your avatar"
                    class="rounded-full mr-2"
                    width="50"
                    height="50"
                >
                <span class="rounded-lg text-xs p-2 text-black text-center" style="width:40px;" v-bind:class="tweetCharsBackground" v-html="tweetLeftChars">255</span>
            </div>

            <div class="flex justify-between items-center">
                <label for="image" class="inline-block hover:text-blue-300 p-2 text-blue rounded-lg uppercase  cursor-pointer ">
                    <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path class="heroicon-ui" d="M4 4h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6c0-1.1.9-2 2-2zm16 8.59V6H4v6.59l4.3-4.3a1 1 0 0 1 1.4 0l5.3 5.3 2.3-2.3a1 1 0 0 1 1.4 0l1.3 1.3zm0 2.82l-2-2-2.3 2.3a1 1 0 0 1-1.4 0L9 10.4l-5 5V18h16v-2.59zM15 10a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/></svg>
                    <input v-on:change="handleFilePreview()" ref="file" id="image" name="image" type='file' class="hidden" />
                </label>

                <button
                    type="submit"
                    class="bg-blue-500 hover:bg-blue-600 rounded-lg shadow px-10 text-sm text-white h-10"
                >
                    Publish
                </button>
            </div>
        </footer>
    </form>

    @error('body')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
    @enderror
</div>
