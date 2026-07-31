<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            ['customer_name' => 'Budi Santoso', 'company' => 'PT Maju Jaya', 'position' => 'Marketing Manager', 'rating' => 5, 'testimonial' => 'Hasil cetak brosur sangat tajam dan warnanya sesuai dengan brand kami. Pelayanannya juga sangat cepat!', 'project_name' => 'Company Profile Brochure', 'is_featured' => true],
            ['customer_name' => 'Siti Aminah', 'company' => 'CV Berkah Abadi', 'position' => 'Owner', 'rating' => 5, 'testimonial' => 'Sangat puas dengan packaging produk kami. Desainnya elegan dan bahan berkualitas.', 'project_name' => 'Product Packaging', 'is_featured' => true],
            ['customer_name' => 'Andi Wijaya', 'company' => 'Startup Tech', 'position' => 'CEO', 'rating' => 5, 'testimonial' => 'Merchandise untuk event kami sangat bagus. Karyawan dan klien sangat menyukainya.', 'project_name' => 'Event Merchandise', 'is_featured' => false],
            ['customer_name' => 'Dewi Lestari', 'company' => 'Boutique Mawar', 'position' => 'Creative Director', 'rating' => 4, 'testimonial' => 'Kartu nama dan paper bag-nya premium. Harga sangat reasonable untuk kualitas sebagus ini.', 'project_name' => 'Branding Kit', 'is_featured' => true],
            ['customer_name' => 'Rizky Pratama', 'company' => 'Kopi Senja', 'position' => 'Founder', 'rating' => 5, 'testimonial' => 'Desain logo dan menu cafe kami jadi lebih menarik. Tim OMH Vector sangat membantu.', 'project_name' => 'Cafe Branding', 'is_featured' => false],
            ['customer_name' => 'Hendra Gunawan', 'company' => 'Real Estate Indah', 'position' => 'Project Manager', 'rating' => 5, 'testimonial' => 'Spanduk dan billboard kami dicetak dengan resolusi tinggi. Sangat recommended!', 'project_name' => 'Outdoor Advertising', 'is_featured' => false],
            ['customer_name' => 'Maya Sari', 'company' => 'School Global', 'position' => 'Admin', 'rating' => 5, 'testimonial' => 'Pembuatan buku tahunan dan kalender sekolah sangat tepat waktu. Terima kasih!', 'project_name' => 'School Calendar', 'is_featured' => false],
            ['customer_name' => 'Joko Susilo', 'company' => 'Restaurant Padang', 'position' => 'Owner', 'rating' => 4, 'testimonial' => 'Menu dan kemasan takeaway kami terlihat lebih profesional sekarang.', 'project_name' => 'Restaurant Menu', 'is_featured' => false],
            ['customer_name' => 'Linda Kusuma', 'company' => 'Wedding Organizer', 'position' => 'Event Planner', 'rating' => 5, 'testimonial' => 'Undangan pernikahan custom untuk klien kami selalu sempurna. Detailnya luar biasa.', 'project_name' => 'Wedding Invitation', 'is_featured' => true],
            ['customer_name' => 'Agus Salim', 'company' => 'Government Office', 'position' => 'Staff', 'rating' => 5, 'testimonial' => 'Pelayanan ramah dan hasil cetak dokumen resmi sangat rapi dan jelas.', 'project_name' => 'Official Documents', 'is_featured' => false],
            ['customer_name' => 'Rina Wati', 'company' => 'Fashion Brand', 'position' => 'Designer', 'rating' => 5, 'testimonial' => 'Label dan hangtag pakaian kami dicetak dengan presisi. Sangat puas!', 'project_name' => 'Fashion Labels', 'is_featured' => false],
            ['customer_name' => 'Doni Setiawan', 'company' => 'Automotive Shop', 'position' => 'Manager', 'rating' => 4, 'testimonial' => 'Stiker branding untuk mobil operasional kami sangat tahan lama dan warnanya cerah.', 'project_name' => 'Vehicle Branding', 'is_featured' => false],
        ];

        foreach ($testimonials as $index => $t) {
            Testimonial::create(array_merge($t, [
                'customer_photo' => 'images/testimonials/' . strtolower(str_replace(' ', '-', $t['customer_name'])) . '.jpg',
                'sort_order' => $index + 1,
                'is_active' => true,
            ]));
        }
    }
}