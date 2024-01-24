@extends('front.layout.app')
@section('content')
    <main>
        <!-- START:: BREADCRUMBS -->
        @include('front.auth.parts.breadcrumbs', [($page_name = __('messages.Login'))])
        <!-- END:: BREADCRUMBS -->


        <!-- START:: AUTHENTICATION -->
        <section class="authentication">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-md-7">
                        <div class="custom_authentication">
                            <div class="custom_tab_authentication">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="active" id="user_login_tab" data-bs-toggle="tab"
                                            data-bs-target="#user_login" type="button" role="tab"
                                            aria-controls="user_login" aria-selected="true"> {{ __('messages.login_c') }}
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a id="provider_login_tab" data-bs-toggle="tab" data-bs-target="#provider_login"
                                            type="button" role="tab" aria-controls="provider_login"
                                            aria-selected="true"> {{ __('messages.login_d') }} </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="custom_form_authentication">

                                <div class="tab-content" id="myTabContent">

                                    {{-- customer --}}
                                    <div class="tab-pane fade show active" id="user_login" role="tabpanel"
                                        aria-labelledby="user_login_tab">

                                        {{-- text info --}}
                                        @include('front.auth.parts.text_info', [
                                            ($title = __('messages.hello')),
                                            ($desc = __('messages.plase')),
                                        ])

                                        <form action="{{ route('customer.check_auth') }}" method="POST"
                                            class="form-group-custom edit_password row">
                                            @csrf

                                            @include('front.auth.login.login_inputs')

                                            <div class="col-md-12">
                                                @include('front.auth.parts.forget_link')
                                            </div>
                                            <div class="col-md-12">
                                                <button type="submit" class="btn-animation-2 w-100">
                                                    {{ __('messages.Login') }}
                                                </button>
                                            </div>
                                            <div class="col-md-12">
                                                @include('front.auth.parts.create_account_link')
                                            </div>
                                        </form>
                                        <div class="form-group"
                                            style="display: flex;justify-content: space-evenly; margin: 10px">
                                            <a href="{{ url('login/facebook') }}" class="btn btn-social-icon btn-facebook">
                                                <img src="https://cdn-icons-png.flaticon.com/128/2504/2504903.png"
                                                    width="40px" /></a>
                                            <a href="{{ url('login/google') }}" class="btn btn-social-icon btn-google-plus">
                                                <img src="https://cdn-icons-png.flaticon.com/128/2991/2991148.png"
                                                    width="40px" /></a>
                                        </div>
                                    </div>

                                    {{-- dealer --}}
                                    <div class="tab-pane fade" id="provider_login" role="tabpanel"
                                        aria-labelledby="provider_login_tab">

                                        {{-- text info --}}
                                        @include('front.auth.parts.text_info', [
                                            ($title = __('messages.hello')),
                                            ($desc = __('messages.plase')),
                                        ])

                                        <form action="{{ route('dealer.check_auth') }}" method="POST"
                                            class="form-group-custom edit_password row">
                                            @csrf

                                            @include('front.auth.login.login_inputs')

                                            <div class="col-md-12">
                                                @include('front.auth.parts.forget_link')
                                            </div>
                                            <div class="col-md-12">
                                                <button type="submit" class="btn-animation-2 w-100">
                                                    {{ __('messages.Login') }} </button>
                                            </div>
                                            <div class="col-md-12">
                                                @include('front.auth.parts.create_account_link')
                                            </div>
                                        </form>
                                        <div class="form-group"
                                            style="display: flex;justify-content: space-evenly; margin: 10px">
                                            <a href="{{ url('login/facebook') }}" class="btn btn-social-icon btn-facebook">
                                                <img src="https://cdn-icons-png.flaticon.com/128/2504/2504903.png"
                                                    width="40px" /></a>
                                            <a href="{{ url('login/google') }}" class="btn btn-social-icon btn-google-plus">
                                                <img src="https://cdn-icons-png.flaticon.com/128/2991/2991148.png"
                                                    width="40px" /></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END:: AUTHENTICATION -->
    </main>
@endsection
