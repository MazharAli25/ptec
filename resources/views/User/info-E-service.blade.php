@include('User_interface.parts.header')
@include('User_interface.parts.logo')


@include('User_interface.parts.nav')
<!-- Logo Section -->
<section
    style="background-image: url('{{ asset(`bg-down.jpg`) }}');"
    class="relative w-full h-[300px] bg-center bg-cover bg-no-repeat flex items-center justify-center font-[Poppins] block">

    <!-- Green Overlay -->
    <div class="absolute inset-0 bg-[#056a58] opacity-60"></div>

    <!-- Heading -->
    <div class="relative z-10 text-white text-4xl font-extrabold">
        E-Services
    </div>
</section>

<!-- Main Content -->
<section class="main">
    <div class="flex justify-center">
        <div class="container w-[70vw] py-[48px]">
            <!-- INTRODUCTION -->
            <h3 class="text-[32px] font-bold mb-2">Introduction</h3>
            <p class="text-[#5f5f5f]">
                Learning resources are texts, videos, software, and other materials that teachers use to assist
                students to meet expectations for learning as defined by the provincial curricula. A quality learning
                resource has to fit the curriculum and meet expectations for learning keeping social considerations,
                and age/developmental appropriateness in mind. In this age of technological advancement learning and
                teaching resources are not confined to a mere textbook. There are now diversified web-based learning
                materials, computer-based learning, structured coursework and audio-visual teaching aids.
            </p>

            <p class="text-[#5f5f5f] mt-3">
                In fact, video tutorials amplify learning and increase student engagement, which in turn helps boost
                creativity and the desire to achieve great heights. Most importantly, if students are interested in the
                material, they will process and remember it better. Digital videos also facilitate remote learning
                opportunities so that teachers can reach students from all over the world.
            </p>

            <!-- THE RESOURCES ON PTEC WEBSITE -->
            <h3 class="text-[32px] font-bold mb-3 mt-4">The Resources On PTEC Website</h3>
            <p class="text-[#5f5f5f]">
                The tab ‘Resource Material’ on the website gives an option to look for relevant subjects of each grade.
                Use the search bar for the subject of your preference, whereas the main tab holds the specific subject
                title. Once the tab is clicked, you will be given the option of grades. As you click the grade the
                document will open.
            </p>

            <p class="text-[#5f5f5f] mt-3">
                You will find three types of documents: teacher resource, students’ resource and assessments.
            </p>

            <p class="text-[#5f5f5f] mt-3">
                This section is in progress. Currently, we have developed resources for Engineering, Information
                technology, Management science, and Medical Science. Resource materials for other subjects are in
                progress.
            </p>

            <p class="text-[#5f5f5f] mt-3">
                Examination Syllabi too, are developed for different subjects whereas other subjects are in progress.
            </p>

            <!-- DIGITAL RESOURCES -->
            <h3 class="text-[32px] font-bold mb-3 mt-4">Digital Resources</h3>
            <p class="text-[#5f5f5f]">
                In this digital age, students use educational videos for learning abstract topics as well as tedious
                steps of mathematical calculations. Topics that once seemed difficult to teach and learn are now more
                accessible and understandable thanks to the availability of educational videos for online learning.
            </p>

            <p class="text-[#5f5f5f] mt-3">
                Studies have shown that the use of short video clips allows for more efficient processing and memory
                recall. The visual and auditory nature of videos appeals to a wide audience and allows each user to
                process information in a way that’s natural to them. In a nutshell, videos are good teachers.
            </p>

            <h3 class="text-[20px] font-bold mb-3 mt-4">Research Evidence Of Videos As A Go</h3>
            <ul class="list-disc marker:text-[#5f5f5f] ml-[50px]">
                <li class="text-[16px] text-[#5f5f5f] pb-1">
                    <span class="font-bold">Videos create a more engaging sensory experience than using print materials alone.</span>
                    Learners actually get to see and hear the concept being taught, and they can process it in the same
                    way they process their everyday interactions.
                </li>
                <li class="text-[16px] text-[#5f5f5f] pb-1">
                    <span class="font-bold">They provide a go-to resource that can be watched from anywhere</span>
                    with an internet connection. Videos are accessible on a multitude of devices including laptops,
                    tablets, and smartphones.
                </li>
                <li class="text-[16px] text-[#5f5f5f] pb-1">
                    <span class="font-bold">Videos increase knowledge retention</span>
                    since they can be stopped and replayed as many times as needed.
                </li>
                <li class="text-[16px] text-[#5f5f5f] pb-1">
                    <span class="font-bold">They greatly assist in the learning of all subjects,</span>
                    but particularly those topics that are complex and/or highly visual.
                </li>
                <li class="text-[16px] text-[#5f5f5f] pb-1">
                    <span class="font-bold">They offer flexibility</span>
                    to pause, rewind, or skip throughout the video to review particular areas.
                </li>
                <li class="text-[16px] text-[#5f5f5f] pb-1">
                    <span class="font-bold">They enable teachers to create a flipped classroom</span>
                    or “blended” learning environment.
                </li>
            </ul>

            <p class="text-[#5f5f5f] font-bold mt-4">
                Pakistan Technical & Educational Council acknowledges the importance of both print material and textbooks.
                We believe videos are meant to enhance other materials and lectures — not replace them.
            </p>
        </div>
    </div>
</section>
@include('User_interface.parts.input_img')
<!-- FOOTER -->
@include('User_interface.parts.footer')
