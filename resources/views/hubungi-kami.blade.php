@extends('layouts.app')

@section('content')

<main>
    <section class="hubungi-kami">
        <div class="container">
            <!-- Text Section -->
            <div class="text centered-text">
                <p class="left-align"><strong>Tim</strong></p>
                <p>Tim SecondSwap terdiri dari mahasiswa Politeknik Negeri Batam, Program Studi Teknologi Rekayasa Perangkat Lunak.</p>
            </div>

            <!-- Square Grid for Team Members -->
            <div class="square-grid centered-text">
                <div class="square">
                    <div class="square-content">
                        <img src="{{ asset('logo/profil.png') }}" alt="Dhani Dzulkarnain">
                        <p>4342301046</p>
                        <p>Dhani Dzulkarnain</p>
                    </div>
                </div>
                <div class="square">
                    <div class="square-content">
                        <img src="{{ asset('logo/profil.png') }}" alt="M. Dzakwan Naufal">
                        <p>4342301037</p>
                        <p>M. Dzakwan Naufal</p>
                    </div>
                </div>
                <div class="square">
                    <div class="square-content">
                        <img src="{{ asset('logo/profil.png') }}" alt="Iqbal Sulthan Athallah">
                        <p>4342301041</p>
                        <p>Iqbal Sulthan Athallah</p>
                    </div>
                </div>
                <div class="square">
                    <div class="square-content">
                        <img src="{{ asset('logo/profil.png') }}" alt="Isnan Abdullah">
                        <p>4342301059</p>
                        <p>Isnan Abdullah</p>
                    </div>
                </div>
                <div class="square">
                    <div class="square-content">
                        <img src="{{ asset('logo/profil.png') }}" alt="Ahmad Saif Al Muflihin">
                        <p>4342301053</p>
                        <p>Ahmad Saif Al Muflihin</p>
                    </div>
                </div>
                <div class="square">
                    <div class="square-content">
                        <img src="{{ asset('logo/profil.png') }}" alt="M. Dzaky Naufal">
                        <p>4342301049</p>
                        <p>M. Dzaky Naufal</p>
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="contact-info centered-text">
                <p class="left-align"><strong>Kontak</strong></p>
                <p><a href="mailto:teamsecondswap@gmail.com">teamsecondswap@gmail.com</a> untuk pertanyaan pers/media atau peluang kemitraan.</p>
                <p><a href="mailto:helpsecondswap@gmail.com">helpsecondswap@gmail.com</a> untuk pertanyaan apa pun.</p>
            </div>
        </div>
    </section>
</main>

@endsection

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap');

body {
    font-family: 'Poppins', sans-serif;
    background: #e0e0e0;
}

.centered-text {
    max-width: 800px;
    margin: 0 auto;
    text-align: justify;
    color: white;
}

.left-align {
    text-align: left;
}

.text {
    margin-bottom: 20px;
}

.text p {
    font-size: 24px;
    margin: 0;
}

.text p:first-child {
    font-size: 36px;
    font-weight: bold;
}

.square-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin: 0 auto;
    justify-content: center;
    margin-top: 20px;
    max-width: 800px;
}

.square {
    width: 100%;
    max-width: 6cm;
    height: 8cm;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
    transition: transform 0.6s ease-in-out, box-shadow 0.2s ease-in-out;
    cursor: pointer;
    perspective: 1000px;
    border-radius: 15px;
    background: linear-gradient(135deg, #e0e0e0 0%, #b0b0b0 50%, #e0e0e0 100%);
    background-clip: padding-box;
    border: 1px solid rgba(255, 255, 255, 0.4);
    color: white;
    position: relative;
}

.square:before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.6) 0%, rgba(0, 0, 0, 0.1) 50%, rgba(255, 255, 255, 0.6) 100%);
    mix-blend-mode: overlay;
    opacity: 0.7;
    pointer-events: none;
    border-radius: 15px;
}

.square:hover {
    box-shadow: 0 0 20px rgba(255, 255, 255, 0.8);
}

.square:active .square-content {
    animation: flipCard 0.6s forwards;
}

@keyframes flipCard {
    0% {
        transform: scale(1) rotateY(0);
    }
    50% {
        transform: scale(1.2) rotateY(180deg);
    }
    100% {
        transform: scale(1) rotateY(360deg);
    }
}

.square-content {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    padding: 15px;
    background: rgba(255, 255, 255, 0.1);
    height: 100%;
    width: 100%;
    transform-style: preserve-3d;
    backface-visibility: hidden;
    transition: transform 0.6s ease-in-out;
    border-radius: 15px;
    z-index: 1;
}

.square img {
    width: 4cm;
    height: 4cm;
    border-radius: 50%;
    object-fit: cover;
    margin-bottom: 10px;
    border: 2px solid white;
}

.square p {
    margin: 5px 0;
    font-size: 14px;
    font-weight: bold;
}

.contact-info {
    margin-top: 30px;
}

.contact-info p {
    font-size: 18px;
    margin: 5px 0;
    color: white;
}

.contact-info p:first-child {
    font-size: 24px;
    font-weight: bold;
}

.glitter {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    background: url('https://cdn.pixabay.com/photo/2016/03/27/21/29/golden-1281338_960_720.png') repeat;
    background-size: cover;
    opacity: 0;
    animation: glitter 2s infinite;
    z-index: 0;
    border-radius: 15px;
}

@keyframes glitter {
    0%,
    100% {
        opacity: 0;
        transform: scale(1);
    }
    50% {
        opacity: 1;
        transform: scale(1.5);
    }
}

/* Responsive Design */
@media (max-width: 768px) {
    .square-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .text p {
        font-size: 18px;
    }

    .text p:first-child {
        font-size: 28px;
    }

    .contact-info p {
        font-size: 16px;
    }

    .contact-info p:first-child {
        font-size: 20px;
    }
}

@media (max-width: 480px) {
    .square-grid {
        grid-template-columns: 1fr;
    }

    .text p {
        font-size: 16px;
    }

    .text p:first-child {
        font-size: 24px;
    }

    .contact-info p {
        font-size: 14px;
    }

    .contact-info p:first-child {
        font-size: 18px;
    }

    .square {
        max-width: 100%;
        height: auto;
    }

    .square img {
        width: 3cm;
        height: 3cm;
    }

    .square p {
        font-size: 12px;
    }
}
</style>
