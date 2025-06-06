<div class="grid" >
    <div class="card card-grid h-full min-w-full">
        <div class="card-header">
            {{--If there's no test--}}
            @if(count($tests) == 0)
                <h3 class="card-title">
                    Aucune test
                </h3>
            @else
                <h3 class="card-title">
                    Test à faire
                </h3>
            @endif
        </div>
        <div class="flex items-center justify-between p-0 flex-wrap border-b">
            @foreach($tests as $test)
                @if(in_array($test[0]->test_id, $todo))
                    <div class="task_blocs" >
                        <div class="card-body p-5">
                            <div class="flex justify-start flex-wrap gap-7.5">
                                <div class="flex items-center gap-2.5">
                                    <div class="border border-brand-clarity rounded-lg">
                                        <div class="flex items-center justify-center border-b border-b-brand-clarity bg-brand-light rounded-t-lg">
                                            <span class="text-3xs text-brand fw-medium p-1.5">
                                                {{--Show the month the test was created--}}
                                                @php
                                                    $time = $test[0]->created_at;
                                                    $dateShow = $time->format("M");
                                                    echo($dateShow);
                                                @endphp
                                            </span>
                                        </div>
                                        <div class="flex items-center justify-center size-9">
                                            <span class="fw-semibold text-gray-900 text-md tracking-tight">
                                                {{--Show the date the test was created--}}
                                                @php
                                                    $time = $test[0]->created_at;
                                                    $dateShow = $time->format("d");
                                                    echo($dateShow);
                                                @endphp
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex flex-col gap-1.5">
                                        <h3 class="card-title">
                                            {{$test[0]->language}}
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="flex item-center justify-end gap-2.5 flex-wrap">
                                @if(in_array($test[0]->test_id,$tests_done))
                                    {{--Open the modal to show the rate of the test done--}}
                                    <button class="btn btn-success" onclick="openModal('note{{$test[0]->test_id}}')">
                                        Voir la note
                                    </button>
                                @else
                                    {{--Open the modal with the test to do--}}
                                    <button class="btn btn-primary" onclick="openModal({{$test[0]->test_id}})">
                                        Faire le test
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
@include('pages.knowledge.test-replace-pages')
@include('pages.knowledge.ratting')
