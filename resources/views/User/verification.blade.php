@include('User_interface.parts.header')
@include('User_interface.parts.logo')


<body class="font-[Poppins, sans-serif]">
    <div class="logo flex justify-center">
        <img src="images/logo.png" alt="" class="w-[300px] h-[143.3] pt-[24px] pb-[24px]" />
    </div>
    @include('User_interface.parts.nav')




    <section
        style="background-image: url('{{ asset('bg-down.jpg') }}');"
        class="relative w-full h-[300px] bg-center bg-cover bg-no-repeat flex items-center justify-center font-[Poppins] block">
        <div class="absolute inset-0 bg-[#056a58] opacity-60"></div>
        <div class="relative z-10 text-white text-4xl font-extrabold">
            <h1 class="text-white text-6xl font-[900] font-[Poppins] tracking-tight leading-none">
                Verification
            </h1>
            <p style="margin-left: 28%;" class="text-sm uppercase  tracking-wide">
                <a href="#" class="hover:underline">Home</a> › Verification
            </p>
        </div>
    </section>






    <section class="main flex justify-center">
        <div class="container flex flex-col justify-center items-center align-center w-[70vw] mt-[70px] mb-[70px]">
            <form action="" class="flex flex col">
                <div class="flex flex-col block relative">
                    <label for="v_code" class="font-bold mb-3 text-[#5f5f5f] text-[18px]">Verification Code / Roll
                        No:</label>
                    <input type="number" id="v_code" name="v_code" placeholder="Enter Your Verification Code"
                        class="w-[670px] h-[52px] px-[12px] py-[6px] border-[1px] border-gray-500 font-[20px] rounded" />
                    <button class="bg-[#056a58] text-white px-4 py-2 cursor-pointer absolute right-0 bottom-[5px]"
                        type="submit">
                        Verify
                    </button>
                </div>
            </form>
            
            <div class="content pr-[120px] pl-[145px] mt-[50px]">
                <span class="font-bold text-[#5f5f5f] text-[14px]">DISCLAIMER:</span>
                <p class="text-[#5f5f5f] text-[14px]">
                    This result is issued provisionally, errors and omission excepted,
                    as a notice only. Any entry appearing on the website does not itself
                    confer any right or privilege on a candidate for the grant of
                    certificate which will be issued under the rules/regulations on the
                    basis of the original record of the Board.
                </p>
            </div>
            <div class="content w-[100%] pl-[145px] mt-[50px]">
                <span class="font-bold text-[#5f5f5f] text-[14px]">Words Need to Know:</span>
                <ul class="list-disc marker:text-[#5f5f5f] marker:text-[12px]">
                    <li class="text-[14px] text-[#5f5f5f] pb-1">
                        <span class="font-bold text-[#5f5f5f] text-[14px]">RL:</span>
                        Result Late
                    </li>
                    <li class="text-[14px] text-[#5f5f5f] pb-1">
                        <span class="font-bold text-[#5f5f5f] text-[14px]">RLF:</span>
                        Result Late Fees
                    </li>
                    <li class="text-[14px] text-[#5f5f5f]">
                        <span class="font-bold text-[#5f5f5f] text-[14px]">MNI:</span>
                        Marks Not Improved
                    </li>
                    <li class="text-[14px] text-[#5f5f5f] pb-1">
                        <span class="font-bold text-[#5f5f5f] text-[14px]">RL CC:</span>
                        Result Late Due to Course Completion Certificate
                    </li>
                    <li class="text-[14px] text-[#5f5f5f] pb-1">
                        <span class="font-bold text-[#5f5f5f] text-[14px]">UMC:</span>
                        Unfair Means Case
                    </li>
                </ul>
            </div>
        </div>
    </section>
    @include('User_interface.parts.input_img')

    <!-- FOOTER SECTION -->
    @include('User_interface.parts.footer')
</body>

</html>