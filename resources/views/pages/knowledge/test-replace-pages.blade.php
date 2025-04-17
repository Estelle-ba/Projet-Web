@foreach($tests as $test)
    <div class="modal" id="{{$test[0]->test_id}}" tabindex="-1" role="dialog" aria-labelledby="{{$test[0]->test_id}}">
        <div class="modal-dialog " role="document">
            <div class="modal-content" >
                <div class="modal-header">
                    @php
                        $time = $test[0]->created_at;
                        $dateShow = $time->format("d/m/Y");
                    @endphp
                    <h5 class="flex modal-title">Test {{$test[0]->language}} du {{$dateShow}}</h5>
                </div>
                <div class="modal-body">
                    <form method="Post" action="{{route('knowledge.result')}}">
                        @csrf
                        <!-- Question 1 -->
                        <div class="flex flex-col mb-4">
                            @php
                                $temp= $test[count($test)-1];
                                $nbquestion = $temp->question_id;
                                $i=1;
                            @endphp
                            @foreach($test as $question)
                                @if($question->answer_id == 0 && $question->question_id==$i)
                                    <label for="q1" class="text-lg text-gray-800 mb-2">
                                        {{$question->question}}
                                    </label>
                                    <div class="flex items-center space-x-4">
                                        <input type="radio" name="{{$question->question_id}}"
                                               value="{{$question->IsTrue}}" required>
                                        <label class="text-gray-700">
                                            {{$question->answer}}
                                        </label>
                                    </div>
                                @elseif($question->question_id==$i)
                                    <div class="flex items-center space-x-4">
                                        <input type="radio" name="{{$question->question_id}}"
                                               value="{{$question->IsTrue}}" required>
                                        <label for="q1a" class="text-gray-700">
                                            {{$question->answer}}
                                        </label>
                                    </div>
                                @else
                                    @php
                                        $i+=1;
                                    @endphp
                                    <label for="q1" class="text-lg text-gray-800 mb-2">
                                        {{$question->question}}
                                    </label>
                                    <div class="flex items-center space-x-4">
                                        <input type="radio" name="{{$question->question_id}}"
                                               value="{{$question->IsTrue}}" required>
                                        <label class="text-gray-700">
                                            {{$question->answer}}
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <div class="flex item-center justify-end gap-2.5">
                            <input type="hidden" name="language" value="{{$test[0]->language}}">
                            <input type="hidden" name="test_id" value="{{$test[0]->test_id}}">
                            <input type="hidden" name="size" value="{{$nbquestion}}">
                            <button type="submit">
                                Fermer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
