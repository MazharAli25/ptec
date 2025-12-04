@include('User_interface.parts.header')
@include('User_interface.parts.logo')

<!-- <style>
        .hero{
            background: url(images/bg-down.jpg);
        }
    </style> -->
</head>

<body class="font-[Poppins, sans-serif]">
  <div class="logo flex justify-center">
    <img src="images/logo.png" alt="" class="w-[300px] h-[143.3] pt-[24px] pb-[24px]">
  </div>
  @include('User_interface.parts.nav')


  <section
    style="background-image: url('{{ asset(`bg-down.jpg`) }}');"
    class="relative w-full h-[300px] bg-center bg-cover bg-no-repeat flex items-center justify-center font-[Poppins] block">
    <div class="absolute inset-0 bg-[#056a58] opacity-60"></div>
    <div class="relative z-10 text-white text-4xl font-extrabold">
      <h1 class="text-white text-6xl font-[900] font-[Poppins] tracking-tight leading-none">
        Downloads
      </h1>
      <p style="margin-left: 28%;" class="text-sm uppercase  tracking-wide">
        <a href="#" class="hover:underline">Home</a> › Downloads
      </p>
    </div>
  </section>
  <section class="download-items pb-[50px]">
    <div class="container flex justify-center">
      <table class="table-auto mt-[50px] shadow">
        <thead>
          <tr>
            <!-- Heading that spans all 3 columns -->
            <th colspan="3" class="bg-[#056a58] text-white text-left p-[12px] text-lg text-center">
              <div class="text-center text-[16px]">DOWNLOAD PDF'S</div>
            </th>
          </tr>
        <tbody>
          <tr>
            <td class="p-4 text-[16px] text-[#FD5F00]">1</td>
            <td class="p-4 text-[16px] w-[643px] text-[#FD5F00] font-semibold">AFFILIATION FORM</td>
          </tr>
          <tr>
            <td class="p-4 text-[16px] text-[#FD5F00]">2</td>
            <td class="p-4 text-[16px] w-[643px] text-[#FD5F00] font-semibold">AFFILIATION FORM</td>
          </tr>
          <tr>
            <td class="p-4 text-[16px] text-[#FD5F00]">3</td>
            <td class="p-4 text-[16px] w-[643px] text-[#FD5F00] font-semibold">AFFILIATION FORM</td>
          </tr>


        </tbody>
      </table>
    </div>
  </section>
  @include('User_interface.parts.input_img')
  <!-- FOOTER SECTION -->
  @include('User_interface.parts.footer')

</body>

</html>