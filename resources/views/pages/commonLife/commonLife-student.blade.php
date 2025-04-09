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
            <div class="grid" >
                <div class="card card-grid h-full min-w-full">
                    <div class="card-header">
                        @if(count($tasks) == 0)
                            <h3 class="card-title">
                                Aucune tâche
                            </h3>
                        @else
                            <h3 class="card-title">
                                Tâches à faire
                            </h3>
                        @endif
                    </div>
                    <div class="flex items-center justify-between p-0 flex-wrap border-b">
                        @foreach($tasks as $task)
                            <div class="card">
                                <div class="card-body p-5">
                                    <div class="flex justify-end flex-wrap gap-7.5">
                                        <div class="flex items-center gap-2.5">
                                            <div class="border border-brand-clarity rounded-lg">
                                                <div class="flex items-center justify-center border-b border-b-brand-clarity bg-brand-light rounded-t-lg">
                                                   <span class="text-3xs text-brand fw-medium p-1.5">
                                                       @php
                                                           $time = $task->created_at;
                                                           $dateShow = $time->format("M");
                                                           echo($dateShow);
                                                       @endphp
                                                   </span>
                                                </div>
                                                <div class="flex items-center justify-center size-9">
                                                   <span class="fw-semibold text-gray-900 text-md tracking-tight">
                                                        @php
                                                            $time = $task->created_at;
                                                            $dateShow = $time->format("d");
                                                            echo($dateShow);
                                                        @endphp
                                                   </span>
                                                </div>
                                            </div>
                                            <div class="flex flex-col gap-1.5">
                                                <h3 class="card-title">
                                                    {{$task->title}}
                                                </h3>
                                                <a class="hover:text-primary-active font-medium text-gray-700 text-xs">
                                                    {{$task->description}}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex item-center justify-end gap-2.5">
                                        <form method ="POST">
                                            @csrf
                                            <input type="hidden" id="id" name="id" value="{{$task->task_id}}">
                                            <button class="btn btn-dark btn-sm" type="submit">
                                                Terminer
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
        <div class="lg:col-span-1">
            <div class="card h-full">
                <div class="card-header">
                    <h3 class="card-title">
                        Ajouter une tache commune
                    </h3>
                </div>
                <form method ="POST" action="{{route('common-life.create')}}">
                    @csrf
                    <div class="card-body flex flex-col gap-5">
                        <x-forms.input id="title" name="title" type="text" :label="__('Title')" />

                        <x-forms.input id="description"  name="description" type="text" :label="__('Description')" />

                        <x-forms.primary-button type="submit">
                            {{ __('Valider') }}
                        </x-forms.primary-button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <!-- end: grid -->
</x-app-layout>
