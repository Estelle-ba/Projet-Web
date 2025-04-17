@foreach($done as $ratting)
    <div class="custom-modal" id="note{{$ratting->test_id}}" tabindex="-1" role="dialog" aria-labelledby="note{{$ratting->test_id}}">
        <div class="modal-dialog " role="document">
            <div class="modal-content" >
                <div class="modal-header">
                    @php
                        $time = $ratting->created_at;
                        $dateShow = $time->format("d/m/Y");
                    @endphp
                    <h5 class="flex modal-title">Test {{$ratting->language}} du {{$dateShow}}</h5>
                </div>
                <div class="modal-body">
                    <h5 class="flex modal-title">{{$ratting->ratting}} / {{$ratting->total}}</h5>
                </div>
                <button class="flex btn btn-outline btn-danger" type="button" onclick="closeModal('note{{$ratting->test_id}}')">
                    Fermer
                </button>
            </div>
        </div>
    </div>
@endforeach
