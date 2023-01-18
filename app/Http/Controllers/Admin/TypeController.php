<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::all();
        return view('admin.types.index', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $val_data = $request->validate([
            'name' => ['required', 'unique:types']
        ]);
        $val_data['slug'] = Str::slug($val_data['name'], '-');
        $type = Type::create($val_data);
        return redirect()->back()->with('message', "Tipo $type->name creato con successo");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Type $type
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        return view('admin.types.show', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Type $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type)
    {
        $val_data = $request->validate([
            'name' => ['required', Rule::unique('types')->ignore($type)]
        ]);
        $val_data['slug'] = Str::slug($val_data['name']);
        $type->update($val_data);
        return redirect()->back()->with('message', "Tipo $type->name aggiornato con successo");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Type $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        $type->delete();
        return redirect()->back()->with('message', "Tipo $type->name cancellato");
    }
}
