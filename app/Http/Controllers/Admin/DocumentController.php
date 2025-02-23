<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::orderBy('category')
            ->orderBy('display_order')
            ->get();
        return view('admin.documents.index', compact('documents'));
    }

    public function create()
    {
        $categories = ['Godišnji izveštaji', 'Javne nabavke'];
        return view('admin.documents.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'category' => 'required|in:Godišnji izveštaji,Javne nabavke',
            'description' => 'nullable|max:1000',
            'file' => 'required|mimes:pdf|max:10240', // max 10MB
            'display_order' => 'required|integer|min:0',
        ]);

        $file = $request->file('file');
        $path = $file->store('documents', 'public');

        Document::create([
            'title' => $request->title,
            'category' => $request->category,
            'description' => $request->description,
            'file_path' => $path,
            'display_order' => $request->display_order,
            'is_public' => $request->boolean('is_public')
        ]);

        return redirect()
            ->route('admin.documents.index')
            ->with('success', 'Dokument je uspešno dodat.');
    }

    public function edit(Document $document)
    {
        $categories = ['Godišnji izveštaji', 'Javne nabavke'];
        return view('admin.documents.edit', compact('document', 'categories'));
    }

    public function update(Request $request, Document $document)
    {
        $request->validate([
            'title' => 'required|max:255',
            'category' => 'required|in:Godišnji izveštaji,Javne nabavke',
            'description' => 'nullable|max:1000',
            'file' => 'nullable|mimes:pdf|max:10240', // max 10MB
            'display_order' => 'required|integer|min:0',
        ]);

        if ($request->hasFile('file')) {
            // Brisanje starog fajla
            Storage::disk('public')->delete($document->file_path);
            
            // Upload novog fajla
            $file = $request->file('file');
            $path = $file->store('documents', 'public');
            $document->file_path = $path;
        }

        $document->update([
            'title' => $request->title,
            'category' => $request->category,
            'description' => $request->description,
            'display_order' => $request->display_order,
            'is_public' => $request->boolean('is_public')
        ]);

        return redirect()
            ->route('admin.documents.index')
            ->with('success', 'Dokument je uspešno ažuriran.');
    }

    public function destroy(Document $document)
    {
        // Brisanje fajla
        Storage::disk('public')->delete($document->file_path);
        
        // Brisanje zapisa iz baze
        $document->delete();

        return redirect()
            ->route('admin.documents.index')
            ->with('success', 'Dokument je uspešno obrisan.');
    }
}
