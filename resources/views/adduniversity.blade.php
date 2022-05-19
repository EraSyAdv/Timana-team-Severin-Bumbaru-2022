@extends('layout.theme')

@section('content')

	 <section class="page-section masthead text-dark mb-0" id="about">
        <div class="container">
            @if(session('message') && session('type') && session('title'))
                <div class="container text-center" style="max-width: 50rem">
                    <div class="alert alert-{{ session('type') }}" role="alert">
                        <h2 class="alert-heading">{{ session('title') }}</h2>
                        <h5>{!! session('message') !!}</h5>
                    </div>
                </div>
            @endif
            <!-- de aici incepe orasul -->
            <h2 class="page-section-heading text-center text-uppercase">Adaugare oras</h2>
            <div class="divider-custom divider-dark">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <form method="POST" action="{{ route('addCity') }}">
                @csrf
                <div class="form-group pb-3">
                    <label for="city">Oras</label>
                    <input type="city" class="form-control" id="city" aria-describedby="city" name="city" placeholder="Scrie numele orasului">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <!-- de aici specialitatile -->
            <h2 class="page-section-heading text-center text-uppercase">Adaugare specialitate</h2>
            <div class="divider-custom divider-dark">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <form method="POST" action="{{ route('addSpeciality') }}">
                @csrf
                <div class="form-group pb-3">
                    <label for="speciality">Specialitate</label>
                    <input type="speciality" class="form-control" id="speciality" aria-describedby="speciality" name="speciality" placeholder="Scrie numele specialitatii">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <!-- de aici incepe universitatea -->
            <h2 class="page-section-heading text-center text-uppercase">Adaugare universitate</h2>
            <div class="divider-custom divider-dark">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <form method="POST" action="{{ route('addUniversityPost') }}">
                @csrf
                <div class="form-group pb-3">
                    <label for="name">Numele universitatii</label>
                    <input type="text" class="form-control" id="name" name="name" aria-describedby="name" placeholder="Scrie numele universitatii">
                </div>
                <div class="form-group pb-3">
                    <label for="speciality">Specialitatea universitatii</label>
                    <select class="form-control" id="speciality" name="speciality">
                        @foreach($specialities as $speciality)
                            <option id="{{ $speciality->specialityID }}" value="{{ $speciality->specialityID }}">{{ $speciality->specialityName }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group pb-3">
                    <label for="city">Orasul universitatii</label>
                    <select id="city" name="city" class="form-control">
                        @foreach($cities as $city)
                            <option id="{{ $city->cityID }}" value="{{ $city->cityID }}">{{ $city->cityName }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group pb-3">
                    <label for="acceptance">Modul de admitere al universitatii</label>
                    <select id="acceptance" name="acceptance" class="form-control">
                        <option id="1" value="1">Cu Dosar</option>
                        <option id="2" value="2">Cu Examen</option>
                    </select>
                </div>
                <div class="form-group pb-3">
                    <label for="details">Detalii despre universitate</label>
                    <input type="text" class="form-control" id="details" name="details" aria-describedby="details" placeholder="Scrie detalii despre universitate">
                </div>
                <div class="form-group pb-3">
                    <label for="link">Link-ul catre site-ul universitatii</label>
                    <input type="text" class="form-control" id="link" aria-describedby="link" name="link" placeholder="Scrie link-ul universitatii">
                </div>
                <div class="form-group pb-3">
                    <label for="linkg">Link-ul catre google maps-ul universitatii</label>
                    <input type="text" class="form-control" id="linkg" aria-describedby="linkg" name="linkg" placeholder="Scrie link-googlemaps al universitatii">
                </div>
                <div class="custom-file">
                  <input data-classButton="btn btn-primary" type="file" class="custom-file-input" id="file" name="file">
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </section>

@endsection