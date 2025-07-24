<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regenciesData = [
            // Banten (ID 3)
            ['id' => 301, 'province_id' => 3, 'name' => 'Kabupaten Serang'],
            ['id' => 302, 'province_id' => 3, 'name' => 'Kabupaten Tangerang'],
            ['id' => 303, 'province_id' => 3, 'name' => 'Kabupaten Lebak'],
            ['id' => 304, 'province_id' => 3, 'name' => 'Kabupaten Pandeglang'],
            ['id' => 305, 'province_id' => 3, 'name' => 'Kota Serang'],
            ['id' => 306, 'province_id' => 3, 'name' => 'Kota Cilegon'],
            ['id' => 307, 'province_id' => 3, 'name' => 'Kota Tangerang'],
            ['id' => 308, 'province_id' => 3, 'name' => 'Kota Tangerang Selatan'],

            // DKI Jakarta (ID 6)
            ['id' => 601, 'province_id' => 6, 'name' => 'Kota Jakarta Pusat'],
            ['id' => 602, 'province_id' => 6, 'name' => 'Kota Jakarta Utara'],
            ['id' => 603, 'province_id' => 6, 'name' => 'Kota Jakarta Barat'],
            ['id' => 604, 'province_id' => 6, 'name' => 'Kota Jakarta Selatan'],
            ['id' => 605, 'province_id' => 6, 'name' => 'Kota Jakarta Timur'],
            ['id' => 606, 'province_id' => 6, 'name' => 'Kabupaten Kepulauan Seribu'],

            // Jawa Barat (ID 10)
            ['id' => 1001, 'province_id' => 10, 'name' => 'Kabupaten Bandung'],
            ['id' => 1002, 'province_id' => 10, 'name' => 'Kabupaten Bogor'],
            ['id' => 1003, 'province_id' => 10, 'name' => 'Kabupaten Bekasi'],
            ['id' => 1004, 'province_id' => 10, 'name' => 'Kabupaten Cianjur'],
            ['id' => 1005, 'province_id' => 10, 'name' => 'Kabupaten Garut'],
            ['id' => 1006, 'province_id' => 10, 'name' => 'Kabupaten Sukabumi'],
            ['id' => 1007, 'province_id' => 10, 'name' => 'Kabupaten Tasikmalaya'],
            ['id' => 1008, 'province_id' => 10, 'name' => 'Kabupaten Ciamis'],
            ['id' => 1009, 'province_id' => 10, 'name' => 'Kabupaten Kuningan'],
            ['id' => 1010, 'province_id' => 10, 'name' => 'Kabupaten Cirebon'],
            ['id' => 1011, 'province_id' => 10, 'name' => 'Kabupaten Majalengka'],
            ['id' => 1012, 'province_id' => 10, 'name' => 'Kabupaten Sumedang'],
            ['id' => 1013, 'province_id' => 10, 'name' => 'Kabupaten Indramayu'],
            ['id' => 1014, 'province_id' => 10, 'name' => 'Kabupaten Subang'],
            ['id' => 1015, 'province_id' => 10, 'name' => 'Kabupaten Purwakarta'],
            ['id' => 1016, 'province_id' => 10, 'name' => 'Kabupaten Karawang'],
            ['id' => 1017, 'province_id' => 10, 'name' => 'Kabupaten Bandung Barat'],
            ['id' => 1018, 'province_id' => 10, 'name' => 'Kabupaten Pangandaran'],
            ['id' => 1019, 'province_id' => 10, 'name' => 'Kota Bandung'],
            ['id' => 1020, 'province_id' => 10, 'name' => 'Kota Bogor'],
            ['id' => 1021, 'province_id' => 10, 'name' => 'Kota Bekasi'],
            ['id' => 1022, 'province_id' => 10, 'name' => 'Kota Depok'],
            ['id' => 1023, 'province_id' => 10, 'name' => 'Kota Cirebon'],
            ['id' => 1024, 'province_id' => 10, 'name' => 'Kota Sukabumi'],
            ['id' => 1025, 'province_id' => 10, 'name' => 'Kota Tasikmalaya'],
            ['id' => 1026, 'province_id' => 10, 'name' => 'Kota Cimahi'],
            ['id' => 1027, 'province_id' => 10, 'name' => 'Kota Banjar'],

            // Jawa Tengah (ID 11)
            ['id' => 1101, 'province_id' => 11, 'name' => 'Kabupaten Semarang'],
            ['id' => 1102, 'province_id' => 11, 'name' => 'Kabupaten Demak'],
            ['id' => 1103, 'province_id' => 11, 'name' => 'Kabupaten Kudus'],
            ['id' => 1104, 'province_id' => 11, 'name' => 'Kabupaten Magelang'],
            ['id' => 1105, 'province_id' => 11, 'name' => 'Kabupaten Klaten'],
            ['id' => 1106, 'province_id' => 11, 'name' => 'Kabupaten Banyumas'],
            ['id' => 1107, 'province_id' => 11, 'name' => 'Kabupaten Cilacap'],
            ['id' => 1108, 'province_id' => 11, 'name' => 'Kabupaten Purbalingga'],
            ['id' => 1109, 'province_id' => 11, 'name' => 'Kabupaten Banjarnegara'],
            ['id' => 1110, 'province_id' => 11, 'name' => 'Kabupaten Kebumen'],
            ['id' => 1111, 'province_id' => 11, 'name' => 'Kabupaten Purworejo'],
            ['id' => 1112, 'province_id' => 11, 'name' => 'Kabupaten Wonosobo'],
            ['id' => 1113, 'province_id' => 11, 'name' => 'Kabupaten Temanggung'],
            ['id' => 1114, 'province_id' => 11, 'name' => 'Kabupaten Kendal'],
            ['id' => 1115, 'province_id' => 11, 'name' => 'Kabupaten Batang'],
            ['id' => 1116, 'province_id' => 11, 'name' => 'Kabupaten Pekalongan'],
            ['id' => 1117, 'province_id' => 11, 'name' => 'Kabupaten Pemalang'],
            ['id' => 1118, 'province_id' => 11, 'name' => 'Kabupaten Tegal'],
            ['id' => 1119, 'province_id' => 11, 'name' => 'Kabupaten Brebes'],
            ['id' => 1120, 'province_id' => 11, 'name' => 'Kabupaten Pati'],
            ['id' => 1121, 'province_id' => 11, 'name' => 'Kabupaten Jepara'],
            ['id' => 1122, 'province_id' => 11, 'name' => 'Kabupaten Rembang'],
            ['id' => 1123, 'province_id' => 11, 'name' => 'Kabupaten Blora'],
            ['id' => 1124, 'province_id' => 11, 'name' => 'Kabupaten Grobogan'],
            ['id' => 1125, 'province_id' => 11, 'name' => 'Kabupaten Sragen'],
            ['id' => 1126, 'province_id' => 11, 'name' => 'Kabupaten Karanganyar'],
            ['id' => 1127, 'province_id' => 11, 'name' => 'Kabupaten Wonogiri'],
            ['id' => 1128, 'province_id' => 11, 'name' => 'Kabupaten Sukoharjo'],
            ['id' => 1129, 'province_id' => 11, 'name' => 'Kota Semarang'],
            ['id' => 1130, 'province_id' => 11, 'name' => 'Kota Surakarta'],
            ['id' => 1131, 'province_id' => 11, 'name' => 'Kota Magelang'],
            ['id' => 1132, 'province_id' => 11, 'name' => 'Kota Salatiga'],
            ['id' => 1133, 'province_id' => 11, 'name' => 'Kota Pekalongan'],
            ['id' => 1134, 'province_id' => 11, 'name' => 'Kota Tegal'],

            // DI Yogyakarta (ID 12)
            ['id' => 1201, 'province_id' => 12, 'name' => 'Kabupaten Bantul'],
            ['id' => 1202, 'province_id' => 12, 'name' => 'Kabupaten Sleman'],
            ['id' => 1203, 'province_id' => 12, 'name' => 'Kabupaten Kulon Progo'],
            ['id' => 1204, 'province_id' => 12, 'name' => 'Kabupaten Gunungkidul'],
            ['id' => 1205, 'province_id' => 12, 'name' => 'Kota Yogyakarta'],

            // Jawa Timur (ID 13)
            ['id' => 1301, 'province_id' => 13, 'name' => 'Kabupaten Sidoarjo'],
            ['id' => 1302, 'province_id' => 13, 'name' => 'Kabupaten Malang'],
            ['id' => 1303, 'province_id' => 13, 'name' => 'Kabupaten Pasuruan'],
            ['id' => 1304, 'province_id' => 13, 'name' => 'Kabupaten Jember'],
            ['id' => 1305, 'province_id' => 13, 'name' => 'Kabupaten Banyuwangi'],
            ['id' => 1306, 'province_id' => 13, 'name' => 'Kabupaten Kediri'],
            ['id' => 1307, 'province_id' => 13, 'name' => 'Kabupaten Blitar'],
            ['id' => 1308, 'province_id' => 13, 'name' => 'Kabupaten Lumajang'],
            ['id' => 1309, 'province_id' => 13, 'name' => 'Kabupaten Bondowoso'],
            ['id' => 1310, 'province_id' => 13, 'name' => 'Kabupaten Situbondo'],
            ['id' => 1311, 'province_id' => 13, 'name' => 'Kabupaten Probolinggo'],
            ['id' => 1312, 'province_id' => 13, 'name' => 'Kabupaten Mojokerto'],
            ['id' => 1313, 'province_id' => 13, 'name' => 'Kabupaten Jombang'],
            ['id' => 1314, 'province_id' => 13, 'name' => 'Kabupaten Nganjuk'],
            ['id' => 1315, 'province_id' => 13, 'name' => 'Kabupaten Madiun'],
            ['id' => 1316, 'province_id' => 13, 'name' => 'Kabupaten Magetan'],
            ['id' => 1317, 'province_id' => 13, 'name' => 'Kabupaten Ngawi'],
            ['id' => 1318, 'province_id' => 13, 'name' => 'Kabupaten Pacitan'],
            ['id' => 1319, 'province_id' => 13, 'name' => 'Kabupaten Ponorogo'],
            ['id' => 1320, 'province_id' => 13, 'name' => 'Kabupaten Trenggalek'],
            ['id' => 1321, 'province_id' => 13, 'name' => 'Kabupaten Tulungagung'],
            ['id' => 1322, 'province_id' => 13, 'name' => 'Kabupaten Bojonegoro'],
            ['id' => 1323, 'province_id' => 13, 'name' => 'Kabupaten Tuban'],
            ['id' => 1324, 'province_id' => 13, 'name' => 'Kabupaten Lamongan'],
            ['id' => 1325, 'province_id' => 13, 'name' => 'Kabupaten Gresik'],
            ['id' => 1326, 'province_id' => 13, 'name' => 'Kabupaten Bangkalan'],
            ['id' => 1327, 'province_id' => 13, 'name' => 'Kabupaten Sampang'],
            ['id' => 1328, 'province_id' => 13, 'name' => 'Kabupaten Pamekasan'],
            ['id' => 1329, 'province_id' => 13, 'name' => 'Kabupaten Sumenep'],
            ['id' => 1330, 'province_id' => 13, 'name' => 'Kota Surabaya'],
            ['id' => 1331, 'province_id' => 13, 'name' => 'Kota Malang'],
            ['id' => 1332, 'province_id' => 13, 'name' => 'Kota Kediri'],
            ['id' => 1333, 'province_id' => 13, 'name' => 'Kota Blitar'],
            ['id' => 1334, 'province_id' => 13, 'name' => 'Kota Madiun'],
            ['id' => 1335, 'province_id' => 13, 'name' => 'Kota Pasuruan'],
            ['id' => 1336, 'province_id' => 13, 'name' => 'Kota Probolinggo'],
            ['id' => 1337, 'province_id' => 13, 'name' => 'Kota Mojokerto'],
            ['id' => 1338, 'province_id' => 13, 'name' => 'Kota Batu'],
        ];

        DB::table('regencies')->insert($regenciesData);
    }
}
