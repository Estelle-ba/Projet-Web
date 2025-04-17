@foreach($tests as $test)
    <div class="custom-modal" id="{{$test[0]->test_id}}" tabindex="-1" role="dialog" aria-labelledby="{{$test[0]->test_id}}">
        <div class="modal-dialog " role="document">
            <div class="modal-content" >
                <div class="modal-header">
                    <h5 class="flex modal-title">Test {{$test[0]->test_id}} : {{$test[0]->language}}</h5>
                </div>
                <form method ="POST" action="{{route('test.modify')}}">
                    @csrf
                    <div class="card-body flex flex-col gap-5">
                        <x-forms.dropdown name="language" :label="__('Promotions')">
                            <option>Aucune formation</option>
                            <option value="everybody">Toutes les promotions</option>
                            @foreach($cohorts as $cohort)
                                <option value="{{$cohort->id}}">{{$cohort->name}}</option>
                            @endforeach
                        </x-forms.dropdown>
                        <div class="flex item-center justify-end gap-2.5">
                            <input type="hidden" name="id" value="{{$test[0]->test_id}}">
                            <button class="flex btn btn-outline btn-danger" type="button" onclick="closeModal({{$test[0]->test_id}})">
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

