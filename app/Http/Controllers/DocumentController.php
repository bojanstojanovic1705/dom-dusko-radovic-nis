<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index()
    {
        $categories = ['Godišnji izveštaji', 'Javne nabavke'];
        
        $documents = [];
        foreach ($categories as $category) {
            $documents[$category] = Document::public()
                ->byCategory($category)
                ->orderBy('display_order')
                ->get();
        }

        return view('documents.index', compact('documents', 'categories'));
    }

    public function reports()
    {
        $documents = Document::public()
            ->byCategory('Godišnji izveštaji')
            ->orderBy('display_order')
            ->get();

        return view('documents.reports', compact('documents'));
    }

    public function procurement()
    {
        $documents = Document::public()
            ->byCategory('Javne nabavke')
            ->orderBy('display_order')
            ->get();

        return view('documents.procurement', compact('documents'));
    }
}
