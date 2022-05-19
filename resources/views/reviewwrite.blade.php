@extends('layout.theme')

@section('content')

<section name="review" id="review" class="masthead page-section">
    <div class="container">
    	<h2 class="page-section-heading text-center text-uppercase mb-0">Review</h2>
        <div class="divider-custom">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
        </div>

       	@if(session('message') && session('type') && session('title'))
            <div class="container text-center" style="max-width: 50rem">
                <div class="alert alert-{{ session('type') }}" role="alert">
                    <h2 class="alert-heading">{{ session('title') }}</h2>
                    <h5>{{ session('message') }}</h5>
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

        <form method="POST" class="text-center" action="{{ route('review.post') }}">
        	@csrf
            <div class="form-group pb-3">
                <label style="margin: auto; display: block; width: 30rem;" for="name">Nume</label>
                <input style="margin: auto; display: block; width: 30rem;" type="text" class="form-control" id="name" name="name" aria-describedby="name" placeholder="Scrie numele complet">
                <small style="margin: auto; display: block; width: 30rem;" id="emailHelp" class="form-text text-muted">Acest nume va fi vazut de toata lumea</small>
            </div>
            <div class="form-group pb-3">
                <label style="margin: auto; display: block; width: 30rem;" for="code">Cod unic</label>
                <input style="margin: auto; display: block; width: 30rem;" type="text" class="form-control" id="code" name="code" placeholder="Introdu codul unic pentru inregistrare">
            </div>
            <div class="form-group pb-3">
                <label style="margin: auto; display: block; width: 30rem;" for="text">Mesaj</label>
                <textarea style="margin: auto; display: block; width: 30rem;" rows="2" cols="25" class="form-control" id="text" name="text" placeholder="Mesaj"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</section>

@endsection