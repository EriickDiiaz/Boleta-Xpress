<?php

namespace App\Http\Controllers;

use App\Models\Escuela;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class EscuelaController extends Controller
{
    public function index()
    {
        $escuelas = Escuela::all();
        return view('escuelas.index', compact('escuelas'));
    }

    public function create()
    {
        return view('escuelas.create');
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateEscuela($request);
        
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logos', 'public');
            $validatedData['logo'] = $path;
        }

        $escuela=Escuela::create($validatedData);

        return redirect()->route('escuelas.show', $escuela->id)->with('mensaje', 'Se ha agregado la nueva Escuela con éxito.');
    }

    public function show(Escuela $escuela)
    {
        return view('escuelas.show', compact('escuela'));
    }


    public function edit($id)
    {
        $escuela = Escuela::findOrFail($id);
        return view('escuelas.edit', compact('escuela'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $this->validateEscuela($request, $id);
        $escuela = Escuela::findOrFail($id);

        if ($request->hasFile('logo')) {
            if ($escuela->getRawOriginal('logo')) {
                Storage::disk('public')->delete($escuela->getRawOriginal('logo'));
            }
            $path = $request->file('logo')->store('logos', 'public');
            $validatedData['logo'] = $path;
        }

        $escuela->update($validatedData);

        return redirect()->route('escuelas.show', $escuela->id)->with('mensaje', 'Se ha actualizado la Escuela con éxito.');
    }

    public function destroy($id)
    {
        $escuela = Escuela::findOrFail($id);
        if ($escuela->getRawOriginal('logo')) {
            Storage::disk('public')->delete($escuela->getRawOriginal('logo'));
        }
        $escuela->delete();

        return redirect()->route('escuelas.index')->with('mensaje', 'Se ha eliminado la Escuela con éxito.');
    }

    protected function validateEscuela(Request $request, $id = null)
    {
        $rules = [
            'nombre' => 'required|max:255',
            'dea' => ['required', 'max:20', Rule::unique('escuelas')->ignore($id)],
            'territorial' => 'nullable|max:10',
            'director' => 'nullable|max:255',
            'subdirector' => 'nullable|max:255',
            'direccion' => 'nullable|max:255',
            'ciudad' => 'nullable|max:255',
            'telefono' => 'nullable|max:100',
            'correo' => ['nullable', 'email', 'max:255', Rule::unique('escuelas')->ignore($id)],
            'logo' => 'nullable|image|max:2048',
        ];

        $messages = [
            'nombre.required' => 'El Nombre de la Escuela es obligatorio.',
            'nombre.max' => 'El Nombre de la Escuela no puede tener más de 255 caracteres.',
            'dea.required' => 'El Código DEA es obligatorio.',
            'dea.unique' => 'Este Código DEA ya está en uso.',
            'dea.max' => 'El Código DEA no puede tener más de 20 caracteres.',
            'territorial.max' => 'El código Territorial no puede tener más de 10 caracteres.',
            'director.max' => 'El nombre del/la Director(a) de la Escuela no puede tener más de 255 caracteres.',
            'subdirector.max' => 'El nombre del/la Subdirector(a) de la Escuela no puede tener más de 255 caracteres.',
            'direccion.max' => 'La Dirección de la Escuela no puede tener más de 255 caracteres.',
            'ciudad.max' => 'La Ciudad no puede tener más de 255 caracteres.',
            'telefono.max' => 'El Teléfono de la Escuela no puede tener más de 100 caracteres.',
            'correo.email' => 'El Correo Electrónico debe ser una dirección de correo válida.',
            'correo.max' => 'El Correo Electrónico de la Escuela no puede tener más de 255 caracteres.',
            'correo.unique' => 'Este Correo Electrónico ya está en uso.',
            'logo.image' => 'El archivo debe ser una imagen.',
            'logo.max' => 'El tamaño del logo no puede ser mayor a 2MB.',
        ];

        return $request->validate($rules, $messages);
    }
}