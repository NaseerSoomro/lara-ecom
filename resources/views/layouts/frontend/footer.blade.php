<div>
    <div class="footer-area">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h4 class="footer-heading">{{ $appSetting->website_name }}</h4>
                    <div class="footer-underline"></div>
                    <p>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nostrum quos inventore voluptatem, repellendus eius autem expedita laudantium deleniti omnis sint, quibusdam qui quidem illo vitae laboriosam doloremque officiis quam neque.
                    </p>
                </div>
                <div class="col-md-3">
                    <h4 class="footer-heading">Quick Links</h4>
                    <div class="footer-underline"></div>
                    <div class="mb-2"><a href="{{ route('home_page') }}" class="text-white">Home</a></div>
                    <div class="mb-2"><a href="{{ route('about_us') }}" class="text-white">About Us</a></div>
                    <div class="mb-2"><a href="{{ route('contact_us') }}" class="text-white">Contact Us</a></div>
                    <div class="mb-2"><a href="{{ route('blogs') }}" class="text-white">Blogs</a></div>
                    <div class="mb-2"><a href="{{ route('site_maps') }}" class="text-white">Site Maps</a></div>
                </div>
                <div class="col-md-3">
                    <h4 class="footer-heading">Shop Now</h4>
                    <div class="footer-underline"></div>
                    <div class="mb-2"><a href="{{ route('collections') }}" class="text-white">Collections</a></div>
                    <div class="mb-2"><a href="{{ route('home_page') }}" class="text-white">Trending Products</a>
                    </div>
                    <div class="mb-2"><a href="{{ route('new_arrivals') }}" class="text-white">New Arrivals
                            Products</a></div>
                    <div class="mb-2"><a href="{{ route('featured_products') }}" class="text-white">Featured
                            Products</a></div>
                    <div class="mb-2"><a href="{{ route('carts') }}" class="text-white">Cart</a></div>
                </div>
                <div class="col-md-3">
                    <h4 class="footer-heading">Reach Us</h4>
                    <div class="footer-underline"></div>
                    <div class="mb-2">
                        <p>
                            <i class="fa fa-map-marker"></i>
                            {{ $appSetting->address }}
                        </p>
                    </div>
                    <div class="mb-2">
                        <a href="" class="text-white">
                            <i class="fa fa-phone"></i>
                            {{ $appSetting->phone_1 }}
                        </a>
                    </div>
                    <div class="mb-2">
                        <a href="" class="text-white">
                            <i class="fa fa-envelope"></i>
                            {{ $appSetting->email_1 }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <p class=""> &copy; 2023 Lara-Ecom. All rights reserved.</p>
                </div>
                <div class="col-md-4">
                    <div class="social-media">
                        Get Connected:
                        @if ($appSetting->facebook)
                            <a href="{{ $appSetting->facebook }}"><i class="fa fa-facebook"></i></a>
                        @endif
                        @if ($appSetting->twitter)
                            <a href="{{ $appSetting->twitter }}"><i class="fa fa-twitter"></i></a>
                        @endif
                        @if ($appSetting->instagram)
                            <a href="{{ $appSetting->instagram }}"><i class="fa fa-instagram"></i></a>
                        @endif
                        @if ($appSetting->youtube)
                            <a href="{{ $appSetting->youtube }}"><i class="fa fa-youtube"></i></a>
                        @endif
                        @if ($appSetting->whatsapp)
                            <a href="{{ $appSetting->whatsapp }}"><i class="fa fa-whatsapp"></i></a>
                        @endif  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
