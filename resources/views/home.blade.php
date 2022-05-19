@extends('layout.theme')

@section('content')

<!-- Configurator section-->
<section class="page-section select" id="acasa">
    <div class="container d-flex align-items-center flex-column">
        @if(session('type') == "success")
        @else
            <h2 class="page-section-heading text-center text-uppercase mb-0">Cautare</h2>
        @endif
        <div class="divider-custom">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
        </div>

        @if(session('message') && session('type') && session('title'))
            <div class="container text-center" style="max-width: 50rem">
                <div class="alert alert-{{ session('type') }}" role="alert">
                    <h2 class="alert-heading">{{ session('title') }}</h2>
                    <h5>{!! session('message') !!}</h5>
                </div>
            </div>
        @endif

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

    @if(session('type') == "success")

    <p class="h4 mb-2">Te rugăm să selectezi orașul, specialitate și facultatea.</p>
    
    </br>
    <a class="btn btn-primary btn-lg" href="{{ route('review.write') }}">
        Lasa un review !
    </a>

    @else

        <p class="h4 mb-2">Te rugăm să selectezi orașul, specialitate și facultatea.</p>
        </br>
        <form style="width:60%;max-width:90%;" class="text-center d-flex flex-column" action="{{ route('universitySearch') }}" method="POST">
            @csrf
            <select class="form-control text-center form-select-lg mb-3" id="city" name="city" style="width:100%;max-width:100%;" required=""> 
                <option selected>Alege orasul</option>

                @foreach($homepage->cities as $city)
                    <option id="{{ $city->cityID }}" value="{{ $city->cityID }}">{{ $city->cityName }}</option>
                @endforeach

            </select>

            <select class="form-control text-center form-select-lg mb-3" id="speciality" name="speciality" style="width:100%;max-width:100%; display:none;" required>
            </select>

            <select class="form-control text-center form-select-lg mb-3" id="acceptance" name="acceptance" style="width:100%;max-width:100%; display:none;" required>
            </select>

            <button style="display:none;" type="submit" name="search" id="search" value="0" class="btn btn-primary btn-lg">Cauta !</button>
        </form>

    @endif
    </div>
</section>

<section class="page-section mb-0 bg-secondary" id="carousel">
    <div id="carouselReview" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <h2 class="page-section-heading text-center text-white text-uppercase mb-0">Lasati-ne un review !</h2>
            <div class="divider-custom divider-light">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            
            <div class="carousel-item active" data-bs-interval="5000">
                <div class="bg-secondary" style="width: 100%; height: 20rem;"></div>
                <div class="carousel-caption">
                    <h2>Parerea voastra conteaza !</h2>
                    <h5>Nu ezitati sa impartasiti cu noi parerile voastre !</h5>
                </div>
            </div>

            @foreach($homepage->reviews as $review)

                <div class="carousel-item" data-bs-interval="3000">
                    <div class="bg-secondary" style="width: 100%; height: 20rem;"></div>
                    <div class="carousel-caption">
                        <img class="pb-3" style="width: 200px; height: 200px;" src="{{ asset('assets/img/avatar.png') }}"><br>
                        <h2>{{ $review->reviewName }}:</h2>
                        <h5>{{ $review->reviewText }}</h5>
                    </div>
                </div>

            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselReview" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselReview" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>

<!-- About Section-->
<section class="page-section mb-0 bg-primary" id="about">
    <div class="container">
        <h2 class="page-section-heading text-center text-white text-uppercase">About</h2>

        <div class="divider-custom divider-light">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon">
                <i class="fas fa-star">
                </i>
            </div>

            <div class="divider-custom-line"></div>
        </div>

        <p class="lead text-white text-center">
            Cauti o facultate? <br>
            Nu esti hotarat? <br>
            Site-ul nostru te va ajuta sa iti gasesti facultatea potrivita ! <br>
            Iti venim in ajutor pentru a-ti usura munca, pentru a-ti alege viitorul !
        </p>

    </div>
</section>

@endsection

@section('script')

<script> 
    (function ($) {
    $('#city').change(function() {
        var options = '';
        options = '<option id="0" value="0">Alege Specialitate</option>';

        @foreach($homepage->specialities as $speciality)

            options += '<option id="{{ $speciality->specialityID }}" value="{{ $speciality->specialityID }}">{{ $speciality->specialityName }}</option>';

        @endforeach

        $('#speciality').html(options).show();
        $('#acceptance').hide();
        $('#search').hide();
    });

    $('#speciality').change(function() {
        var options = '';

        options += '<option id="0" value="0">Admitere Cu Dosar + Admitere Cu Examen Admitere</option>';
        options += '<option id="1" value="1">Admitere Cu Dosar</option>';
        options += '<option id="2" value="2">Admitere Cu Examen Admitere</option>';

        $('#acceptance').html(options).show();
        $('#search').show();
    });

    $('#acceptance').change(function() {
        $('#search').show();  
    });

    })(jQuery);
</script>

@endsection

@section('centerimage')

<header class="masthead bg-primary text-white text-center">
    <div class="container d-flex align-items-center flex-column">
        <!-- Masthead Avatar Image-->
        <img class="masthead-avatar mb-5" src="{{ asset('assets/img/avataaars.svg') }}" alt="..." />
        <!-- Masthead Heading-->
        <h1 class="masthead-heading text-uppercase mb-0">{{ config('app.name', 'Laravel') }}</h1>
        <!-- Icon Divider-->
        <div class="divider-custom divider-light">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <!-- Masthead Subheading-->
        <p class="masthead-subheading font-weight-light mb-0">Noi suntem raspunsul alegerilor tale.</p>
    </div>
</header>

@endsection