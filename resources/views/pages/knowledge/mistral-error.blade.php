<x-app-layout>
    <script src="https://js.puter.com/v2/"></script>
    <x-slot name="header">
        <h1 class="flex items-center gap-1 text-sm font-normal">
            <span class="text-gray-700">
                {{ __('Bilan de connaissance') }}
            </span>
        </h1>
    </x-slot>
    <h1>ERREUR MISTRAL</h1>
    <h3>Veuillez réessayer plus tard</h3>
    <form action="{{route('knowledge.index')}}">
        <button class="btn btn-primary flex items-center"type="submit">Retour à la page</button>
    </form>
</x-app-layout>
