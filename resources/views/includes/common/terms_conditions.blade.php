@extends('layouts.frontend')

@section('content')
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class=" container container-fluid">
        <!--begin::Education-->
        <div class="d-flex flex-row">
            @include('frontend/includes/aside')
            <div class="flex-row-fluid ml-lg-8">
                <!--begin::Card-->
                <div class="card card-custom gutter-bs">
                    <!--begin::Card-->
                    <div class="card card-custom">
                        <div class="card-header flex-wrap border-0 pt-6 pb-0">
                            <div class="card-title">
                                <h3 class="card-label">Terms & Conditions
                                <span class="d-block text-muted pt-2 font-size-sm">  </span></h3>
                            </div>
                        </div>
                        <div class="card-body">
                           <div class="container">

                                <p>Welcome to Serendipity Arts!</p>

                                <p>These terms and conditions outline the rules and regulations for the use of Serendipity Arts's Website, located at serendipityarts.com.</p>

                                <p>By accessing this website we assume you accept these terms and conditions. Do not continue to use Serendipity Arts if you do not agree to take all of the terms and conditions stated on this page.</p>

                                <h2>Cookies</h2>
                                <p>We employ the use of cookies. By accessing Serendipity Arts, you agreed to use cookies in agreement with the Serendipity Arts's Privacy Policy.</p>

                                <h2>License</h2>
                                <p>Unless otherwise stated, Serendipity Arts and/or its licensors own the intellectual property rights for all material on Serendipity Arts. All intellectual property rights are reserved. You may access this from Serendipity Arts for your own personal use subjected to restrictions set in these terms and conditions.</p>

                                <h2>You must not:</h2>
                                <ul>
                                    <li>Republish material from Serendipity Arts</li>
                                    <li>Sell, rent or sub-license material from Serendipity Arts</li>
                                    <li>Reproduce, duplicate or copy material from Serendipity Arts</li>
                                    <li>Redistribute content from Serendipity Arts</li>
                                </ul>

                                <h2>Content Liability</h2>
                                <p>We shall not be hold responsible for any content that appears on your Website. You agree to protect and defend us against all claims that is rising on your Website.</p>

                                <h2>Your Privacy</h2>
                                <p>Please read Privacy Policy</p>

                                <h2>Reservation of Rights</h2>
                                <p>We reserve the right to request that you remove all links or any particular link to our Website. You approve to immediately remove all links to our Website upon request.</p>

                                <h2>Disclaimer</h2>
                                <p>To the maximum extent permitted by applicable law, we exclude all representations, warranties and conditions relating to our website and the use of this website.</p>
                            </div>                           
                        </div>
                        <!--end::Card-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection