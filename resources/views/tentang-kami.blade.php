@extends('layouts.apppage')

@section('content')

<main>
    <!-- Community Image -->
    <section>
        <img src="{{ asset('logo/komunitas.jpg') }}" alt="Community Image" style="width: 100%; height: auto;">
    </section>

    <!-- Text Section -->
    <section class="text-section" style="padding: 4rem; background-color: #f8f9fa; display: flex; justify-content: center; align-items: center; text-align: center;">
        <div class="container" style="max-width: 800px;">
            <h2 style="font-family: 'Poppins', sans-serif; font-weight: bold;" class="fade-in-text">SecondSwap menyatukan orang-orang sebagai wadah komunitas lokal yang erat</h2>
            <p style="font-family: 'Poppins', sans-serif; text-align: justify;" class="fade-in-text">
                <strong>Mengapa Secondswap Penting?</strong><br>
                Bagaimana jika kita memiliki barang yang tidak terpakai? Apakah ada platform yang bisa memudahkan masyarakat untuk menjual barang bekas? Di era teknologi saat ini, jawabannya adalah ya.<br><br>

                Secondswap adalah platform yang dirancang untuk memudahkan masyarakat menjual dan membeli barang bekas. Saat kita merasa rumah kita penuh dengan barang-barang yang jarang digunakan, Secondswap hadir sebagai solusi praktis. Di sini, kita bisa dengan mudah memasang iklan untuk barang-barang tersebut dan menemukan pembeli yang mungkin sangat membutuhkannya.<br><br>

                Di era teknologi yang semakin maju, Secondswap memanfaatkan kemajuan ini untuk menciptakan platform yang user-friendly dan efisien. Dengan beberapa klik saja, kita bisa mengunggah foto barang, menulis deskripsi, dan menetapkan harga. Tidak perlu lagi repot-repot mencari pembeli secara manual atau melalui proses yang panjang.<br><br>

                Selain itu, Secondswap juga berperan dalam mengurangi limbah dan mendukung keberlanjutan. Dengan menjual barang bekas, kita memberikan kesempatan kedua bagi barang-barang tersebut untuk digunakan kembali, mengurangi kebutuhan akan produksi barang baru, dan membantu menjaga lingkungan.<br><br>

                Memanfaatkan teknologi untuk kebaikan bersama. Bergabunglah dengan Secondswap dan rasakan kemudahan dalam menjual dan membeli barang bekas, sambil membantu menciptakan dunia yang lebih berkelanjutan.
            </p>
            <p style="font-family: 'Poppins', sans-serif; text-align: justify;" class="fade-in-text">
                <strong>Gambaran Umum</strong><br>
                SecondSwap di tengah pesatnya perkembangan teknologi informasi, Platform ini tidak hanya memudahkan penjualan barang bekas, tetapi dengan berfokus pada aspek sosial, aplikasi ini mengundang pengguna untuk berpartisipasi dalam ekosistem yang lebih besar, di mana interaksi dan kepercayaan komunitas menjadi kunci.<br><br>

                Aplikasi pasar second online kini berfungsi sebagai mediator yang memfasilitasi pertemuan antara penjual dan pembeli, namun tidak mengambil bagian dalam transaksi atau pengiriman, menjadikannya alat yang ampuh untuk membangun jaringan sosial sekaligus ekonomi sirkular yang berkelanjutan.
            </p>
        </div>
    </section>
</main>

@endsection

@section('styles')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
<style>
    .text-section {
        animation: fadeIn 2s ease-in-out;
    }

    @keyframes fadeIn {
        0% { opacity: 0; }
        100% { opacity: 1; }
    }

    .container p {
        text-align: justify;
        text-align-last: center; /* For modern browsers */
    }

    .container h2 {
        text-align: center;
    }

    .fade-in-text {
        animation: fadeIn 2s ease-in-out;
    }
</style>
@endsection
