@extends('layout.theme')

@section('content')

<section name="universitydata" id="universitydata" class="masthead page-section">
    <div class="container text-center">

    	@if(session('message') && session('type') && session('title'))
            <div class="container text-center" style="max-width: 50rem">
                <div class="alert alert-{{ session('type') }}" role="alert">
                    <h2 class="alert-heading">{{ session('title') }}</h2>
                    <h5>{{ session('message') }}</h5>
                </div>
            </div>
        @endif
        
    	@if($university->universityAcceptance == 1)

    		<h3 class="text-primary"> Dosare adaugate - {{ $university->universityName }} </h3>
	        <p class="text-secondary"> In momentul de fata sunt {{ $schedules->count() }} dosare in curs. </p>
	            <table class="table">
	            <thead>
	             <tr>
	                <th scope="col">#</th>
	                <th scope="col">Numele</th>
	                <th scope="col">E-Mail</th>
	                <th scope="col">Nr. de tel</th>
	                <th scope="col">Cod</th>
	                <th scope="col">Universitatea</th>
	                <th scope="col">Actiuni</th>
	            </tr>
	            </thead>
	            <tbody>

	            @foreach($schedules as $schedule)
	            	<tr>

	            		<th scope="row">#{{ $schedule->scheduleID }}</th>
	            		<td>{{ $schedule->scheduleName }}</td>
	            		<td>{{ $schedule->scheduleMail }}</td>
	            		<td>{{ $schedule->schedulePhone }}</td>
	            		<td>{{ $schedule->scheduleCode }}</td>
	            		<td>{{ $university->universityName }}</td>

	            		<td>
	            			<form action="{{ route('university.schedule.delete') }}" method="POST">
	            				@csrf

	            				<button type="submit" class="btn btn-danger">Remove</button>
	            				<input type="hidden" name="scheduleID" id="scheduleID" value="{{ $schedule->scheduleID }}">
	            				<input type="hidden" name="universityID" id="universityID" value="{{ $schedule->scheduleUniversity }}">
	            			</form>
	            		</td>

	            	</tr>
	            @endforeach
	        </tbody>
	        </table>

    	@else

    		<h3 class="text-primary"> Programari admitere - {{ $university->universityName }} </h3>
	        <p class="text-secondary"> In momentul de fata sunt {{ $schedules->count() }} programari create. </p>
	            <table class="table">
	            <thead>
	             <tr>
	                <th scope="col">#</th>
	                <th scope="col">Numele</th>
	                <th scope="col">E-Mail</th>
	                <th scope="col">Nr. de tel</th>
	                <th scope="col">Universitatea</th>
	                <th scope="col">Actiuni</th>
	            </tr>
	            </thead>
	            <tbody>

	            @foreach($schedules as $schedule)
	            	<tr>

	            		<th scope="row">#{{ $schedule->scheduleID }}</th>
	            		<td>{{ $schedule->scheduleName }}</td>
	            		<td>{{ $schedule->scheduleMail }}</td>
	            		<td>{{ $schedule->schedulePhone }}</td>
	            		<td>{{ $university->universityName }}</td>
	            		<td>
	            			<form action="{{ route('university.scheduleA.delete') }}" method="POST">
	            				@csrf

	            				<button type="submit" class="btn btn-danger">Remove</button>
	            				<input type="hidden" name="scheduleID" id="scheduleID" value="{{ $schedule->scheduleID }}">
	            				<input type="hidden" name="universityID" id="universityID" value="{{ $schedule->scheduleUniversity }}">
	            			</form>
	            		</td>

	            	</tr>
	            @endforeach
	        </tbody>
	        </table>
    	@endif

    	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

    </div>
</section>

@endsection