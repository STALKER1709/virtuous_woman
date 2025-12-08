@extends('layouts.app')
@section('content')

<main>
    <!-- Hero Slider avec le style Virtuous Woman -->
    <section class="swiper-container js-swiper-slider swiper-number-pagination slideshow virtuous-slider" data-settings='{
        "autoplay": {
          "delay": 5000
        },
        "slidesPerView": 1,
        "effect": "fade",
        "loop": true
      }'>
      <div class="swiper-wrapper">
        <div class="swiper-slide virtuous-slide">
          <div class="overflow-hidden position-relative h-100">
            <div class="slideshow-character position-absolute bottom-0 pos_right-center">
              <img loading="lazy" src="{{asset('assets/images/home/demo3/slideshow-character1.png')}}" width="542" height="733"
                alt="Virtuous Woman Empowerment"
                class="slideshow-character__img animate animate_fade animate_btt animate_delay-9 w-auto h-auto" />
              <div class="character_markup type2 virtuous-markup">
                <p class="text-uppercase font-sofia mark-orange-color animate animate_fade animate_btt animate_delay-10 mb-0">
                  Empowerment</p>
              </div>
            </div>
            <div class="slideshow-text container position-absolute start-50 top-50 translate-middle">
              <h6 class="text_dash text-uppercase fs-base fw-medium animate animate_fade animate_btt animate_delay-3 virtuous-subtitle">
                Authentic Style</h6>
              <h2 class="h1 fw-normal mb-0 animate animate_fade animate_btt animate_delay-5">Discover Your</h2>
              <h2 class="h1 fw-bold animate animate_fade animate_btt animate_delay-5 virtuous-title">Inner Strength</h2>
              <a href="#"
                class="btn-link btn-link_lg default-underline fw-medium animate animate_fade animate_btt animate_delay-7 virtuous-cta">Explore Collection</a>
            </div>
          </div>
        </div>

        <div class="swiper-slide virtuous-slide">
          <div class="overflow-hidden position-relative h-100">
            <div class="slideshow-character position-absolute bottom-0 pos_right-center">
              <img loading="lazy" src="{{asset('assets/images/slideshow-character1.png')}}" width="400" height="733"
                alt="Virtuous Woman Community"
                class="slideshow-character__img animate animate_fade animate_btt animate_delay-9 w-auto h-auto" />
              <div class="character_markup virtuous-markup">
                <p class="text-uppercase font-sofia fw-bold animate animate_fade animate_rtl animate_delay-10 mark-orange-color">Community</p>
              </div>
            </div>
            <div class="slideshow-text container position-absolute start-50 top-50 translate-middle">
              <h6 class="text_dash text-uppercase fs-base fw-medium animate animate_fade animate_btt animate_delay-3 virtuous-subtitle">
                Join Our Sisterhood</h6>
              <h2 class="h1 fw-normal mb-0 animate animate_fade animate_btt animate_delay-5">Where Style Meets</h2>
              <h2 class="h1 fw-bold animate animate_fade animate_btt animate_delay-5 virtuous-title">Solidarity</h2>
              <a href="#"
                class="btn-link btn-link_lg default-underline fw-medium animate animate_fade animate_btt animate_delay-7 virtuous-cta">Join Community</a>
            </div>
          </div>
        </div>

        <div class="swiper-slide virtuous-slide">
          <div class="overflow-hidden position-relative h-100">
            <div class="slideshow-character position-absolute bottom-0 pos_right-center">
              <img loading="lazy" src="{{asset('assets/images/slideshow-character2.png')}}" width="400" height="690"
                alt="Virtuous Woman Daily Inspiration"
                class="slideshow-character__img animate animate_fade animate_rtl animate_delay-10 w-auto h-auto" />
            </div>
            <div class="slideshow-text container position-absolute start-50 top-50 translate-middle">
              <h6 class="text_dash text-uppercase fs-base fw-medium animate animate_fade animate_btt animate_delay-3 virtuous-subtitle">
                Daily Inspiration</h6>
              <h2 class="h1 fw-normal mb-0 animate animate_fade animate_btt animate_delay-5">Embrace Your</h2>
              <h2 class="h1 fw-bold animate animate_fade animate_btt animate_delay-5 virtuous-title">Authentic Self</h2>
              <a href="#"
                class="btn-link btn-link_lg default-underline fw-medium animate animate_fade animate_btt animate_delay-7 virtuous-cta">Get Inspired</a>
            </div>
          </div>
        </div>
      </div>

      <div class="container">
        <div class="slideshow-pagination slideshow-number-pagination d-flex align-items-center position-absolute bottom-0 mb-5">
        </div>
      </div>
    </section>

    <div class="container mw-1620 bg-white border-radius-10">
      <div class="mb-3 mb-xl-5 pt-1 pb-4"></div>
      
      <!-- Section Daily Inspiration Quote -->
      <section class="inspiration-section container text-center mb-5">
        <div class="inspiration-quote virtuous-quote">
          <blockquote class="fs-2 fst-italic text-dark mb-3">
            "Treme ipsorn dissure exercatocond iac ocp alatet varve strane in he estu tonic ho turned to blueento horinx oport prandi etap."
          </blockquote>
          <p class="text-orange fw-medium text-uppercase">- Daily Inspiration</p>
        </div>
      </section>

      <!-- Categories avec les valeurs de la marque -->
      <section class="category-carousel container">
        <h2 class="section-title text-center mb-3 pb-xl-2 mb-xl-4 virtuous-section-title">Our Collections</h2>

        <div class="position-relative">
          <div class="swiper-container js-swiper-slider" data-settings='{
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": 8,
              "slidesPerGroup": 1,
              "effect": "none",
              "loop": true,
              "navigation": {
                "nextEl": ".products-carousel__next-1",
                "prevEl": ".products-carousel__prev-1"
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 2,
                  "slidesPerGroup": 2,
                  "spaceBetween": 15
                },
                "768": {
                  "slidesPerView": 4,
                  "slidesPerGroup": 4,
                  "spaceBetween": 30
                },
                "992": {
                  "slidesPerView": 6,
                  "slidesPerGroup": 1,
                  "spaceBetween": 45,
                  "pagination": false
                },
                "1200": {
                  "slidesPerView": 8,
                  "slidesPerGroup": 1,
                  "spaceBetween": 60,
                  "pagination": false
                }
              }
            }'>
            <div class="swiper-wrapper">
              <div class="swiper-slide virtuous-category">
                <img loading="lazy" class="w-100 h-auto mb-3" src="{{asset('assets/images/home/demo3/category_1.png')}}" width="124" height="124" alt="Empowerment Dresses" />
                <div class="text-center">
                  <a href="#" class="menu-link fw-medium virtuous-category-link">Empowerment<br />Dresses</a>
                </div>
              </div>
              <div class="swiper-slide virtuous-category">
                <img loading="lazy" class="w-100 h-auto mb-3" src="{{asset('assets/images/home/demo3/category_2.png')}}" width="124" height="124" alt="Community Pants" />
                <div class="text-center">
                  <a href="#" class="menu-link fw-medium virtuous-category-link">Community<br />Essentials</a>
                </div>
              </div>
              <div class="swiper-slide virtuous-category">
                <img loading="lazy" class="w-100 h-auto mb-3" src="{{asset('assets/images/home/demo3/category_3.png')}}" width="124" height="124" alt="Authentic Clothes" />
                <div class="text-center">
                  <a href="#" class="menu-link fw-medium virtuous-category-link">Authentic<br />Collection</a>
                </div>
              </div>
              <div class="swiper-slide virtuous-category">
                <img loading="lazy" class="w-100 h-auto mb-3" src="{{asset('assets/images/home/demo3/category_4.png')}}" width="124" height="124" alt="Style Jeans" />
                <div class="text-center">
                  <a href="#" class="menu-link fw-medium virtuous-category-link">Signature<br />Style</a>
                </div>
              </div>
              <div class="swiper-slide virtuous-category">
                <img loading="lazy" class="w-100 h-auto mb-3" src="{{asset('assets/images/home/demo3/category_5.png')}}" width="124" height="124" alt="Inspiration Shirts" />
                <div class="text-center">
                  <a href="#" class="menu-link fw-medium virtuous-category-link">Daily<br />Inspiration</a>
                </div>
              </div>
              <div class="swiper-slide virtuous-category">
                <img loading="lazy" class="w-100 h-auto mb-3" src="{{asset('assets/images/home/demo3/category_6.png')}}" width="124" height="124" alt="Strength Shoes" />
                <div class="text-center">
                  <a href="#" class="menu-link fw-medium virtuous-category-link">Inner<br />Strength</a>
                </div>
              </div>
              <div class="swiper-slide virtuous-category">
                <img loading="lazy" class="w-100 h-auto mb-3" src="{{asset('assets/images/home/demo3/category_7.png')}}" width="124" height="124" alt="Sisterhood Dresses" />
                <div class="text-center">
                  <a href="#" class="menu-link fw-medium virtuous-category-link">Sisterhood<br />Dresses</a>
                </div>
              </div>
              <div class="swiper-slide virtuous-category">
                <img loading="lazy" class="w-100 h-auto mb-3" src="{{asset('assets/images/home/demo3/category_8.png')}}" width="124" height="124" alt="Women Tops" />
                <div class="text-center">
                  <a href="#" class="menu-link fw-medium virtuous-category-link">Women<br />Empowerment</a>
                </div>
              </div>
            </div>
          </div>

          <div class="products-carousel__prev products-carousel__prev-1 position-absolute top-50 d-flex align-items-center justify-content-center virtuous-carousel-nav">
            <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
              <use href="#icon_prev_md" />
            </svg>
          </div>
          <div class="products-carousel__next products-carousel__next-1 position-absolute top-50 d-flex align-items-center justify-content-center virtuous-carousel-nav">
            <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
              <use href="#icon_next_md" />
            </svg>
          </div>
        </div>
      </section>

      <div class="mb-3 mb-xl-5 pt-1 pb-4"></div>

      <!-- Hot Deals adapté -->
      <section class="hot-deals container">
        <h2 class="section-title text-center mb-3 pb-xl-3 mb-xl-4 virtuous-section-title">Empowerment Collection</h2>
        <div class="row">
          <div class="col-md-6 col-lg-4 col-xl-20per d-flex align-items-center flex-column justify-content-center py-4 align-items-md-start virtuous-deals-text">
            <h2 class="fw-light">Authentic Style</h2>
            <h2 class="fw-bold virtuous-title">Up to 60% Off</h2>

            <div class="position-relative d-flex align-items-center text-center pt-xxl-4 js-countdown mb-3 virtuous-countdown"
              data-date="18-3-2024" data-time="06:50">
              <div class="day countdown-unit">
                <span class="countdown-num d-block"></span>
                <span class="countdown-word text-uppercase text-secondary">Days</span>
              </div>

              <div class="hour countdown-unit">
                <span class="countdown-num d-block"></span>
                <span class="countdown-word text-uppercase text-secondary">Hours</span>
              </div>

              <div class="min countdown-unit">
                <span class="countdown-num d-block"></span>
                <span class="countdown-word text-uppercase text-secondary">Mins</span>
              </div>

              <div class="sec countdown-unit">
                <span class="countdown-num d-block"></span>
                <span class="countdown-word text-uppercase text-secondary">Sec</span>
              </div>
            </div>

            <a href="#" class="btn-link default-underline text-uppercase fw-medium mt-3 virtuous-cta">Discover Collection</a>
          </div>
          <div class="col-md-6 col-lg-8 col-xl-80per">
            <div class="position-relative">
              <div class="swiper-container js-swiper-slider" data-settings='{
                  "autoplay": {
                    "delay": 5000
                  },
                  "slidesPerView": 4,
                  "slidesPerGroup": 4,
                  "effect": "none",
                  "loop": false,
                  "breakpoints": {
                    "320": {
                      "slidesPerView": 2,
                      "slidesPerGroup": 2,
                      "spaceBetween": 14
                    },
                    "768": {
                      "slidesPerView": 2,
                      "slidesPerGroup": 3,
                      "spaceBetween": 24
                    },
                    "992": {
                      "slidesPerView": 3,
                      "slidesPerGroup": 1,
                      "spaceBetween": 30,
                      "pagination": false
                    },
                    "1200": {
                      "slidesPerView": 4,
                      "slidesPerGroup": 1,
                      "spaceBetween": 30,
                      "pagination": false
                    }
                  }
                }'>
                <div class="swiper-wrapper">
                  <!-- Produits avec images originales mais noms adaptés -->
                  <div class="swiper-slide product-card product-card_style3 virtuous-product">
                    <div class="pc__img-wrapper">
                      <a href="details.html">
                        <img loading="lazy" src="{{asset('assets/images/home/demo3/product-0-1.jpg')}}" width="258" height="313"
                          alt="Empowerment Dress" class="pc__img">
                        <img loading="lazy" src="{{asset('assets/images/home/demo3/product-0-2.jpg')}}" width="258" height="313"
                          alt="Empowerment Dress" class="pc__img pc__img-second">
                      </a>
                    </div>

                    <div class="pc__info position-relative">
                      <h6 class="pc__title"><a href="details.html">Empowerment Leather Jacket</a></h6>
                      <div class="product-card__price d-flex">
                        <span class="money price text-orange">$89</span>
                      </div>

                      <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body virtuous-product-actions">
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside virtuous-btn"
                          data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view virtuous-btn"
                          data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                          <span class="d-none d-xxl-block">Quick View</span>
                          <span class="d-block d-xxl-none"><svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <use href="#icon_view" />
                            </svg></span>
                        </button>
                        <button class="pc__btn-wl bg-transparent border-0 js-add-wishlist virtuous-wishlist" title="Add To Wishlist">
                          <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <use href="#icon_heart" />
                          </svg>
                        </button>
                      </div>
                    </div>
                  </div>

                  <div class="swiper-slide product-card product-card_style3 virtuous-product">
                    <div class="pc__img-wrapper">
                      <a href="details.html">
                        <img loading="lazy" src="{{asset('assets/images/home/demo3/product-1-1.jpg')}}" width="258" height="313"
                          alt="Community Shorts" class="pc__img">
                        <img loading="lazy" src="{{asset('assets/images/home/demo3/product-1-2.jpg')}}" width="258" height="313"
                          alt="Community Shorts" class="pc__img pc__img-second">
                      </a>
                    </div>

                    <div class="pc__info position-relative">
                      <h6 class="pc__title"><a href="details.html">Community Comfort Shorts</a></h6>
                      <div class="product-card__price d-flex">
                        <span class="money price text-orange">$62</span>
                      </div>

                      <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body virtuous-product-actions">
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside virtuous-btn"
                          data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view virtuous-btn"
                          data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                          <span class="d-none d-xxl-block">Quick View</span>
                          <span class="d-block d-xxl-none"><svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <use href="#icon_view" />
                            </svg></span>
                        </button>
                        <button class="pc__btn-wl bg-transparent border-0 js-add-wishlist virtuous-wishlist" title="Add To Wishlist">
                          <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <use href="#icon_heart" />
                          </svg>
                        </button>
                      </div>
                    </div>
                  </div>

                  <div class="swiper-slide product-card product-card_style3 virtuous-product">
                    <div class="pc__img-wrapper">
                      <a href="details.html">
                        <img loading="lazy" src="{{asset('assets/images/home/demo3/product-2-1.jpg')}}" width="258" height="313"
                          alt="Authentic T-Shirt" class="pc__img">
                        <img loading="lazy" src="{{asset('assets/images/home/demo3/product-2-2.jpg')}}" width="258" height="313"
                          alt="Authentic T-Shirt" class="pc__img pc__img-second">
                      </a>
                    </div>

                    <div class="pc__info position-relative">
                      <h6 class="pc__title"><a href="details.html">Authentic Kirby T-Shirt</a></h6>
                      <div class="product-card__price d-flex">
                        <span class="money price text-orange">$42</span>
                      </div>

                      <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body virtuous-product-actions">
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside virtuous-btn"
                          data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view virtuous-btn"
                          data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                          <span class="d-none d-xxl-block">Quick View</span>
                          <span class="d-block d-xxl-none"><svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <use href="#icon_view" />
                            </svg></span>
                        </button>
                        <button class="pc__btn-wl bg-transparent border-0 js-add-wishlist virtuous-wishlist" title="Add To Wishlist">
                          <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <use href="#icon_heart" />
                          </svg>
                        </button>
                      </div>
                    </div>
                  </div>

                  <div class="swiper-slide product-card product-card_style3 virtuous-product">
                    <div class="pc__img-wrapper">
                      <a href="details.html">
                        <img loading="lazy" src="{{asset('assets/images/home/demo3/product-3-1.jpg')}}" width="258" height="313"
                          alt="Inspiration Shawl" class="pc__img">
                        <img loading="lazy" src="{{asset('assets/images/home/demo3/product-3-2.jpg')}}" width="258" height="313"
                          alt="Inspiration Shawl" class="pc__img pc__img-second">
                      </a>
                    </div>

                    <div class="pc__info position-relative">
                      <h6 class="pc__title"><a href="details.html">Daily Inspiration Shawl</a></h6>
                      <div class="product-card__price d-flex align-items-center">
                        <span class="money price-old">$129</span>
                        <span class="money price text-orange">$99</span>
                      </div>

                      <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body virtuous-product-actions">
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside virtuous-btn"
                          data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view virtuous-btn"
                          data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                          <span class="d-none d-xxl-block">Quick View</span>
                          <span class="d-block d-xxl-none"><svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <use href="#icon_view" />
                            </svg></span>
                        </button>
                        <button class="pc__btn-wl bg-transparent border-0 js-add-wishlist virtuous-wishlist" title="Add To Wishlist">
                          <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <use href="#icon_heart" />
                          </svg>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <div class="mb-3 mb-xl-5 pt-1 pb-4"></div>

      <!-- Bannières de catégories avec images originales -->
      <section class="category-banner container">
        <div class="row">
          <div class="col-md-6">
            <div class="category-banner__item border-radius-10 mb-5 virtuous-banner">
              <img loading="lazy" class="h-auto" src="{{asset('assets/images/home/demo3/category_9.jpg')}}" width="690" height="665"
                alt="Community Collection" />
              <div class="category-banner__item-mark virtuous-banner-mark">
                Community Love
              </div>
              <div class="category-banner__item-content">
                <h3 class="mb-0">Sisterhood</h3>
                <a href="#" class="btn-link default-underline text-uppercase fw-medium virtuous-cta">Join Now</a>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="category-banner__item border-radius-10 mb-5 virtuous-banner">
              <img loading="lazy" class="h-auto" src="{{asset('assets/images/home/demo3/category_10.jpg')}}" width="690" height="665"
                alt="Daily Inspiration" />
              <div class="category-banner__item-mark virtuous-banner-mark">
                Daily Quotes
              </div>
              <div class="category-banner__item-content">
                <h3 class="mb-0">Inspiration</h3>
                <a href="#" class="btn-link default-underline text-uppercase fw-medium virtuous-cta">Get Inspired</a>
              </div>
            </div>
          </div>
        </div>
      </section>

      <div class="mb-3 mb-xl-5 pt-1 pb-4"></div>

      <!-- Produits vedettes avec images originales -->
      <section class="products-grid container">
        <h2 class="section-title text-center mb-3 pb-xl-3 mb-xl-4 virtuous-section-title">Authentic Collection</h2>

        <div class="row">
          <!-- Produits avec images originales mais noms adaptés -->
          <div class="col-6 col-md-4 col-lg-3">
            <div class="product-card product-card_style3 mb-3 mb-md-4 mb-xxl-5 virtuous-product">
              <div class="pc__img-wrapper">
                <a href="details.html">
                  <img loading="lazy" src="{{asset('assets/images/home/demo3/product-4.jpg')}}" width="330" height="400"
                    alt="Authentic Blouse" class="pc__img">
                </a>
                <div class="product-label text-uppercase bg-orange text-white top-0 left-0 mt-2 mx-2 virtuous-label">Empowerment</div>
              </div>

              <div class="pc__info position-relative">
                <h6 class="pc__title"><a href="details.html">Authentic Silk Blouse</a></h6>
                <div class="product-card__price d-flex align-items-center">
                  <span class="money price text-orange">$129</span>
                </div>

                <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body virtuous-product-actions">
                  <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside virtuous-btn"
                    data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                  <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view virtuous-btn"
                    data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                    <span class="d-none d-xxl-block">Quick View</span>
                    <span class="d-block d-xxl-none"><svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_view" />
                      </svg></span>
                  </button>
                  <button class="pc__btn-wl bg-transparent border-0 js-add-wishlist virtuous-wishlist" title="Add To Wishlist">
                    <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <use href="#icon_heart" />
                    </svg>
                  </button>
                </div>
              </div>
            </div>
          </div>

          <div class="col-6 col-md-4 col-lg-3">
            <div class="product-card product-card_style3 mb-3 mb-md-4 mb-xxl-5 virtuous-product">
              <div class="pc__img-wrapper">
                <a href="details.html">
                  <img loading="lazy" src="{{asset('assets/images/home/demo3/product-5.jpg')}}" width="330" height="400"
                    alt="Community Shorts" class="pc__img">
                </a>
              </div>

              <div class="pc__info position-relative">
                <h6 class="pc__title"><a href="details.html">Community Comfort Shorts</a></h6>
                <div class="product-card__price d-flex align-items-center">
                  <span class="money price text-orange">$62</span>
                </div>

                <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body virtuous-product-actions">
                  <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside virtuous-btn"
                    data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                  <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view virtuous-btn"
                    data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                    <span class="d-none d-xxl-block">Quick View</span>
                    <span class="d-block d-xxl-none"><svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_view" />
                      </svg></span>
                  </button>
                  <button class="pc__btn-wl bg-transparent border-0 js-add-wishlist virtuous-wishlist" title="Add To Wishlist">
                    <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <use href="#icon_heart" />
                    </svg>
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- Continuer avec les autres produits... -->
        </div>

        <div class="text-center mt-2">
          <a class="btn-link btn-link_lg default-underline text-uppercase fw-medium virtuous-cta" href="#">View All Collections</a>
        </div>
      </section>
    </div>

    <div class="mb-3 mb-xl-5 pt-1 pb-4"></div>

</main>

<style>
/* Styles spécifiques pour Virtuous Woman */
:root {
  --virtuous-orange: #FF6800;
  --virtuous-orange-light: #FF8C42;
  --virtuous-dark: #2C2C2C;
  --virtuous-light: #F8F8F8;
}

.virtuous-slider .swiper-slide {
  background: linear-gradient(135deg, var(--virtuous-light) 0%, #ffffff 100%);
}

.virtuous-title {
  color: var(--virtuous-orange);
  font-family: 'Allura', cursive;
}

.virtuous-subtitle {
  color: var(--virtuous-dark);
  letter-spacing: 0.2em;
}

.virtuous-cta {
  color: var(--virtuous-orange);
  border-bottom: 2px solid var(--virtuous-orange);
}

.virtuous-cta:hover {
  color: var(--virtuous-orange-light);
}

.virtuous-section-title {
  color: var(--virtuous-dark);
  position: relative;
}

.virtuous-section-title::after {
  content: '';
  position: absolute;
  bottom: -10px;
  left: 50%;
  transform: translateX(-50%);
  width: 60px;
  height: 2px;
  background: var(--virtuous-orange);
}

.virtuous-category-link {
  color: var(--virtuous-dark);
  transition: color 0.3s ease;
}

.virtuous-category-link:hover {
  color: var(--virtuous-orange);
}

.virtuous-product-actions .virtuous-btn {
  color: var(--virtuous-dark);
}

.virtuous-product-actions .virtuous-btn:hover {
  color: var(--virtuous-orange);
}

.virtuous-wishlist:hover svg {
  color: var(--virtuous-orange);
}

.virtuous-banner-mark {
  background: var(--virtuous-orange);
  color: white;
}

.virtuous-label {
  background: var(--virtuous-orange) !important;
}

.mark-orange-color {
  color: var(--virtuous-orange) !important;
}

.text-orange {
  color: var(--virtuous-orange) !important;
}

.bg-orange {
  background-color: var(--virtuous-orange) !important;
}

.virtuous-quote {
  border-left: 4px solid var(--virtuous-orange);
  padding-left: 2rem;
}

.virtuous-carousel-nav svg {
  color: var(--virtuous-orange);
}

.virtuous-countdown .countdown-num {
  color: var(--virtuous-orange);
  font-weight: bold;
}

/* Adaptation des prix pour utiliser la couleur orange */
.virtuous-product .money.price {
  color: var(--virtuous-orange) !important;
}

/* Adaptation des boutons produits */
.virtuous-product .btn-link:hover {
  color: var(--virtuous-orange) !important;
}
</style>

@endsection