<?php

namespace Database\Seeders;

use App\Models\Document;
use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    public function run()
    {
        Document::create([
            'title' => 'Godišnji izveštaj za 2024. godinu',
            'file_path' => 'documents/godisnji-izvestaj-2024.pdf',
            'category' => 'Godišnji izveštaji',
            'description' => 'Detaljan izveštaj o radu ustanove za 2024. godinu',
            'display_order' => 1,
            'is_public' => true
        ]);

        Document::create([
            'title' => 'Javna nabavka opreme 2024',
            'file_path' => 'documents/javna-nabavka-2024.pdf',
            'category' => 'Javne nabavke',
            'description' => 'Dokumentacija za javnu nabavku opreme u 2024. godini',
            'display_order' => 1,
            'is_public' => true
        ]);
    }
}
