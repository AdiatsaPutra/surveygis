<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;
use PDF;

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

    public function generatePDF(Request $request)
    {

        $survey = Survey::all();
        $pdf = PDF::loadView('survey.download-data', compact('survey'))->setPaper('a4', 'landscape');
        return $pdf->stream();
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
                ->orWhere('kategori', 'like', "%{$request->keyword}%")
                ->orWhere('kelurahan', 'like', "%{$request->keyword}%")
                ->orWhere('rw', 'like', "%{$request->keyword}%");
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
        ]);

        $survey = new Survey;
        $survey->lattitude = $request->lat;
        $survey->longtitude = $request->lng;
        $survey->namalokasi = $request->namalokasi;
        $survey->kategori = $request->kategori;
        $survey->rt = $request->rt;
        $survey->rw = $request->rw;
        $survey->kelurahan = $request->kelurahan;
        $survey->kecamatan = $request->kecamatan;
        $survey->pic1 = $request->pic1;
        $survey->pic2 = $request->pic2;
        $survey->telp1 = $request->telp1;
        $survey->telp2 = $request->telp2;
        $survey->namasurveyor = $request->namasurveyor;
        $survey->tanggal = $request->tgl;
        $survey->save();

        if ($request->hasFile('foto')) {
            $files = $request->file('foto');
            foreach ($files as $file) {
                $name = Str::random(10);
                $extension = $file->getClientOriginalName();
                $fileName = $file->getClientOriginalExtension();
                $imgName = $fileName . $name . '.' . $extension;
                Storage::putFileAs('public/images', $file, $imgName);
                $foto = new foto;
                $foto->path = $imgName;
                $foto->survey_id = $survey->id;
                $foto->survey()->associate($survey);
                $foto->save();
            }
        }
        return redirect('data-survey');
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

    public function show($id)
    {
        $survey = Survey::findOrFail($id);
        return view('survey.detail', compact('survey'));
    }

    public function print($id)
    {
        $survey = Survey::findOrFail($id);
        return view('survey.cetak', compact('survey'));
    }

    public function update(Request $request, $id)
    {
        // $updateData = $request->validate([
        //     'lng' => 'required',
        //     'lat' => 'required',
        //     'namalokasi' => 'required',
        //     'kategori' => 'required',
        //     'rt' => 'required',
        //     'rw' => 'required',
        //     'kelurahan' => 'required',
        //     'kecamatan' => 'required',
        //     'pic1' => 'required',
        //     'telp1' => 'required',
        //     'namasurveyor' => 'required',
        //     'tgl' => 'required',
        //     'foto1' => 'required|file',
        //     'foto2' => 'required|file',
        // ]);

        // $extension = $request->file('foto1')->extension();
        // $extension2 = $request->file('foto2')->extension();
        // $random = Str::random(10);
        // $random2 = Str::random(10);
        // $imgName = $random . '.' . $extension;
        // $imgName2 = $random2 . '.' . $extension2;

        // Storage::putFileAs('public/images', $request->file('foto1'), $imgName);
        // Storage::putFileAs('public/images', $request->file('foto2'), $imgName2);

        // Survey::whereId($id)->update($updateData);
        $survey = Survey::findOrFail($id);
        $survey->update($request->all());
        return redirect('/data-survey');
    }
}
