<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="description" content="Askbootstrap">
   <meta name="author" content="Askbootstrap">
   <title>Groci - Organic Food & Grocery Market Template</title>
   <!-- Favicon Icon -->
   <link rel="icon" type="image/png" href="img/favicon.png">
   <!-- Bootstrap core CSS -->
   <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
   <!-- Material Design Icons -->
   <link href="vendor/icons/css/materialdesignicons.min.css" media="all" rel="stylesheet" type="text/css" />
   <!-- Select2 CSS -->
   <link href="vendor/select2/css/select2-bootstrap.css" />
   <link href="vendor/select2/css/select2.min.css" rel="stylesheet" />
   <!-- Custom styles for this template -->
   <link href="css/osahan.css" rel="stylesheet">
   <!-- Owl Carousel -->
   <link rel="stylesheet" href="vendor/owl-carousel/owl.carousel.css">
   <link rel="stylesheet" href="vendor/owl-carousel/owl.theme.css">
</head>

<body>
   <?php include "./header.php" ?>
   <!-- Inner Header -->
   <section class="section-padding bg-dark inner-header">
      <div class="container">
         <div class="row">
            <div class="col-md-12 text-center">
               <h1 class="mt-0 mb-3 text-white">Contact Us</h1>
               <div class="breadcrumbs">
                  <p class="mb-0 text-white"><a class="text-white" href="#">Home</a> / <span class="text-success">Contact Us</span></p>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- End Inner Header -->
   <!-- Contact Us -->
   <section class="section-padding">
      <div class="container">
         <div class="row">
            <div class="col-lg-4 col-md-4">
               <h3 class="mt-1 mb-5">Get In Touch</h3>
               <h6 class="text-dark"><i class="mdi mdi-home-map-marker"></i> Address :</h6>
               <p>86 Petersham town, New South wales Waedll Steet, Australia PA 6550</p>
               <h6 class="text-dark"><i class="mdi mdi-phone"></i> Phone :</h6>
               <p>+91 12345-67890, (+91) 123 456 7890</p>
               <h6 class="text-dark"><i class="mdi mdi-deskphone"></i> Mobile :</h6>
               <p>(+20) 220 145 6589, +91 12345-67890</p>
               <h6 class="text-dark"><i class="mdi mdi-email"></i> Email :</h6>
               <p>iamosahan@gmail.com, info@gmail.com</p>
               <h6 class="text-dark"><i class="mdi mdi-link"></i> Website :</h6>
               <p>www.askbootstrap.com</p>
               <div class="footer-social"><span>Follow : </span>
                  <a href="#"><i class="mdi mdi-facebook"></i></a>
                  <a href="#"><i class="mdi mdi-twitter"></i></a>
                  <a href="#"><i class="mdi mdi-instagram"></i></a>
                  <a href="#"><i class="mdi mdi-google"></i></a>
               </div>
            </div>
            <div class="col-lg-8 col-md-8">
               <div class="card">
                  <div class="card-body">
                     <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d117663.74787302804!2d72.439654878125!3d23.022505038386523!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e84f2a7b894b5%3A0x6a8494603bcb5481!2sAhmedabad%2C%20Gujarat!5e0!3m2!1sen!2sin!4v1711812345678"
                        width="100%"
                        height="500"
                        frameborder="0"
                        style="border:0"
                        allowfullscreen>
                     </iframe>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- End Contact Us -->
   <!-- Contact Me -->
   <section class="section-padding  bg-white">
      <div class="container">
         <div class="row">
            <div class="col-lg-12 col-md-12 section-title text-left mb-4">
               <h2>Contact Us</h2>
            </div>
            <form class="col-lg-12 col-md-12" name="sentMessage" id="contactForm" novalidate>
               <div class="control-group form-group">
                  <div class="controls">
                     <label>Full Name <span class="text-danger">*</span></label>
                     <input type="text" placeholder="Full Name" class="form-control" id="name" required data-validation-required-message="Please enter your name.">
                     <p class="help-block"></p>
                  </div>
               </div>
               <div class="row">
                  <div class="control-group form-group col-md-6">
                     <label>Phone Number <span class="text-danger">*</span></label>
                     <div class="controls">
                        <input type="tel" placeholder="Phone Number" class="form-control" id="phone" required data-validation-required-message="Please enter your phone number.">
                     </div>
                  </div>
                  <div class="control-group form-group col-md-6">
                     <div class="controls">
                        <label>Email Address <span class="text-danger">*</span></label>
                        <input type="email" placeholder="Email Address" class="form-control" id="email" required data-validation-required-message="Please enter your email address.">
                     </div>
                  </div>
               </div>
               <div class="control-group form-group">
                  <div class="controls">
                     <label>Message <span class="text-danger">*</span></label>
                     <textarea rows="4" cols="100" placeholder="Message" class="form-control" id="message" required data-validation-required-message="Please enter your message" maxlength="999" style="resize:none"></textarea>
                  </div>
               </div>
               <div id="success"></div>
               <!-- For success/fail messages -->
               <button type="submit" class="btn btn-success">Send Message</button>
            </form>
         </div>
      </div>
   </section>
   <!-- End Contact Me -->
   <?php include "./footer.php" ?>
   <!-- Bootstrap core JavaScript -->
   <script src="vendor/jquery/jquery.min.js"></script>
   <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
   <!-- Contact form JavaScript -->
   <!-- Do not edit these files! In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
   <script src="js/jqBootstrapValidation.js"></script>
   <script src="js/contact_me.js"></script>
   <!-- select2 Js -->
   <script src="vendor/select2/js/select2.min.js"></script>
   <!-- Owl Carousel -->
   <script src="vendor/owl-carousel/owl.carousel.js"></script>
   <!-- Custom -->
   <script src="js/custom.js"></script>
</body>

</html>