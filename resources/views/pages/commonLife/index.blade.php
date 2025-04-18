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
            {{--If the user is an admin--}}
            @can('isAdmin')
                {{--he can modify or remove a common life--}}
                @include('pages.commonLife.view-admin')
            {{--If the user is a student--}}
            @elsecan('isStudent')
                {{--otherwise he can do common life--}}
                @include('pages.commonLife.view-student')
            @endcan
        </div>


        <div class="lg:col-span-1">
            <div class="card h-full">
                {{--If the user is an admin--}}
                @can('isAdmin')
                    {{--he can add a common life--}}
                    @include('pages.commonLife.addCommonLife')
                {{--If the user is a student--}}
                @elsecan('isStudent')
                    {{--otherwise he can see the common life he can do--}}
                    @include('pages.commonLife.history')
                @endcan
            </div>
        </div>
    </div>
</x-app-layout>
