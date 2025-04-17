<div class="lg:col-span-1">
    <div class="card h-full">
        <div class="card-header">
            <h3 class="card-title">
                Ajouter un questionnaire
            </h3>
        </div>
        <form action="{{route('generateText')}}" method="POST">
            @csrf
            <x-forms.dropdown name="language" :label="__('Langage')">
                <option value="Ada">Ada</option>
                <option value="Assembly language">Assembly language</option>
                <option value="C">C</option>
                <option value="C#">C#</option>
                <option value="C++">C++</option>
                <option value="COBOL">COBOL</option>
                <option value="CSS">CSS</option>
                <option value="Delphi/Object Pascal">Delphi/Object Pascal</option>
                <option value="Fortran">Fortran</option>
                <option value="Go">Go</option>
                <option value="HolyC">HolyC</option>
                <option value="HTML">HTML</option>
                <option value="Java">Java</option>
                <option value="JavaScript">JavaScript</option>
                <option value="Linux">Linux</option>
                <option value="MATLAB">MATLAB</option>
                <option value="Perl">Perl</option>
                <option value="PHP">PHP</option>
                <option value="Python">Python</option>
                <option value="R">R</option>
                <option value="Rust">Rust</option>
                <option value="SQL">SQL</option>
                <option value="Typescript">Typescript</option>
                <option value="Visual Basic">Visual Basic</option>
            </x-forms.dropdown>
            <select name="promotion" :label="__('Promotions')">
                <option>Aucune formation</option>
                <option value="everybody">Toutes les promotions</option>
                @foreach($cohorts as $cohort)
                    <option value="{{$cohort->id}}">{{$cohort->name}}</option>
                @endforeach
            </select>
            <x-forms.input name="question" type="number" :label="__('Nombre de questions')"> </x-forms.input>
            <x-forms.input name="answer" type="number" :label="__('Nombre de réponses')"> </x-forms.input>
            <button class="btn btn-primary" type="submit">Generate</button>
        </form>
    </div>
</div>
