<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pendaftaran</title>
</head>
<style>
    body {
        margin: 0;
        padding: 0;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: Arial, sans-serif;
    }

    .marquee-wrapper {
        width: 100%;
        overflow: hidden;
        position: relative;
        padding: 20px 0;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
    }

    .marquee {
        display: flex;
        animation: scroll 20s linear infinite;
    }

    .marquee-text {
        font-size: 60px;
        font-weight: 900;
        color: white;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        white-space: nowrap;
        padding: 0 50px;
    }

    @keyframes scroll {
        0% {
            transform: translateX(0);
        }
        100% {
            transform: translateX(-50%);
        }
    }

    /* Efek glowing */
    .marquee-text {
        animation: glow 2s ease-in-out infinite alternate;
    }

    @keyframes glow {
        from {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }
        to {
            text-shadow: 2px 2px 20px rgba(255, 255, 255, 0.8),
                         2px 2px 30px rgba(255, 255, 255, 0.6);
        }
    }
</style>
<body>

    <div class="marquee-wrapper">
        <div class="marquee">
            <span class="marquee-text">Mau daftar ya NINING anjing</span>
            <span class="marquee-text">Mau daftar ya NINING anjing</span>
            <span class="marquee-text">Mau daftar ya NINING anjing</span>
            <span class="marquee-text">Mau daftar ya NINING anjing</span>
        </div>
    </div>

</body>
</html>
