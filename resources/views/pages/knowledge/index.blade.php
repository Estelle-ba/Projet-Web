<x-app-layout>
    <x-slot name="header">
        <h1 class="flex items-center gap-1 text-sm font-normal">
            <span class="text-gray-700">
                {{ __('Vie commune') }}
            </span>
        </h1>
    </x-slot>

    <form action="/generate-text" method="POST">
        @csrf
        <textarea name="prompt" placeholder="Enter your prompt here"></textarea>
        <button type="submit">Generate</button>
    </form>

</x-app-layout>
