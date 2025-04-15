<x-app-layout>
    <script src="https://js.puter.com/v2/"></script>
    <x-slot name="header">
        <h1 class="flex items-center gap-1 text-sm font-normal">
            <span class="text-gray-700">
                {{ __('Vie commune') }}
            </span>
        </h1>
    </x-slot>

    <form action="/generate-text" method="POST">
        @csrf
        <select name="langage">
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
        </select>
        <x-forms.input name="question" type="number" :label="__('Nombre de questions')"> </x-forms.input>
        <x-forms.input name="answer" type="number" :label="__('Nombre de réponses')"> </x-forms.input>
        <button type="submit">Generate</button>
    </form>

</x-app-layout>
