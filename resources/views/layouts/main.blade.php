<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/b922d3d440.js" crossorigin="anonymous"></script>
    <title>Downloads | PTEC</title>
    <style>
        .hero{
            background: url(images/bg-down.jpg);
        }
    </style>
</head>
<body class="font-[Poppins, sans-serif]">
    <div class="logo flex justify-center">
        <img src="images/logo.png" alt="" class="w-[300px] h-[143.3] pt-[24px] pb-[24px]">
    </div>
   <x-nav></x-nav>
   <section class="relative h-[300px] bg-[url('images/bg-down.jpg')] bg-center bg-cover bg-no-repeat flex items-center justify-center">

        <!-- Greenish Overlay -->
        <div class="absolute inset-0 bg-[#056a58] opacity-60"></div>
    
        <!-- Content -->
        <div class="relative z-10 text-white text-4xl font-[900] text-[40px] font-(Poppins, sans-serif)">
            {{ yield('hero-heading') }}
        </div>  
    </section>

    {{ yeild('content') }}
    
    <!-- FOOTER SECTION -->
    <x-footer></x-footer>
</body>
</html>