@include('User_interface.parts.header')
@include('User_interface.parts.logo')
@include('User_interface.parts.nav')

<section
    style="background-image: url('{{ asset('bg-down.jpg') }}');"
    class="relative w-full h-[300px] bg-center bg-cover bg-no-repeat flex items-center justify-center font-[Poppins] block">
    <div class="absolute inset-0 bg-[#056a58] opacity-60"></div>
    <div class="relative z-10 text-white text-4xl font-extrabold">
        <h1 class="text-white text-6xl font-[900] font-[Poppins] tracking-tight leading-none">
            Trades
        </h1>
        <p style="margin-left: 22%;" class="text-sm uppercase  tracking-wide">
            <a href="#" class="hover:underline">Home</a> › Trades
        </p>
    </div>
</section>

<style>
    .course-count {
        background-color: #38a169;

        color: white;
        padding: 2px 10px;
        font-size: 0.75rem;
        border-radius: 50rem;

        display: inline-block;
        margin-top: 8px;
    }


    .card-img-top {
        height: 150px;

        object-fit: cover;

    }

    .card-body {
        text-align: center;
    }
</style>
</head>

<body>

    <div class="container my-5">
        <div class="row g-4">
            <div style=" transition: transform 500ms ease-in-out, box-shadow 1000ms ease-in-out;
        cursor: pointer;" class="col-6 col-md-3 hover:scale-105 transition-transform-duration-2000">
                <div class="card h-100 border-0 shadow-sm">
                    <img src="https://ptec.com.pk/images/trades/accounts-and-finance.JPG" class="card-img-top" alt="Accounts and Finance">
                    <div class="card-body d-flex flex-column justify-content-between align-items-center">
                        <h5 class="card-title fs-6 fw-normal mb-1">Accounts and Finance</h5>
                        <span class="course-count">35 courses</span>
                    </div>
                </div>
            </div>

            <div style=" transition: transform 500ms ease-in-out, box-shadow 1000ms ease-in-out;
        cursor: pointer;" class="col-6 col-md-3 hover:scale-105 transition-transform-duration-2000">
                <div class="card h-100 border-0 shadow-sm">
                    <img src="https://ptec.com.pk/images/trades/banking.png" class="card-img-top" alt="Banking">
                    <div class="card-body d-flex flex-column justify-content-between align-items-center">
                        <h5 class="card-title fs-6 fw-normal mb-1">Banking</h5>
                        <span class="course-count">14 courses</span>
                    </div>
                </div>
            </div>

            <div style=" transition: transform 500ms ease-in-out, box-shadow 1000ms ease-in-out;
        cursor: pointer;" class="col-6 col-md-3 hover:scale-105 transition-transform-duration-2000">
                <div class="card h-100 border-0 shadow-sm">
                    <img src="https://ptec.com.pk/images/trades/clinical-medical.jpg" class="card-img-top" alt="Clinical Medical">
                    <div class="card-body d-flex flex-column justify-content-between align-items-center">
                        <h5 class="card-title fs-6 fw-normal mb-1">Clinical Medical</h5>
                        <span class="course-count">27 courses</span>
                    </div>
                </div>
            </div>

            <div style=" transition: transform 500ms ease-in-out, box-shadow 1000ms ease-in-out;
        cursor: pointer;" class="col-6 col-md-3 hover:scale-105 transition-transform-duration-2000">
                <div class="card h-100 border-0 shadow-sm">
                    <img src="https://ptec.com.pk/images/trades/conservation-enviornment.JPG" class="card-img-top" alt="Conservation Environment">
                    <div class="card-body d-flex flex-column justify-content-between align-items-center">
                        <h5 class="card-title fs-6 fw-normal mb-1">Conservation Environment</h5>
                        <span class="course-count">14 courses</span>
                    </div>
                </div>
            </div>

            <div style=" transition: transform 500ms ease-in-out, box-shadow 1000ms ease-in-out;
        cursor: pointer;" class="col-6 col-md-3 hover:scale-105 transition-transform-duration-2000">
                <div class="card h-100 border-0 shadow-sm">
                    <img src="https://ptec.com.pk/images/trades/construction.JPG" class="card-img-top" alt="Construction">
                    <div class="card-body d-flex flex-column justify-content-between align-items-center">
                        <h5 class="card-title fs-6 fw-normal mb-1">Construction</h5>
                        <span class="course-count">21 courses</span>
                    </div>
                </div>
            </div>

            <div style=" transition: transform 500ms ease-in-out, box-shadow 1000ms ease-in-out;
        cursor: pointer;" class="col-6 col-md-3  hover:scale-105 transition-transform-duration-2000">
                <div class="card h-100 border-0 shadow-sm ">
                    <img src="https://ptec.com.pk/images/trades/education-diploma.JPG" class="card-img-top" alt="Education Diploma">
                    <div class="card-body d-flex flex-column justify-content-between align-items-center">
                        <h5 class="card-title fs-6 fw-normal mb-1">Education Diploma</h5>
                        <span class="course-count">13 courses</span>
                    </div>
                </div>
            </div>

            <div style="transition: transform 500ms ease-in-out, box-shadow 1000ms ease-in-out;
        cursor: pointer;" class="col-6 col-md-3 hover:scale-105 transition-transform-duration-2000">
                <div class="card h-100 border-0 shadow-sm">
                    <img src="https://ptec.com.pk/images/trades/engineering.jpg" class="card-img-top" alt="Technical & Engineering">
                    <div class="card-body d-flex flex-column justify-content-between align-items-center">
                        <h5 class="card-title fs-6 fw-normal mb-1">Technical & Engineering</h5>
                        <span class="course-count">36 courses</span>
                    </div>
                </div>
            </div>

            <div style=" transition: transform 500ms ease-in-out, box-shadow 1000ms ease-in-out;
        cursor: pointer;" class="col-6 col-md-3 hover:scale-105 transition-transform-duration-2000">
                <div class="card h-100 border-0 shadow-sm">
                    <img src="https://ptec.com.pk/images/trades/executive-courses.JPG" class="card-img-top" alt="Executive Courses">
                    <div class="card-body d-flex flex-column justify-content-between align-items-center">
                        <h5 class="card-title fs-6 fw-normal mb-1">Executive Courses</h5>
                        <span class="course-count">11 courses</span>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @include('User_interface.parts.input_img')
    @include('User_interface.parts.footer')