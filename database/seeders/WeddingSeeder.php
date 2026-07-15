<?php

namespace Database\Seeders;

use App\Models\BankAccount;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Gift;
use App\Models\Story;
use App\Models\Wedding;
use Illuminate\Database\Seeder;

class WeddingSeeder extends Seeder
{
    public function run(): void
    {
        $wedding = Wedding::create([
            'couple' => [
                'groomName' => 'Ahmad Fauzi',
                'brideName' => 'Siti Nurhaliza',
                'groomShort' => 'Ahmad',
                'brideShort' => 'Siti',
                'groomParents' => 'Bpk. H. Rahman & Ibu Hj. Aminah',
                'brideParents' => 'Bpk. H. Sutrisno & Ibu Hj. Fatimah',
                'groomInstagram' => 'https://instagram.com/ahmadfauzi',
                'brideInstagram' => 'https://instagram.com/sitinurhaliza',
                'groomInstagramHandle' => '@ahmadfauzi',
                'brideInstagramHandle' => '@sitinurhaliza',
            ],
            'wedding_info' => [
                'date' => '2026-08-20T09:00:00',
                'dateFormatted' => '20 Agustus 2026',
                'day' => 'Kamis',
                'location' => 'Gedung Serbaguna Mutiara',
                'address' => 'Jl. Mawar No. 123, Jakarta Selatan',
                'phone' => '6281234567890',
                'mapsEmbed' => 'https://www.google.com/maps/embed?pb=...',
                'mapsLink' => 'https://maps.google.com/?q=...',
            ],
            'quotes' => [
                'bismillah' => 'بِسْمِ اللَّهِ الرَّحْمَنِ الرَّحِيمِ',
                'quran' => 'Dan di antara tanda-tanda kekuasaan-Nya ialah Dia menciptakan untukmu isteri-isteri dari jenismu sendiri, supaya kamu cenderung dan merasa tenteram kepadanya, dan dijadikan-Nya diantaramu rasa kasih dan sayang.',
                'quranRef' => 'QS. Ar-Rum: 21',
                'opening' => 'Assalamu\'alaikum Warahmatullahi Wabarakatuh',
                'openingText' => 'Dengan memohon rahmat dan ridho Allah SWT, kami bermaksud menyelenggarakan pernikahan putra-putri kami.',
                'closingText' => 'Merupakan suatu kehormatan dan kebahagiaan apabila Bapak/Ibu/Saudara/i berkenan hadir memberikan doa restu.',
                'footerClosing' => 'Wassalamu\'alaikum Warahmatullahi Wabarakatuh',
            ],
            'wa_number' => '6281234567890',
            'sections' => [
                'event' => ['enabled' => true],
                'story' => ['enabled' => true],
                'gallery' => ['enabled' => true],
                'video' => ['enabled' => true],
                'location' => ['enabled' => true],
                'rsvp' => ['enabled' => true],
                'gift' => ['enabled' => true],
                'wish' => ['enabled' => true],
            ],
        ]);

        Event::create([
            'wedding_id' => $wedding->id,
            'type' => 'akad',
            'title' => 'Akad Nikah',
            'icon' => 'bi-book',
            'date' => 'Kamis, 20 Agustus 2026',
            'time' => '08:00 - 10:00 WIB',
            'venue' => 'Gedung Serbaguna Mutiara',
            'address' => 'Jl. Mawar No. 123, Jakarta Selatan',
            'calendar_link' => 'https://calendar.google.com/...',
        ]);

        Event::create([
            'wedding_id' => $wedding->id,
            'type' => 'resepsi',
            'title' => 'Resepsi',
            'icon' => 'bi-cup',
            'date' => 'Kamis, 20 Agustus 2026',
            'time' => '11:00 - 17:00 WIB',
            'venue' => 'Gedung Serbaguna Mutiara',
            'address' => 'Jl. Mawar No. 123, Jakarta Selatan',
            'calendar_link' => 'https://calendar.google.com/...',
        ]);

        $stories = [
            ['sort_order' => 1, 'date_label' => 'Januari 2022', 'title' => 'Pertemuan Pertama', 'description' => 'Kami pertama kali bertemu di sebuah acara kampus. Saat itu kami tidak menyangka bahwa pertemuan ini akan membawa kami sejauh ini.', 'animation' => 'fade-right'],
            ['sort_order' => 2, 'date_label' => 'Maret 2023', 'title' => 'Mulai Serius', 'description' => 'Setelah setahun berkenalan, kami memutuskan untuk menjalin hubungan yang lebih serius dan saling mengenal lebih dalam.', 'animation' => 'fade-left'],
            ['sort_order' => 3, 'date_label' => 'Desember 2025', 'title' => 'Lamaran', 'description' => 'Keluarga Ahmad datang untuk melamar. Momen penuh haru yang menandai dimulainya perjalanan baru kami.', 'animation' => 'fade-right'],
            ['sort_order' => 4, 'date_label' => 'Agustus 2026', 'title' => 'Pernikahan', 'description' => 'Hari yang kami nantikan. Dengan restu Allah SWT, kami akan bersatu dalam ikatan suci pernikahan.', 'animation' => 'fade-left'],
        ];

        foreach ($stories as $story) {
            Story::create(array_merge(['wedding_id' => $wedding->id, 'image' => null], $story));
        }

        for ($i = 1; $i <= 6; $i++) {
            Gallery::create([
                'wedding_id' => $wedding->id,
                'sort_order' => $i,
                'src' => "images/gallery/photo-{$i}.jpg",
                'alt' => "Foto Prewedding {$i}",
                'title' => "Momen Bahagia {$i}",
            ]);
        }

        $gift = Gift::create([
            'wedding_id' => $wedding->id,
            'qris_enabled' => false,
            'qris_image' => null,
        ]);

        BankAccount::create([
            'gift_id' => $gift->id,
            'bank_name' => 'Bank BCA',
            'account_number' => '8420123456',
            'account_holder' => 'Ahmad Fauzi',
        ]);

        BankAccount::create([
            'gift_id' => $gift->id,
            'bank_name' => 'Bank Mandiri',
            'account_number' => '1200012345678',
            'account_holder' => 'Siti Nurhaliza',
        ]);
    }
}
