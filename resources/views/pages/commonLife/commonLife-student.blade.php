<x-app-layout>
    <x-slot name="header">
        <h1 class="flex items-center gap-1 text-sm font-normal">
            <span class="text-gray-700">
                {{ __('Vie commune') }}
            </span>
        </h1>
    </x-slot>

    <!-- begin: grid -->
    <div class="grid lg:grid-cols-3 gap-5 lg:gap-7.5 items-stretch">
        <div class="lg:col-span-2">
            <div class="grid">
                <div class="card card-grid h-full min-w-full">
                    <div class="card-header">
                        <h3 class="card-title">
                            Block 1
                        </h3>
                    </div>
                    <div class="flex flex-col gap-3" id="event_invitation">
                        <div class="card">
                            <div class="card-body p-5">
                                <div class="flex items-center justify-between flex-wrap gap-7.5">
                                    <div class="flex items-center gap-2.5">
                                        <div class="border border-brand-clarity rounded-lg">
                                            <div class="flex items-center justify-center border-b border-b-brand-clarity bg-brand-light rounded-t-lg">
                                               <span class="text-3xs text-brand fw-medium p-1.5">
                                                Apr
                                               </span>
                                            </div>
                                            <div class="flex items-center justify-center size-9">
                                               <span class="fw-semibold text-gray-900 text-md tracking-tight">
                                                12
                                               </span>
                                            </div>
                                        </div>
                                        <div class="flex flex-col gap-1.5">
                                            <a class="hover:text-primary-active font-medium text-gray-700 text-xs" href="#">
                                                Tâche commune
                                            </a>
                                        </div>
                                    </div>
                                    <div class="flex -space-x-2">
                                        <div class="flex">
                                            <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-light-light size-6" src="/static/metronic/tailwind/docs/dist/assets/media/avatars/300-4.png"/>
                                        </div>
                                        <div class="flex">
                                            <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-light-light size-6" src="/static/metronic/tailwind/docs/dist/assets/media/avatars/300-1.png"/>
                                        </div>
                                        <div class="flex">
                                            <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-light-light size-6" src="/static/metronic/tailwind/docs/dist/assets/media/avatars/300-2.png"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex item-center justify-end gap-2.5">
                            <button class="btn btn-light btn-sm" data-dismiss="#event_invitation" data-dismiss-mode="hide">
                                Supprimer
                            </button>
                            <button class="btn btn-dark btn-sm">
                                Modifier
                            </button>
                        </div>
                    </div>
                    <button class="btn btn-primary hidden" id="dismiss_restore_btn">
                        Show back
                    </button>
                </div>
            </div>
        </div>
        <div class="lg:col-span-1">
            <div class="card h-full">
                <div class="card-header">
                    <h3 class="card-title">
                        Ajouter une tache commune
                    </h3>
                </div>
                <form method ="POST" action="{{route('common-life')}}">
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
    </div>
    </div>
    <!-- end: grid -->
</x-app-layout>
