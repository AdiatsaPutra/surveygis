<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('survey.add-survey');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function data(Request $request)
    {
        $survey = Survey::when($request->keyword, function ($query) use ($request) {
            $query->where('namalokasi', 'like', "%{$request->keyword}%")
                ->orWhere('kategori', 'like', "%{$request->keyword}%");
        })->paginate(5);
        return view('survey.data-survey', compact('survey'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'lng' => 'required',
            'lat' => 'required',
            'namalokasi' => 'required',
            'kategori' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'kelurahan' => 'required',
            'kecamatan' => 'required',
            'pic1' => 'required',
            'telp1' => 'required',
            'namasurveyor' => 'required',
            'tgl' => 'required',
            'foto1' => 'required|file',
            'foto2' => 'required|file',
        ]);

        $extension = $request->file('foto1')->extension();
        $extension2 = $request->file('foto2')->extension();
        $random = Str::random(10);
        $random2 = Str::random(10);
        $imgName = $random . '.' . $extension;
        $imgName2 = $random2 . '.' . $extension2;

        Storage::putFileAs('public/images', $request->file('foto1'), $imgName);
        Storage::putFileAs('public/images', $request->file('foto2'), $imgName2);

        Survey::create(
            [
                'lattitude' => $request->lat,
                'longtitude' => $request->lng,
                'namalokasi' => $request->namalokasi,
                'kategori' => $request->kategori,
                'rt' => $request->rt,
                'rw' => $request->rw,
                'kelurahan' => $request->kelurahan,
                'kecamatan' => $request->kecamatan,
                'pic1' => $request->pic1,
                'pic2' => $request->pic2,
                'telp1' => $request->telp1,
                'telp2' => $request->telp2,
                'namasurveyor' => $request->namasurveyor,
                'tanggal' => $request->tgl,
                'fotolokasi1' => $imgName,
                'fotolokasi2' => $imgName2,
            ]
        );

        return redirect('/data-survey');
    }

    public function showModal($id)
    {
        $survey = Survey::findOrFail($id);
        return view('survey.data-table', compact('survey'));
    }

    public function destroy($id)
    {
        $survey = Survey::findOrFail($id);
        $survey->delete();
        return redirect('/data-survey');
    }

    public function edit($id)
    {
        $survey = Survey::findOrFail($id);
        return view('survey.edit-survey', compact('survey'));
    }

    public function print($id)
    {
        $survey = Survey::findOrFail($id);
        return view('survey.cetak', compact('survey'));
    }

    public function update(Request $request, $id)
    {
        $updateData = $request->validate([
            'lng' => 'required',
            'lat' => 'required',
            'namalokasi' => 'required',
            'kategori' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'kelurahan' => 'required',
            'kecamatan' => 'required',
            'pic1' => 'required',
            'telp1' => 'required',
            'namasurveyor' => 'required',
            'tgl' => 'required',
            'foto1' => 'required|file',
            'foto2' => 'required|file',
        ]);

        $extension = $request->file('foto1')->extension();
        $extension2 = $request->file('foto2')->extension();
        $random = Str::random(10);
        $random2 = Str::random(10);
        $imgName = $random . '.' . $extension;
        $imgName2 = $random2 . '.' . $extension2;

        Storage::putFileAs('public/images', $request->file('foto1'), $imgName);
        Storage::putFileAs('public/images', $request->file('foto2'), $imgName2);

        Survey::whereId($id)->update($updateData);

        return redirect('/datasurvey');
    }
}
