<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveAutorRequest;
use App\Models\Assunto;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Redirect;

class AssuntoController extends Controller
{
    //
    /**
     * Display the user's profile form.
     */
    public function index(Request $request): Response
    {
        $build = new Assunto();
        
        if(!is_null($request->input('search',null))){
            $build = $build->porTexto($request->input('search',null));
        }

        $assuntos = $build->paginate(5);

        return Inertia::render('Assunto/Index', [
            'page' => $assuntos,
            'filter' => $request->all(),
        ]);
    }

    /**
     * Display the user's profile form.
     */
    public function create(Request $request): Response
    {
        return Inertia::render('Autor/Create', [
            'assunto' => new Assunto()
        ]);
    }
    
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request, Assunto $autor): Response
    {
        return Inertia::render('Assunto/Edit', [
            'assunto' => $autor,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function store(SaveAutorRequest $request): RedirectResponse
    {
        $assunto = Assunto::create($request->validated());

        return Redirect::route('assuntos.index');
    }

    /**
     * Update the user's profile information.
     */
    public function update(SaveAutorRequest $request, $id): RedirectResponse
    {
        $assunto = Assunto::findOrFail($id);
        $assunto->update($request->validated());

        return Redirect::route('assuntos.index');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request, $id): RedirectResponse
    {
        Assunto::destroy($id);

        return Redirect::route('assuntos.index');
    }
}
