@extends('layout.guest-page')
@section('content')
    <!-- ================ start banner area ================= -->
    <section class="blog-banner-area" id="category">
        <div class="container h-100">
            <div class="blog-banner">
                <div class="text-center">
                    <h1>Register</h1>
                    <nav aria-label="breadcrumb" class="banner-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Register</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ end banner area ================= -->

    <!--================Login Box Area =================-->
    <section class="login_box_area section-margin">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="login_box_img">
                        <div class="hover">
                            <h4>Already have an account?</h4>
                            <p>There are advances being made in science and technology everyday, and a good example of
                                this is the</p>
                            <a class="button button-account" href="login.html">Login Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login_form_inner register_form_inner">
                        <h3>Create an account</h3>
                        <form method="post" class="row login_form" action="{{ route('register') }}" id="register_form">
                            @csrf
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Name'">
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="user_name" name="user_name"
                                    placeholder="User Name" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'User Name'">
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Password" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'Password'">
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control" id="confirmPassword"
                                    name="password_confirmation" placeholder="Confirm Password"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Confirm Password'">
                            </div>
                            <div class="col-md-12 form-group">
                                <div class="creat_account">
                                    <input type="checkbox" id="f-option2" name="selector">
                                    <label for="f-option2">Keep me logged in</label>
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <button class="button button-register w-100">Register</button>
                            </div>
                            <x-error />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Login Box Area =================-->
@endsection
