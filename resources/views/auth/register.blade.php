@extends('layouts.app_user')
@section('content')
    <link rel="stylesheet" href="login_css/fonts/material-icon/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="login_css/css/style.css">
    <div class="main">
        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <!-- Display Message if User's Account is Blocked -->
                        @if(session('message'))
                            <div class="alert" style="color: #ed1818 !important">
                                {{ session('message') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="name" id="name" placeholder="Your Name"/>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email"/>
                            </div>
                            <!-- Phone Number Field -->
                            <div class="form-group">
                                <label for="phone"><i class="zmdi zmdi-phone"></i></label>
                                <input type="text" name="phone" id="phone" placeholder="Your Phone Number"/>
                            </div>

                            <!-- Role Selection -->
                            <div class="form-group">
                                <label for="role"><i class="zmdi zmdi-account-circle"></i></label>
                                <select name="role" id="role">
                                    <option value="transporter">Transporter</option>
                                    <option value="distributor">Distributor</option>
                                    <option value="farmer">Farmer</option>
                                    <option value="individual">Individual</option>
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="password" placeholder="Password"/>
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Repeat your password"/>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="login_css/images/signup-image.jpg" alt="sing up image"></figure>
                        <a href="{{url('login')}}" class="signup-image-link">I am already member</a>
                    </div>
                </div>
            </div>
        </section>

    </div>
    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
@endsection
