    @include('User_interface.parts.header')
    @include('User_interface.parts.logo')
    @include('User_interface.parts.nav')


    <section
        style="background-image: url('{{ asset('bg-down.jpg') }}');"
        class="relative w-full h-[300px] bg-center bg-cover bg-no-repeat flex items-center justify-center font-[Poppins] block">
        <div class="absolute inset-0 bg-[#056a58] opacity-60"></div>
        <div class="relative z-10 text-white text-4xl font-extrabold">
            <h1 class="text-white text-6xl font-[900] font-[Poppins] tracking-tight leading-none">
                Apply Online
            </h1>
            <p style="margin-left: 36%;" class="text-sm mt-4 uppercase  tracking-wide">
                <a href="#" class="hover:underline">Home</a> › Apply
            </p>
        </div>
    </section>

    <div class="container my-5">
        <form>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="dob" class="form-label">Name <span class="required-star">*</span></label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="dob" required>
                        <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="cnic" class="form-label">Father Name <span class="required-star">*</span></label>
                    <input type="text" class="form-control" id="" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="dob" class="form-label">Date Of Birth <span class="required-star">*</span></label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="dob" placeholder="mm/dd/yyyy" required>
                        <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="cnic" class="form-label">CNIC <span class="required-star">*</span></label>
                    <input type="text" class="form-control" id="cnic" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="cellNo" class="form-label">Cell No. <span class="required-star">*</span></label>
                    <input type="tel" class="form-control" id="cellNo" required>
                </div>
                <div class="col-md-6">
                    <label for="qualification" class="form-label">Academic Qualification <span class="required-star">*</span></label>
                    <select class="form-select" id="qualification" required>
                        <option selected disabled>--Select Here--</option>
                        <option value="matric">Matriculation</option>
                        <option value="inter">Intermediate</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="experience" class="form-label">Years Of Experience <span class="required-star">*</span></label>
                    <input type="number" class="form-control" id="experience" required>
                </div>
                <div class="col-md-6">
                    <label for="tradeCourse" class="form-label">Trade Course <span class="required-star">*</span></label>
                    <input type="text" class="form-control" id="tradeCourse" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="courseSession" class="form-label">Course Session <span class="required-star">*</span></label>
                    <input type="text" class="form-control" id="courseSession" required>
                </div>
                <div class="col-md-6">
                    <label for="courseDuration" class="form-label">Course Duration <span class="required-star">*</span></label>
                    <select class="form-select" id="courseDuration" required>
                        <option selected disabled>--Select Duration--</option>
                        <option value="3m">3 Months</option>
                        <option value="6m">6 Months</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="modeOfStudy" class="form-label">Mode Of Study <span class="required-star">*</span></label>
                    <select class="form-select" id="modeOfStudy" required>
                        <option selected disabled>--Select Study Mode--</option>
                        <option value="full">Full-Time</option>
                        <option value="part">Part-Time</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="address" class="form-label">Address <span class="required-star">*</span></label>
                    <input type="text" class="form-control" id="address" required>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <label for="city" class="form-label">City <span class="required-star">*</span></label>
                    <input type="text" class="form-control" id="city" required>
                </div>
                <div class="col-md-6">
                    <label for="nationality" class="form-label">Nationality <span class="required-star">*</span></label>
                    <input type="text" class="form-control" id="nationality" required>
                </div>
            </div>

            <button type="submit" class="btn text-white" style="background-color: #1a744e;">
                Submit
            </button>
        </form>
    </div>

    @include('User_interface.parts.input_img')
    @include('User_interface.parts.footer')