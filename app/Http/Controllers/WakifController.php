<?php

namespace App\Http\Controllers;

use App\Models\Wakif;
use Illuminate\Http\Request;

class WakifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Wakif::where('status', 'PAID')->orderBy('paid_at', 'desc')->get();
        return response()->json(['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Wakif $wakif)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Wakif $wakif)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Wakif $wakif)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Wakif $wakif)
    {
        //
    }
}
