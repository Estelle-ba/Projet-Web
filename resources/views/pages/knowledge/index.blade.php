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
            {{--Change the view if it's a student--}}
            @can('isStudent')
                @include('pages.knowledge.view-student')
            {{--If the user is an admin--}}
            @elsecan('isAdmin')
                @include('pages.knowledge.view-admin')
            @endcan
        </div>
        {{--Add form to add test if it's an admin--}}
        @can('isAdmin')
        <div class="lg:col-span-1">
            <div class="card h-full">
                    @include('pages.knowledge.add-test')
            </div>
        </div>
        @endcan
    </div>
</x-app-layout>
