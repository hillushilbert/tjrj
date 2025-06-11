<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveAutorRequest;
use App\Models\Autor;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Redirect;

class AutorController extends Controller
{
    //

    /**
     * Display the user's profile form.
     */
    public function index(Request $request): Response
    {
        $build = new Autor();
        
        if(!is_null($request->input('search',null))){
            $build = $build->porNome($request->input('search',null));
        }

        $autores = $build->paginate(5);

        return Inertia::render('Autor/Index', [
            'page' => $autores,
            'filter' => $request->all(),
        ]);
    }

    /**
     * Display the user's profile form.
     */
    public function create(Request $request): Response
    {
        return Inertia::render('Autor/Create', [
            'autor' => new Autor()
        ]);
    }
    
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request, Autor $autor): Response
    {
        return Inertia::render('Autor/Edit', [
            'autor' => $autor,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function store(SaveAutorRequest $request): RedirectResponse
    {
        $autor = Autor::create($request->validated());

        return Redirect::route('autores.index');
    }

    /**
     * Update the user's profile information.
     */
    public function update(SaveAutorRequest $request, $id): RedirectResponse
    {
        $autor = Autor::findOrFail($id);
        $autor->update($request->validated());

        return Redirect::route('autores.index');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request, $id): RedirectResponse
    {
        Autor::destroy($id);

        return Redirect::route('autores.index');
    }
}
