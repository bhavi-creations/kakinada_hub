


<?php
   include "header.php";
   ?>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Contact Us</h2>
        <form>
            <div class="mb-3">
                <label for="name" class="form-label">Child's Name</label>
                <input type="text" class="form-control" id="name" placeholder="Enter child's name" required>
            </div>
            <div class="mb-3">
                <label for="parentName" class="form-label">Parent's Name</label>
                <input type="text" class="form-control" id="parentName" placeholder="Enter parent's name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="tel" class="form-control" id="phone" placeholder="Enter phone number" required>
            </div>
            <div class="mb-3">
                <label for="service" class="form-label">Select Service</label>
                <select class="form-select nice-select" id="service" required>
                    <option selected disabled>Choose a service</option>
                    <option value="daycare">Daycare</option>
                    <option value="preschool">Preschool</option>
                    <option value="kindergarten">Kindergarten</option>
                    <option value="afterSchool">After School Programs</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control" id="message" rows="4" placeholder="Write your message here"></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100">Submit</button>
        </form>
    </div>


<!-- 
    <section class="cs_appointment">
    <div class="cs_height_110 cs_height_lg_70"></div>
    <div class="container">
      <div class="cs_appointment_form_wrapper">
        <div class="cs_section_heading cs_style_1 text-center">
          <p class="cs_section_subtitle text">
            <span class="cs_shape_left text"></span>MAKE APPOINTMENTS<span class="cs_shape_right text"></span>
          </p>
          <h2 class="cs_section_title">Booking Now Appointments</h2>
        </div>
        <div class="cs_height_40 cs_height_lg_35"></div>
        <form class="cs_appointment_form row cs_gap_y_30">
          <div class="col-md-6">
            <input type="text" name="name" class="cs_form_field" placeholder="Name">
          </div>
          <div class="col-md-6">
            <input type="email" name="email" class="cs_form_field" placeholder="Email">
          </div>
          <div class="col-md-12">
            <input type="text" name="address" class="cs_form_field" placeholder="Address">
          </div>
          <div class="col-md-12">
            <select name="service" class="cs_form_field">
              <option value="choose-service">Choose Service</option>
              <option value="crutches">Crutches</option>
              <option value="x-Ray">X-Ray</option>
              <option value="pulmonary">Pulmonary</option>
              <option value="cardiology">Cardiology</option>
              <option value="dental-care">Dental Care</option>
              <option value="neurology">Neurology</option>
            </select>
          </div>
          <div class="col-md-12">
            <input type="text" name="date" class="cs_form_field" placeholder="Appointment date & time">
          </div>
          <div class="col-md-12">
            <button type="submit" class="cs_btn cs_style_1 cs_white_color">Make an appoinment</button>
          </div>
        </form>
      </div>
    </div>
    <div class="cs_height_120 cs_height_lg_80"></div>
  </section> -->


    <?php include 'footer.php'; ?>




