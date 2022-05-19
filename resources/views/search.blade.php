@extends('layout.theme')

@section('content')

<!-- Universities Section-->
<section class="page-section universities" id="universities">
    <div class="container">
        <h2 class="page-section-heading text-center text-uppercase mb-0">
        	@if($universities->count() > 0)

        		Tocmai am gasit 

	        	@if($universities->count() == 1)
	        		o facultate
	        	@else
	        		{{ $universities->count() }} facultati
	        	@endif
	        		pentru tine !

        	@else

        	@endif
        </h2>

        <div class="divider-custom divider-light">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
        </div>

        <div class="row justify-content-center">

            @foreach($universities as $university)
            	<div class="col-md-6 col-lg-4 mb-5">
	                <div class="universities-item mx-auto" data-bs-toggle="modal" data-bs-target="#universitiesModal{{ $university->universityID }}">
	                    <div class="universities-item-caption d-flex align-items-center justify-content-center h-100 w-100">
	                        <div class="universities-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
	                    </div>
	                    <img class="img-fluid" src="{{ asset('assets/img/university/' . $university->universityID . '.jpg') }}" alt="..." />
	                    <h4 class="pt-3 text-center text-dark">{{ $university->universityName }}</h4>
	                </div>
	            </div>

	            <div class="universities-modal modal fade" id="universitiesModal{{ $university->universityID }}" tabindex="-1" aria-labelledby="universitiesModal{{ $university->universityID }}" aria-hidden="true">
		            <div class="modal-dialog modal-xl">
		                <div class="modal-content">
		                    <div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button></div>
		                    <div class="modal-body text-center pb-5">
		                        <div class="container">
		                            <div class="row justify-content-center">
		                                <div class="col-lg-8">
		                                    <h2 class="universities-modal-title text-secondary text-uppercase mb-0">{{ $university->universityName }}</h2>

		                                    <div class="divider-custom">
		                                        <div class="divider-custom-line"></div>
		                                        <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
		                                        <div class="divider-custom-line"></div>
		                                    </div>
		                                    <img class="img-fluid rounded mb-5" src="{{ asset('assets/img/university/' . $university->universityID . '.jpg') }}" alt="..." />
		                                    <p class="mb-4">{{ $university->universityDetails }}</p>
		                                    <a href="{{ route('university.view', $university->universityID) }}" class="btn btn-primary">
		                                    	<i class="fas fa-arrow-right fa-fw"></i>
		                                    	Viziteaza facultatea
		                                    </a>
		                                    <button class="btn btn-danger" data-bs-dismiss="modal">
		                                        <i class="fas fa-xmark fa-fw"></i>
		                                        Inchide
		                                    </button>
		                                </div>
		                            </div>
		                        </div>
		                    </div>
		                </div>
		            </div>
		        </div>
            @endforeach
           
        </div>
    </div>
</section>

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