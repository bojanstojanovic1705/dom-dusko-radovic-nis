<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\News;
use App\Models\NewsImage;
use Carbon\Carbon;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        $news = [
            [
                'title' => 'Proslava Dana ustanove',
                'excerpt' => 'Uspešno smo proslavili Dan naše ustanove uz bogat kulturno-umetnički program koji su pripremila naša deca.',
                'content' => 'U radosnoj atmosferi, uz prisustvo brojnih zvanica, proslavili smo Dan naše ustanove. Program su pripremila deca uz pomoć vaspitača, a posebno su se istakli muzičke i dramske tačke. Nakon programa, organizovan je koktel za sve prisutne, gde su deca imala priliku da se druže sa gostima i podele svoje utiske o nastupu.',
                'main_image' => 'https://placehold.co/800x400/e9ecef/0d6efd?text=Proslava+Dana+ustanove',
                'published_at' => Carbon::now()->subDays(2),
            ],
            [
                'title' => 'Uspešno završen letnji kamp',
                'excerpt' => 'Naša deca su provela nezaboravne trenutke na dvonedeljnom letnjem kampu na Zlatiboru.',
                'content' => 'Tokom protekle dve nedelje, deca iz naše ustanove boravila su na Zlatiboru gde su učestvovala u brojnim edukativnim i zabavnim aktivnostima. Kamp je obuhvatao sportske aktivnosti, kreativne radionice i časove engleskog jezika. Posebno su bili oduševljeni posetom avantura parku i jahanjem konja.',
                'main_image' => 'https://placehold.co/800x400/e9ecef/0d6efd?text=Letnji+kamp',
                'published_at' => Carbon::now()->subDays(5),
            ],
            [
                'title' => 'Novi kutak za učenje',
                'excerpt' => 'Otvorili smo novi, moderno opremljeni prostor za učenje i razvoj naše dece.',
                'content' => 'Zahvaljujući donacijama naših partnera, uspeli smo da opremimo novi prostor za učenje najsavremenijom opremom. Prostor uključuje računare, interaktivnu tablu i bogatu biblioteku. Ovo će značajno unaprediti kvalitet obrazovanja naše dece i pomoći im u savladavanju školskog gradiva.',
                'main_image' => 'https://placehold.co/800x400/e9ecef/0d6efd?text=Kutak+za+učenje',
                'published_at' => Carbon::now()->subDays(7),
            ],
            [
                'title' => 'Humanitarna akcija za decu',
                'excerpt' => 'Uspešno je sprovedena humanitarna akcija prikupljanja školskog pribora za našu decu.',
                'content' => 'Zahvaljujući velikodušnosti naših sugrađana i lokalnih kompanija, prikupljena je značajna količina školskog pribora za svu decu u našoj ustanovi. Akcija je trajala mesec dana i pokazala je koliko je naša zajednica spremna da pomogne onima kojima je pomoć potrebna.',
                'main_image' => 'https://placehold.co/800x400/e9ecef/0d6efd?text=Humanitarna+akcija',
                'published_at' => Carbon::now()->subDays(10),
            ],
            [
                'title' => 'Kreativna radionica slikanja',
                'excerpt' => 'Organizovali smo kreativnu radionicu slikanja za našu decu uz pomoć lokalnih umetnika.',
                'content' => 'Proteklog vikenda, naša ustanova je ugostila nekoliko lokalnih umetnika koji su održali kreativnu radionicu slikanja za našu decu. Deca su imala priliku da nauče različite tehnike slikanja i izraze svoju kreativnost. Najbolji radovi biće izloženi u holu ustanove.',
                'main_image' => 'https://placehold.co/800x400/e9ecef/0d6efd?text=Kreativna+radionica',
                'published_at' => Carbon::now()->subDays(12),
            ],
        ];

        foreach ($news as $item) {
            $newsItem = News::create([
                'title' => $item['title'],
                'excerpt' => $item['excerpt'],
                'content' => $item['content'],
                'main_image' => $item['main_image'],
                'is_published' => true,
                'published_at' => $item['published_at'],
            ]);

            // Dodajemo dodatne slike za svaku vest
            for ($i = 1; $i <= 3; $i++) {
                NewsImage::create([
                    'news_id' => $newsItem->id,
                    'image_path' => "https://placehold.co/800x400/e9ecef/0d6efd?text=Galerija+{$newsItem->id}-{$i}",
                    'caption' => "Slika {$i} za vest {$newsItem->title}",
                    'sort_order' => $i
                ]);
            }
        }
    }
}
