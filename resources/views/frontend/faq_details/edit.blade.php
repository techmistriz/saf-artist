@extends('layouts.frontend')
@section('content')




<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class=" container ">
        <!--begin::Education-->
        <div class="d-flex flex-row">
            <!--begin::Aside-->
            @include('frontend/includes/aside')
            <!--end::Aside-->
            <!--begin::Content-->
            <div class="flex-row-fluid ml-lg-8">
                <!--begin::Card-->
                <div class="card card-custom gutter-bs">

                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">Frequently Asked Questions</h3>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">               
                                <div class="faq-main">
                                    <div class="faq-item">
                                        <div class="faq-label">What is the Dimension of AuraJet Machine?<i></i></div>
                                        <div class="faq-cont"><p>Machine dimension (LxWxH) is 2995mm x 790mm x 1260mm.</p></div>
                                    </div>                      
                                </div>
                            </div>
                            
                            <div class="col-md-12">               
                                <div class="faq-main">
                                    <div class="faq-item">
                                        <div class="faq-label">What is the Dimension of AuraJet Machine?<i></i></div>
                                        <div class="faq-cont"><p>Machine dimension (LxWxH) is 2995mm x 790mm x 1260mm.</p></div>
                                    </div>                    
                                </div>
                            </div>

                            <div class="col-md-12">               
                                <div class="faq-main">
                                    <div class="faq-item">
                                        <div class="faq-label">What is the Dimension of AuraJet Machine?<i></i></div>
                                        <div class="faq-cont"><p>Machine dimension (LxWxH) is 2995mm x 790mm x 1260mm.</p></div>
                                    </div>                      
                                </div>
                            </div>
                            
                            <div class="col-md-12">               
                                <div class="faq-main">
                                    <div class="faq-item">
                                        <div class="faq-label">What is the Dimension of AuraJet Machine?<i></i></div>
                                        <div class="faq-cont"><p>Machine dimension (LxWxH) is 2995mm x 790mm x 1260mm.</p></div>
                                    </div>                    
                                </div>
                            </div>

                            <div class="col-md-12">               
                                <div class="faq-main">
                                    <div class="faq-item">
                                        <div class="faq-label">What is the Dimension of AuraJet Machine?<i></i></div>
                                        <div class="faq-cont"><p>Machine dimension (LxWxH) is 2995mm x 790mm x 1260mm.</p></div>
                                    </div>                      
                                </div>
                            </div>
                            
                            <div class="col-md-12">               
                                <div class="faq-main">
                                    <div class="faq-item">
                                        <div class="faq-label">What is the Dimension of AuraJet Machine?<i></i></div>
                                        <div class="faq-cont"><p>Machine dimension (LxWxH) is 2995mm x 790mm x 1260mm.</p></div>
                                    </div>                    
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!--end::Card-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Education-->
    </div>
    <!--end::Container-->
</div>
@endsection

@push('scripts')
<script type="text/javascript">

let items = document.querySelectorAll(".faq-main .faq-item");
            items.forEach(function (t) {
              t.addEventListener("click", function (e) {
                items.forEach(function (e) {
                  e !== t || e.classList.contains("faq-item-show")
                    ? e.classList.remove("faq-item-show")
                    : e.classList.add("faq-item-show");
                });
              });
            });

</script>
@endpush