<?php

namespace App\Http\Controllers;

use App\Models\Artigo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArtigoController extends Controller
{
    public function index(Request $request)
    {
        $q = Artigo::query()->where('publicado', true)->orderByDesc('publicado_em');

        if ($cat = $request->query('categoria')) {
            $q->where('categoria', $cat);
        }

        return response()->json($q->paginate((int) $request->query('per_page', 12)));
    }

    public function show(string $slug)
    {
        $artigo = Artigo::where('slug', $slug)->firstOrFail();
        return response()->json($artigo);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo' => 'required|string|max:200',
            'slug' => 'nullable|string|max:200|unique:artigos,slug',
            'categoria' => 'nullable|string|max:100',
            'resumo' => 'nullable|string|max:500',
            'conteudo' => 'required|string',
            'imagem' => 'nullable|string|max:500',
            'autor' => 'nullable|string|max:150',
            'publicado' => 'nullable|boolean',
        ]);

        $data['slug'] = $data['slug'] ?? Str::slug($data['titulo']);
        $data['publicado'] = $data['publicado'] ?? true;
        $data['publicado_em'] = now();

        $artigo = Artigo::create($data);

        return response()->json($artigo, 201);
    }

    public function update(Request $request, string $slug)
    {
        $artigo = Artigo::where('slug', $slug)->firstOrFail();

        $data = $request->validate([
            'titulo' => 'sometimes|string|max:200',
            'slug' => 'sometimes|string|max:200|unique:artigos,slug,'.$artigo->id,
            'categoria' => 'sometimes|string|max:100',
            'resumo' => 'nullable|string|max:500',
            'conteudo' => 'sometimes|string',
            'imagem' => 'nullable|string|max:500',
            'autor' => 'nullable|string|max:150',
            'publicado' => 'nullable|boolean',
        ]);

        $artigo->update($data);
        return response()->json($artigo);
    }

    public function destroy(string $slug)
    {
        Artigo::where('slug', $slug)->firstOrFail()->delete();
        return response()->json(['ok' => true]);
    }
}
