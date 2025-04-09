<x-app-layout>
    <x-slot name="header">
    </x-slot>
    @include('pages.commonLife.commonLife-admin')
    @foreach($tasks as $task)
            <div class="flex flex-col gap-3" id="event_invitation">
                <div class="card">
                    <div class="card-body p-5">
                        <div class="flex items-center justify-between flex-wrap gap-7.5">
                            <div class="flex items-center gap-2.5">
                                <div class="border border-brand-clarity rounded-lg">
                                    <div class="flex items-center justify-center border-b border-b-brand-clarity bg-brand-light rounded-t-lg">
                                                   <span class="text-3xs text-brand fw-medium p-1.5">
                                                    Apr
                                                   </span>
                                    </div>
                                    <div class="flex items-center justify-center size-9">
                                                   <span class="fw-semibold text-gray-900 text-md tracking-tight">
                                                    12
                                                   </span>
                                    </div>
                                </div>
                                <div class="flex flex-col gap-1.5">
                                    <h3 class="card-title">
                                        {{$task->title}}
                                    </h3>
                                    <a class="hover:text-primary-active font-medium text-gray-700 text-xs" href="#">
                                        {{$task->description}}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex item-center justify-end gap-2.5">
                    <button class="btn btn-light btn-sm" data-dismiss="#event_invitation" data-dismiss-mode="hide">
                        Supprimer
                    </button>
                    <button class="btn btn-dark btn-sm">
                        Modifier
                    </button>
                </div>
            </div>
    @endforeach
</x-app-layout>
