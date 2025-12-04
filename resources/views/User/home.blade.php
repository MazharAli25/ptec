@include('User_interface.parts.header')
@include('User_interface.parts.logo')
@include('User_interface.parts.nav')

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div style="width:100%; height:95vh;" class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="https://ptec.com.pk/images/slider-IT-and-Management.jpg" alt="First slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="https://ptec.com.pk/images/slider-Engineering.jpg" alt="Second slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="https://ptec.com.pk/images/slider-Health-and-safety.jpg" alt="Third slide">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<section class="relative bg-[url('/bg-down.jpg')] bg-cover bg-center bg-no-repeat py-16 px-6">
    <!-- Dark Overlay -->
    <div class="absolute inset-0 bg-teal-900/80"></div>

    <!-- Content -->
    <div class="relative z-10 max-w-5xl mx-auto text-white">
        <!-- Title -->
        <h1 class="text-3xl md:text-4xl font-extrabold leading-snug uppercase mb-6">
            Welcome to Pakistan Technical & Educational Council Islamabad
        </h1>

        <!-- Paragraphs -->
        <p class="text-base md:text-lg leading-relaxed mb-6">
            The Pakistan Technical & Educational Council (PTEC) has been constituted as statutory body under society
            registration Act (Xxi of 1860), by the Government of Pakistan under National Training Ordinance – 1980 amended
            Ordinance – 2002 on the initiative of World Bank, ILO and Employers’ Federation of Pakistan, to make the Technical
            & Vocational Training Programs flexible, demand driven and cost effective with the maximum participation of employers.
        </p>

        <p class="text-base md:text-lg leading-relaxed mb-6">
            The main social target of our Organization, Governments and of WHO should be the attainment by all the people of
            the world by the year 2050 of a level of health which would permit them to lead a socially and economically
            productive life. The basic aims of Trade Testing Council are to promote Technical / Health Education and to
            provide well-trained and highly Skilled Professionals to Society and to decrease unemployment graph level. It is
            basically an employer led autonomous organization functioning under National Training Board on the methodology
            of public & private partnership.
        </p>

        <!-- Subheading -->
        <h2 class="text-2xl font-bold mt-8 mb-4">Working Mechanism</h2>

        <!-- Paragraph -->
        <p class="text-base md:text-lg leading-relaxed mb-4">
            PTEC design and develop training courses in accordance with emerging needs with the involvement of experts from
            relevant industry. PTEC does not have its own training institutes but collaborates and works in partnership with
            industry, training institutes / colleges and other organizations to arrange training which is:
        </p>

        <!-- List -->
        <ul class="list-decimal list-inside space-y-2 text-base md:text-lg leading-relaxed">
            <li>Relevant to the Needs of Local Industry / Employment Market.</li>
            <li>Flexible to Respond to Change.</li>
            <li>Recognized for Employment Nationally and Internationally</li>
        </ul>
        <div class=" md:flex">
            <div class="md:ml-8">
                <h2 class="text-2xl font-bold mt-8 mb-4">Major Responsibilities</h2>
                <ul class=" list-inside space-y-2 text-base md:text-lg leading-relaxed">
                    <li>Prescribe courses of study for its examinations.</li>
                    <li> Lay down conditions for recognition of institutions to ensure provision of requisite <br>
                        facilities in the affiliated institutions.</li>
                    <li> Grant certificates and diplomas to persons who have passed its examinations.</li>
                    <li>Institute and award scholarships, medals and prizes in accordance with the Regulations and Rules.</li>
                </ul>
            </div>
            <div>

                <h2 style="width: 300px;" class="text-2xl font-bold w-full  mt-8 mb-4">Jurisdiction of PTEC</h2>
                <Ul class=" list-inside space-y-2 text-base md:text-lg leading-relaxed">
                    <li> Khyber Pakhtunkhwa</li>
                    <li> Islamabad</li>
                    <li> Azad Jammu Kashmir</li>
                    <li>Gilgit Baltistan</li>
                    <li>Chitral</li>
                    <li>Lahore</li>
                    <li>Karachi</li>
                </Ul>
            </div>
        </div>
    </div>
</section>
<div class="bg-gray-100 text-center py-10 relative">

    <h2 class="text-lg md:text-xl font-semibold uppercase mb-6 tracking-wide">
        REGISTER GOVERNMENT OF PUNJAB
    </h2>
    <img
        src="https://ptec.com.pk/images/registrar-logo.png"
        alt="Registrar Logo"
        class="mx-auto h-40 md:h-44 mb-6" />


    <h2 class="text-lg md:text-xl font-semibold uppercase mt-4 mb-2 tracking-wide">
        PROJECT
    </h2>

    <p class="text-base md:text-lg font-semibold uppercase">
        PAKISTAN HEALTH SCIENCES COUNCIL &amp; SKILL ORGANIZATION
    </p>
</div>



<div class="max-w-5xl mx-auto p-8 font-sans text-gray-800 bg-white">
    <h2 class="text-2xl font-bold mb-6 text-center">Mode of Studies</h2>
    <p class="text-gray-600 mb-8 text-center">
        We develop diverse, student- and workplace-oriented learning environments that promote personal and professional growth, communal responsibility and active citizenship.
    </p>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center md:text-left">
        <!-- Regular Education -->
        <div>
            <h3 class="text-xl font-semibold mb-2">Regular Education</h3>
            <p class="text-gray-600">
                "Regular education" is the term often used to describe the educational experience of typically developing students.
            </p>
        </div>
        <!-- Fast Track / RPL Education -->
        <div>
            <h3 class="text-xl font-semibold mb-2">Fast Track/RPL Education</h3>
            <p class="text-gray-600">
                Fast Track/RPL Education Recognition of Prior Learning RPL and Skills Recognition is a simple process of formal recognition through which you turn your experience or overseas qualification into an country recognized qualification.
            </p>
        </div>
        <!-- Distance Education -->
        <div>
            <h3 class="text-xl font-semibold mb-2">Distance Education</h3>
            <p class="text-gray-600">
                Distance education, also called distance learning, is the education of students who may not always be physically present at a institutions.
            </p>
        </div>
    </div>
</div>
@include('User_interface.parts.input_img')
@include('User_interface.parts.footer')