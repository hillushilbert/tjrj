<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use App\Http\Requests\SaveLivroRequest;
use App\Http\Resources\LivroResource;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
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
        $livroResource = new LivroResource($livro);
        return Inertia::render('Livro/Edit', [
            'data' => $livroResource,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function store(SaveLivroRequest $request): RedirectResponse
    {
        try
        {
            DB::beginTransaction();
            $livro = Livro::create($request->validated());

            $livro->autores()->detach();
            $livro->autores()->attach($request->autores);
            DB::commit();
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            return redirect()->back()->withErrors(['Titulo'=>[$e->getMessage()]]);
        }

        return Redirect::route('livros.index');
    }

    /**
     * Update the user's profile information.
     */
    public function update(SaveLivroRequest $request, $id): RedirectResponse
    {
        try
        {
            DB::beginTransaction();
            $livro = Livro::findOrFail($id);
            $livro->update($request->validated());

            $livro->autores()->detach();
            $livro->autores()->attach($request->autores);
            DB::commit();
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            return redirect()->back()->withErrors(['Titulo'=>[$e->getMessage()]]);
        }

        return Redirect::route('livros.index');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request, $id): RedirectResponse
    {
        try
        {
            DB::beginTransaction();
            $livro = Livro::findOrFail($id);
            $livro->autores()->detach();
            Livro::destroy($id);
            DB::commit();
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            return redirect()->back()->withErrors(['Titulo'=>[$e->getMessage()]]);
        }

        return Redirect::route('livros.index');
    }
    
}
