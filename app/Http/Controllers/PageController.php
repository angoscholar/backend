<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return response()->json(Page::orderBy('slug')->get());
    }

    public function show(string $slug)
    {
        return response()->json(Page::where('slug', $slug)->firstOrFail());
    }

    public function update(Request $request, string $slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();

        $data = $request->validate([
            'titulo' => 'sometimes|string|max:200',
            'meta_description' => 'nullable|string|max:500',
            'conteudo' => 'sometimes|string',
        ]);

        $page->update($data);
        return response()->json($page);
    }
}
