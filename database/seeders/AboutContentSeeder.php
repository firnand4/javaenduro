<?php

namespace Database\Seeders;

use App\Models\AboutContent;
use Illuminate\Database\Seeder;

class AboutContentSeeder extends Seeder
{
    public function run(): void
    {
        AboutContent::updateOrCreate(['id' => 1], [
            'heading' => 'Javaenduro Ride with character',
            'paragraph_1' => 'JavaEnduro lahir dari kebiasaan sekelompok rider Malang yang lebih sering pulang berlumpur daripada berdebu. Kami memetakan jalur yang tidak ada di GPS mana pun — dari kaki Semeru sampai hutan pinus Cangar.',
            'paragraph_2' => 'Kami bukan komunitas balap. Kami komunitas yang mengukur perjalanan dari seberapa jujur medannya, bukan seberapa cepat sampainya. Setiap member wajib bawa pulang sampahnya sendiri — trek yang kami rawat hari ini yang akan kami trabas lagi tahun depan.',
            'value_chips' => ['Solidaritas Konvoi', 'Safety Riding', 'Leave No Trace', 'Regenerasi Rider'],
            'graphic_caption' => 'SEMERU · BROMO · KAWI · ARJUNO',
        ]);
    }
}
