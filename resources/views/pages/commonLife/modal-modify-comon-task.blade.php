{{--Modal to modify the task--}}
@foreach($tasks as $task)
    <div class="custom-modal" id="{{$task->task_id}}" tabindex="-1" role="dialog" aria-labelledby="{{$task->task_id}}">
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
                        {{--Assign a cohort to a common life task--}}
                        <x-forms.dropdown name="language" :label="__('Promotions')">
                            <option>Aucune formation</option>
                            <option value="everybody">Toutes les promotions</option>
                            @foreach($cohorts as $cohort)
                                <option value="{{$cohort->id}}">{{$cohort->name}}</option>
                            @endforeach
                        </x-forms.dropdown>
                        <div class="flex item-center justify-end gap-2.5">
                            <button class="btn btn-primary" type="submit">
                                Modifier
                            </button>
                        </div>
                    </div>
                </form>
                <form method ="POST" action="{{route('common-life.cohort-delete')}}">
                    {{--Delete a cohort--}}
                    @csrf
                    <x-forms.dropdown name="id" :label="__('Promotions')">
                        {{--Take the id of the cohort that had to do the task--}}
                        @foreach($todo as $t)
                            {{--Take the id of the cohort--}}
                            @if($t->task_id == $task->task_id)
                                {{--Take the name of the cohort--}}
                                @php
                                    foreach($cohorts as $cohort){
                                        if($cohort->id == $t->promotion){
                                            $name = $cohort->name;
                                        }
                                    }
                                @endphp
                                <option value="{{$t->promotion}}">{{$name}}</option>
                            @endif
                        @endforeach
                    </x-forms.dropdown>
                    <div class="flex item-center justify-end gap-2.5">
                        <input type="hidden" name="task_id" value="{{$task->task_id}}">
                        <button class="flex btn btn-outline btn-danger" type="button" onclick="closeModal({{$task->task_id}})">
                            Fermer
                        </button>
                        <button class="btn btn-primary" type="submit">
                            Modifier
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
