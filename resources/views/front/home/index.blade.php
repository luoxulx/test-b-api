@extends('front.layout.app')
@section('main')
    <div class="ts-page-wrapper" id="page-top">

        @include('front.layout.nav')

        <div id="ts-hero" class="ts-animate-hero-items">
        <div class="container position-relative h-100 ts-align__vertical">
            <div class="row w-100">
                <div class="col-md-8">
                    <figure class="ts-social-icons mb-4">
                        <a href="#" class="mr-3"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="mr-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="mr-3"><i class="fab fa-pinterest"></i></a>
                        <a href="#" class="mr-3"><i class="fab fa-slack"></i></a>
                        <a href="#" class="mr-3"><i class="fab fa-instagram"></i></a>
                    </figure>
                    <h1>14k</h1>
                    <h1 class="ts-bubble-border">
                        <span class="ts-title-rotate">
                            <span class="active">Hacker</span>
                            <span>World of Warcraft, For Azeroth</span>
                            <span>Go | Laravel</span>
                            <span>C++ & Python Developer</span>
                            <span>Web Designer</span>
                        </span>
                    </h1>
                </div>
            </div>
            <a href="#my-services" class="ts-btn-effect position-absolute ts-bottom__0 ts-left__0 ts-scroll ml-3 mb-3"><span class="ts-visible ts-circle__sm rounded-0 ts-bg-primary"><i class="fa fa-arrow-down text-white"></i></span><span class="ts-hidden ts-circle__sm rounded-0"><i class="fa fa-arrow-down text-white"></i></span></a>
        </div>
        <div class="ts-background">
            <div class="ts-background-image" data-bg-image="{{ $bingPic[0] }}"></div>
        </div>
    </div>

        <main id="ts-content">
        <section id="my-services" class="ts-block ts-xs-text-center pb-0">
            <div class="container">
                <div class="ts-title text-center"><h2>My Services</h2></div>
                <div class="row">

                    <div class="col-sm-6 col-md-4 col-xl-4">
                        <div class="ts-item" data-animate="ts-fadeInUp">
                            <div class="ts-item-content">
                                <div class="ts-item-header">
                                    <figure class="icon"><img src="http://luoxu.oss-cn-shanghai.aliyuncs.com/olr/icon-brushes.png" alt=""></figure>
                                </div>
                                <div class="ts-item-body"><h4>White Hat Hacker</h4>
                                    <p class="mb-0">Hacker Arsenal What is done is not malicious destruction, they are a group of technical personnel across the network, keen on scientific and technological exploration, Computer science research.</p>
                                </div>
                                <div class="ts-item-footer">
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#modal" class="ts-link-arrow-effect" target="_blank"><span>Read More</span></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4 col-xl-4">
                        <div class="ts-item" data-animate="ts-fadeInUp" data-delay=".1s">
                            <div class="ts-item-content">
                                <div class="ts-item-header">
                                    <figure class="icon"><img src="http://luoxu.oss-cn-shanghai.aliyuncs.com/olr/icon-camera.png" alt=""></figure>
                                </div>
                                <div class="ts-item-body"><h4>C++</h4>
                                    <p class="mb-0">https://cn.bing.com/https://cn.bing.com/https://cn.bing.com/https://cn.bing.com/</p>
                                </div>
                                <div class="ts-item-footer">
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#modal" class="ts-link-arrow-effect" target="_blank"><span>Read More</span></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4 col-xl-4">
                        <div class="ts-item" data-animate="ts-fadeInUp" data-delay=".2s">
                            <div class="ts-item-content">
                                <div class="ts-item-header">
                                    <figure class="icon"><img src="http://luoxu.oss-cn-shanghai.aliyuncs.com/olr/icon-video.png" alt=""></figure>
                                </div>
                                <div class="ts-item-body"><h4>Video Editing</h4>
                                    <p class="mb-0">Aenean pretium nulla libero, vitae iaculis libero efficitur a. Fusce ut augue finibus quam</p></div><!--end ts-item-body-->
                                <div class="ts-item-footer">
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#modal" class="ts-link-arrow-effect" target="_blank"><span>Read More</span></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4 col-xl-4">
                        <div class="ts-item" data-animate="ts-fadeInUp" data-delay=".3s">
                            <div class="ts-item-content">
                                <div class="ts-item-header">
                                    <figure class="icon"><img src="http://luoxu.oss-cn-shanghai.aliyuncs.com/olr/icon-pencil.png" alt=""></figure>
                                </div>
                                <div class="ts-item-body"><h4>Copy Writing</h4>
                                    <p class="mb-0">Fusce lorem ex, fringilla eget consequat ut, molestie sit amet nibh. Nullam vitae tincidunt</p></div><!--end ts-item-body-->
                                <div class="ts-item-footer">
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#modal" class="ts-link-arrow-effect"><span>Read More</span></a>
                                </div><!--end ts-item-footer-->
                            </div><!--end ts-item-content-->
                        </div><!--end ts-item-->
                    </div><!--end col-xl-4-->

                    <div class="col-sm-6 col-md-4 col-xl-4">
                        <div class="ts-item" data-animate="ts-fadeInUp" data-delay=".4s">
                            <div class="ts-item-content">
                                <div class="ts-item-header">
                                    <figure class="icon"><img src="http://luoxu.oss-cn-shanghai.aliyuncs.com/olr/icon-lcd.png" alt=""></figure><!--end icon-->
                                </div><!--end ts-item-header-->
                                <div class="ts-item-body"><h4>Coding</h4>
                                    <p class="mb-0">Aenean pretium nulla libero, vitae iaculis libero efficitur a. Fusce ut augue finibus quam</p>
                                </div><!--end ts-item-body-->
                                <div class="ts-item-footer">
                                    <a href="#" data-toggle="modal" data-target="#modal" class="ts-link-arrow-effect"><span>Read More</span></a>
                                </div><!--end ts-item-footer-->
                            </div><!--end ts-item-content-->
                        </div><!--end ts-item-->
                    </div><!--end col-xl-4-->

                    <div class="col-sm-6 col-md-4 col-xl-4">
                        <div class="ts-item" data-animate="ts-fadeInUp" data-delay=".5s">
                            <div class="ts-item-content">
                                <div class="ts-item-header">
                                    <figure class="icon"><img src="http://luoxu.oss-cn-shanghai.aliyuncs.com/olr/icon-phone.png" alt=""></figure><!--end icon-->
                                </div><!--end ts-item-header-->
                                <div class="ts-item-body"><h4>App Developing</h4>
                                    <p class="mb-0">Duis molestie enim mattis gravida viverra. Fusce ut eros augue. Sed id mauris vel neque</p>
                                </div><!--end ts-item-body-->
                                <div class="ts-item-footer">
                                    <a href="#" data-toggle="modal" data-target="#modal" class="ts-link-arrow-effect"><span>Read More</span></a>
                                </div><!--end ts-item-footer-->
                            </div><!--end ts-item-content-->
                        </div><!--end ts-item-->
                    </div><!--end col-xl-4-->

                </div><!--end row-->
            </div><!--end container-->
        </section>
        <!--END MY SERVICES *************************************************************************************-->
        <section id="about-me" class="ts-block pb-4">
            <div class="container">
                <div class="ts-title text-center"><h2>About Me</h2></div><!--end ts-title-->
                <div class="row ts-align__vertical">
                    <div class="col-md-6"><img src="{{ $bingPic[1] }}" alt="" class="mw-100 mb-5"></div>
                    <div class="col-md-6">
                        <h4 class="ts-bubble-border">Hi There</h4>
                        <p>In id nulla magna. Nullam posuere fermentum mattis. Nunc id dui at sapien faucibus fermentum ut vel diam. Nullam tempus, nunc id efficitur sagittis, urna est ultricies eros, ac porta sem turpis quis leo. Nulla in feugiat elit.</p>
                        <dl class="ts-column-count-2">
                            <dt>Name:</dt>
                            <dd>Jonathan Doe</dd>
                            <dt>Phone:</dt>
                            <dd>+1 908-736-1801</dd>
                            <dt>Email:</dt>
                            <dd>hello@example.com</dd>
                            <dt>Twitter:</dt>
                            <dd>freelancer9</dd>
                        </dl>
                        <hr class="ts-hr-light mb-5">
                        <a href="#contact" class="ts-btn-effect mr-2"><span class="ts-visible btn btn-primary ts-btn-arrow">Contact Me</span><span class="ts-hidden btn btn-primary ts-btn-arrow" data-bg-color="#d44729">Contact Me</span></a>
                        <!--<a href="#contact" class="btn btn-primary ts-btn-arrow mr-2">Contact Me</a>-->
                        <!--<a href="#contact" class="btn btn-outline-light ts-btn-border-light">-->
                        <!--<i class="fa fa-download small mr-2"></i>--><!--Download CV--><!--</a>-->
                        <a href="#contact" class="ts-btn-effect mr-2"><span class="ts-visible btn btn-outline-light"><i class="fa fa-download small mr-2"></i>                                    Download CV</span><span class="ts-hidden btn btn-light bg-white"><i class="fa fa-download small mr-2"></i>                                    Download CV</span></a>
                    </div>
                </div><!--end row-->
            </div>
        </section>

        <section class="ts-block">
            <div class="container">
                <div class="text-center px-5 pt-5 position-relative"><h3 class="my-3"> Let’s Work Together On Your Next Project!</h3><a href="#contact" class="btn btn-primary mr-2 ts-push-down__50 ts-has-talk-arrow">Hire Me Now!</a>
                    <div class="ts-background ts-opacity__20" data-bg-image="http://luoxu.oss-cn-shanghai.aliyuncs.com/olr/bg-keyboard.jpg"></div>
                </div>
            </div>
        </section>

        <section id="my-skills" class="ts-block pb-5">
            <div class="container">
                <div class="ts-title text-center">
                    <h2>My Skills</h2>
                </div><!--end ts-title-->
                <h4>Every Day is a New Challenge</h4>
                <div class="row">
                    <div class="col-md-6">
                        <p>In id nulla magna. Nullam posuere fermentum mattis. Nunc id dui at sapien faucibus fermentum ut vel diam. Nullam tempus, nunc id efficitur sagittis, urna est ultricies eros, ac porta sem turpis quis leo. Nulla in feugiat elit.</p>
                        <p>Phasellus accumsan scelerisque dolor, quis mattis justo bibendum non. Nulla sollicitudin turpis in enim elementum varius. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae</p>
                        <a href="#contact" class="btn btn-outline-light mb-5">Contact Me</a>
                    </div><!--end col-md-6-->
                    <div class="col-md-6">
                        <div class="progress" data-progress-width="100%"><h5 class="ts-progress-title">Webdesign</h5>
                            <figure class="ts-progress-value"></figure>
                            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div><!--end progress-->
                        <div class="progress" data-progress-width="80%"><h5 class="ts-progress-title">Photography</h5>
                            <figure class="ts-progress-value"></figure>
                            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div><!--end progress-->
                        <div class="progress" data-progress-width="90%"><h5 class="ts-progress-title">Coding</h5>
                            <figure class="ts-progress-value"></figure>
                            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div><!--end progress-->
                        <div class="progress" data-progress-width="60%"><h5 class="ts-progress-title">Copywriting</h5>
                            <figure class="ts-progress-value"></figure>
                            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div><!--end progress-->
                    </div><!--end col-md-6-->
                </div><!--end row-->
            </div><!--end container-->
        </section>

        <section class="ts-block pb-5" id="portfolio">
            <div class="container">
                <div class="ts-title"><h2>Portfolio</h2></div><!--end ts-title-->
                <div class="card-columns ts-gallery ts-column-count-4">
                    <a href="http://luoxu.oss-cn-shanghai.aliyuncs.com/olr/img-work-01.png" class="card ts-gallery__item popup-image" data-animate="ts-fadeInUp">
                        <div class="ts-gallery__item-description">
                            <h6 class="ts-opacity__50">Branding</h6>
                            <h4>Pehaz</h4>
                        </div>
                        <img src="http://luoxu.oss-cn-shanghai.aliyuncs.com/olr/img-work-01.png" class="card-img" alt=""><!--end ts-gallery__image-->
                    </a><!--end card ts-gallery__item-->

                    <a href="http://luoxu.oss-cn-shanghai.aliyuncs.com/olr/img-work-02.png" class="card ts-gallery__item popup-image" data-animate="ts-fadeInUp">
                        <div class="ts-gallery__image">
                            <div class="ts-gallery__item-description">
                                <h6 class="ts-opacity__50">Webdesign</h6>
                                <h4>Carilo</h4>
                            </div>
                            <img src="http://luoxu.oss-cn-shanghai.aliyuncs.com/olr/img-work-02.png" class="card-img" alt=""><!--end ts-gallery__item-description-->
                        </div><!--end ts-gallery__image-->
                    </a><!--end card ts-gallery__item-->

                    <a href="http://luoxu.oss-cn-shanghai.aliyuncs.com/olr/img-work-03.png" class="card ts-gallery__item popup-image" data-animate="ts-fadeInUp">
                        <div class="ts-gallery__image"><img src="http://luoxu.oss-cn-shanghai.aliyuncs.com/olr/img-work-03.png" class="card-img" alt="">
                            <div class="ts-gallery__item-description">
                                <h6 class="ts-opacity__50">Typography</h6>
                                <h4>Kali</h4>
                            </div><!--end ts-gallery__item-description-->
                        </div><!--end ts-gallery__image-->
                    </a><!--end card ts-gallery__item-->

                    <a href="http://luoxu.oss-cn-shanghai.aliyuncs.com/olr/img-work-04.png" class="card ts-gallery__item popup-image" data-animate="ts-fadeInUp">
                        <div class="ts-gallery__image"><img src="http://luoxu.oss-cn-shanghai.aliyuncs.com/olr/img-work-04.png" class="card-img" alt="">
                            <div class="ts-gallery__item-description">
                                <h6 class="ts-opacity__50">Identity</h6>
                                <h4>Purity</h4>
                            </div><!--end ts-gallery__item-description-->
                        </div><!--end ts-gallery__image-->
                    </a><!--end card ts-gallery__item-->

                    <a href="http://luoxu.oss-cn-shanghai.aliyuncs.com/olr/img-work-05.png" class="card ts-gallery__item popup-image" data-animate="ts-fadeInUp">
                        <div class="ts-gallery__image"><img src="http://luoxu.oss-cn-shanghai.aliyuncs.com/olr/img-work-05.png" class="card-img" alt="">
                            <div class="ts-gallery__item-description">
                                <h6 class="ts-opacity__50">Coding</h6>
                                <h4>SawMill</h4>
                            </div><!--end ts-gallery__item-description-->
                        </div><!--end ts-gallery__image-->
                    </a><!--end card ts-gallery__item-->

                    <a href="http://luoxu.oss-cn-shanghai.aliyuncs.com/olr/img-work-06.png" class="card ts-gallery__item popup-image" data-animate="ts-fadeInUp">
                        <div class="ts-gallery__image"><img src="http://luoxu.oss-cn-shanghai.aliyuncs.com/olr/img-work-06.png" class="card-img" alt="">
                            <div class="ts-gallery__item-description">
                                <h6 class="ts-opacity__50">Webdesign</h6>
                                <h4>Browar</h4>
                            </div><!--end ts-gallery__item-description-->
                        </div><!--end ts-gallery__image-->
                    </a><!--end card ts-gallery__item-->

                    <a href="http://luoxu.oss-cn-shanghai.aliyuncs.com/olr/img-work-07.png" class="card ts-gallery__item popup-image" data-animate="ts-fadeInUp">
                        <div class="ts-gallery__image"><img src="http://luoxu.oss-cn-shanghai.aliyuncs.com/olr/img-work-07.png" class="card-img" alt="">
                            <div class="ts-gallery__item-description">
                                <h6 class="ts-opacity__50">Experiment</h6>
                                <h4>Wood Tables</h4>
                            </div><!--end ts-gallery__item-description-->
                        </div><!--end ts-gallery__image-->
                    </a><!--end card ts-gallery__item-->

                    <a href="http://luoxu.oss-cn-shanghai.aliyuncs.com/olr/img-work-08.png" class="card ts-gallery__item popup-image"
                       data-animate="ts-fadeInUp">
                        <div class="ts-gallery__image"><img src="http://luoxu.oss-cn-shanghai.aliyuncs.com/olr/img-work-08.png" class="card-img" alt="">
                            <div class="ts-gallery__item-description">
                                <h6 class="ts-opacity__50">Product Design</h6>
                                <h4>Air Purifier</h4>
                            </div><!--end ts-gallery__item-description-->
                        </div><!--end ts-gallery__image-->
                    </a><!--end card ts-gallery__item-->

                    <a href="http://luoxu.oss-cn-shanghai.aliyuncs.com/olr/img-work-10.png" class="card ts-gallery__item popup-image" data-animate="ts-fadeInUp">
                        <div class="ts-gallery__image"><img src="http://luoxu.oss-cn-shanghai.aliyuncs.com/olr/img-work-10.png" class="card-img" alt="">
                            <div class="ts-gallery__item-description">
                                <h6 class="ts-opacity__50">App Developing</h6>
                                <h4>Boombox</h4>
                            </div><!--end ts-gallery__item-description-->
                        </div><!--end ts-gallery__image-->
                    </a><!--end card ts-gallery__item-->

                    <a href="http://luoxu.oss-cn-shanghai.aliyuncs.com/olr/img-work-11.png" class="card ts-gallery__item popup-image" data-animate="ts-fadeInUp">
                        <div class="ts-gallery__image"><img src="http://luoxu.oss-cn-shanghai.aliyuncs.com/olr/img-work-11.png" class="card-img" alt="">
                            <div class="ts-gallery__item-description">
                                <h6 class="ts-opacity__50">3D Art</h6>
                                <h4>The Deer</h4>
                            </div><!--end ts-gallery__item-description-->
                        </div><!--end ts-gallery__image-->
                    </a><!--end card ts-gallery__item-->

                    <a href="http://luoxu.oss-cn-shanghai.aliyuncs.com/olr/img-work-09.png" class="card ts-gallery__item popup-image" data-animate="ts-fadeInUp">
                        <div class="ts-gallery__image"><img src="http://luoxu.oss-cn-shanghai.aliyuncs.com/olr/img-work-09.png" class="card-img" alt="">
                            <div class="ts-gallery__item-description">
                                <h6 class="ts-opacity__50">Rebranding</h6>
                                <h4>Dafont</h4>
                            </div><!--end ts-gallery__item-description-->
                        </div><!--end ts-gallery__image-->
                    </a><!--end card ts-gallery__item-->

                </div><!--end ts-gallery-->
            </div><!--end container-->
        </section><!--end portfolio-->

        <section class="ts-block" data-bg-image="{{ $bingPic[2] }}">
            <div class="container ts-promo-numbers">
                <div class="row">
                    <div class="col-sm-6 col-md-3">
                        <div class="ts-promo-number text-center">
                            <figure class="odometer" data-odometer-final="43">0</figure>
                            <h5>Clients</h5>
                        </div><!--end ts-promo-number-->
                    </div><!--end col-md-3-->

                    <div class="col-sm-6 col-md-3">
                        <div class="ts-promo-number text-center">
                            <figure class="odometer" data-odometer-final="68">0</figure>
                            <h5>Projects</h5>
                        </div><!--end ts-promo-number-->
                    </div><!--end col-md-3-->

                    <div class="col-sm-6 col-md-3">
                        <div class="ts-promo-number text-center">
                            <figure class="odometer" data-odometer-final="17">0</figure>
                            <h5>Awards</h5>
                        </div><!--end ts-promo-number-->
                    </div><!--end col-md-3-->

                    <div class="col-sm-6 col-md-3">
                        <div class="ts-promo-number text-center">
                            <figure class="odometer" data-odometer-final="12">0</figure>
                            <h5>Years Experience</h5>
                        </div><!--end ts-promo-number-->
                    </div><!--end col-md-3-->
                </div>
            </div>
        </section><!--end ts-block-->

        <section id="testimonials" class="ts-block text-center pb-5">
            <div class="container">
                <div class="ts-title"><h2>Testimonials</h2></div><!--end ts-title-->
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="owl-carousel" data-owl-dots="1" data-owl-loop="1" data-animate="ts-fadeInUp">
                            <div class="slide mb-5">
                                <figure class="d-inline-block p-3 ts-bg-primary text-white ts-has-talk-arrow"><i class="fa fa-quote-right"></i></figure>
                                <p class="ts-h5"> In id nulla magna. Nullam posuere fermentum mattis. Nunc id dui at sapien faucibus fermentum ut vel diam. Nullam tempus, nunc id efficitur sagittis</p>
                                <div class="ts-circle__lg mb-3" data-bg-image="http://luoxu.oss-cn-shanghai.aliyuncs.com/olr/person.jpg"></div>
                                <h5>Jane Doe</h5><h6 class="ts-opacity__40">Bristol Creative</h6>
                            </div><!--end slide-->

                            <div class="slide mb-5">
                                <figure class="d-inline-block p-3 ts-bg-primary text-white ts-has-talk-arrow"><i class="fa fa-quote-right"></i></figure>
                                <p class="ts-h5"> Nam egestas porta posuere. Nunc velit lorem, vestibulum vitae massa nec, lacinia dictum ligula. Quisque scelerisque nec dolor id convallis. Vestibulum porta ipsum pretium turpis rhoncus, non fringilla ipsum mattis.</p>
                                <div class="ts-circle__lg mb-3" data-bg-image="http://luoxu.oss-cn-shanghai.aliyuncs.com/olr/person-02.jpg"></div>
                                <h5>John Brown</h5><h6 class="ts-opacity__40">ABC Architects</h6>
                            </div><!--end slide-->

                        </div><!--end owl-carousel-->
                    </div><!--end col-md-8-->
                </div><!--end row-->
            </div><!--end container-->
        </section><!--end #testimonials ts-block-->

        <!--LOGOS ***********************************************************************************************-->
        <section id="partners" class="ts-block py-4"><!--container-->
            <div class="container"><!--block of logos-->
                <div class="d-block d-md-flex justify-content-between align-items-center text-center ts-partners py-3">
                    <a href="#"><img src="http://luoxu.oss-cn-shanghai.aliyuncs.com/olr/logo-01-w.png" alt=""></a>
                    <a href="#"><img src="http://luoxu.oss-cn-shanghai.aliyuncs.com/olr/logo-02-w.png" alt=""></a>
                    <a href="#"><img src="http://luoxu.oss-cn-shanghai.aliyuncs.com/olr/logo-03-w.png" alt=""></a>
                    <a href="#"><img src="http://luoxu.oss-cn-shanghai.aliyuncs.com/olr/logo-04-w.png" alt=""></a>
                    <a href="#"><img src="http://luoxu.oss-cn-shanghai.aliyuncs.com/olr/logo-05-w.png" alt=""></a>
                </div><!--end logos-->
            </div><!--end container-->
        </section>
        <!--END LOGOS *******************************************************************************************-->
    </main>

        @include('front.layout.foot')
    </div>
    @include('front.layout.modal')
@endsection
