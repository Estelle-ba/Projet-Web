{{--Modal to add a comment or remove-it--}}
@foreach($done as $task_done)
    <div class="custom-modal" id="comment{{$task_done->id}}" tabindex="-1" role="dialog" aria-labelledby="{{$task_done->id}}">
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
