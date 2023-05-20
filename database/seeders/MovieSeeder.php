<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::withoutForeignKeyConstraints(function () {
            Movie::truncate();
        });

        Movie::insert(
            [
                [
                    'title' => 'Kapitan Ameryka:Civil war',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed velit urna, viverra sit amet, ultrices vitae, sodales at, nisi. Sed velit urna, viverra sit amet, ultrices vitae, sodales at, nisi.',
                    'image'=>'storage/img/civil_war.png',
                    'director'=>'Anthony Russo',
                    'actors'=>'Robert Downey Jr., Chris Evans, Mark Ruffalo',
                    'duration'=>'120',
                    'score'=>'8.5',
                ],
                [
                    'title' => 'Suzume',
                    'description' => 'Podróż Suzume rozpoczyna się w spokojnym miasteczku w Kyushu (południowo-zachodnia Japonia), kiedy spotyka chłopaka, który szuka tajemniczych drzwi. Suzume znajduje je zniszczone pośród ruin, jakby były osłonięte przed jakąkolwiek katastrofą. Suzume zdaje się być przyciągana przez ich moc i sięga aby je otworzyć... Drzwi zaczynają otwierać kolejne drzwi w całej Japonii, siejąc zniszczenie. Suzume musi zamknąć te portale, aby zapobiec dalszej katastrofie.',
                    'image'=> 'storage/img/suzume.png',
                    'director'=> 'Makoto Shinkai',
                    'actors'=> 'Nanoka Hara, Hokuto Matsumura, Eri Fukatsu',
                    'duration'=> '122',
                    'score'=> '9',
                ],
                [
                    'title' => 'John Wick 4',
                    'description' => 'Ceny idą w górę, więc także stawka za głowę legendarnego zabójcy, Johna Wicka przebiła już sufit. Stając do ostatecznego pojedynku, który może dać mu upragnioną wolność i zasłużoną emeryturę, John wie, że może liczyć tylko na siebie. Dla niego, to nic nowego. To co zmieniło się tym razem, to fakt, że przeciwko sobie ma całą międzynarodową organizację najlepszych płatnych zabójców, a jej nowy szef Markiz de Gramond jest równie wyrafinowany, co bezlitosny. Zanim John stanie z nim oko w oko, będzie musiał odwiedzić kilka kontynentów mierząc się z całą plejadą twardzieli, którzy wiedzą wszystko o zabijaniu. Tuż przed wielkim finałem tej morderczej symfonii, John Wick trafi na trop swojej dalekiej rodziny, której członkowie mogą mieć decydujący wpływ na wynik całej rozgrywki.',
                    'image'=> 'storage/img/john_wick.png',
                    'director'=> 'Chad Stahelski',
                    'actors'=>'Keanu Reeves, Donnie Yen, Bill Skarsgard',
                    'duration'=>'169',
                    'score'=>'8',
                ],
                [
                    'title' => 'Asteriks i Obelisk:Imperium smoka',
                    'description' => 'Jest rok 50 p.n.e. Cesarzowa Chin, w wyniku zamachu stanu przeprowadzonego przez zdradzieckiego księcia, zostaje uwięziona. Córka porwanej władczyni – księżniczka Sass-Yi, wraz ze swoim wiernym ochroniarzem i fenickim kupcem wyrusza do odległej Galii, aby szukać pomocy dla swojego kraju. Tak oto poznaje Asteriksa i Obeliksa – dwóch dzielnych bohaterów, którzy nie cofną się przed niczym, aby zaprowadzić ład i porządek wszędzie tam, gdzie zapanował chaos i bezprawie… Oraz wszędzie tam, gdzie można przy okazji smacznie podjeść. Galowie z wielką chęcią przystają na prośbę księżniczki i wspólnie z jej przyjaciółmi oraz odpowiednim zapasem magicznego napoju wyruszają w długą i pełną przygód podróż na Daleki Wschód. Jednak oko na to wszystko ma także słynny wróg Asteriksa i Obeliksa – Juliusz Cezar, który jest żądny nowych zdobyczy i zbiera potężną armię, aby podbić orientalną krainę po drugiej stronie globu.',
                    'image'=>'storage/img/asteriks_i_obelisk.png',
                    'director'=>'Guillaume Canet',
                    'actors'=>'Marion Cotillard, Franck Gastambide, Vincent Cassel',
                    'duration'=>'111',
                    'score'=>'7',
                ],
                [
                    'title' => 'Pulp fiction',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed velit urna, viverra sit amet, ultrices vitae, sodales at, nisi. Sed velit urna, viverra sit amet, ultrices vitae, sodales at, nisi',
                    'image'=>'storage/img/pulp_fiction.png',
                    'director'=>'Quentin Tarantino',
                    'actors'=>'John Travolta, Uma Thurman, Samuel L. Jackson',
                    'duration'=>'154',
                    'score'=>'9',

                ]


            ]
        );

    }
}
