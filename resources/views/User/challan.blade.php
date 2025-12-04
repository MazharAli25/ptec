@include('User_interface.parts.header')
@include('User_interface.parts.logo')
@include('User_interface.parts.nav')

<section
    style="background-image: url('{{ asset(`bg-down.jpg`) }}');"
    class="relative w-full h-[300px] bg-center bg-cover bg-no-repeat flex items-center justify-center font-[Poppins] block">

    <div class="absolute inset-0 bg-[#056a58] opacity-60"></div>

    <!-- Heading -->
    <div class="relative z-10 text-white text-4xl font-extrabold">
        <h1 class="text-4xl font-bold mb-3">Generate Bank Deposit Slip</h1>
        <p style="margin-left: 36%;" class="text-sm  uppercase tracking-wide">
            <a href="#" class="hover:underline">Home</a> › Contact
        </p>
    </div>
</section>

<!-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ -->

<div class="container form-container">
    <form>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="candidateName" class="form-label">
                    Name of Candidate / Institute <span class="required-star">*</span>
                </label>
                <input type="text" class="form-control" id="candidateName" required>
            </div>
            <div class="col-md-6">
                <label for="rollNo" class="form-label">
                    Roll No. <span class="required-star">*</span>
                </label>
                <input type="text" class="form-control" id="rollNo" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="registrationNo" class="form-label">
                    Registration No. <span class="required-star">*</span>
                </label>
                <input type="text" class="form-control" id="registrationNo" required>
            </div>
            <div class="col-md-6">
                <label for="contact" class="form-label">
                    Contact <span class="required-star">*</span>
                </label>
                <input type="tel" class="form-control" id="contact" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="discipline" class="form-label">
                    Discipline <span class="required-star">*</span>
                </label>
                <input type="text" class="form-control" id="discipline" required>
            </div>
            <div class="col-md-6">
                <label for="accountOf" class="form-label">
                    On Account Of. <span class="required-star">*</span>
                    <small class="text-secondary">(<a href="#" class="text-decoration-none">view fee structure</a>)</small>
                </label>
                <select class="form-select" id="accountOf" required>
                    <option selected>Registration Fee</option>
                    <option value="1">Exam Fee</option>
                    <option value="2">Late Fee</option>
                </select>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12">
                <label for="address" class="form-label">
                    Address <span class="required-star">*</span>
                </label>
                <input type="text" class="form-control" id="address" required>
            </div>
        </div>

        <div class="row align-items-center mb-4">
            <div class="col-auto d-flex align-items-center">
                <div class="form-check me-3">
                    <input class="form-check-input" type="checkbox" value="" id="imNotRobot" required>
                    <label class="form-check-label" for="imNotRobot">
                        I'm not a robot
                    </label>
                </div>
                <div class="text-muted small me-4" style="font-size: 0.75rem;">
                    reCAPTCHA is changing its terms of service. <a href="#" class="text-decoration-none">Take action</a>
                </div>
            </div>
            <div class="col-auto">
                <div class="text-center">
                    <img src="https://via.placeholder.com/30x30?text=R" alt="reCAPTCHA logo" class="me-1" style="vertical-align: middle;">
                    <span class="text-muted small" style="font-size: 0.75rem;">reCAPTCHA<br><a href="#" class="text-decoration-none">Privacy</a> - <a href="#" class="text-decoration-none">Terms</a></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn text-white" style="background-color: #1a744e;">
                    Print Challan
                </button>
            </div>
        </div>

    </form>
</div>


<div class="container mt-5" style="margin-bottom:20px">
    <div class="card shadow-sm border-0">
        <div class="fee-header-band">
            FEE STRUCTURE
        </div>

        <div class="table-responsive">
            <table class="table table-bordered mb-0">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 15%;">Code No</th>
                        <th style="width: 65%;">Details</th>
                        <th class="fee-column" style="width: 20%;">Fee (Rs.)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">11</td>
                        <td>Registration Fee</td>
                        <td class="fee-column">1,580</td>
                    </tr>
                    <tr>
                        <td class="text-center">12</td>
                        <td>Examination Fee</td>
                        <td class="fee-column">1,800</td>
                    </tr>
                    <tr>
                        <td class="text-center">13</td>
                        <td>Duplicate Diploma / Certificate / DMC</td>
                        <td class="fee-column">1,000</td>
                    </tr>
                    <tr>
                        <td class="text-center">14</td>
                        <td>Affiliation Fee</td>
                        <td class="fee-column">20,000</td>
                    </tr>
                    <tr>
                        <td class="text-center">15</td>
                        <td>DMC Fee</td>
                        <td class="fee-column">500</td>
                    </tr>
                    <tr>
                        <td class="text-center">16</td>
                        <td>Verification Fee</td>
                        <td class="fee-column">1,500</td>
                    </tr>
                    <tr>
                        <td class="text-center">17</td>
                        <td>Change Correction</td>
                        <td class="fee-column">700</td>
                    </tr>
                    <tr>
                        <td class="text-center">18</td>
                        <td>Gazette Fee</td>
                        <td class="fee-column">1,500</td>
                    </tr>
                    <tr>
                        <td class="text-center">19</td>
                        <td>Hall Creation Fee</td>
                        <td class="fee-column">15,000</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>


@include('User_interface.parts.input_img')
@include('User_interface.parts.footer')



















































<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>











</body>

</html>