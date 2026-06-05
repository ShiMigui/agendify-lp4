@extends('base')

@section('content')
    <div class="form-card form-card--full">
        <h1>@yield('title')</h1>

        @yield('content-pre-form')

        <form action="@yield('form-action')" method="POST" enctype="multipart/form-data" class="form-grid">
            @csrf
            @yield('inputs')
            <div class="options">
                <button type="submit" class="btn primary">Salvar</button>
                <a href="{{ url()->previous() }}" class="btn tertiary">Cancelar</a>
            </div>
        </form>

        @yield('content-pos-form')
    </div>
@endsection
