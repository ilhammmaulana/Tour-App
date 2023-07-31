<?php

namespace Database\Seeders;

use App\Models\CategoryDestination;
use App\Models\Destination;
use App\Models\Province;
use App\Models\User;
use Illuminate\Database\Seeder;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = CategoryDestination::where('name', 'Tour')->first();
        $admin = User::where('email', 'admin@gmail.com')->first();
        collect([
            [
                "name" => "Bali - Pantai Kuta",
                "latitude" => "-8.718217114877184",
                "longitude" => "115.16851805736904",
                "address" => "Kuta, Kabupaten Badung, Bali",
                "description" => "Pantai Kuta adalah tujuan wisata populer di Bali, dikenal dengan pantainya yang indah, kehidupan malam yang ramai, dan tempat surfing yang menarik.",
                "image" => "https://placehold.co/600x400?text=Pantai+Kuta",
                "province_id" => Province::where('name', 'like', 'Bali')->select('id')->first()->id,
                "created_by" => $admin['id'],
                "category_id" => $category['id'],
            ],
            [
                "name" => "Yogyakarta - Candi Prambanan",
                "latitude" => "-7.750238487239045",
                "longitude" => "110.49400114449674",
                "address" => "Bokoharjo, Prambanan, Kabupaten Sleman, Yogyakarta",
                "description" => "Candi Prambanan adalah kompleks candi Hindu yang megah di Yogyakarta, Indonesia, terkenal dengan arsitektur yang indah dan warisan budayanya yang kaya.",
                "image" => "https://placehold.co/600x400?text=Candi+Prambanan",
                "created_by" => $admin['id'],
                "province_id" => Province::where('name', 'like', 'YOGYAKARTA')->select('id')->first()->id,
                "category_id" => $category['id'],
            ],
            [
                "name" => "Lombok - Gili Trawangan",
                "latitude" => "-8.3503091",
                "longitude" => "116.025906",
                "address" => "Gili Trawangan, Kecamatan Pemenang, Kabupaten Lombok Utara, Nusa Tenggara Barat",
                "description" => "Gili Trawangan adalah pulau yang terkenal di Lombok, Nusa Tenggara Barat, dikenal dengan pantainya yang indah, kehidupan bawah laut yang menakjubkan, dan suasana yang santai.",
                "image" => "https://placehold.co/600x400?text=Gili+Trawangan",
                "province_id" => Province::where('name', 'like', 'Nusa Tenggara Barat')->select('id')->first()->id,
                "created_by" => $admin['id'],
                "category_id" => $category['id'],
            ],
            [
                "name" => "Monumen Nasional - Monas",
                "latitude" => "-6.038821949078396",
                "longitude" => "106.86023702664814",
                "address" => "Jalan Medan Merdeka Barat No.1, Gambir, Jakarta Pusat",
                "description" => "Monumen Nasional (Monas) adalah landmark terkenal di Jakarta, Indonesia, yang melambangkan perjuangan dan kemerdekaan bangsa Indonesia.",
                "province_id" => Province::where('name', 'DKI JAKARTA')->select('id')->first()->id,
                "image" => "https://placehold.co/600x400?text=Monumen+Nasional",
                "created_by" => $admin['id'],
                "category_id" => $category['id'],
            ],
            [
                "name" => "Gunung Tangkuban Perahu",
                "latitude" => "-6.7592965054720455",
                "longitude" => "107.60965187901247",
                "address" => "Cikole, Lembang, Kabupaten Bandung Barat, Jawa Barat",
                "description" => "Gunung Tangkuban Perahu adalah gunung berapi yang terkenal di Bandung, Jawa Barat, dikenal dengan kawahnya yang indah dan pemandangan alam yang menakjubkan.",
                "province_id" => Province::where('name', 'like', 'Jawa Barat')->select('id')->first()->id,
                "image" => "https://placehold.co/600x400?text=Gunung+Tangkuban+Perahu",
                "created_by" => $admin['id'],
                "category_id" => $category['id'],
            ],
            [
                "name" => "Pulau Komodo - Taman Nasional Komodo",
                "latitude" => "-8.515256",
                "longitude" => "119.498413",
                "address" => "Taman Nasional Komodo, Nusa Tenggara Timur",
                "description" => "Taman Nasional Komodo adalah tempat tinggal komodo, hewan langka yang hanya ada di Indonesia. Pulau ini menawarkan keindahan alam yang luar biasa dan kehidupan satwa yang unik.",
                "image" => "https://placehold.co/600x400?text=Taman+Nasional+Komodo",
                "created_by" => $admin['id'],
                "category_id" => $category['id'],
            ],
            [
                "name" => "Kalimantan - Taman Nasional Tanjung Puting",
                "latitude" => "-2.789085",
                "longitude" => "111.666298",
                "address" => "Kumai, Kabupaten Kotawaringin Barat, Kalimantan Tengah",
                "description" => "Taman Nasional Tanjung Puting adalah rumah bagi orangutan, satwa ikonik Indonesia. Dengan hutan tropis yang luas, taman nasional ini menawarkan pengalaman alam yang luar biasa.",
                "image" => "https://placehold.co/600x400?text=Taman+Nasional+Tanjung+Puting",
                "created_by" => $admin['id'],
                "category_id" => $category['id'],
            ],
            [
                "name" => "Taman Nasional Bromo Tengger Semeru - Gunung Bromo",
                "latitude" => "-7.942493",
                "longitude" => "112.953331",
                "address" => "Ngadisari, Sukapura, Kabupaten Probolinggo, Jawa Timur",
                "description" => "Taman Nasional Bromo Tengger Semeru adalah tempat wisata terkenal di Jawa Timur, Indonesia. Gunung Bromo, dengan kawahnya yang ikonik, menawarkan pemandangan yang spektakuler.",
                "image" => "https://placehold.co/600x400?text=Gunung+Bromo",
                "created_by" => $admin['id'],
                "category_id" => $category['id'],
            ],
            [
                "name" => "Raja Ampat - Kepulauan Wayag",
                "latitude" => "-0.438043",
                "longitude" => "130.384644",
                "address" => "Kepulauan Wayag, Kabupaten Raja Ampat, Papua Barat",
                "description" => "Kepulauan Wayag di Raja Ampat adalah surga penyelam dan pecinta alam. Terkenal dengan laguna biru, pantai pasir putih, dan kehidupan bawah laut yang menakjubkan.",
                "image" => "https://placehold.co/600x400?text=Kepulauan+Wayag",
                "created_by" => $admin['id'],
                "category_id" => $category['id'],
            ],
            [
                "name" => "Ubud - Tegallalang Rice Terrace",
                "latitude" => "-8.431615675753264",
                "longitude" => "115.27924935108328",
                "address" => "Tegallalang, Kabupaten Gianyar, Bali",
                "description" => "Tegallalang Rice Terrace adalah pemandangan sawah yang indah di Ubud, Bali. Terkenal dengan teraseringnya yang menakjubkan dan panorama alam yang menenangkan.",
                "image" => "https://placehold.co/600x400?text=Tegallalang+Rice+Terrace",
                "created_by" => $admin['id'],
                "category_id" => $category['id'],
            ]

        ])->each(function ($data) {
            Destination::create($data);
        });
    }
}
