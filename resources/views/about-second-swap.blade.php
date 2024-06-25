@extends('layouts.apppage')

@section('content')

<main>
    <section class="about-second-swap ">
        <div class="background-image">
            <div class="container">
                <h1 class="fade-in-text">SecondSwap</h1>
                <p class="fade-in-text">Bergabung dengan platform SecondSwap. 
                    Beli dengan percaya diri.
                    Untuk menjual dan membeli barang bekas. Selamat datang di pasar lingkungan baru Anda.</p>
                <!-- Add more content as needed -->
            </div>
        </div>
    </section>
    <div class="logo-container slide-in-logo">
        <img src="/logo/SecondSwap2.png" alt="SecondSwap Logo" class="fade-in-logo small-logo">
    </div>
    <section class="shopping-image">
        <img src="/logo/belanja.jpg" alt="Shopping Image" class="shopping-img fade-in-image">
        <div class="text-overlay slide-in-text">
            <h2 class="fade-in-text">Apa itu SecondSwap?</h2>
            <p class="fade-in-text">Cara yang lebih baik untuk membeli dan menjual berbagai barang bekas, dan terhubung dengan komunitas Anda saat Anda melakukannya.</p>
        </div>
    </section>
    <section class="save-environment fade-in-section">
        <div class="save-content">
            <img src="/logo/savee.png" alt="Save Environment" class="save-img slide-in-image">
            <div class="save-text fade-in-text">
                <p class="justified-text">Dengan menjual barang bekas, Anda tidak hanya mengurangi limbah, tetapi juga memberikan kehidupan baru pada barang-barang yang masih layak pakai. Hemat uang, dukung lingkungan, dan temukan nilai baru di setiap barang bekas!</p>
            </div>
        </div>
    </section>
</main>

@endsection

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap');

    body {
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 0;
    }

    .about-second-swap {
        position: relative;
        width: 100%;
        height: auto;
        color: white;
    }

    .about-second-swap .background-image {
        background-image: url('/logo/about.jpg');
        background-size: cover;
        background-position: center;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        flex-direction: column;
        animation: fadeIn 2s ease-in-out;
    }

    .about-second-swap .container {
        position: relative;
        z-index: 2;
        text-align: center;
        animation: slideIn 1s ease-in-out;
    }

    .about-second-swap h1 {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .about-second-swap p {
        font-size: 1.5rem;
        font-weight: 400;
        margin-bottom: 20px;
    }

    .logo-container {
        display: flex;
        justify-content: center;
        padding: 5px;
        background-color: white;
        position: relative;
        top: -50px;
        z-index: 3;
        text-align: center;
    }

    .about-second-swap img.fade-in-logo {
        animation: fadeIn 2s ease-in-out;
    }

    .about-second-swap img.fade-in-logo.small-logo {
        width: 2cm;
        height: 2cm;
        animation: scaleIn 2s ease-in-out;
    }

    .about-second-swap .background-image::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1;
    }

    .fade-in-text {
        animation: fadeIn 2s ease-in-out;
    }

    .slide-in-text {
        animation: slideIn 1.5s ease-in-out;
    }

    .fade-in-image {
        animation: fadeIn 2s ease-in-out;
    }

    .slide-in-image {
        animation: slideIn 2s ease-in-out;
    }

    .fade-in-section {
        animation: fadeIn 3s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    @keyframes slideIn {
        from {
            transform: translateY(100px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    @keyframes scaleIn {
        from {
            transform: scale(0.5);
            opacity: 0;
        }
        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    .shopping-image {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin: 20px 0;
        text-align: center;
    }

    .shopping-img {
        width: 100%;
        max-width: 800px;
        height: auto;
    }

    .text-overlay {
        margin-top: 20px;
        text-align: center;
        color: white;
    }

    .text-overlay h2 {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .text-overlay p {
        font-size: 1.2rem;
        font-weight: 400;
    }

    .save-environment {
        background-color: white;
        padding: 40px 20px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .save-content {
        display: flex;
        align-items: center;
    }

    .save-img {
        width: 400px;
        height: 400px;
        margin-right: 10px;
    }

    .save-text {
        max-width: 600px;
    }

    .save-text p {
        font-size: 1.2rem;
        font-weight: 400;
        color: #333;
    }

    .justified-text {
        text-align: justify;
    }
</style>
