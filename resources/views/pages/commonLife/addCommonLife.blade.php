<div class="lg:col-span-1">
    <div class="card h-full">
        <div class="card-header">
            <h3 class="card-title">
                Ajouter une tache commune
            </h3>
        </div>
        {{--This form add a common life--}}
        <form method ="POST" action="{{route('common-life.create')}}">
            @csrf
            <div class="card-body flex flex-col gap-5">
                <x-forms.input id="title" name="title" type="text" :label="__('Titre')" />
                <x-forms.input id="description"  name="description" type="text" :label="__('Description')" />
                <x-forms.dropdown name="language" :label="__('Promotions')">
                    <option value="everybody">Toutes les promotions</option>
                    @foreach($cohorts as $cohort)
                        <option value="{{$cohort->id}}">{{$cohort->name}}</option>
                    @endforeach
                </x-forms.dropdown>
                <x-forms.primary-button type="submit">
                    {{ __('Valider') }}
                </x-forms.primary-button>
            </div>
        </form>
    </div>
</div>
