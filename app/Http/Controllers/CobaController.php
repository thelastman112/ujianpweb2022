<?php

namespace App\Http\Controllers;

use App\Models\Coba;
use Illuminate\Http\Request;

class CobaController extends Controller
{
    function index()
    {
        $coba = Coba::all();
        return view('coba', ['coba' => $coba]);
    }

    function store(Request $request)
    {
        // dd($request);
        // $coba = new Coba();
        // $coba->coba = $request->coba;
        // $coba->save();

        Coba::create($request->all());
        return redirect('/coba');
    }

    function edit($id)
    {
        $coba = Coba::find($id);
        return view('coba_edit', ['coba' => $coba]);
    }

    function update(Request $request, $id)
    {
        $coba = Coba::find($id);
        $coba->update($request->all());
        return redirect()->route('coba.index');
    }

    function destroy($id)
    {
        $coba = Coba::find($id);
        $coba->delete();
        return redirect()->route('coba.index');
    }
}
