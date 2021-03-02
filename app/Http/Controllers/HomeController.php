<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
    public function data()
    {
        $datasurvey = Survey::all();
        return view('survey.data-survey', compact('datasurvey'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'lng' => 'required',
            'lat' => 'required',
            'nama' => 'required',
            'kategori' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'kelurahan' => 'required',
            'kecamatan' => 'required',
            'pic1' => 'required',
            'pic2' => 'required',
            'telp1' => 'required',
            'telp2' => 'required',
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
                'lng' => $request->lng,
                'lat' => $request->lat,
                'nama' => $request->nama,
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
                'tgl' => $request->tgl,
                'foto1' => $imgName,
                'foto2' => $imgName2,
            ]
        );

        return redirect('livewire.data-survey');
    }
}
