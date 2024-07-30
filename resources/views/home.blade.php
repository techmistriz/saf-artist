@extends('layouts.frontend')

@section('content')
<style type="text/css">
    .radio {
        display: -webkit-box;
    }

    .image-input {
        margin-right: 10px;
    }

    .image-input .image-input-wrapper {
        width: 85px;
        height: 85px;
    }

    .form-control-custom, .input-group-text {
        background-color: transparent !important;
        border: none; 
        border-bottom: 1px solid #F7EAD3; 
        border-radius: 0;
        color: #F7EAD3 !important;
    }

    input.form-control-custom::placeholder {
      font-size: 12px;
      letter-spacing: 1px;
      line-height: 16px;
      color: #F7EAD3;
      font-family: 'Open Sans', sans-serif;
      text-transform: uppercase;
      opacity: 0.7;
    }

    textarea.form-control-custom::placeholder {
      font-size: 12px;
      letter-spacing: 1px;
      line-height: 16px;
      color: #F7EAD3;
      font-family: 'Open Sans', sans-serif;
      text-transform: uppercase;
      opacity: 0.7;
    }

    input.form-control-custom:focus {
        outline: none;
        background: none;
        border-bottom: 2px solid #F7EAD3;
    }

    .input-group-text .la{
        color: #F7EAD3;
    }

    .radio>span{
        border-radius:0.42rem!important;
    }

    .radio>span after{
        content:'/f00c'!important;
    }
    

    .btn.btn-light.focus:not(.btn-text), .btn.btn-light:focus:not(.btn-text), .btn.btn-light:hover:not(.btn-text):not(:disabled):not(.disabled) {
        color: #F7EAD3;
        background-color: transparent !important;
        border-color: #F7EAD3;
    }

    .bootstrap-select>.dropdown-toggle.btn-light, .bootstrap-select>.dropdown-toggle.btn-secondary {
        background: transparent !important;
        color: #F7EAD3;
        border-color: #F7EAD3!important;
        -webkit-box-shadow: none;
        box-shadow: none;
    }

    .bootstrap-select>.dropdown-toggle.btn-light .filter-option, .bootstrap-select>.dropdown-toggle.btn-secondary .filter-option {
        color: #f7ead3c9;
        text-transform:uppercase;
    }

    .btn.btn-light.dropdown-toggle:after {
        color: #F7EAD3;
    }

    .btn.btn-light.focus:not(.btn-text).dropdown-toggle:after, .btn.btn-light:focus:not(.btn-text).dropdown-toggle:after, .btn.btn-light:hover:not(.btn-text):not(:disabled):not(.disabled).dropdown-toggle:after {
        color: #F7EAD3;
    }


    .bootstrap-select>.dropdown-toggle.bs-placeholder.btn{
        border-top:0!important;
        border-left:0!important;
        border-right:0!important;
        padding: 0.825rem 1.42rem!important;
    }

    .bootstrap-select>.dropdown-toggle{
        border-top:0!important;
        border-left:0!important;
        border-right:0!important;
        padding: 0.825rem 1.42rem!important;
    }

    .mrslect{
        background: transparent !important;
        color: #f7ead3c9!important;
        border-color: #F7EAD3!important;
        -webkit-box-shadow: none;
        box-shadow: none;
        padding: 0.85rem 0.25rem;
        border-top: 0;
        border-right: 0;
        border-left: 0;
        text-transform:uppercase;
    }

    .mrslect:focus{
        border-top: 0;
        border-right: 0;
        border-left: 0;
        outline:none;
    }

    .cntform{
        margin-bottom:50px;
    }


    .form-group label{
        color:#f7ead3c9!important;
        margin-bottom:10px;
        padding:0px 10px;
        text-transform:uppercase;
    }

    .modal-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
        padding: 15px 20px;
    }
    .modal-header h1 {
        margin: 0;
        font-size: 1.5rem;
    }
    .modal-header p {
        margin: 5px 0;
    }
    .modal-content {
        padding: 20px;
    }
    .modal-body {
        max-height: 60vh;
        overflow-y: auto;
        padding: 15px;
    }
    .modal-footer {
        padding: 15px;
        border-top: 1px solid #dee2e6;
        display: flex;
        justify-content: flex-end;
    }
    .close {
        position: absolute;
        top: 10px;
        right: 20px;
        font-size: 1.5rem;
        color: #000;
    }

    @media (min-width: 576px) {
    .modal-dialog {
        max-width: 700px;
        margin: 1.75rem auto;
    }
    }

    #otpTimer{
        color: #ffffff;
        font-weight: normal;
        display: block;
        position: absolute;
        right: 5%;
        bottom: -3%;
        top: 65px;
        font-size: 10px;
    }

    .validation-errors{
        color: #ffffff;
        font-weight: normal;
        display: block;
        position: absolute;
        right: 4%;
        bottom: -3%;
        font-size: 12px;
    }

    .otpButton {
        width: auto;
        border: 2px solid #FA9917 !important;
        padding: 10px 20px;
        position: absolute;
        right: 14px;
        bottom: 25.5px;
        border-radius: 4px;
        color: #FA9917;
        font-weight: 700;
        letter-spacing: 1.17px;
        font-size: 0.9vw;
        line-height: 1.2vw;
        font-family: 'Open Sans', sans-serif;
        text-transform: uppercase;
        background-color: transparent !important;
    }

    .otpButton:hover {
        background: #FA9917 !important;
        color: #FFF;
    }

</style>

<section class="cntform">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="logo-sa">
                    <a href="{{URL::to('/')}}"><img src="{{url('/image/Logo-SVG.svg')}}" alt="Image"/></a>
                </div>

                <div class="login-link">
                    <a href="{{ route('login') }}">Click To Login</a>
                </div>
            </div>
        </div>


        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('flash::message')
                <div class="flex-row-fluid">
                    <!--begin::Card-->
                    <div class="card card-custom gutter-bs theme-bg">
                        <form action="{{ route('user.register') }}" method="POST" enctype="multipart/form-data" class="register-form">

                            {{ csrf_field() }}

                            <!--Begin::Body-->
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-12">
                                        <div class="card-title">
                                            <h3 class="card-label text-center theme-text-color">FILL YOUR DETAILS</h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-12">
                                        <div class="form-group row validated" style="align-items:center;">

                                            <div class="inline-select">
                                                <div class="checkbox-inline">
                                                    <label class="checkbox theme-text-color" style="padding-top:8px; padding-left:0px;">
                                                        Are you
                                                    </label>
                                                </div>
                                                <div class="selectfield">
                                                    <select class="form-control form-control-lg form-control-custom selectpicker1" name="frontend_role_id" id="frontend_role_id" tabindex="null" required>
                                                        <option value="">Select Role</option>
                                                        @if($frontendRoles->count())
                                                            @foreach($frontendRoles as $value)

                                                               <option {{ old('frontend_role_id') == $value->id ? 'selected' : '' }} value="{{$value->id}}">{{$value->name}}</option>

                                                            @endforeach
                                                        @endif
                                                    </select>

                                                    @error('frontend_role_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        <div class="form-group row validated">
                                            
                                            <div class="col-6">
                                                <input type="text" name="name" value="{{ old('name', $row->name ?? '') }}" class="form-control form-control-lg form-control-custom"  placeholder="Enter Full Name" required/>
                                                @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group row validated" style="position:relative;">
                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <input type="text" oninput="this.value=this.value.replace(/[^0-9]/g, '')" name="contact" id="contact" value="{{ old('contact', $row->contact ?? '') }}" class="form-control form-control-lg form-control-custom" maxlength="10" placeholder="Enter Contact" required />
                                                        @error('contact')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div id="otp" style="display:none; bottom: 30px; right: 15px; position: absolute;">
                                                    <input id="otp-input" placeholder="Enter OTP" class="form-control" name="otp" type="text">
                                                </div>
                                                <div class="sendBtn" style="display:none;">
                                                    <input type="button" id="send-otp" class="otpButton" value="Send OTP">
                                                </div>
                                                <div class="resendBtn" style="display:none;">
                                                    <input type="button" id="resend-otp" class="otpButton" value="Resend OTP">
                                                </div>
                                                <span class="otp-message-wrapper">
                                                    <input type="hidden" class="is-valid">
                                                    <span class="valid-feedback" role="alert" id="otp-message">
                                                        <strong></strong>
                                                    </span>
                                                </span>
                                                <div id="otpTimer" style="display:none;"></div>
                                                <div class="validation-errors"></div>
                                            </div>

                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        <div class="form-group row validated">
                                            <div class="col-6">
                                                <div class="form-group row validated">
                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <input type="text" name="email" id="email" value="{{ old('email') ? old('email') : ( isset($row->email) ? $row->email : '') }}" class="form-control form-control-lg form-control-custom"  placeholder="Enter Email" required/>
                                                        @error('email')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-6">
                                                
                                                <div class="form-group row validated">
                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <select class="form-control form-control-lg form-control-custom selectpicker1" name="category_id" tabindex="null" >
                                                            <option value="">Select Category</option>
                                                            @if($categories->count())
                                                                @foreach($categories as $value)

                                                                   <option {{ old('category_id') == $value->id ? 'selected' : '' }} value="{{$value->id}}">{{$value->name}}</option>

                                                                @endforeach
                                                            @endif
                                                        </select>

                                                        @error('category_id')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror                                                    
                                                    </div>
                                                </div>
                                            </div>                                            
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group row validated" style="align-items:center;">

                                            <div class="inline-select">
                                                <div class="checkbox-inline">
                                                    <label style="padding-top:8px; padding-left:0px;"> I am </label>
                                                </div>

                                                <div class="selectfield">
                                                        <select class="form-control form-control-lg form-control-custom selectpicker1" name="artist_type_id" id="artist_type_id" tabindex="null" >
                                                            <option value="">Select</option>
                                                            @if($artistTypes->count())
                                                                @foreach($artistTypes as $value)

                                                                   <option {{ old('artist_type_id') == $value->id ? 'selected' : '' }} value="{{$value->id}}">{{$value->name}}</option>

                                                                @endforeach
                                                            @endif
                                                        </select>

                                                        @error('artist_type_id')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                </div>

                                                <div class="radio-inline">
                                                    <label class="radio theme-text-color" style="padding-top:8px;">
                                                       and part of 
                                                    </label>
                                                </div>

                                                <div class="selectfield">
                                                    <select name="curator_name" id="curator_name" class="myslct form-control form-control-lg form-control-custom selectpicker1 @error('curator_name') is-invalid @enderror">
                                                            <option value="">Select Curator</option>

                                                            @if($curators->count())
                                                                @foreach($curators as $value)
                                                                    <option value="{{$value->name}}" {{ old('curator_name', $row->curator_name ?? '') == $value->name ? 'selected' : '' }}>{{$value->name}}</option>
                                                                @endforeach
                                                            @endif

                                                        </select>
                                                        @error('curator_name')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                </div>
                                            </div>                                            

                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group row validated">
                                            <div class="checkbox-inline">
                                                <label class="checkbox theme-text-color">
                                                    <input type="checkbox" name="terms" value="1" required="" />
                                                    <span></span>
                                                    I accept <a data-toggle="modal" data-target="#termCondition">Terms and Conditions.</a>
                                                </label>
                                            </div>

                                            @error('terms')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-lg-12 text-center">
                                        <button type="submit" class="theme-btn">REGISTER</button>
                                    </div>
                                </div>

                            </div>
                            <!--end::Body-->
                        </form>
                    </div>
                    <!--end::Card-->
                </div>
            </div>
        </div>
    </div>

    <!-- Term Condition -->
    <div class="modal fade" id="termCondition" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-center flex-column col-md-12">
                    <h1>Terms and Conditions</h1>
                </div>
                <div class="modal-body col-md-12">
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
                <div class="modal-footer col-md-12">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


</section>

@endsection

@push('scripts')
<script type="text/javascript">
    
    function iAmPress(_this){

        if($(_this).val() == 2){

            $("#artist_type_id").val('');
            $("#artist_type_id").prop('disabled', true);
            $("#artist_type_id").css('opacity', 0.5);
            // $("#artist_type_id").selectpicker('refresh');
            $("#curator_name").val('');
            $("#curator_name").prop('disabled', true);
            $("#curator_name").css('opacity', 0.5);
            // $("#curator_name").selectpicker('refresh');
            
        } else {

            $("#artist_type_id").prop('disabled', false);
            // $("#artist_type_id").selectpicker('refresh');
            $("#artist_type_id").css('opacity', 1);
            $("#curator_name").prop('disabled', false);
            // $("#curator_name").selectpicker('refresh');
            $("#curator_name").css('opacity', 1);
            
        }
    }

    $(document).ready(function () {
        $('#contact').on('input', function () {
            var inputValue = $(this).val();
            if (inputValue.length === 10 && !isNaN(inputValue)) {
                $('.sendBtn').show();
            } else {
                $('.sendBtn').hide();
            }
        });
    });

    $(document).ready(function() {
       $('#send-otp, #resend-otp').click(function(e) {
            e.preventDefault();
            var contact = $("#contact").val();
            var email = $("#email").val();

            if (!isValidContact(contact)) {
                displayMessage('Please enter a valid 10-digit contact number.', 'danger');
                return;
            }

            if (!isValidEmail(email)) {
                displayMessage('Please enter a valid email address.', 'danger');
                return;
            }

            var button = $(this);
            button.prop('disabled', true);

            $.ajax({
                type: 'POST',
                url: '{{ route("ajax.send.otp") }}',
                data: {"_token": "{{ csrf_token() }}", contact: contact, email: email},
                dataType: 'json',
                success: function(response) {
                    if (response.status) {
                        $('#otp').show().find('input').prop('required', true);
                        $('.sendBtn').hide();
                        $('.resendBtn').hide();
                        startTimer(60);

                        displayMessage('OTP has been sent on your email & whatsapp.', 'success');

                        setTimeout(function() {
                            $('.sendBtn').hide();
                            $('#otp').hide().find('input').prop('required', false);
                            $('.resendBtn').show();
                            button.prop('disabled', false);
                        }, 60000);

                    } else {
                        button.prop('disabled', false);
                        displayMessage(response.message || 'Failed to send OTP. Please try again later.', 'danger');
                    }
                },
                error: function(xhr, status, error) {
                    button.prop('disabled', false);
                    console.error(xhr.responseText);
                    displayMessage('An error occurred. Please try again.', 'danger');
                }
            });
        });

        $('#query-form').submit(function(e) {
            e.preventDefault();
            submitForm();
        });

        function isValidContact(contact) {
            return contact.trim() !== '' && /^\d{10}$/.test(contact);
        }

        function isValidEmail(email) {
            var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            return emailPattern.test(email);
        }

        function displayMessage(message, type) {
            var messageDiv = $('.validation-errors');
            messageDiv.text(message).css('color', type === 'success' ? 'white' : 'red');
            
            setTimeout(function() {
                messageDiv.text('').removeAttr('style');
            }, 10000);
        }

    });

    function startTimer(duration) {
        var timeleft = duration;
        var buttonTimer = setInterval(function(){
            if (timeleft <= 0) {
                clearInterval(buttonTimer);
                $('.sendBtn').disabled = false;
                document.getElementById("otpTimer").style.display = "none";
            } else {
                document.getElementById("otpTimer").innerHTML = "Resend OTP in " + timeleft + " seconds";
                document.getElementById("otpTimer").style.display = "block";
                $('.resendBtn').disabled = true;
                $('.sendBtn').disabled = true;
            }
            timeleft -= 1;
        }, 1000);
    }

    document.addEventListener('DOMContentLoaded', function() {
        const flashMessage = document.querySelector('.alert');

        if (flashMessage) {
            setTimeout(function() {
                flashMessage.style.display = 'none';
            }, 10000);
        }
    });
    
</script>
@endpush