@extends('layout.theme')

@section('content')

<section name="admitere" id="admitere" class="masthead page-section">
    <div class="container">
        <h3 class="text-primary text-center"> {{ $university->universityName }} </h3>
        <h3 class="text-primary text-center"> Inregistrare dosar in platforma online de inscriere </h3>
        <p class="text-secondary text-center"> Înregistrarea în platformă este prima operaţie pe care un candidat trebuie să o execute în vederea înscrierii pentru concursul de admitere.
            În formularul de înregistrare este obligatorie completarea tuturor câmpurilor (adresă de email contact validă, telefon contact, nume, parolă) precum şi marcarea pentru verificarea de securitate şi cu privire la acordul privind termenii de utilizare a platformei, de prelucrare şi stocare a datelor cu caracter personal şi declaraţia privind copiile documentelor ce vor fi încărcate în platformă. </p>

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
        <form class="text-center" action="{{ route('university.schedulePost') }}" method="POST">
            @csrf
            <div class="form-group pb-4">
                <label class="pb-2" for="name">Nume<label style="color: #fd7e14">*</label></label>
                <input type="text" class="form-control text-center pb-2" style="margin: auto; display: block; width: 20rem;" name="name" id="name" aria-dscribedby="name" placeholder="Nume complet">
            </div>
            <div class="form-group pb-4">
                <label class="pb-2" for="email">Adresa de Mail<label style="color: #fd7e14">*</label></label>
                <input type="text" class="form-control text-center pb-2" style="margin: auto; display: block; width: 20rem;" id="mail" name="mail" aria-dscribedby="email" placeholder="E-Mail">
            </div>
            <div class="form-group pb-4">
                <label class="pb-2" for="phone">Telefon<label style="color: #fd7e14">*</label></label>
                <input type="text" class="form-control text-center pb-2" style="margin: auto; display: block; width: 20rem;" id="phone" name="phone" aria-dscribedby="phone" placeholder="Numar de telefon">
            </div>

            <input type="hidden" name="university" id="university" value="{{ $university->universityID }}">
            <button type="submit" style="padding-left: 2rem; padding-right: 2rem;" class="btn btn-primary">Confirma</button>
        </form>
    </div>
</section>

@endsection