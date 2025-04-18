<div class="grid" >
    <div class="card card-grid h-full min-w-full">
        <div class="card-header">
            {{--If there're task to do--}}
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
                {{--If the task is assign to the user cohort--}}
                @if(in_array($task->task_id, $todo))
                    <div class="task_blocs">
                        <div class="card-body p-5">
                            <div class="flex justify-start flex-wrap gap-7.5">
                                <div class="flex items-center gap-2.5">
                                    <div class="border border-brand-clarity rounded-lg">
                                        <div class="date">
                                            <span class="text-3xs text-brand fw-medium p-1.5">
                                                {{--Show the month when the task was created--}}
                                                @php
                                                    $time = $task->created_at;
                                                    $dateShow = $time->format("M");
                                                    echo($dateShow);
                                                @endphp
                                            </span>
                                        </div>
                                        <div class="flex items-center justify-center size-9">
                                            <span class="fw-semibold text-gray-900 text-md tracking-tight">
                                                {{--Show the day when the task was created--}}
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
                                {{--Open the modal to finish the task--}}
                                <button class="btn btn-primary" onclick="openModal('done{{$task->task_id}}')">
                                    Terminer
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
@include('pages.commonLife.modal-add-comment')



