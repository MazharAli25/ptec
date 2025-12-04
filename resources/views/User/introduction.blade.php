@include('User_interface.parts.header')
<style>
    * {
        font-family: Poppins, sans-serif;
    }

    .hero {
        background: url(images/bg-down.jpg);
    }
</style>
</head>

<body class="font-[Poppins, sans-serif]">
    <div class="logo flex justify-center">
        <img src="images/logo.png" alt="" class="w-[300px] h-[143.3] pt-[24px] pb-[24px]" />
    </div>
    <nav class="nav h-[70px] bg-[#056a58] flex justify-around align-center items-center gap-4 px-[100px]">
        <a href="#" class="text-white text-[14px] font-semibold hover:font-bold font-[Poppins,sans-serif] ]">Home</a>
        <div class="relative group">
            <button class="text-white text-[14px] font-semibold hover:font-bold flex items-center">
                About Us
                <svg class="ml-1 w-3 h-3 fill-current" viewBox="0 0 20 20">
                    <path
                        d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.25a.75.75 0 01-1.06 0L5.25 8.29a.75.75 0 01-.02-1.08z" />
                </svg>
            </button>
            <div
                class="absolute hidden group-hover:block bg-white text-black rounded shadow-md mt-2 w-40 z-2 w-[180px]">
                <a href="#" class="block px-4 py-2 hover:bg-gray-100">Introduction</a>
                <a href="#" class="block px-4 py-2 hover:bg-gray-100">Why PTEC</a>
                <a href="#" class="block px-4 py-2 hover:bg-gray-100">Regulations</a>
            </div>
        </div>
        <a href="#" class="text-white text-[14px] font-semibold hover:font-bold font-[Poppins,sans-serif] ]">Trades</a>
        <div class="relative group">
            <button class="text-white text-[14px] font-semibold hover:font-bold flex items-center">
                E-Services
                <svg class="ml-1 w-3 h-3 fill-current" viewBox="0 0 20 20">
                    <path
                        d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.25a.75.75 0 01-1.06 0L5.25 8.29a.75.75 0 01-.02-1.08z" />
                </svg>
            </button>
            <div
                class="absolute hidden group-hover:block bg-white text-black rounded shadow-md mt-2 w-40 z-2 w-[250px]">
                <a href="#" class="block px-4 py-2 hover:bg-gray-100">Info E-Services</a>
                <a href="#" class="block px-4 py-2 hover:bg-gray-100">Students Material</a>
                <a href="#" class="block px-4 py-2 hover:bg-gray-100">Teachers Material</a>
                <a href="#" class="block px-4 py-2 hover:bg-gray-100">Syllabus & Modal Papers</a>
            </div>
        </div>

        <a href="#"
            class="text-white text-[14px] font-semibold hover:font-bold font-[Poppins,sans-serif] ]">Verification</a>
        <a href="#" class="text-white text-[14px] font-semibold hover:font-bold font-[Poppins,sans-serif] ]">Challan</a>
        <a href="#"
            class="text-white text-[14px] font-semibold hover:font-bold font-[Poppins,sans-serif] ]">Downloads</a>
        <a href="#"
            class="text-white text-[14px] font-semibold hover:font-bold font-[Poppins,sans-serif] ]">Contacts</a>
    </nav>
    <section
        class="relative h-[300px] bg-[url('/images/bg-down.jpg')] bg-center bg-cover bg-no-repeat flex items-center justify-center">
        <div class="absolute inset-0 bg-[#056a58] opacity-60"></div>

        <div class="relative z-10 text-white text-4xl font-[900] text-[40px] font-(Poppins, sans-serif)">
            E-Services
        </div>
    </section>
    <section class="main">
        <div class="flex justify-center">
            <div class="container w-[70vw] py-[48px]">
                <!-- INTRODUCTION -->
                <h3 class="text-[32px] font-500 mb-2">Who We Are ?</h3>
                <p class="text-[#5f5f5f]">PTEC has been constituted by the Government of Pakistan under National Training Ordinance 1980 amended Ordinance 2002 on the initiative of World Bank, ILO and Employers’ Federation of Pakistan, to make the Technical & Vocational Training Programs flexible, demand driven and cost effective with the maximum participation of employers. It is basically an employer led autonomous organization functioning under National Training Board on the methodology of public & private partnership. The Council is comprised of 10 members with following composition.</p>


                <!-- Mission -->
                <h3 class="text-[32px] font-500 mb-3 mt-4">Mission</h3>
                <p class="text-[#5f5f5f]">Develop a flexible and responsive Technical Vocational Training System to prepare competent and trained workforce capable to respond to the fast changing needs of the 21st century and to contribute in the Economic Development of Pakistan.
                    The PTEC from its inception (1995) has been very successful in catering to the needs of Human Capital Development by arranging need based training programs and organizing workshops / seminars on promotion of Technical Vocational Education & Training, Entrepreneurship and Employment Generation, Women Training and Empowerment, Enterprise Development and other related issues.</p>

                <!-- Achievements -->
                <h3 class="text-[32px] font-500 mb-3 mt-4">Achievements</h3>
                <ul class="list-disc marker:text-[#5f5f5f] marker:text-[14px] ml-[50px]">
                    <li class="text-[16px] text-[#5f5f5f] pb-1">
                        Provide productive link between industry and training providers for enhancing efficiency, effectiveness and responsive of training.
                    </li>
                    <li class="text-[16px] text-[#5f5f5f] pb-1">
                        Design & develop training courses with the involvement of experts from relevant industries and training institutes.
                    </li>


                    <li class="text-[16px] text-[#5f5f5f] pb-1">
                        Identification and selection of training providers in the public & private sector.
                    </li>
                    <li class="text-[16px] text-[#5f5f5f] pb-1">
                        Design & develop training courses with the involvement of experts from relevant industries and training institutes.
                    </li>
                    <li class="text-[16px] text-[#5f5f5f] pb-1">
                        Advertising / publicizing training programs with the support of training providers.
                    </li>
                    <li class="text-[16px] text-[#5f5f5f] pb-1">
                        Arrange training at reputable training institutions having requisite training infrastructure including qualified and experienced faculty.
                    </li>
                    <li class="text-[16px] text-[#5f5f5f] pb-1">
                        Monitor & Evaluate the training through physical visit and other means to ensure quality of training.
                    </li>
                    <li class="text-[16px] text-[#5f5f5f] pb-1">
                        Arrange and conduct final Trade Testing & Certification for successful trainees.
                    </li>


                    <li class="text-[16px] text-[#5f5f5f] pb-1">
                        Provide assistance in arranging internship and employment after training.
                    </li>
                    <li class="text-[16px] text-[#5f5f5f] pb-1">
                        Arrange skill upgrading, professional development and customized courses.
                    </li>
                    <li class="text-[16px] text-[#5f5f5f] pb-1">
                        Provide assistance to organization to develop and implement in-plant training programs to address the skill deficiencies of employees.
                    </li>
                    <li class="text-[16px] text-[#5f5f5f] pb-1">
                        Organize seminars, workshops and other programs to promote training and employment.
                    </li>

                </ul>

                <h3 class="text-[32px] font-500 mb-3 mt-4">Organization Chart</h3>

                <img src="images/chart.jpg" class="w-[100%]" alt="">

            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <section class="footer py-[84px] bg-[#232323] flex flex-row justify-around">
        <div class="get-in-touch flex flex-col">
            <span class="text-[22px] text-white">Get in touch</span>
            <a href="" class="text-[14px] text-white font-[Poppins, sans-serif]"><i
                    class="fa-solid fa-envelope pt-[20px] text-[18px] pr-[15px]"></i> info@ptec.edu.pk</a>
            <span class="text-[22px] text-white pt-[20px] font-semibold">Connect With Us</span>
            <div class="icons mt-[15px] flex flex-row justify-around">
                <a href=""><i
                        class="fa-brands fa-twitter bg-[#FFFFFF0D] p-[10px] text-white text-[20px] rounded-[50%]"></i></a>
                <a href=""><i
                        class="fa-brands fa-facebook bg-[#FFFFFF0D] p-[10px] text-white text-[20px] rounded-[50%]"></i></a>
                <a href=""><i
                        class="fa-brands fa-instagram bg-[#FFFFFF0D] p-[10px] text-white text-[20px] rounded-[50%]"></i></a>
            </div>

        </div>
        <div class="quick-links">
            <span class="text-[22px] text-white">Quick Links</span>
            <ul class="pt-[25px]">
                <li class="text-[#FFFFFFB3]"><i class="fa-solid fa-arrow-right px-[10px]"></i>Home</li>
                <li class="text-[#FFFFFFB3]"><i class="fa-solid fa-arrow-right px-[10px]"></i>About</li>
                <li class="text-[#FFFFFFB3]"><i class="fa-solid fa-arrow-right px-[10px]"></i>Trades</li>
                <li class="text-[#FFFFFFB3]"><i class="fa-solid fa-arrow-right px-[10px]"></i>Apply Online</li>
                <li class="text-[#FFFFFFB3]"><i class="fa-solid fa-arrow-right px-[10px]"></i>Verification</li>
                <li class="text-[#FFFFFFB3]"><i class="fa-solid fa-arrow-right px-[10px]"></i>Contact</li>
            </ul>
        </div>
        <div class="downloads">
            <span class="text-[22px] text-white">Downloads</span>
            <ul class="pt-[25px]">
                <li class="text-[#FFFFFFB3]"><i class="fa-solid fa-arrow-right px-[10px]"></i>AFFILIATION FORM</li>
            </ul>
        </div>
        <div class="subscribe flex flex-col ">
            <span class="text-[22px] text-white">Subscibe Us!</span>
            <input type="text" placeholder="Enter email address"
                class="bg-[#FFFFFFA1] px-4 py-3 focus:outline-none text-center mt-[25px] transition-color duration-300">
            <button
                class="bg-[#5d50c6] mt-3 px-4 py-3 text-white hover:bg-[#056a58] transition-colors duration-300">Submit</button>
        </div>
    </section>
</body>

</html>