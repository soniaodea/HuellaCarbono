<?php

use Illuminate\Database\Seeder;
use App\Models\Region;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $countryId = App\Models\Country::where('name', 'España')->firstOrFail()->id;
        $regions = [
            'A Coruña',
            'Álava',
            'Albacete',
            'Alicante',
            'Almería',
            'Asturias',
            'Ávila',
            'Badajoz',
            'Barcelona',
            'Bizkaia',
            'Burgos',
            'Cáceres',
            'Cádiz',
            'Cantabria',
            'Castellón',
            'Ciudad Real',
            'Córdoba',
            'Cuenca',
            'Girona',
            'Granada',
            'Guadalajara',
            'Gipuzkoa',
            'Huelva',
            'Huesca',
            'Islas Baleares',
            'Jaén',
            'La Rioja',
            'Las Palmas',
            'León',
            'Lleida',
            'Lugo',
            'Madrid',
            'Málaga',
            'Murcia',
            'Navarra',
            'Orense',
            'Palencia',
            'Pontevedra',
            'Salamanca',
            'Santa Cruz de Tenerife',
            'Segovia',
            'Sevilla',
            'Soria',
            'Tarragona',
            'Teruel',
            'Toledo',
            'Valencia',
            'Valladolid',
            'Zamora',
            'Zaragoza',
        ];

        foreach ($regions as $regionName) {
            $region = new Region();
            $region->country_id = $countryId;
            $region->name = $regionName;
            $region->save();
        }
    }
}
