<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\SearchRequest;
use App\Http\Requests\ReviewRequest;
use App\Http\Requests\ScheduleRequest;
use App\Http\Requests\Schedule2Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Cities;
use App\Models\Review;
use App\Models\Reviewcodes;
use App\Models\Specialities;
use App\Models\Universities;
use App\Models\Schedulelist;
use App\Models\Schedulelist2;

class HomeController extends Controller
{
    public function homePage()
    {
    	$homepage = cache()->remember('homepage', 60, function()
    	{
    		$data = [];
    		$data['cities'] = Cities::all();
    		$data['specialities'] = Specialities::all();
    		$data['universities'] = Universities::all();
            $data['reviews'] = Review::all();

    		return (object) $data;
    	});

    	return view('home', compact('homepage'));
    }

    public function universitySchedules(Universities $universityID)
    {
        if($universityID->universityAcceptance == 1)
            $schedules = Schedulelist::orderBy('scheduleID', 'desc')->limit(50)->get();

        else
            $schedules = Schedulelist2::orderBy('scheduleID', 'desc')->limit(50)->get();

        return view('schedules', ['university' => $universityID, 'schedules' => $schedules]);
    }

    public function universityScheduleADelete(Request $request)
    {
        if(auth()->user()->access != $request->universityID)
            return redirect()->back()->with(['message' => "Nu esti autorizat sa faci acest lucru.", 'type' => "danger", 'title' => "Oops.."]);

        $schedule = Schedulelist2::find($request->scheduleID);
        $schedule->delete();

        return redirect()->route('university.schedules', $request->universityID)->with(['message' => "Programare stersa cu succes !", 'type' => "success", "title" => "Succes !"]);
    }

    public function universityScheduleDelete(Request $request)
    {
        if(auth()->user()->access != $request->universityID)
            return redirect()->back()->with(['message' => "Nu esti autorizat sa faci acest lucru.", 'type' => "danger", 'title' => "Oops.."]);

        $schedule = Schedulelist::find($request->scheduleID);
        $schedule->delete();

        return redirect()->route('university.schedules', $request->universityID)->with(['message' => "Dosar sters cu succes !", 'type' => "success", "title" => "Succes !"]);
    }

    public function addUniversity()
    {
        $cities = Cities::all();
        $specialities = Specialities::all();
        return view('adduniversity', compact("specialities", 'cities'));
    }

    public function universityScheduleFilePost(ScheduleRequest $request)
    {
        $validated = $request->validated();

        $universityInstance = Universities::where('universityID', $validated['university'])->first();
        if($universityInstance->count() < 1)
            return redirect()->route('home')->with(['message' => "Ai introdus o facultate invalida.", 'type' => 'danger', 'title' => 'Oops..']);

        $scheduleSearch = Schedulelist::where('scheduleUniversity', $validated['university'])->where('scheduleCode', $validated['code'])->get();
        if($scheduleSearch->count() > 0)
            return redirect()->route('home')->with(['message' => "Ti-ai inscris deja dosarul la aceasta facultate.", 'type' => 'danger', 'title' => 'Oops..']);

        $schedule = Schedulelist::create([
            'scheduleUniversity' => $validated['university'],
            'scheduleName' => $validated['name'],
            'scheduleMail' => $validated['mail'],
            'schedulePhone' => $validated['phone'],
            'scheduleCode' => $validated['code']
        ]);

        $code = Str::random(7);
        $dbCode = Reviewcodes::create([
            'codeValue' => $code,
            'codeActive' => 1
        ]);

        return redirect()->route('home')->with(['message' => "Ti-ai depus dosarul cu succes la facultatea " . $universityInstance->universityName . ". <br>Ne poti lasa un review pe baza codului: " . $code, 'type' => 'success', 'title' => "Felicitari !"]);
    }

    /*public function addUniversityPost(Request $request)
    {
        $university = Universities::create([
            'universityName' => $request->name,
            'universitySpeciality' => $request->speciality,
            'universityCity' => $request->city,
            'universityAcceptance' => $request->acceptance,
            'universityScheduleListState' => 1,
            'universityDetails' => $request->details,
            'universityLink' => $request->link,
            'universityMapsLink' => $request->linkg
        ]);

        $image = Storage::disk('public')->putFileAs('assets/img/university', $request->file('file'), $university->universityID . ".jpg");

        return redirect()->back()->with(['message' => "Facultatea " . $request->name . " a fost creata cu succes !", 'type' => "success", 'title' => "Felicitari !"]);
    }*/

    public function addCityPost(Request $request)
    {
        $city = Cities::create([
            'cityName' => $request->city
        ]);

        return redirect()->back()->with(['message' => "Orasul " . $request->city . " a fost creat cu succes !", 'type' => "success", 'title' => "Felicitari !"]);
    }

    public function addSpeciality(Request $request)
    {
        $speciality = Specialities::create([
            'specialityName' => $request->speciality
        ]);

        return redirect()->back()->with(['message' => "Specializarea " . $request->speciality . " a fost creata cu succes !", 'type' => "success", 'title' => "Felicitari !"]);
    }

    public function universityScheduleFile(Universities $universityID)
    {
        if($universityID->universityScheduleListState == 0)
            return redirect()->route('home')->with(['message' => "Ne pare rau, dar " . $universityID->universityName . " nu are inregistrarea dosarelor activa.", 'type' => "danger", 'title' => 'Oops..']);

        return view('schedulelist', ['university' => $universityID]);
    }

    public function universitySchedulePost(Schedule2Request $request)
    {
        $validated = $request->validated();

        $universityInstance = Universities::where('universityID', $validated['university'])->first();
        if($universityInstance->count() < 1)
            return redirect()->route('home')->with(['message' => "Ai introdus o facultate invalida.", 'type' => 'danger', 'title' => 'Oops..']);

        $code = Str::random(7);
        $dbCode = Reviewcodes::create([
            'codeValue' => $code,
            'codeActive' => 1
        ]);

        $scheduleSearch = Schedulelist2::where('scheduleUniversity', $validated['university'])->where('scheduleName', $validated['name'])->get();
        if($scheduleSearch->count() > 0)
            return redirect()->route('home')->with(['message' => "Te-ai programat deja la admitere.", 'type' => 'danger', 'title' => 'Oops..']);

        $schedule = Schedulelist2::create([
            'scheduleUniversity' => $validated['university'],
            'scheduleName' => $validated['name'],
            'scheduleMail' => $validated['mail'],
            'schedulePhone' => $validated['phone']
        ]);

        return redirect()->route('home')->with(['message' => "Te-ai programat la admiterea facultatii " . $universityInstance->universityName . ". <br>Ne poti lasa un review pe baza codului: " . $code, 'type' => 'success', 'title' => "Felicitari !"]);
    }

    public function reviewWrite()
    {
        return view('reviewwrite');
    }

    public function reviewPost(ReviewRequest $request)
    {
        $validated = $request->validated();

        $codeInstance = Reviewcodes::where('codeValue', $validated['code'])->where('codeActive', 1)->get();
        if($codeInstance->count() < 1)
            return redirect()->route('review.write')->with(['message' => "Ai introdus un cod invalid.", 'type' => 'danger', 'title' => 'Oops..']);

        $review = Review::create([
            'reviewName' => $validated['name'],
            'reviewText' => $validated['text']
        ]);

        $code = Reviewcodes::find($codeInstance->first()->codeID);
        $code->delete();

        return redirect()->route('review.write')->with(['message' => "Multumim pentru review ! Parerea ta este foarte importanta pentru noi.", 'type' => "success", 'title' => "Multumim !"]);
    }

    public function universitySchedule(Universities $universityID)
    {
        if($universityID->universityScheduleListState == 0)
            return redirect()->route('home')->with(['message' => "Ne pare rau, dar " . $universityID->universityName . " nu are programarea admiterilor activa.", 'type' => "danger", 'title' => 'Oops..']);

        return view('schedule', ['university' => $universityID]);
    }

    public function redirectToHome()
    {
    	return redirect()->route('home');
    }

    public function universitiesPage()
    {
    	return view('universities', ['universities' => Universities::all()]);
    }

    public function universityView($universityID)
    {
        $university = cache()->remember('university' . $universityID, 60, function() use ($universityID)
        {
            return Universities::where('universityID', $universityID)->firstOrFail();
        });

        return view('university', compact('university'));
    }

    public function universitySearch(SearchRequest $request)
    {
    	$validated = $request->validated();

    	$lastCityInstance = Cities::orderBy('cityID', 'desc')->limit(1)->get();
    	if((int) $validated['city'] > $lastCityInstance[0]->cityID)
    		return redirect()->back()->with(['message' => "Ai facut ceva incorect.", 'type' => "danger", 'title' => "Oops..."]);

    	$lastSpecialityInstance = Specialities::orderBy('specialityID', 'desc')->limit(1)->get();
    	if((int) $validated['speciality'] > $lastSpecialityInstance[0]->specialityID)
    		return redirect()->back()->with(['message' => "Ai facut ceva incorect.", 'type' => "danger", 'title' => "Oops..."]);

    	if((int) $validated['acceptance'] == 0)
    		$universities = Universities::where('universityCity', $validated['city'])->where('universitySpeciality', $validated['speciality'])->get();

    	else
    		$universities = Universities::where('universityCity', $validated['city'])->where('universitySpeciality', $validated['speciality'])->where('universityAcceptance', $validated['acceptance'])->get();

    	if($universities->count() < 1)
    		return redirect()->back()->with(['message' => "Din pacate nu am gasit nicio facultate dupa criteriile tale.", 'type' => "danger", 'title' => "Oops..."]);

    	return view('search', compact('universities'));
    }
}
