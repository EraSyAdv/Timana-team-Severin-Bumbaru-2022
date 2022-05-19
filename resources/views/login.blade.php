@extends('layout.theme')

@section('content')

<section name="admitere" id="admitere" class="masthead page-section">
    <div class="container">

    	@if ($errors->any())
        <div class="container text-center" style="max-width: 50rem">
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif
        <h3 class="text-primary text-center"> Pagina de login </h3>
        <p class="text-secondary text-center"> Introdu datele de logare pentru a te conecta la cont. </p>
        <form class="text-center" method="POST" action="{{ route('login') }}">
        	@csrf
            <div class="form-group pb-3">
                <label for="email">Adresa de mail</label>
                <input style="margin: auto; display: block; width: 30rem;" type="text" class="form-control" name="email" id="email" aria-describedby="email" placeholder="Adresa de mail">
            </div>
            <div class="form-group pb-3">
                <label for="password">Parola</label>
                <input style="margin: auto; display: block; width: 30rem;" type="password" class="form-control" name="password" id="password" placeholder="Parola">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
    </div>
</section>

@endsection