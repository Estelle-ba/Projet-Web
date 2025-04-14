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
                                        @php
                                            $time = $task_done->created_at;
                                            $dateShow = $time->format("d/m/Y");
                                        @endphp
                                        {{$task_done->title}} fait le {{$dateShow}}
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
@include('pages.commonLife.modal-modify-comment')
