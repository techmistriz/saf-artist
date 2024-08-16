@include('flash::message')

<div class="row">
    <div class="col-md-12">
        
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label">{{ isset($row) && !empty($row) ? 'Edit' : 'Add' }} Banking Details</h3>
                </div>
            </div>
            
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">User Profile</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control selectpicker" name="profile_id" tabindex="null" onchange="getUserDetails()" required>
                                    <option value="" data-slug="">Select User Profile</option>
                                    @if($userProfiles->count())
                                        @foreach($userProfiles as $value)
                                            <option {{ (old('profile_id') ?? optional($row)->profile_id) == $value->id ? 'selected' : '' }} value="{{$value->id}}">
                                                {{ optional($value->festival)->name . ' (' . $value->project_year . ')' }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('profile_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div> 
                    </div>

                    <div class="col-12">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Full Name </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="name" id="name" value="{{ old('name', $row->name ?? '') }}" class="form-control form-control-lg form-control-solid @error('name') is-invalid @enderror" readonly />
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Address</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <textarea class="form-control form-control-lg form-control-solid @error('permanent_address') is-invalid @enderror  no-summernote-editor" name="permanent_address" id="permanent_address" readonly >{{ old('permanent_address', $row->permanent_address ?? '') }}</textarea>
                                @error('permanent_address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Country</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control selectpicker" name="country_id" tabindex="null" onchange="getState()">
                                    <option value="" data-slug="">Select Country</option>
                                    @if($countries->count())
                                        @foreach($countries as $value)
                                          <option {{ (old('country_id') ?? optional($row)->country_id) == $value->id ? 'selected' : '' }} value="{{$value->id}}">{{$value->country_name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('country_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div> 
                    </div>      

                    <div class="col-12">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">State</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control selectpicker" name="state_id" tabindex="null" onchange="getCity()">
                                    <option value="" data-slug="">Select State</option>
                                   
                                </select>
                                @error('state_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div> 
                    </div>  
                    
                    <div class="col-12 state-wrapper">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">City</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control selectpicker" name="city_id" tabindex="null">
                                    <option value="" data-slug="">Select City</option>
                                    
                                </select>
                                @error('city_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div> 
                    </div>

                    <div class="col-12">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Pincode</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="pincode" value="{{ old('pincode', $row->pincode ?? '') }}" class="form-control form-control-lg form-control-solid @error('pincode') is-invalid @enderror " placeholder="Enter Pincode" required/>
                                @error('pincode')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Residency</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control form-control-lg form-control-solid selectpicker" name="residency" tabindex="null" onchange="showShowField()">
                                    <option value="">Select Residency</option>
                                    <option value="Domestic" {{ old('residency') == 'Domestic' || (isset($row->residency) && $row->residency == 'Domestic') ? 'selected' : '' }}>Domestic</option>
                                    <option value="International" {{old('residency') == 'International' || (isset($row->residency) && $row->residency == 'International') ? 'selected' : ''  }}>International</option>
                                </select>
                                @error('residency')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Account Number</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="account_number" oninput="this.value=this.value.replace(/[^0-9]/, '')" minlength="10" maxlength="20" value="{{ old('account_number', $row->account_number ?? '') }}" class="form-control form-control-lg form-control-solid @error('account_number') is-invalid @enderror " placeholder="Enter account number"/>
                                @error('account_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Re-enter Account Number</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="confirm_account_number" oninput="this.value=this.value.replace(/[^0-9]/, '')" minlength="10" maxlength="20" value="{{ old('confirm_account_number') ? old('confirm_account_number') :( isset($row->confirm_account_number) ? $row->confirm_account_number : '') }}" class="form-control form-control-lg form-control-solid @error('confirm_account_number') is-invalid @enderror " placeholder="Enter confirm account number"/>
                                @error('confirm_account_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-12" id="ibanNumber" style="{{( isset($row->residency) && $row->residency == 'Domestic')  ? 'display:none;' : '' }}">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">IBAN Number</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="iban_number" value="{{ old('iban_number', $row->iban_number ?? '') }}" class="form-control form-control-lg form-control-solid @error('iban_number') is-invalid @enderror " placeholder="Enter Iban Number"/>
                                @error('iban_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-12" id="swiftCode" style="{{( isset($row->residency) && $row->residency == 'Domestic')  ? 'display:none;' : '' }}">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Swift Code</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="swift_code" value="{{ old('swift_code', $row->swift_code ?? '') }}" class="form-control form-control-lg form-control-solid @error('swift_code') is-invalid @enderror " placeholder="Enter Swift Code"/>
                                @error('swift_code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-12" id="Corresponding" style="{{( isset($row->residency) && $row->residency == 'Domestic')  ? 'display:none;' : '' }}">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Corresponding Bank Details</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="corresponding_bank_details" value="{{ old('corresponding_bank_details', $row->corresponding_bank_details ?? '') }}" class="form-control form-control-lg form-control-solid @error('corresponding_bank_details') is-invalid @enderror " placeholder="Enter Corresponding Bank Details"/>
                                @error('corresponding_bank_details')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-12" id="bankHolder" style="{{( isset($row->residency) && $row->residency == 'International')  ? 'display:none;' : '' }}">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Bank holder name (As per bank records)</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="bank_holder_name" value="{{ old('bank_holder_name') ? old('bank_holder_name') :( isset($row->bank_holder_name) ? $row->bank_holder_name : '') }}" class="form-control form-control-lg form-control-solid @error('bank_holder_name') is-invalid @enderror " placeholder="Enter Bank Holder name (As per bank records)"/>
                                @error('bank_holder_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-12" id="bankName" style="{{( isset($row->residency) && $row->residency == 'International')  ? 'display:none;' : '' }}">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Bank Name</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="bank_name" value="{{ old('bank_name') ? old('bank_name') :( isset($row->bank_name) ? $row->bank_name : '') }}" class="form-control form-control-lg form-control-solid @error('bank_name') is-invalid @enderror " placeholder="Enter bank name"/>
                                @error('bank_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-12" id="branchAddress" style="{{( isset($row->residency) && $row->residency == 'International')  ? 'display:none;' : '' }}">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Branch Address</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="branch_address" value="{{ old('branch_address') ? old('branch_address') :( isset($row->branch_address) ? $row->branch_address : '') }}" class="form-control form-control-lg form-control-solid @error('branch_address') is-invalid @enderror " placeholder="Enter branch address"/>
                                @error('branch_address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-12" id="ifscCode" style="{{( isset($row->residency) && $row->residency == 'International')  ? 'display:none;' : '' }}">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">IFSC code</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="ifsc_code" value="{{ old('ifsc_code', $row->ifsc_code ?? '') }}" class="form-control form-control-lg form-control-solid @error('ifsc_code') is-invalid @enderror " placeholder="Enter ifsc code" maxlength="11" />
                                @error('ifsc_code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-12" id="cancelCheque" style="{{( isset($row->residency) && $row->residency == 'International')  ? 'display:none;' : '' }}">

                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Cancel Cheque/Passbook</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                
                                <input type="file" name="cancel_cheque_image"  class="form-control form-control-lg form-control-solid @error('cancel_cheque_image') is-invalid @enderror " />

                                Uploaded File: 
                                @if($row && $row->cancel_cheque_image)
                                    <a target="_blank" href="{{ asset('uploads/users/'.$row->cancel_cheque_image) }}">{{$row->cancel_cheque_image}}</a>
                                @else
                                N/A
                                @endif

                                @error('cancel_cheque_image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-12" id="pancardNumber" style="{{( isset($row->residency) && $row->residency == 'International')  ? 'display:none;' : '' }}">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">PAN Card</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="pancard_number" value="{{ old('pancard_number') ? old('pancard_number') :( isset($row->pancard_number) ? $row->pancard_number : '') }}" class="form-control form-control-lg form-control-solid @error('pancard_number') is-invalid @enderror " placeholder="Enter pancard number"/>
                                @error('pancard_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12" id="linkWithAdhar" style="{{( isset($row->residency) && $row->residency == 'International')  ? 'display:none;' : '' }}">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Is your pancard linked with adhaar ?<i class="fa fa-question" data-toggle="tooltip" data-placement="right" title="TDS 20% will be applicable if adhaar is not linked with bank."></i></label>
                            <div class="col-form-label col-lg-9 col-md-9 col-sm-12">
                                <div class="checkbox-inline">
                                    <label class="checkbox">
                                        <input type="checkbox" name="pancard_link_with_adhar" value="1" {{(old('pancard_link_with_adhar', $row->pancard_link_with_adhar ?? '') == '1') ? 'checked' : '' }} />
                                        <span></span>
                                    </label>
                                </div>

                                @error('pancard_link_with_adhar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12" id="panCard" style="{{( isset($row->residency) && $row->residency == 'International')  ? 'display:none;' : '' }}">

                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">PAN Card (Image) </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                
                                <div class="image-input image-input-outline" id="pancard_image" style="background-image: url({{asset('media/users/blank_Img.jpg')}})">

                                    @if(isset($row->pancard_image) && !empty($row->pancard_image))
                                        <div class="image-input-wrapper" style="background-image: url({{asset('uploads/users/'.$row->pancard_image)}})"></div>
                                    @else
                                        <div class="image-input-wrapper pancard_image_base64"></div>
                                    @endif

                                    <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change">
                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                        <input type="file" name="pancard_image" accept=".png, .jpg, .jpeg"/>
                                        <input type="hidden" name="pancard_image_remove"/>
                                    </label>

                                    @if(isset($row->pancard_image) && !empty($row->pancard_image))
                                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove">
                                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                                        </span>
                                    @else
                                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel">
                                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                                        </span>
                                    @endif
                                </div>

                                @error('pancard_image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-12" id="gstApplicable" style="{{( isset($row->residency) && $row->residency == 'International')  ? 'display:none;' : '' }}">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">GST Applicable</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control form-control-lg form-control-solid @error('has_gst_applicable') is-invalid @enderror  selectpicker" name="has_gst_applicable" tabindex="null" onchange="hasGSTApplicable(this)">
                                    <option value="">Select</option>
                                    <option value="Yes" {{(old('has_gst_applicable') == 'Yes' || (!isset($row->has_gst_applicable) || empty($row->has_gst_applicable)) ) ? 'selected' : ( isset($row->has_gst_applicable) && $row->has_gst_applicable == 'Yes' ? 'selected' : '')}}>Yes</option>
                                    <option value="No" {{(old('has_gst_applicable') == 'No' || (!isset($row->has_gst_applicable) || empty($row->has_gst_applicable)) ) ? 'selected' : ( isset($row->has_gst_applicable) && $row->has_gst_applicable == 'No' ? 'selected' : '')}}>No</option>
                                </select>

                                @error('has_gst_applicable')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12 has-gst-applicable" style="display: {{ old('has_gst_applicable', $row->has_gst_applicable ?? 'No') == 'Yes' ? '' : 'none'; }}">

                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">GST Number</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="gst_number" value="{{ old('gst_number') ? old('gst_number') :( isset($row->gst_number) ? $row->gst_number : '') }}" class="form-control form-control-lg form-control-solid @error('gst_number') is-invalid @enderror " placeholder="Enter GST Number"/>
                                @error('gst_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>

                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">gst certificate </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="file" name="gst_certificate_file"  class="form-control form-control-lg form-control-solid @error('gst_certificate_file') is-invalid @enderror " />
                                Uploaded File: 
                                @if($row && $row->gst_certificate_file)
                                    <a target="_blank" href="{{ asset('uploads/users/'.$row->gst_certificate_file) }}">{{$row->gst_certificate_file}}</a>
                                @else
                                N/A
                                @endif
                               
                                @error('gst_certificate_file')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group row validated">
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                &nbsp;
                            </div>
                            <div class="col-form-label col-lg-9 col-md-9 col-sm-12">
                                <div class="checkbox-inline">
                                    <label class="checkbox">
                                        <input type="checkbox" name="terms" value="1" required="" />
                                        <span></span>
                                        <a href="{{route('term.conditions')}}" target="_blank" >{{ env('FORM_CONSENT', 'I Accept Terms & Conditions') }}</a>
                                    </label>
                                </div>

                                @error('terms')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    @if(!isset($row) || $row->banking_status == 1)
                        <input type="hidden" name="banking_status" id="freeze" value="1">
                        <div class="col-lg-12 text-center">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a data-toggle="modal" data-target="#confirmModal" class="theme-btn mt-0 mb-0  " id="saveFreeze">Submit for review</a>
                        </div>
                    @else
                        <div class="col-lg-12">
                            <p class="text-center text-danger small italic">Your account has been frozen by admin, hence you are not able to update any details.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-center flex-column">
                <h3 class="modal-title w-100">Please confirm your submission.</h3>
                <p>Do you really want to submit this for review? In review you can not change or update the information.</p>                
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script type="text/javascript">

    $('#saveFreeze').click(function() {
        $('#freeze').val(2)
    })

    function showShowField() {

        var residency = $('select[name="residency"] option:selected').text();
        if (residency == 'Domestic') {                          
            $('#ibanNumber').hide();
            $('#swiftCode').hide();
            $('#Corresponding').hide();
            $('#bankHolder').show();
            $('#bankName').show();
            $('#branchAddress').show();
            $('#ifscCode').show();
            $('#cancelCheque').show();
            $('#linkWithAdhar').show();
            $('#panCard').show();
            $('#gstApplicable').show();
            $('#pancardNumber').show();
        }else if(residency == 'International'){
            $('#ibanNumber').show();
            $('#swiftCode').show();
            $('#Corresponding').show();
            $('#bankHolder').hide();
            $('#bankName').hide();
            $('#branchAddress').hide();
            $('#ifscCode').hide();
            $('#cancelCheque').hide();
            $('#linkWithAdhar').hide();
            $('#panCard').hide();
            $('#gstApplicable').hide();
            $('#pancardNumber').hide();
        }else{
            $('#ibanNumber').hide();
            $('#swiftCode').hide();
            $('#Corresponding').hide();
            $('#bankHolder').hide();
            $('#bankName').hide();
            $('#branchAddress').hide();
            $('#ifscCode').hide();
            $('#cancelCheque').hide();
            $('#linkWithAdhar').hide();
            $('#panCard').hide();
            $('#gstApplicable').hide();
            $('#pancardNumber').hide();
        }
    } 

    //START pancard_image
    var pancard_image = new KTImageInput('pancard_image');

    pancard_image.on('cancel', function(imageInput) {
        swal.fire({
            title: 'Image successfully canceled !',
            type: 'success',
            buttonsStyling: false,
            confirmButtonText: 'Okay!',
            confirmButtonClass: 'btn btn-primary font-weight-bold'
        });
    });

    pancard_image.on('change', function(imageInput) {
        
    });

    pancard_image.on('remove', function(imageInput) {
        swal.fire({
            title: 'Image successfully removed !',
            type: 'error',
            buttonsStyling: false,
            confirmButtonText: 'Got it!',
            confirmButtonClass: 'btn btn-primary font-weight-bold'
        });
    });
    //END pancard_image

    function hasGSTApplicable(_this){

        if($(_this).val() == 'Yes'){
            $(".has-gst-applicable").show();
        } else {

            $(".has-gst-applicable").hide();
        }
    }

    function getState() {
        //console.log('getState Called');
        var country_id = $('select[name=country_id]').val();
        //console.log('country_id', country_id);
        if (country_id) {
            $.ajax({
                type: "GET",
                url: "{{ url('states') }}/" + country_id,
                dataType: 'json',
                success: function (response) {
                    if (response && response.status) {
                        var options = '<option value="">Select State</option>';
                        if (response.data.length) {

                            var selectedId = '{{ $row->state_id ?? 0 }}';

                            for (var i = 0; i < response.data.length; i++) {
                                var _selected = '';

                                if (selectedId == response.data[i].id) {
                                    _selected = 'selected';
                                }

                                options += '<option ' + _selected + ' value="' + response.data[i].id + '">' + response.data[i].state_name + '</option>';
                            }

                            $("select[name='state_id']").html(options);
                            $("select[name='state_id']").selectpicker('refresh');
                            getCity();
                        }
                    }
                }
            });

        } else {

            $("select[name='state_id']").html('<option value="">Select State</option>');
            $("select[name='state_id']").selectpicker('refresh');
        }
    }

    function getCity() {

        var state_id = $('select[name=state_id]').val();

        if (state_id) {
            $.ajax({
                type: "GET",
                url: "{{ url('cities') }}/" + state_id,
                datatype: 'json',
                success: function (response) {
                    if (response && response.status) {
                        var options = '<option value="">Select City</option>';
                        if (response.data.length) {

                            var selectedId = '{{ $row->city_id ?? 0 }}';

                            for (var i = 0; i < response.data.length; i++) {
                                var _selected = '';

                                if (selectedId == response.data[i].id) {
                                    _selected = 'selected';
                                }

                                options += '<option ' + _selected + ' value="' + response.data[i].id + '">' + response.data[i].city_name + '</option>';
                            }

                            $("select[name='city_id']").html(options);
                            $("select[name='city_id']").selectpicker('refresh');
                        }
                    }
                }
            });

        } else {
            
            $("select[name='city_id']").html('<option value="">Select City</option>');
            $("select[name='city_id']").selectpicker('refresh');
        }
    }

    function getUserDetails() 
    {
        var profile_id = $('select[name=profile_id]').val();

        if(!profile_id){
            return false
        }

        $.ajax({
            type: 'GET',
            url: "{{ url('fetch-user-detail') }}",
            data: {
                profile_id:profile_id
            },
            success: function (response) {
                if (response.status) {
                    var data = response?.data[0];
                    $("#name").val(data?.name);
                    $("#permanent_address").val(data?.permanent_address);
                }
            },
            error: function (error) {
                console.error('Error fetching user details:', error);
            }
        });
    }

    $(document).ready(function(){
        
        getState();
        showShowField();
        
    });    

</script>
@endpush