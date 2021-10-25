<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\Tags\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            // Histoire de l'art
            'art' => 'archéologie',
            'art' => 'art du moyen âge',
            'art' => 'art de l’islam',
            'art' => 'art de la renaissance',
            'art' => 'art baroque',
            'art' => 'art moderne',
            'art' => 'art contemporain',
            'art' => 'art brut',
            'art' => 'art naïf',
            // Art movements
            'movement' => 'art cinétique',
            'movement' => 'art conceptuel',
            'movement' => 'art déco',
            'movement' => 'art nouveau',
            'movement' => 'art populaire',
            'movement' => 'abstraction',
            'movement' => 'action painting',
            'movement' => 'bauhaus',
            'movement' => 'cobra',
            'movement' => 'constructivisme',
            'movement' => 'cubisme',
            'movement' => 'dada',
            'movement' => 'de stilj',
            'movement' => 'der blaue reiter',
            'movement' => 'école de barbizon',
            'movement' => 'expressionnisme',
            'movement' => 'fauvisme',
            'movement' => 'fluxus',
            'movement' => 'futurisme',
            'movement' => 'impressionnisme',
            'movement' => 'japonisme',
            'movement' => 'land art',
            'movement' => 'minimalisme',
            'movement' => 'orientalisme',
            'movement' => 'pop art',
            'movement' => 'post-impressionnisme',
            'movement' => 'post-modernisme',
            'movement' => 'primitivisme',
            'movement' => 'romantisme',
            'movement' => 'suprématisme',
            'movement' => 'surréalisme',
            // Continents
            'continent' => 'afrique',
            'continent' => 'amériques',
            'continent' => 'asie',
            'continent' => 'europe',
            'continent' => 'océanie',
            // Genders
            'gender' => 'femme',
            'gender' => 'homme',
            'gender' => 'collectif',
            // Label
            'label' => 'architecture contemporaine remarquable',
            'label' => 'exposition d’intérêt national',
            'label' => 'maisons des illustres',
            'label' => 'musée de france',
            'label' => 'patrimoine européen',
            // Techniques artistiques
            'technique' => 'architecture',
            'technique' => 'art de la scène',
            'technique' => 'bande dessinée',
            'technique' => 'céramique',
            'technique' => 'cinéma',
            'technique' => 'dessin',
            'technique' => 'estampe',
            'technique' => 'installation',
            'technique' => 'musique',
            'technique' => 'nouveaux médias',
            'technique' => 'orfèvrerie',
            'technique' => 'peinture',
            'technique' => 'photographie',
            'technique' => 'sculpture',
            // Thèmes
            'theme' => 'design',
            'theme' => 'fashion',
            'theme' => 'histoire',
            'theme' => 'littérature',
            'theme' => 'militaire',
            'theme' => 'prix artistique',
            'theme' => 'sciences et techniques',
        ];

        // Drop the table
        DB::table('tags')->delete();

        foreach ($tags as $key => $value)
        {
            Tag::findOrCreate($value, $key);
        }
    }
}
