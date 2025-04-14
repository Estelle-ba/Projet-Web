@foreach($tasks as $task)
    <div class="modal" id="{{$task->task_id}}" tabindex="-1" role="dialog" aria-labelledby="{{$task->task_id}}">
        <div class="modal-dialog " role="document">
            <div class="modal-content" >
                <div class="modal-header">
                    <h5 class="flex modal-title">Tâche {{$task->task_id}} : {{$task->title}}</h5>
                </div>
                <div class="modal-body">
                    <h6>{{$task->description}}</h6>
                </div>
                <form method ="POST" action="{{route('common-life.modify')}}">
                    @csrf
                    <div class="card-body flex flex-col gap-5">
                        <input type="hidden" id="id" name="id" value="{{$task->task_id}}">
                        <x-forms.input id="title" name="title" type="text" :label="__('Title')" />
                        <x-forms.input id="description"  name="description" type="text" :label="__('Description')" />
                        <div class="flex item-center justify-end gap-2.5">
                            <button class="flex btn btn-outline btn-danger" type="button" onclick="closeModal({{$task->task_id}})">
                                Fermer
                            </button>
                            <button class="btn btn-primary" type="submit">
                                Modifier
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endforeach
