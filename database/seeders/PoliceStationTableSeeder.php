<?php

namespace Database\Seeders;

use App\Models\PoliceStation;
use Illuminate\Database\Seeder;

class PoliceStationTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    PoliceStation::truncate();

    $stations = [
      ["name" => "Aizawl PS"],
      ["name" => "Bawngkawn PS"],
      ["name" => "Kulikawn PS"],
      ["name" => "Vaivakawn PS"],
      ["name" => "Zonuam OP"],
      ["name" => "Sialsuk PS"],
      ["name" => "Darlawn PS"],
      ["name" => "Sakawrdai PS"],
      ["name" => "Sairang PS"],
      ["name" => "N.Vervek OP"],
      ["name" => "Kolasib PS"],
      ["name" => "Kawnpui PS"],
      ["name" => "Bairabi PS"],
      ["name" => "Vairengte PS"],
      ["name" => "Bilkhawthlir OP"],
      ["name" => "Saiphai OP"],
      ["name" => "Mamit PS"],
      ["name" => "Kawrthah PS"],
      ["name" => "Kanhmun PS"],
      ["name" => "Zawlnuam OP"],
      ["name" => "W. Phaileng PS"],
      ["name" => "Marpara PS"],
      ["name" => "Lunglei PS"],
      ["name" => "Lungsen PS"],
      ["name" => "Tlabung PS"],
      ["name" => "Bunghmun PS"],
      ["name" => "Hrangchalkawn OP"],
      ["name" => "Lawngtlai  PS"],
      ["name" => "Chawngte PS"],
      ["name" => "Borapansuri PS"],
      ["name" => "Sangau PS"],
      ["name" => "Bungtlang 'S' OP"],
      ["name" => "Bualpui 'NG' OP"],
      ["name" => "Vasei PS"],
      ["name" => "Siaha PS"],
      ["name" => "Siahatla OP"],
      ["name" => "Kaochao OP"],
      ["name" => "Lobo OP"],
      ["name" => "Tipa PS"],
      ["name" => "Phura PS"],
      ["name" => "Thingsai PS"],
      ["name" => "Hnahthial PS"],
      ["name" => "S.Vanlaiphai OP"],
      ["name" => "Champhai PS"],
      ["name" => "Zokhawthar OP"],
      ["name" => "Dungtlang OP"],
      ["name" => "Serchhip PS"],
      ["name" => "Thenzawl PS"],
      ["name" => "N.Vanlaiphai PS"],
      ["name" => "Serchhip Bazar BP"],
      ["name" => "Chhiahtlang BP"],
      ["name" => "Khawzawl PS"],
      ["name" => "Saitual PS"],
      ["name" => "Ngopa PS"],
    ];
    foreach ($stations as $station) {
      PoliceStation::create($station);
    }
  }
}
