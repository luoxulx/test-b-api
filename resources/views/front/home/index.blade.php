@extends('front.layout.app')
@section('main')
    <div class="ts-page-wrapper" id="page-top">

        @include('front.layout.nav')

        <div id="ts-hero" class="ts-animate-hero-items">
        <div class="container position-relative h-100 ts-align__vertical">
            <div class="row w-100">
                <div class="col-md-8">
                    <figure class="ts-social-icons mb-4">
                        <a href="https://www.facebook.com/luoxulx" target="_blank" class="mr-3"><i class="fab fa-facebook"></i></a>
                        <a href="https://www.twitter.com/luoxulx" target="_blank" class="mr-3"><i class="fab fa-twitter"></i></a>
                        <a href="javascript:void(0);" target="_blank" class="mr-3"><i class="fab fa-pinterest"></i></a>
                        <a href="javascript:void(0);" target="_blank" class="mr-3"><i class="fab fa-slack"></i></a>
                        <a href="https://www.instagram.com/luoxulx" target="_blank" class="mr-3"><i class="fab fa-instagram"></i></a>
                    </figure>
                    <h1>Frankenstein</h1>
                    <h2 class="ts-bubble-border">
                        <span class="ts-title-rotate">
                            <span class="active">World of Warcraft, For Azeroth</span>
                            <span>Hacker</span>
                            <span>Go | PHP Laravel</span>
                            <span>C++ & Python Developer</span>
                            <span>Web & Vue</span>
                        </span>
                    </h2>
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
                <div class="ts-title text-center"><h2>14k' Services</h2></div>
                <div class="row">

                    <div class="col-sm-6 col-md-4 col-xl-4">
                        <div class="ts-item" data-animate="ts-fadeInUp">
                            <div class="ts-item-content">
                                <div class="ts-item-header">
                                    <figure class="icon"><img src="/images/pic/hacker.jpg" alt=""></figure>
                                </div>
                                <div class="ts-item-body"><h4>Fake Hacker</h4>
                                    <p class="mb-0"><a href="https://en.wikipedia.org/wiki/Hacker" target="_blank">Hacker</a> Arsenal What is done is not malicious destruction, they are a group of technical personnel across the network, keen on scientific and technological exploration, Computer science research. </p>
                                </div>
                                <div class="ts-item-footer">
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#modal-hacker" class="ts-link-arrow-effect" target="_blank"><span>Detail</span></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4 col-xl-4">
                        <div class="ts-item" data-animate="ts-fadeInUp" data-delay=".1s">
                            <div class="ts-item-content">
                                <div class="ts-item-header">
                                    <figure class="icon"><img src="/images/pic/python.jpg" alt=""></figure>
                                </div>
                                <div class="ts-item-body"><h4>Python</h4>
                                    <p class="mb-0"><a href="https://www.python.org/" target="_blank">Python</a> is powerful... and fast,plays well with others,runs everywhere,is friendly & easy to learn,is Open.These are some of the reasons people who use Python would rather not use anything else. </p>
                                </div>
                                <div class="ts-item-footer">
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#modal-python" class="ts-link-arrow-effect" target="_blank"><span>Detail</span></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4 col-xl-4">
                        <div class="ts-item" data-animate="ts-fadeInUp" data-delay=".2s">
                            <div class="ts-item-content">
                                <div class="ts-item-header">
                                    <figure class="icon"><img src="/images/pic/vue.jpg" alt=""></figure>
                                </div>
                                <div class="ts-item-body"><h4>Web & Vue</h4>
                                    <p class="mb-0"><a href="https://vuejs.org/v2/guide/" target="_blank">Vue</a>, an incrementally adoptable ecosystem that scales between a library and a full-featured framework. 20KB min+gzip Runtime Blazing Fast Virtual DOM Minimal Optimization Efforts. </p></div>
                                <div class="ts-item-footer">
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#modal-vue" class="ts-link-arrow-effect" target="_blank"><span>Detail</span></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4 col-xl-4">
                        <div class="ts-item" data-animate="ts-fadeInUp" data-delay=".3s">
                            <div class="ts-item-content">
                                <div class="ts-item-header">
                                    <figure class="icon"><img src="/images/pic/php.jpg" alt=""></figure>
                                </div>
                                <div class="ts-item-body"><h4>PHP & Laravel</h4>
                                    <p class="mb-0">Laravel, Value elegance, simplicity, and readability? You’ll fit right in. <a href="https://laravel.com/" target="_blank">Laravel</a> is designed for people just like you. If you need help getting started, check out Laracasts and their great <a href="https://laravel.com/docs" target="_blank">documentation</a>. </p></div>
                                <div class="ts-item-footer">
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#modal-laravel" class="ts-link-arrow-effect"><span>Detail</span></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4 col-xl-4">
                        <div class="ts-item" data-animate="ts-fadeInUp" data-delay=".4s">
                            <div class="ts-item-content">
                                <div class="ts-item-header">
                                    <figure class="icon"><img src="/images/pic/icon-lcd.png" alt=""></figure>
                                </div>
                                <div class="ts-item-body"><h4>Go</h4>
                                    <p class="mb-0"><a href="https://golang.org/" target="_blank">Go</a> is an open source programming language that makes it easy to build simple, reliable, and efficient software. </p>
                                </div>
                                <div class="ts-item-footer">
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#modal-go" class="ts-link-arrow-effect"><span>Detail</span></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4 col-xl-4">
                        <div class="ts-item" data-animate="ts-fadeInUp" data-delay=".5s">
                            <div class="ts-item-content">
                                <div class="ts-item-header">
                                    <figure class="icon"><img src="/images/pic/wow.jpg" alt=""></figure>
                                </div>
                                <div class="ts-item-body"><h4>World of Warcraft</h4>
                                    <p class="mb-0"><a href="https://worldofwarcraft.com/" target="_blank">World of Warcraft (WoW)</a> is a massively multiplayer online role-playing game (MMORPG) released in 2004 by Blizzard Entertainment. </p>
                                </div>
                                <div class="ts-item-footer">
                                    <a href="#" data-toggle="modal" data-target="#modal-warcraft" class="ts-link-arrow-effect"><span>Detail</span></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!--END MY SERVICES *************************************************************************************-->
        <section id="about-me" class="ts-block pb-4">
            <div class="container">
                <div class="ts-title text-center"><h2>About 14k</h2></div>
                <div class="row ts-align__vertical">
                    <div class="col-md-6"><img src="{{ $bingPic[1] }}" alt="" class="mw-100 mb-5"></div>
                    <div class="col-md-6">
                        <h4 class="ts-bubble-border">Hi There</h4>
                        <p>Even if my dreams are lonely, I will not forget to cheer myself up. At least, LongKui will accompany me to the end! &nbsp;&nbsp;LNMPA. </p>
                        <dl class="ts-column-count-2">
                            <dt>Name:</dt>
                            <dd>Frankenstein 14k</dd>
                            <dt>Phone:</dt>
                            <dd>0081-9012-345-678</dd>
                            <dt>Email:</dt>
                            <dd>dr_14k@yeah.net</dd>
                            <dt>Twitter:</dt>
                            <dd>14k</dd>
                        </dl>
                        <hr class="ts-hr-light mb-5">
                        <a href="#contact" class="ts-btn-effect mr-2">
                            <span class="ts-visible btn btn-primary ts-btn-arrow">Contact Me</span>
                            <span class="ts-hidden btn btn-primary ts-btn-arrow" data-bg-color="#d44729">Contact Me</span>
                        </a>
                        <a href="#contact" class="ts-btn-effect mr-2">
                            <span class="ts-visible btn btn-outline-light"><i class="fa fa-download small mr-2"></i>Download CV</span>
                            <span class="ts-hidden btn btn-light bg-white"><i class="fa fa-download small mr-2"></i>Download CV</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="ts-block">
            <div class="container">
                <div class="text-center px-5 pt-5 position-relative">
                    <h3 class="my-3"> Fish and bear's paw can not be both, but single and poor can! </h3>
                    <a href="#contact" class="btn btn-primary mr-2 ts-push-down__50 ts-has-talk-arrow">WeChat: Antediluvian-X</a>
                    <div class="ts-background ts-opacity__20" data-bg-image="/images/pic/bg-keyboard.jpg"></div>
                </div>
            </div>
        </section>
        <!-- my skill -->
        <section id="my-skills" class="ts-block pb-5">
            <div class="container">
                <div class="ts-title text-center">
                    <h2>Skills</h2>
                </div>
                <h4>Every Day is a New Challenge</h4>
                <div class="row">
                    <div class="col-md-6">
                        <p>One day, I will become a legitimate American. </p>
                        <a href="#contact" class="btn btn-outline-light mb-5">Contact Me</a>
                    </div>
                    <div class="col-md-6">
                        <div class="progress" data-progress-width="90%"><h5 class="ts-progress-title">PHP Laravel&Lumen</h5>
                            <figure class="ts-progress-value"></figure>
                            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="progress" data-progress-width="80%"><h5 class="ts-progress-title">Web Javascript Vue</h5>
                            <figure class="ts-progress-value"></figure>
                            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="progress" data-progress-width="65%"><h5 class="ts-progress-title">Python Go</h5>
                            <figure class="ts-progress-value"></figure>
                            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="progress" data-progress-width="40%"><h5 class="ts-progress-title">C++ Bash Hacker</h5>
                            <figure class="ts-progress-value"></figure>
                            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- github info -->
        <section class="ts-block" data-bg-image="{{ $bingPic[2] }}">
                <div class="container ts-promo-numbers">
                    <div class="row">
                        <div class="col-sm-6 col-md-3">
                            <div class="ts-promo-number text-center">
                                <figure class="odometer" data-odometer-final="55">0</figure>
                                <h5>Repositories</h5>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <div class="ts-promo-number text-center">
                                <figure class="odometer" data-odometer-final="68">0</figure>
                                <h5>Issues</h5>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <div class="ts-promo-number text-center">
                                <figure class="odometer" data-odometer-final="17">0</figure>
                                <h5>Stars</h5>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <div class="ts-promo-number text-center">
                                <figure class="odometer" data-odometer-final="5">0</figure>
                                <h5>Followers</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <!-- photos -->
        <section class="ts-block pb-5" id="portfolio">
            <div class="container">
                <div class="ts-title"><h2>Photos</h2></div>
                <div class="card-columns ts-gallery ts-column-count-4">
                    @forelse($allPics as $val)
                        <a href="{{ $val['real_url'] }}" class="card ts-gallery__item popup-image" data-animate="ts-fadeInUp">
                            <div class="ts-gallery__image"><img src="{{ $val['real_url'] }}" class="card-img" alt="">
                                <div class="ts-gallery__item-description">
                                    <h6 class="ts-opacity__50 ts-text-small">{{ $val['copyright'] }}</h6>
                                    <h4>{{ $val['startdate'] }}</h4>
                                </div>
                            </div>
                        </a>
                    @empty
                        <a href="/images/pic/img-work-01.png" class="card ts-gallery__item popup-image" data-animate="ts-fadeInUp">
                        <div class="ts-gallery__item-description">
                            <h6 class="ts-opacity__50">Branding</h6>
                            <h4>Pehaz</h4>
                        </div>
                        <img src="/images/pic/img-work-01.png" class="card-img" alt=""><!--end ts-gallery__image-->
                    </a><!--end card ts-gallery__item-->
                    @endforelse

                </div>
            </div>
        </section>
    </main>

        @include('front.layout.foot')
    </div>
    {{--@include('front.layout.modal')--}}
@endsection
