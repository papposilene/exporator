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
            'art' => [
                'archéologie',
                'art du moyen âge',
                'art de l’islam',
                'art de la renaissance',
                'art baroque',
                'art moderne',
                'art contemporain',
                'art brut',
                'art naïf',
            ],
            // Art movements
            'movement' => [
                'art cinétique',
                'art conceptuel',
                'art déco',
                'art nouveau',
                'art populaire',
                'abstraction',
                'action painting',
                'bauhaus',
                'cobra',
                'constructivisme',
                'cubisme',
                'dada',
                'de stilj',
                'der blaue reiter',
                'école de barbizon',
                'expressionnisme',
                'fauvisme',
                'fluxus',
                'futurisme',
                'impressionnisme',
                'japonisme',
                'land art',
                'minimalisme',
                'orientalisme',
                'pop art',
                'post-impressionnisme',
                'post-modernisme',
                'primitivisme',
                'romantisme',
                'suprématisme',
                'surréalisme',
            ],
            // Continents
            'continent' => [
                'afrique',
                'amériques',
                'asie',
                'europe',
                'océanie',
            ],
            // Genders
            'gender' => [
                'femme',
                'homme',
                'collectif',
            ],
            // Label
            'label' => [
                'architecture contemporaine remarquable',
                'exposition d’intérêt national',
                'maisons des illustres',
                'musée de france',
                'patrimoine européen',
            ],
            // Techniques artistiques
            'technique' => [
                'architecture',
                'art de la scène',
                'bande dessinée',
                'céramique',
                'cinéma',
                'dessin',
                'estampe',
                'installation',
                'musique',
                'nouveaux médias',
                'orfèvrerie',
                'peinture',
                'photographie',
                'sculpture',
            ],
            // Thèmes
            'theme' => [
                'design',
                'fashion',
                'histoire',
                'littérature',
                'militaire',
                'prix artistique',
                'rétrospective',
                'sciences et techniques',
            ],
        ];

        // Drop the table
        DB::table('tags')->delete();

        for ($ii = 0; $ii < count($tags); $ii++)
        {
            $type = key($tags);

            for ($jj = 0; $jj < count($tags[$type]); $jj++)
            {
                Tag::findOrCreate($tags[$type][$jj], $type);
            }
        }
    }
}
