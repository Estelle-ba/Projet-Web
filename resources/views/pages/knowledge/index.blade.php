<x-app-layout>
    <x-slot name="header">
        <h1 class="flex items-center gap-1 text-sm font-normal">
            <span class="text-gray-700">
                {{ __('Bilan de connaissance') }}
            </span>
        </h1>
    </x-slot>
        <!-- begin: grid -->
    <div class="grid lg:grid-cols-3 gap-5 lg:gap-7.5 items-stretch">
        <div class="lg:col-span-2">
            @can('isAdmin')
                @include('pages.knowledge.view-admin')
            @else

            @endcan
        </div>

        <div class="lg:col-span-1">
            <div class="card h-full">
                @can('isAdmin')
                    @include('pages.knowledge.add-test')
                @else

                @endcan
            </div>
        </div>
    </div>
</x-app-layout>
