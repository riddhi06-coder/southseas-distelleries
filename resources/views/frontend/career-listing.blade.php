

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Southseas Distilleries</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('frontend/assets/img/logo/fav.png') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/media.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/effect.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/hover.css') }}">
    <!-- <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" /> -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/owl.theme.default.min.css') }}">
    <!-- Hotjar Tracking Code for https://southseasdistilleries.com -->
    <script>
        (function(h,o,t,j,a,r){
            h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
            h._hjSettings={hjid:5069043,hjsv:6};
            a=o.getElementsByTagName('head')[0];
            r=o.createElement('script');r.async=1;
            r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
            a.appendChild(r);
        })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
    </script>
  </head>

  <body>
    <div class="main_menu_site page_menu">
      <nav>
        <ul class="main_logo">
          <li><a href="index.html"><img src="{{ asset('frontend/assets/img/logo/new-logo.png') }}" style="width:220px;"></a></li>
        </ul>
        <div class="button">
          <a class="btn-open"><img src="{{ asset('frontend/assets/img/icon/open-menu.png') }}"></a>
        </div>
      </nav>
      <div class="overlay" id="style-3">
        <div class="wrap">
          <div class="row">
            <div class="col-md-12">
              <a class="btn_close"><img src="{{ asset('frontend/assets/img/icon/close.png') }}"></a>
            </div>
          </div>
          <div class="row">
            <div class="col-md-8">
              <div class="menu_img">
                <img src="{{ asset('frontend/assets/img/menu-img-new.png') }}" class="img-responsive">
              </div>
            </div>
            <div class="col-md-4">

              <nav class="navigation">
                <ul class="mainmenu">
                  <li><a href="our-legacy.html">OUR LEGACY</a></li>
                  <li><a href="our-ethos.html">OUR ETHOS</a></li>
                  <li><a href="our-journey.html">OUR JOURNEY</a></li>
                  <li>
                    <a href="#">OUR SPIRITS</a>
                    <ul class="submenu">
                      <li><a href="our-spirits.html"><span>&#187;</span> Crazy Cock</a></li>
                      <li><a href="https://www.sixbrothers.com"><span>&#187;</span> Six Brothers</a></li>
                    </ul>
                  </li>
                  <li><a href="csr.html">CSR</a></li>
                  <li><a href="contact-us.html">CONTACT US</a></li>
                </ul>
              </nav>
            </div>
          </div>
          <div class="social">

            <p>©2024 South Seas Distilleries & Breweries Pvt. Ltd.</p>
          </div>
        </div>
      </div>
    </div>

    <section class="craft-title-wrap">
      <div class="container-fluid no-padding">
        <div class="row no-margin craft-row">
          <div class="col-md-4 no-padding craft-img"
              @if(!empty($banner->banner_image))
                        style="background-image: url('{{ asset('uploads/careers/' . $banner->banner_image) }}'); background-size: cover; background-position: center; background-repeat: no-repeat;"
                    @endif>
          </div>
          <div class="col-md-8 no-padding">
            <div class="craft-text">
              <h4>{{ $banner->banner_heading ?? '' }}</h4>
            </div>
          </div>
        </div>
      </div>
    </section>


    <div class="openings-dashboard-wrap">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="openings-search">
              <p>{!! $banner->section_heading ?? '' !!}</p>

              <div class="search-box-wrap">
                <div class="row">

                  <!-- First Column -->
                  <div class="col-md-9">
                    <!-- Search Input with Icon -->
                    <div class="input-group search-box">
                      <input type="text" class="form-control" placeholder="Search by category, keyword, or location">
                      <span class="input-group-addon">
                        <i class="fa fa-search"></i>
                      </span>
                    </div>

                    <!-- Checkbox and Button Row -->
                    <div class="checkbox-row">
                      <!-- <div class="checkbox">
                        <label><input type="checkbox"> Entry Level Jobs</label>
                      </div> -->
                      <button class="btn btn-primary">Share Search Results <img src="{{ asset('frontend/assets/img/icon/share.png') }}" /></button>
                    </div>
                  </div>

                  <!-- Second Column -->
                  <div class="col-md-3">
                    <!-- Job Search Filters Dropdown -->
                    <div class="career-dropdown">
                      <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                          Job Search Filters <img src="{{ asset('frontend/assets/img/icon/down-arrow.png') }}" />
                        </button>
                        <ul class="dropdown-menu">
                          <li><a href="#">Remote Only</a></li>
                          <li><a href="#">Full-Time</a></li>
                          <li><a href="#">Part-Time</a></li>
                          <li><a href="#">Internships</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    
    <section class="openings-list-wrap">
      <div class="container">
        <div class="row">

          <div class="col-md-12">
            <!-- <div class="selected-filter">
              <ul>
                <li><img src="{{ asset('frontend/assets/img/icon/x-mark.png') }}">Human Resources</li>
              </ul>
            </div> -->
            <table class="table responsive-job-table">
                <thead class="single-head-opening">
                    <tr>
                    <th><h2 class="text-left">Job</h2></th>
                    <th><h2>Department</h2></th>
                    <th><h2>Location</h2></th>
                    <th><h2>&nbsp;</h2></th> 
                    </tr>
                </thead>
                <tbody>
                    @foreach($details as $item)
                    <tr class="single-opening">
                        <td>
                        <a href="{{ route('job.details', $item->slug) }}">
                            <h2 class="text-left">{{ $item->job_role }}</h2>
                        </a>
                        </td>
                        <td><h4>{{ $item->department }}</h4></td>
                        <td><h6>{{ $item->location }}</h6></td>
                        <td>
                        <div class="opening-btn">
                            <a href="#">
                            <button class="btn btn-primary">Apply Now</button>
                            </a>
                            <a href="#"><img src="{{ asset('frontend/assets/img/icon/share.png') }}" alt="Share" /></a>
                        </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>

          </div>

        </div>
      </div>
    </section>


    <section class="article-one-sec">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="article-one-text">
              <h2>OVER <span>100</span> YEARS OF DISTILLING WISDOM</h2>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="footer-one">
      <div class="container">
        <div class="row">
          <div class="col-md-1">
            <div class="footer-logo">
              <img src="{{ asset('frontend/assets/img/home/icon.png') }}" class="img-responsive">
            </div>
          </div>
          <div class="col-md-9">
            <div class="footer-links">
              <ul class="footer-links-one">
                <li><a href="terms-and-conditions.html">Terms & Conditions</a></li>
                <li><a href="privacy-notice.html">Privacy Notice</a></li>
                <li><a href="cookie-policy.html">Cookie Policy</a></li>
                <!--<li><a href="ugc-policy-and-social-responsibility.html">UGC Policy / Social Responsibility</a></li>-->
              </ul>
              <br>
              <ul class="footer-links-two">
                <li><a href="contact-us.html">CONTACT US</a></li>
                <!--<li><a href="#">PRESS OFFICE</a></li>-->
                <li><a href="#" data-toggle="modal" data-target="#basicExampleModal">JOIN OUR COMMUNITY</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-2">
            <div class="footer-social">
              <ul>
                <li><a href="https://www.instagram.com/southseasdistilleries" target="_blank"><i class="fa fa-instagram"></i></a></li>
                <!--<li><a href="#"><i class="fa fa-linkedin"></i></a></li>-->
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="footer-two">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="footer-two-text">
              <p class="footer-two-text-one">This content is intended only for people who are of legal purchase age in their country. Forward to those of legal purchase age only.</p>
              <p class="drink_line">DRINK RESPONSIBLY.</p>
              <p>©2024 South Seas Distilleries & Breweries Pvt. Ltd.</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Modal -->
    <div id="legacy-one" class="modal legacy-content-popup fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <!-- <h4 class="modal-title">Modal Header</h4> -->
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div class="popup-legacy-content" id="style-3">
                <p>Ever since, we’ve been<br>
                <span class="text-italic">quietly</span> working behind the scenes. </p>

                <p>We’ve <span class="text-italic">honed</span> our skills<br>
                and mastered the art of distillation.</p>

                <p>We’ve embarked on a journey<br>
                which spans continents, traversing the globe<br>
                in our quest for the most <span class="text-italic">exquisite</span> oak casks,<br>
                each with a history as rich and profound<br>
                as the spirits they are destined to embrace.</p>

                <p>We are a distillery located in Dahanu,<br>
                a region known for its serene casuarina fringed<br>
                shores and warm climate, which, we were told,<br>
                isn’t ideal for single malt maturation.  </p>

                <p>We’ve proved the <span class="text-italic">naysayers</span> wrong<br>
                by producing uniquely matured single malts,<br>
                owing to the <span class="text-italic">micro-climatic</span> conditions.</p>

                <p>At a time when no one dared to enter<br>
                the realm of single malt whiskies,<br>
                we installed India’s <span class="text-italic">largest</span> Copper Pot Stills.</p>

                <p><span class="text-italic">But we didn’t stop there. </span></p>

                <p>We went against the tide and built<br>
                India’s <span class="text-italic">largest</span> warehouse, to patiently mature<br>
                our <span class="text-italic">distinctive</span> spirits. </p>

                <p>In the hallowed halls of our distillery,<br>
                traditional <span class="text-italic">craftsmanship</span> meets modern <span class="text-italic">innovation,</span><br>
                resulting in extraordinary spirits,<br>
                which serve as a testament<br>
                of our boundless <span class="text-italic">passion</span> and <span class="text-italic">artistry.</span></p>
            </div>
              </div>
            </div>
          </div>
          <!-- <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div> -->
        </div>

      </div>
    </div>
    <div id="legacy-two" class="modal legacy-content-popup fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <!-- <h4 class="modal-title">Modal Header</h4> -->
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div class="popup-legacy-content" id="style-3">
                <p>Driven by our <span class="text-italic">passion</span> for the art of distillation,<br>
                our Master Distillers delved deep into their craft,<br>
                <span class="text-italic">refining</span> their techniques in the shadows. </p>

                <p><span class="text-italic">The move paid off.</span></p>

                <p>When the shackles of prohibition were finally lifted,<br>we rose again, like a Phoenix rising from the ashes. </p>

                <p><span class="text-italic">A new era had dawned.</span></p>

                <p>Our founder’s passion for distillation led to <br>the establishment of South Seas Distilleries in 1984, <br>in the quaint town of Dahanu, Maharashtra. </p>

               <!--  <p>We restarted our operations with a new distillery<br>
                  located in the quaint village of Aswa, Dahanu.</p> -->

                <p>The birth of our new distillery<br>
                marked the <span class="text-italic">rebirth</span> of hope in our hearts<br>
                to realise our cherished dream.
                </p>

                <p>Soon, our casks were replete<br>
                with spirits which <span class="text-italic">transcended</span> the extraordinary.
                </p>

                <p>The spirits travelled across continents,<br>
                  much to the delight of discerning master distillers.
                  </p>

                <p>To this day, our founder’s legacy lives on<br>
                and is celebrated with every drop of liquid gold<br>
                we produce, serving as a reminder<br>
                that all it takes is perseverance<br>
                to transform adversity into <span class="text-italic">excellence.</span>
                </p>
            </div>
              </div>
            </div>
          </div>
          <!-- <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div> -->
        </div>

      </div>
    </div>
    <div id="legacy-three" class="modal legacy-content-popup fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <!-- <h4 class="modal-title">Modal Header</h4> -->
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div class="popup-legacy-content" id="style-3">
                <p>Which is why, we transcend the hurried pace<br>
                of the modern world to patiently produce<br>
                a <span class="text-italic">remarkable</span> single malt whisky among the finest<br>
                the world has to offer. </p>

                <p>Across four generations,<br>
                the family has embraced the virtue<br>
                of patience with the deep seeded<br>
                understanding that true greatness<br>
                could never be rushed.</p>

                <p>Our single malt whiskies lie<br>
                  for years interacting with the wood of the casks,<br>
                  until they achieve a balance<br>
                  which is nothing short of <span class="text-italic">perfection.</span></p>

                <p>We continue to use<br>
                the original Copper Pot Stills<br>
                we installed, to this day. </p>

                <p>We are sticklers for detail<br>
                and we hold back a whisky until<br>
                it’s <span class="text-italic">‘just right’</span>, even if it means<br>
                waiting for decades, should need be,<br>
                including our packaging. </p>

                <p>Simply because we know<br>
                that the one thing which makes a long,<br>
                tiring journey worthwhile is<br>
                the <span class="text-italic">warm</span> feeling of coming home.</p>

                <p>After crafting spirits which speak our story,<br>
                <span class="text-italic">we are home.</span></p>
            </div>
              </div>
            </div>
          </div>
          <!-- <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div> -->
        </div>

      </div>
    </div>
    <!-- popup form -->
    <div class="modal fade onload_form_popup" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <!--  <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          </div> -->
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
            </div>
          </div>
          <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-11 no-padding">
              <div class="popup-main-title">
                <div class="popup-main-icon">
                  <img src="{{ asset('frontend/assets/img/popup-icon.png') }}">
                </div>
                <div class="popup-main-text">
                  <h3>Join our community.</h3>
                  <h6>Sign up today for news and updates from the distillery.</h6>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <form class="popup_form_onload">
            <div class="row">
              <div class="col-md-1"></div>
              <div class="form-group col-md-5">
                <label for="inputEmail" class="col-md-4 no-padding col-form-label">First Name:</label>
                <div class="col-md-8 no-padding">
                  <input type="text" class="form-control" id="inputEmail" placeholder="">
                </div>
              </div>
              <div class="form-group col-md-5">
                <label for="inputEmail" class="col-md-4 no-padding col-form-label">Last Name:</label>
                <div class="col-md-8 no-padding">
                  <input type="text" class="form-control" id="inputEmail" placeholder="">
                </div>
              </div>
              <div class="col-md-1"></div>
            </div>

            <div class="row">
              <div class="col-md-1"></div>
              <div class="form-group col-md-5">
                <label for="inputEmail" class="col-md-4 no-padding col-form-label">DoB:</label>
                <div class="col-md-8 no-padding">
                  <div class="datepicker">
                    <div class="date_div">
                    <input type="text" class="form-control" placeholder="D">
                    <input type="text" class="form-control" placeholder="D">
                  </div>
                  <div class="month_div">
                    <input type="text" class="form-control" placeholder="M">
                    <input type="text" class="form-control" placeholder="M">
                  </div>
                  <div class="year_div">
                    <input type="text" class="form-control" placeholder="Y">
                    <input type="text" class="form-control" placeholder="Y">
                    <input type="text" class="form-control" placeholder="Y">
                    <input type="text" class="form-control" placeholder="Y">
                  </div>
                  </div>
                </div>
              </div>
              <div class="form-group col-md-5">
                <label for="inputEmail" class="col-md-4 no-padding col-form-label">Email:</label>
                <div class="col-md-8 no-padding">
                  <input type="text" class="form-control" id="inputEmail" placeholder="">
                </div>
              </div>
              <div class="col-md-1"></div>
            </div>

            <div class="row">
              <div class="col-md-1"></div>
              <div class="form-group col-md-5">
                <label for="inputEmail" class="col-md-4 no-padding col-form-label">Country:</label>
                <div class="col-md-8 no-padding">
                  <input type="text" class="form-control" id="inputEmail" placeholder="">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-1"></div>
              <div class="form-group col-md-11">
                <label class="col-form-label condition_label">(By entering the details, you agree to our Terms & Conditions and Privacy policy.)</label>
              </div>
            </div>

            <div class="row">
              <div class="col-md-1"></div>
              <div class="form-group col-md-10">
                <div class="checkbox_row">
                <input type="checkbox" class="checkbox-square" />
                <label> I would like to receive special offers and promotions from Crazy Cock Single Malt by email.</label>
                </div>
              </div>
              <div class="col-md-1"></div>
            </div>

            <div class="row">
              <div class="col-md-1"></div>
               <div class="form-group col-md-10">
                <div class="checkbox_row">
                <input type="checkbox" class="checkbox-square" />
                <label> I accept Crazy Cock Single Malt’s Conditions of Use and acknowledge the Privacy and Cookie Notice.</label>
                </div>
              </div>
              <div class="col-md-1"></div>
            </div>
            <div class="row">
              <div class="col-md-1"></div>
              <div class="form-group col-md-11">
                <button type="submit" class="popup_btn" value="SUBSCRIBE">SUBSCRIBE</button>
              </div>
            </div>
            </form>
          </div>
          
          <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10 no-padding"> 
            <hr class="popup_form_onload_hr">
            <p class="form-below-text">Your information may be used by South Seas Distilleries and Breweries Pvt. Ltd.,<br>
            we value and respect your privacy. You can unsubscribe at any time.</p> 
            </div>
            <div class="col-md-1"></div>
          </div>
        </div>
      </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <script src="{{ asset('frontend/assets/js/owl.carousel.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/custom.js') }}"></script>

  </body>
</html>