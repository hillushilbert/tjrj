<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use App\Http\Requests\SaveLivroRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Redirect;

class LivroController extends Controller
{
    //

    /**
     * Display the user's profile form.
     */
    public function index(Request $request): Response
    {
        $build = new Livro();
        
        if(!is_null($request->input('search',null))){
            $build = $build->porTexto($request->input('search',null));
        }

        $livros = $build->paginate(5);

        return Inertia::render('Livro/Index', [
            'page' => $livros,
            'filter' => $request->all(),
        ]);
    }

    /**
     * Display the user's profile form.
     */
    public function create(Request $request): Response
    {
        return Inertia::render('Livro/Create', [
            'livro' => new Livro()
        ]);
    }
    
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request, Livro $livro): Response
    {
        return Inertia::render('Livro/Edit', [
            'livro' => $livro,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function store(SaveLivroRequest $request): RedirectResponse
    {
        $livro = Livro::create($request->validated());

        return Redirect::route('livros.index');
    }

    /**
     * Update the user's profile information.
     */
    public function update(SaveLivroRequest $request, $id): RedirectResponse
    {
        $livro = Livro::findOrFail($id);
        $livro->update($request->validated());

        return Redirect::route('livros.index');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request, $id): RedirectResponse
    {
        Livro::destroy($id);

        return Redirect::route('livros.index');
    }
}
