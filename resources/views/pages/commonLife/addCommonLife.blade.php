<div class="lg:col-span-1">
    <div class="card h-full">
        <div class="card-header">
            <h3 class="card-title">
                Ajouter une tache commune
            </h3>
        </div>
        <form method ="POST" action="{{route('common-life.create')}}">
            @csrf
            <div class="card-body flex flex-col gap-5">
                <x-forms.input id="title" name="title" type="text" :label="__('Title')" />
                <x-forms.input id="description"  name="description" type="text" :label="__('Description')" />
                <x-forms.primary-button type="submit">
                    {{ __('Valider') }}
                </x-forms.primary-button>
            </div>
        </form>
    </div>
</div>
