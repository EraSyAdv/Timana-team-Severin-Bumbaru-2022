@extends('layout.theme')

@section('content')

<!-- University section -->
<section name="facultate-link" id="facultate-link" class="text-white text-center pb-5">
    <div class="container-fluid" style="padding-left: 0px; padding-right: 0px;">
        <div>
            <img class="img-fluid" id="university-image" src="{{ asset('assets/img/university/' . $university->universityID . '.jpg') }}">
            <h2 class="page-section-heading pt-5 text-center text-uppercase mb-0 text-dark">{{ $university->universityName }}</h2>
            <div class="divider-custom">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <div class="container">
            	<h5 class="text-dark text-center">{{ $university->universityDetails }}</h5>
            </div>

            <br>

            @can('view.universitydata', $university)
                @if($university->universityAcceptance == 1)
                    <a class="btn btn-warning" href="{{ route('university.schedules', $university->universityID) }}">Vezi dosare</a>
                @else
                    <a class="btn btn-warning" href="">Vezi programari admiteri</a>
                @endif
            @endcan
        </div>
    </div>
</section>

<section class="page-section bg-primary text-white mb-0" id="facultate-link">
    <div class="container">
        <h2 class="page-section-heading text-center text-uppercase text-white">Viziteaza site-ul facultatii !</h2>
        <!-- Icon Divider-->
        <div class="divider-custom divider-light">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <!-- About Section Content-->
            <div class="text-center"><p class="lead">In cazul in care doresti mai multe informatii despre facultatea la care doresti sa aplici poti verifica aici.</p>
        <!-- About Section Button-->
        <div class="text-center mt-4">
            <a class="btn btn-xl btn-outline-light" target="_blank" href="{{ $university->universityLink }}">
                {{ $university->universityLink }}
            </a>
        </div>
    </div>
</section>

@if($university->universityAcceptance == 1)

    <section name="facultate-aplica" id="facultate-aplica" class="text-white text-center pb-5">
        <div class="container-fluid" style="padding-left: 0px; padding-right: 0px;">
            <div>
                <h2 class="page-section-heading pt-5 text-center text-uppercase mb-0 text-dark">
                    Vrei sa ni te alaturi? 
                    <br>Depune-ti dosarul online ! 
                    <br>In cadrul facultatii noastre admiterea se face doar cu dosarul !
                </h2>

                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>

                @if($university->universityScheduleListState == 1)

                    <a href="{{ route('university.scheduleFile', $university->universityID) }}" class="btn btn-primary">
                        <i class="fas fa-arrow-right fa-fw"></i>
                        Depune-ti dosarul !
                    </a>

                @else

                    <button class="btn btn-danger" disabled>
                        <i class="fas fa-arrow-right fa-fw"></i>
                        Inregistrari indisponibile !
                    </button>

                @endif
            </div>
        </div>
    </section>

@else

    <section name="facultate-aplica" id="facultate-aplica" class="text-white text-center pb-5">
        <div class="container-fluid" style="padding-left: 0px; padding-right: 0px;">
            <div>
                <h2 class="page-section-heading pt-5 text-center text-uppercase mb-0 text-dark">
                    Vrei sa ni te alaturi? 
                    <br>Programeaza-te la admitere ! 
                    <br>In cadrul facultatii noastre admiterea se face doar cu examen de admitere !
                </h2>

                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>

                @if($university->universityScheduleListState == 1)

                <a href="{{ route('university.schedule', $university->universityID) }}" class="btn btn-primary">
                    <i class="fas fa-arrow-right fa-fw"></i>
                    Programeaza-te !
                </a>

                @else

                    <button class="btn btn-danger" disabled>
                        <i class="fas fa-arrow-right fa-fw"></i>
                        Programari indisponibile !
                    </button>

                @endif
            </div>
        </div>
    </section>

@endif

<!-- chestie pentru google earth -->
<section class="bg-light text-white mb-0" id="about">
    <div class="map-responsive">
        <iframe src="{{ $university->universityMapsLink }}" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</section>

@endsection