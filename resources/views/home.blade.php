    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Renomobilemoney | Data Refill, Airtime, Cable TV, Electricity Subscription</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link rel="icon" href="{{asset("images/bn.jpeg")}}" type="image/png" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <script charset="UTF-8" src="//web.webpushs.com/js/push/9e64f0fe6770fbc524fb38a0b8e5ad3b_1.js" async></script>

    <!-- Vendor CSS Files -->
    <link href="{{asset('land/assets/vendor/aos/aos.css')}}" rel="stylesheet">
    <link href="{{asset('land/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('land/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('land/assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('land/assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
    <link href="{{asset('land/assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
    <link href="{{asset('land/assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{asset('land/assets/css/style.css')}}" rel="stylesheet">

    <!-- =======================================================
    * Template Name: Bethany - v4.7.0
    * Template URL: https://bootstrapmade.com/bethany-free-onepage-bootstrap-theme/
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
{{--    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4783566552108386"--}}
{{--            crossorigin="anonymous"></script>--}}
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1367363826948615"
            crossorigin="anonymous"></script>
</head>


{{-- toastr --}}
{{--<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />--}}

<body>
@include('sweetalert::alert')
<script>
    $(document).ready(function() {
        toastr.options.timeOut = 10000;
        @if (Auth()->user())
        toastr.success('Welcome Back {{\App\Console\encription::decryptdata(Auth::user()->name)}}');
        @endif
    });

</script>
<!-- ======= Header ======= -->
<header id="header" class="fixed-top d-flex align-items-center">
    <div class="container">
        <div class="header-container d-flex align-items-center justify-content-between">
            <div class="logo">
                <h1 class="text-light"><a href="{{route('home')}}"><img src="{{asset('land/assets/img/logo.png')}}" class="img-fluid" alt=""></a></h1>
                <!-- Uncomment below if you prefer to use an image logo -->
                <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
            </div>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                    <li><a class="nav-link scrollto" href="#about">About</a></li>
                    <li><a class="nav-link scrollto" href="#services">Services</a></li>
                    <li><a class="nav-link scrollto " href="#testimonials">Price </a></li>
                    <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                    @if(Auth()->user())
                        <li><a class="badge badge-success" href="#">{{\App\Console\encription::decryptdata(Auth::user()->username)}}</a></li>
                    @else
                        <li><a class="getstarted scrollto" href="{{route('register')}}">Sign Up</a></li>
                    @endif
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div><!-- End Header Container -->
    </div>
</header><!-- End Header -->

<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">
    <div class="container text-center position-relative" data-aos="fade-in" data-aos-delay="200">
        <h1>RENO MOBILE MONEY</h1>
        <h2>We Provide
            The Best Tools To Save</h2>
        @if(Auth()->user())
        <a href="{{route('dashboard')}}" class="btn btn-success">{{\App\Console\encription::decryptdata(Auth::user()->name)}}</a>
            <form method="POST" action="{{ route('logout') }}" x-data>
                @csrf
                <br>
                <a href="{{ route('logout') }}"><button type="submit" class="btn btn-success">logout</button></a>
            </form>
        @else
        <a href="{{route('login')}}" class="btn-get-started scrollto">Login </a>
        <a href="{{route('register')}}" class="btn-get-started scrollto">Sign up</a>
            @endif
    </div>
</section><!-- End Hero -->

<main id="main">

    <!-- ======= Clients Section ======= -->
    <section id="clients" class="clients">
        <div class="container">

            <div class="row">

                <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center" data-aos="zoom-in" data-aos-delay="100">
                    <img src="{{asset('land/assets/img/clients/mtn-1.png')}}" class="img-fluid" alt="">
                </div>

                <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center" data-aos="zoom-in" data-aos-delay="200">
                    <img src="{{asset('land/assets/img/clients/airtime-1.png')}}" class="img-fluid" alt="">
                </div>

                <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center" data-aos="zoom-in" data-aos-delay="300">
                    <img src="{{asset('land/assets/img/clients/glo-1.png')}}" class="img-fluid" alt="">
                </div>

                <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center" data-aos="zoom-in" data-aos-delay="400">
                    <img src="{{asset('land/assets/img/clients/9mobile-1.png')}}" class="img-fluid" alt="">
                </div>

                <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center" data-aos="zoom-in" data-aos-delay="500">
                    <img src="{{asset('land/assets/img/clients/cable-tv.png')}}" class="img-fluid" alt="">
                </div>

                <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center" data-aos="zoom-in" data-aos-delay="600">
                    <img src="{{asset('land/assets/img/clients/eletricity.png')}}" class="img-fluid" alt="">
                </div>

            </div>

        </div>
    </section><!-- End Clients Section -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container">

            <div class="row content">
                <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
                    <h2>SAVE SMART, SAVE SECURELY, SAVE REGULARLY!</h2>
                    <h3>We help you save money with our our secure safe lock plans. Save and earn 5-10% per annum</h3>
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0" data-aos="fade-left" data-aos-delay="200">
                    <p>
                        Reno Mobile Money is a registered telecommunication vendor known for providing internet services, airtime VTU, cable TV subscriptions, electricity payment, converting airtime to cash.
                    </p>
                    <ul>
                        <li><i class="ri-check-double-line"></i> Convert MTN, 9mobile, Airtel and Glo airtime to cash instantly. Airtime topup and data purchase are automated and get delivered to you almost instantly.</li>
                        <li><i class="ri-check-double-line"></i> lets you purchase mobile data, top up airtime, pay your cable and electricity bills e.t.c all at the speed of light</li>
                        <li><i class="ri-check-double-line"></i> We use a customized application specifically designed a testing gnose to keep away for people.</li>
                    </ul>
                    <p class="fst-italic">

                    </p>
                </div>
            </div>

        </div>
    </section><!-- End About Section -->

    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts">
        <div class="container">

            <div class="row counters">

                <div class="col-lg-3 col-6 text-center">
                    <span data-purecounter-start="0" data-purecounter-end="1258" data-purecounter-duration="1" class="purecounter"></span>
                    <p>PROJECTS COMPLETED</p>
                </div>

                <div class="col-lg-3 col-6 text-center">
                    <span data-purecounter-start="0" data-purecounter-end="150" data-purecounter-duration="1" class="purecounter"></span>
                    <p>AWARDS</p>
                </div>

                <div class="col-lg-3 col-6 text-center">
                    <span data-purecounter-start="0" data-purecounter-end="1255" data-purecounter-duration="1" class="purecounter"></span>
                    <p>CUSTOMER ACTIVE</p>
                </div>

                <div class="col-lg-3 col-6 text-center">
                    <span data-purecounter-start="0" data-purecounter-end="1157" data-purecounter-duration="1" class="purecounter"></span>
                    <p>GOOD REVIEWS</p>
                </div>

            </div>

        </div>
    </section><!-- End Counts Section -->

    <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us">
        <div class="container">

            <div class="row">
                <div class="col-lg-4 d-flex align-items-stretch" data-aos="fade-right">
                    <div class="content">
                        <h3>Who We Are</h3>
                        <p>
                            Reno Mobile Money is an online saving platform that give her users avenue to automate their savings, users can save their funds using our well secured saving plan. We give 10% interest Per annum on every Penny Saved. We help you save your money safely and securely with our safe lock plans.
                        </p>
                        <div class="text-center">
                            <a href="#" class="more-btn">Learn More <i class="bx bx-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 d-flex align-items-stretch">
                    <div class="icon-boxes d-flex flex-column justify-content-center">
                        <div class="row">
                            <div class="col-xl-4 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                                <div class="icon-box mt-4 mt-xl-0">
                                    <i class="bx bx-receipt"></i>
                                    <h4>Save Smart</h4>
                                    <p>Save smart, earn smart interest on every penny saved! Join the team of smart savers and smart earners. Automate your savings with a click</p>
                                </div>
                            </div>
                            <div class="col-xl-4 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="200">
                                <div class="icon-box mt-4 mt-xl-0">
                                    <i class="bx bx-cube-alt"></i>
                                    <h4>Opening Of Account</h4>
                                    <p>Open a savings account entirely online with no need for paper work & signature.t</p>
                                </div>
                            </div>
                            <div class="col-xl-4 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="300">
                                <div class="icon-box mt-4 mt-xl-0">
                                    <i class="bx bx-images"></i>
                                    <h4>24/7 Support</h4>
                                    <p>We offer instant recharge of Airtime, Databundle, CableTV (DStv, GOtv & Startimes), Electricity Bill Payment and Educational PIN(s) with instant delivery</p>
                                </div>
                            </div>
                        </div>
                    </div><!-- End .content-->
                </div>
            </div>

        </div>
    </section><!-- End Why Us Section -->

    <!-- ======= Cta Section ======= -->
    <section id="cta" class="cta">
        <div class="container">

            <div class="text-center" data-aos="zoom-in">
                <h3>Call To Action</h3>
                <p> You Can Perform Quick Transactions Anytime And Anywhere Using Any Device. Awesome Customer Support. Quick Payment Steps. Safe and Secure. Services: Instant Reconnection, 24/7 Support, Secure Payment, Fast Support Response, Prompt Customer Support.</p>
                <a class="cta-btn" href="#">Call To Action</a>
            </div>

        </div>
    </section><!-- End Cta Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
        <div class="container">

            <div class="row">
                <div class="col-lg-4">
                    <div class="section-title" data-aos="fade-right">
                        <h2>Services</h2>
                        <p>We help you Save and Keep your Funds Securely</p>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-md-6 d-flex align-items-stretch">
                            <div class="icon-box" data-aos="zoom-in" data-aos-delay="100">
                                <div class="icon"><i class="bx bxl-dribbble"></i></div>
                                <h4><a href="">Stable & Profitable</a></h4>
                                <p>Experienced business owners and managers know that 3 things are necessary to ensure the long- term success of any business: growth, profit and stability</p>
                            </div>
                        </div>

                        <div class="col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
                            <div class="icon-box" data-aos="zoom-in" data-aos-delay="200">
                                <div class="icon"><i class="bx bx-file"></i></div>
                                <h4><a href="">Instant Withdraw</a></h4>
                                <p>Withdrawal Speed: Up to 4 hours .General rules for depositing and withdrawing funds . If a deposit or withdrawal is not subject to instant execution</p>
                            </div>
                        </div>

                        <div class="col-md-6 d-flex align-items-stretch mt-4">
                            <div class="icon-box" data-aos="zoom-in" data-aos-delay="300">
                                <div class="icon"><i class="bx bx-tachometer"></i></div>
                                <h4><a href="">Mobile Data</a></h4>
                                <p> Start enjoying this very low rates Data plan for your internet browsing databundle.</p>
                            </div>
                        </div>

                        <div class="col-md-6 d-flex align-items-stretch mt-4">
                            <div class="icon-box" data-aos="zoom-in" data-aos-delay="400">
                                <div class="icon"><i class="bx bx-world"></i></div>
                                <h4><a href="">Referral Provides</a></h4>
                                <p>A referral program is an organized process in which customers are rewarded for spreading the word.</p>
                            </div>
                        </div>

                        <div class="col-md-6 d-flex align-items-stretch mt-4">
                            <div class="icon-box" data-aos="zoom-in" data-aos-delay="300">
                                <div class="icon"><i class="bx bx-tachometer"></i></div>
                                <h4><a href="">SECURITY</a></h4>
                                <p> Your payment is secure and your details will never be at risk</p>
                            </div>
                        </div>

                        <div class="col-md-6 d-flex align-items-stretch mt-4">
                            <div class="icon-box" data-aos="zoom-in" data-aos-delay="400">
                                <div class="icon"><i class="bx bx-world"></i></div>
                                <h4><a href="">Cable Subscription</a></h4>
                                <p>Instantly Activate Cable subscription with favourable discount compare to others</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section><!-- End Services Section -->


    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials section-bg">
        <div class="container">

            <div class="row">
                <div class="col-lg-4">
                    <div class="section-title" data-aos="fade-right">
                        <h2>AFFORDABLE PLANS & PRICING</h2>
                        <p>Enjoy sweet rate </p>
                    </div>
                </div>
                <div class="col-lg-8" data-aos="fade-up" data-aos-delay="100">

                    <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
                        <div class="swiper-wrapper">

                            <div class="swiper-slide">
                                <div class="testimonial-item">
                                    <p>
                                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                    <div class="box">
                                        <h3>MTN Data</h3>
                                        <img src="{{asset('land/assets/img/mtn-1.png')}}" class="img-fluid" alt="">
                                        <ul>
                                            @foreach($mtn as $m)
                                                <li><i class="bx bx-check"></i> {{$m->plan}}  for   #{{$m->ramount}}</li>
                                            @endforeach

                                        </ul>
                                        <a href="#" class="buy-btn">Get Started</a>
                                    </div>
                                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                    </p>

                                </div>
                            </div><!-- End testimonial item -->

                            <div class="swiper-slide">
                                <div class="testimonial-item">
                                    <p>
                                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                    <div class="box featured">
                                        <h3>Airtel Data</h3>
                                        <img src="{{asset('land/assets/img/airtime-1.png')}}" class="img-fluid" alt="">
                                        <ul>
                                            @foreach($airtel as $g)
                                                <li><i class="bx bx-check"></i> {{$g->plan}}  for   #{{$g->ramount}}</li>
                                            @endforeach
                                        </ul>
                                        <a href="#" class="buy-btn">Get Started</a>
                                    </div>
                                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                    </p>

                                </div>
                            </div><!-- End testimonial item -->

                            <div class="swiper-slide">
                                <div class="testimonial-item">
                                    <p>
                                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                    <div class="box">
                                        <h3>Glo Data</h3>
                                        <img src="{{asset('land/assets/img/glo-1.png')}}" class="img-fluid" alt="">
                                        <ul>
                                            @foreach($glo as $go)
                                                <li><i class="bx bx-check"></i> {{$go->plan}}   for   #{{$go->ramount}}</li>
                                            @endforeach
                                        </ul>
                                        <a href="#" class="buy-btn">Get Started</a>
                                    </div>
                                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                    </p>
                                </div>
                            </div><!-- End testimonial item -->

                            <div class="swiper-slide">
                                <div class="testimonial-item">
                                    <p>
                                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>

                                    <div class="box">
                                        <h3>9mobile Data</h3>
                                        <img src="{{asset('land/assets/img/9mobile-1.png')}}" class="img-fluid" alt="">
                                        <ul>
                                            @foreach($eti as $e)
                                                <li><i class="bx bx-check"></i>{{$e->plan}}   for   #{{$e->ramount}}</li>
                                            @endforeach

                                        </ul>
                                        <a href="#" class="buy-btn">Get Started</a>
                                    </div>
                                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                    </p>
                                </div>
                            </div><!-- End testimonial item -->


                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>

        </div>
    </section><!-- End Testimonials Section -->

    <!-- ======= Team Section ======= -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-4" data-aos="fade-right">
                    <div class="section-title">
                        <h2>Contact</h2>
                        <p>Chat with us for immediate expert advice on our products and services. Or you can send an email to our customer support team and we'll get back to you.</p>
                    </div>
                </div>

                <div class="col-lg-8" data-aos="fade-up" data-aos-delay="100">
                    <iframe style="border:0; width: 100%; height: 270px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" allowfullscreen></iframe>
                    <div class="info mt-4">
                        <i class="bi bi-geo-alt"></i>
                        <h4>Location:</h4>
                        <p>lagos</p>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mt-4">
                            <div class="info">
                                <i class="bi bi-envelope"></i>
                                <h4>Email:</h4>
                                <p>info@efemobilemoney.com</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="info w-100 mt-4">
                                <i class="bi bi-phone"></i>
                                <h4>Call:</h4>
                                <p>08066215840 or 0816 693 9205</p>
                            </div>
                        </div>
                    </div>

                    <form action="#" method="post" role="form" class="php-email-form mt-4">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                            </div>
                            <div class="col-md-6 form-group mt-3 mt-md-0">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                        </div>
                        <div class="form-group mt-3">
                            <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                        </div>
                        <div class="my-3">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>
                        </div>
                        <div class="text-center"><button type="submit">Send Message</button></div>
                    </form>
                </div>
            </div>

        </div>
    </section><!-- End Contact Section -->

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<footer id="footer">

    <div class="footer-top">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-md-6 footer-contact">
                    <h3>Reno Mobile money</h3>
                    <p>
                        Lagos <br>
                        Lagos<br>
                        Nigeria <br><br>
                        <strong>Phone:</strong> 08066215840 or 08166939205<br>
                        <strong>Email:</strong> info@efemobilemoney.com<br>
                    </p>
                </div>

                <div class="col-lg-2 col-md-6 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Our Services</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Data</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Airtel</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Cable Tv</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Eletricity</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Save Money</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-6 footer-newsletter">
                    <h4>Join Our Newsletter</h4>
                    <p>Join our network of outstanding entrepreneurs patnering with Reno Mobile Money.
                    </p>
                    <form action="" method="post">
                        <input type="email" name="email"><input type="submit" value="Subscribe">
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="container d-md-flex py-4">

        <div class="me-md-auto text-center text-md-start">
            <div class="copyright">
                &copy; Copyright <strong><span>Efemobilemoney</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/bethany-free-onepage-bootstrap-theme/ -->
                Designed by <a href="#">Efemobilemoney</a>
            </div>
        </div>
        <div class="social-links text-center text-md-right pt-3 pt-md-0">
            <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
            <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
            <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
            <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
            <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
        </div>
    </div>
    <style>
        .float{
            position:fixed;
            width:60px;
            height:60px;
            bottom:40px;
            right:40px;
            background-color:#25d366;
            color:#FFF;
            border-radius:50px;
            text-align:center;
            font-size:30px;
            box-shadow: 2px 2px 3px #999;
            z-index:100;
        }

        .my-float{
            margin-top:16px;
        }
    </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <a href="https://api.whatsapp.com/send?phone=+2348066215840" class="float" target="_blank">
        <i class="fa fa-whatsapp my-float"></i>
    </a>
</footer><!-- End Footer -->
<a href="http://wa.me/2348036711447"> <i class="ri-whatsapp-fill"></i></a>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="{{asset('land/assets/vendor/purecounter/purecounter.js')}}"></script>
<script src="{{asset('land/assets/vendor/aos/aos.js')}}"></script>
<script src="{{asset('land/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('land/assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
<script src="{{asset('land/assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('land/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
<script src="{{asset('land/assets/vendor/php-email-form/validate.js')}}"></script>
{{-- toastr js --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

<!-- Template Main JS File -->
<script src="{{asset('land/assets/js/main.js')}}"></script>
{{--@include('layouts.footer')--}}

</body>

</html>
