{{--The modal put the common task to finish and the user can add a comment--}}
@foreach($tasks as $task)
    <div class="custom-modal" id="done{{$task->task_id}}" tabindex="-1" role="dialog" aria-labelledby="{{$task->task_id}}">
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
