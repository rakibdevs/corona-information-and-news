@extends('layouts.app')
@section('container')
    <!-- Masthead-->
    <header class="masthead">
        <div class="container h-100">
            <div class="row h-100">
                <div class="col-lg-6">
                    <div class="row mt-5 ">
                        <div class="col-sm-5 mt-4">
                            <div class="card custom-header-card p-2">
                                <p class="wizard-number mb-0 typewrite" data-period="2000" data-type='["{{number_format($covid_summary->cases_new)}}"]'></p>
                                <p class="wizard-title mb-0">New Cases</p>
                            </div>
                        </div>
                        <div class=" col-sm-6 ">
                            <div class="card custom-header-card p-2">
                                <p class="wizard-number mb-0 typewrite" data-period="2000" data-type='["{{number_format($covid_summary->cases_total)}}"]'></p>
                                <p class="wizard-title mb-0">Total Cases</p>
                            </div>
                        </div>
                    </div>
                    <div class="row  ">
                        <div class="col-sm-5">
                            <div class="card custom-header-card-rev p-2">
                                <p class="wizard-number mb-0 typewrite" data-period="2000" data-type='["{{number_format($covid_summary->deaths_total)}}"]'></p>
                                <p class="wizard-title mb-0">Total Death</p>
                            </div>
                        </div>
                        <div class=" col-sm-6 mt-4">
                            <div class="card custom-header-card-rev p-2">
                                <p class="wizard-number mb-0 typewrite" data-period="2000" data-type='["{{number_format($covid_summary->tests_total)}}"]'></p>
                                <p class="wizard-title mb-0">Total Tests</p>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5 justify-content-end">
                        <a class="down-arrow-btn  js-scroll-trigger" href="#donate"><i class="fas fa-arrow-down"></i></a>
                    </div>
                    
                </div>
            </div>
        </div>
    </header>
    <!-- About section-->
    <section class="page-section bg-primary" id="donate">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="text-white mt-0">Wanna get involved</h2>
                    <hr class="divider light my-4" />
                    <p class="text-white-50 mb-4">Vestibulum quam nisi, pretium a nibh sit amet, consectetur hendrerit mi. Aenean imperdiet lacus sit amet elit porta, et malesuada erat bibendum. Cras sed nunc mass</p>
                    <a class="btn btn-light btn-xl js-scroll-trigger" href="#services">Donate here!</a>
                </div>
            </div>
        </div>
    </section>
    <section class="page-section" id="statistics">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center">
                    <div class="corona-head">
                        <span class="covid-donate">Donation for</span>
                        <span class="name-covid">COVID-19</span>
                        <span class="date-section">{{date('d F, Y')}}</span>
                    </div>
                    <div class="accounts-block">
                        <div class="bb-0">
                            <span class="account-head">
                                TOTAL <br>PARTICIPANT</span>
                            <span class="ammounts">12</span>
                        </div>
                        <div class="bt-0">
                            <span class="ammounts middle-con">12000</span>
                            <span class="account-head">TOTAL COST</span>
                        </div>
                        <div class="bb-0">
                            <span class="account-head">TOTAL<br> AMOUNT</span>
                            <span class="ammounts">16000</span>
                        </div>
                    </div>
                    <div class="in-total">
                        IN TOTAL PARTICIPATIONS 54 <br>
                        IN TOTAL AMOUNT 32000
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <canvas id="compare"  height="220"></canvas>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Portfolio section-->
    <section id="gallery">
        <div class="container-fluid p-0">
            <div class="row no-gutters">
                @foreach($gallery as $key => $img)
                <div class="col-lg-4 col-sm-6">
                    <a class="portfolio-box" href="{{url('/media/images/'.$img->url)}}">
                        <img class="img-fluid" src="{{url('/media/thumbnails/'.$img->url)}}" alt="" />
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
   
    <!-- Contact section-->
    <section class="page-section" id="contact">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="mt-0">Let's Get In Touch!</h2>
                    <hr class="divider my-4" />
                    <p class="text-muted mb-5"></p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 ml-auto text-center mb-5 mb-lg-0">
                    <i class="fas fa-phone fa-3x mb-3 text-muted"></i>
                    <div>+1 (555) 123-4567</div>
                </div>
                <div class="col-lg-4 mr-auto text-center">
                    <i class="fas fa-envelope fa-3x mb-3 text-muted"></i
                    ><!-- Make sure to change the email address in BOTH the anchor text and the link target below!--><a class="d-block" href="mailto:contact@yourwebsite.com">contact@yourwebsite.com</a>
                </div>
            </div>
        </div>
    </section>

    <script>
        var TxtType = function(el, toRotate, period) {
            this.toRotate = toRotate;
            this.el = el;
            this.loopNum = 0;
            this.period = parseInt(period, 10) || 2000;
            this.txt = '';
            this.tick();
            this.isDeleting = false;
        };

        TxtType.prototype.tick = function() {
            var i = this.loopNum % this.toRotate.length;
            var fullTxt = this.toRotate[i];

            if (this.isDeleting) {
            this.txt = fullTxt.substring(0, this.txt.length - 1);
            } else {
            this.txt = fullTxt.substring(0, this.txt.length + 1);
            }

            this.el.innerHTML = '<span class="wrap">'+this.txt+'</span>';

            var that = this;
            var delta = 200 - Math.random() * 100;

            if (this.isDeleting) { delta /= 2; }

            if (!this.isDeleting && this.txt === fullTxt) {
            delta = this.period;
            this.isDeleting = true;
            } else if (this.isDeleting && this.txt === '') {
            this.isDeleting = false;
            this.loopNum++;
            delta = 500;
            }

            setTimeout(function() {
            that.tick();
            }, delta);
        };

        window.onload = function() {
            var elements = document.getElementsByClassName('typewrite');
            for (var i=0; i<elements.length; i++) {
                var toRotate = elements[i].getAttribute('data-type');
                var period = elements[i].getAttribute('data-period');
                if (toRotate) {
                  new TxtType(elements[i], JSON.parse(toRotate), period);
                }
            }
            // INJECT CSS
            var css = document.createElement("style");
            css.type = "text/css";
            css.innerHTML = ".typewrite > .wrap { border-right: 0.08em solid #67adc5}";
            document.body.appendChild(css);
        };
    </script>
@endsection