
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
                            <div class="task_blocs">
                                <div class="card-body p-5">
                                    <div class="flex justify-start flex-wrap gap-7.5">
                                        <div class="flex items-center gap-2.5">
                                            <div class="border border-brand-clarity rounded-lg">
                                                <div class="date">
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
                                                <p class="task-title">
                                                    {{$task->title}}
                                                </p>
                                                <span class="font-medium text-gray-700 text-xs">
                                                    {{$task->description}}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex item-center justify-end gap-2.5">
                                        <button class="btn btn-primary" onclick="openModal('done{{$task->task_id}}')">
                                            Terminer
                                        </button>
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
                    @if(count($done) == 0)
                        <h3 class="card-title">
                            Aucune tâche terminée
                        </h3>
                    @else
                        <h3 class="card-title">
                            Tâches finies
                        </h3>
                    @endif
                </div>
                    @foreach($done as $task_done)
                    <div class="mb-4 lg:flex lg:flex-col lg:w-[300px] lg:rounded-xl lg:border" data-drawer="true" data-drawer-class="drawer drawer-start max-w-[90%] w-[300px]" data-drawer-enable="true|lg:false" id="drawer_3">
                        <div data-accordion="true">
                            <div class="accordion-item [&:not(:last-child)]:border-b badge-outline badge-success border-b-gray-200" data-accordion-item="true" id="accordion_item_{{$task_done->id}}">
                                <button class="accordion-toggle py-4 group flex items-center justify-between p-5 border-b" data-accordion-toggle="#accordion_content_{{$task_done->id}}">
                                    <span class="text-base text-gray-900 font-medium">
                                        {{$task_done->title}}
                                    </span>
                                    <i class="ki-outline ki-plus text-gray-600 text-2sm accordion-active:hidden block">
                                    </i>
                                    <i class="ki-outline ki-minus text-gray-600 text-2sm accordion-active:block hidden">
                                    </i>
                                </button>
                            <div class="accordion-content hidden" id="accordion_content_{{$task_done->id}}">
                                <div class="text-gray-700 text-md pb-4">
                                    <div class="p-5">
                                        Description :
                                        <div>
                                            <span class="font-medium text-gray-700 text-xs">
                                                {{$task_done->description}}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="p-5">
                                        Mon commentaire :
                                        <div>
                                            @if($task_done->comment == null)
                                                <span class="font-medium text-gray-700 text-xs">
                                                Aucun commentaire
                                            </span>
                                            @else
                                                <span class="font-medium text-gray-700 text-xs">
                                                {{$task_done->comment}}
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex item-center justify-end gap-2.5 flex-wrap">
                                        <form method ="POST" action="{{route('comment-delete')}}">
                                            @csrf
                                            <input type="hidden" id="id" name="id" value="{{$task_done->id}}">
                                            <button class="flex btn btn-danger" type="submit">
                                                Supprimer
                                            </button>
                                        </form>
                                        <button class="btn btn-primary" onclick="openModal('comment{{$task_done->id}}')">
                                            Modifier
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
    <!-- end: grid -->
</x-app-layout>
@foreach($tasks as $task)
    <div class="modal" id="done{{$task->task_id}}" tabindex="-1" role="dialog" aria-labelledby="{{$task->task_id}}">
        <div class="modal-dialog " role="document">
            <div class="modal-content" >
                <div class="modal-header">
                    <h5 class="flex modal-title">Tâche {{$task->task_id}} : {{$task->title}}</h5>
                </div>
                <div class="modal-body">
                    <h6>{{$task->description}}</h6>
                    <p>Ajouter un commentaire</p>
                </div>
                <form method ="POST" action="{{route('comment-add')}}">
                    @csrf
                    <div class="card-body flex flex-col gap-5">
                        <input type="hidden" id="title" name="title" value="{{$task->title}}">
                        <input type="hidden" id="description" name="description" value="{{$task->description}}">
                        <x-forms.input id="comment" name="comment" type="text" :label="__('Commentaire')" />
                        <div class="flex item-center justify-end gap-2.5">
                            <button class="flex btn btn-outline btn-danger" type="button" onclick="closeModal('done{{$task->task_id}}')">
                                Fermer
                            </button>
                            <button class="btn btn-primary" type="submit">
                                Terminer
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endforeach
@foreach($done as $task_done)
    <div class="modal" id="comment{{$task_done->id}}" tabindex="-1" role="dialog" aria-labelledby="{{$task_done->id}}">
        <div class="modal-dialog " role="document">
            <div class="modal-content" >
                <div class="modal-header">
                    <h5 class="flex modal-title">Tâche {{$task_done->task_id}} : {{$task_done->title}}</h5>
                </div>
                <div class="modal-body">
                    <h6>{{$task_done->description}}</h6>
                    <p>Changer le commentaire</p>
                </div>
                <form method ="POST" action="{{route('comment-modify')}}">
                    @csrf
                    <div class="card-body flex flex-col gap-5">
                        <input type="hidden" id="id" name="id" value="{{$task_done->id}}">
                        <x-forms.input id="comment" name="comment" type="text" :label="__('Commentaire')" />
                        <div class="flex item-center justify-end gap-2.5">
                            <button class="flex btn btn-outline btn-danger" type="button" onclick="closeModal('comment{{$task_done->id}}')">
                                Fermer
                            </button>
                            <button class="btn btn-primary" type="submit">
                                Terminer
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endforeach
