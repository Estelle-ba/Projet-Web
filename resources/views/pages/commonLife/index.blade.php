<x-app-layout>
    <x-slot name="header">
        <h1 class="flex items-center gap-1 text-sm font-normal">
            <span class="text-gray-700">
                {{ __('Vie commune') }}
            </span>
        </h1>
    </x-slot>

    <!-- begin: grid -->
    <div class="grid lg:grid-cols-3 gap-5 lg:gap-7.5 items-stretch">
        <div class="lg:col-span-2">
            @can('isAdmin')
                @include('pages.commonLife.view-admin')
            @else
                @include('pages.commonLife.view-student')
            @endcan
        </div>


        <div class="lg:col-span-1">
            <div class="card h-full">
                @can('isAdmin')
                    @include('pages.commonLife.addCommonLife')
                @else
                    @include('pages.commonLife.history')
                @endcan
            </div>
        </div>
    </div>
</x-app-layout>
