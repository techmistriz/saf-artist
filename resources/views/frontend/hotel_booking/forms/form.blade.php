@include('flash::message')

<div class="row">
    <div class="col-md-12">
        
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label">{{ isset($row) && !empty($row) ? 'Edit' : 'Add' }} Hotel Booking</h3>
                </div>
            </div>
            
            <div class="card-body">                
                <div class="row">

                    <div class="col-12">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">User Profile</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control selectpicker" name="profile_id" tabindex="null" onchange="getProfileMember()" required>
                                    <option value="" data-slug="">Select User Profile</option>
                                    @if($userProfiles->count())
                                        @foreach($userProfiles as $value)
                                          <option {{ (old('profile_id') ?? optional($row)->profile_id) == $value->id ? 'selected' : '' }} value="{{$value->id}}">{{$value->festival->name . ' ('. $value->project_year . ')'}}</option>
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
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Purpose of travel</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control selectpicker" name="travel_purpose_id" tabindex="null">
                                    <option value="">Select purpose of travel</option>
                                    @if($travelPurposes->count())
                                        @foreach($travelPurposes as $value)
                                          <option {{ (old('travel_purpose_id') ?? optional($row)->travel_purpose_id) == $value->id ? 'selected' : '' }} value="{{$value->id}}">{{$value->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('travel_purpose_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12" style="{{ isset(Auth::user()->frontendRole->name) && (Auth::user()->frontendRole->name == 'Individual') ? 'display:none;' : ''}}">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Profile Member</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control selectpicker" name="profile_member_ids[]" tabindex="null" multiple>
                                    <option value="">Select Profile Member</option>
                                </select>
                                @error('profile_member_ids')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror                                
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Accomodation Required</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control selectpicker" name="accomodation" tabindex="null" onchange="hideField()">
                                    <option value="">Select</option>
                                    <option value="Yes" {{ old('accomodation') == 'Yes' || (isset($row->accomodation) && $row->accomodation == 'Yes') ? 'selected' : '' }}>Yes</option>
                                    <option value="No" {{ old('accomodation') == 'No' || (isset($row->accomodation) && $row->accomodation == 'No') ? 'selected' : '' }}>No</option>
                                </select>

                                @error('accomodation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-12" id="field_hide" style="{{ isset($row->accomodation) && ($row->accomodation == 'No') ? 'display:none;' : ''}}">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Check In Date </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">

                                <div class="input-group date">
                                    <input type="text" name="check_in_date" id="check_in_date" value="{{ old('check_in_date', $row->check_in_date ?? '') }}" class="form-control  kt_datepicker" placeholder="Enter Details" readonly onchange="roomNightCalc()" />
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="la la-calendar-check-o"></i>
                                        </span>
                                    </div>
                                </div>
                                
                                @error('check_in_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                   
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Check Out Date </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">

                                <div class="input-group date">
                                    <input type="text" name="check_out_date" id="check_out_date" value="{{ old('check_out_date', $row->check_out_date ?? '') }}" class="form-control check_out_date_datepicker" placeholder="Enter Details" readonly onchange="roomNightCalc()" />

                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="la la-calendar-check-o"></i>
                                        </span>
                                    </div>
                                </div>

                                @error('check_out_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Total Room Nights</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="total_room_nights" id="total_room_nights" value="{{ old('total_room_nights', $row->total_room_nights ?? '') }}" class="form-control " placeholder="Enter Details" readonly="" />
                                @error('total_room_nights')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Additional Requirements</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <textarea class="form-control  no-summernote-editor" name="artist_remarks" id="artist_remarks" placeholder="Enter Remarks">{{ old('artist_remarks', $row->artist_remarks ?? '') }}</textarea>
                                @error('artist_remarks')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    @if(!isset($row) || $row->hotel_status == 1)
                        <input type="hidden" name="hotel_status" id="freeze" value="1">
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
                <p>If you freeze your hotel then you are not edit hotel.</p>                
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

    function roomNightCalc(){

        var check_in_date  = document.getElementById('check_in_date').value;
        var check_out_date  = document.getElementById('check_out_date').value;
        
        if(!check_in_date && check_out_date){

            $("#total_room_nights").val('');
            return;
        }

        if(check_in_date && check_out_date){

            const date1 = moment(check_in_date, 'DD/MM/YYY').toDate();
            const date2 = moment(check_out_date, 'DD/MM/YYY').toDate();

            var diff = Math.abs(date2.getTime() - date1.getTime());
            var dayDiff = Math.ceil(diff / (1000 * 3600 * 24));  

            if (date1 > date2){ 

                $("#total_room_nights").val('');
                $("#check_out_date").parent().after('<div class="invalid-feedback">Check-out date must be after check-in date!</div>');

            } else {
                
                $("#total_room_nights").val(dayDiff);
                $("#check_out_date").parent().parent().find('.invalid-feedback').remove();
                return;
            }

        } else {
            
            $("#total_room_nights").val('');
        }
    }

    function hideField() {

        
        var accomodation = $('select[name="accomodation"] option:selected').text();

        if (accomodation == 'Yes') {
            $('#field_hide').show();
        }else if (accomodation == 'No'){
            $('#field_hide').hide();
        }else{
            $('#field_hide').show();
        }
    } 

    function getProfileMember() {
        var profile_id = $('select[name=profile_id]').val();
        var selectedIds = {!! json_encode(old('profile_member_ids', $row->profile_member_ids ?? [])) !!};

        if(profile_id) {
            $.ajax({
                type: "GET",
                url: "{{ url('hotel-profile-members') }}?profile_id=" + profile_id + '&profile_member_id=' + selectedIds,
                datatype: 'json',
                success: function (response) {
                    if(response?.status) {
                        var options = '<option value="">Select Profile Member</option>';
                        if(response.data.length) {                            

                            for (var i = 0; i < response.data.length; i++) {
                                var _selected = selectedIds.includes(response.data[i].id.toString()) ? 'selected' : '';
                                options += '<option ' + _selected + ' value="' + response.data[i].id + '">' + response.data[i].name + '</option>';
                            }
                            $("select[name='profile_member_ids[]']").html(options);
                            $("select[name='profile_member_ids[]']").selectpicker('refresh');
                        }
                    }
                }
            });
        } else {
            $("select[name='profile_member_ids[]']").html('<option value="">Select Profile Member</option>');
            $("select[name='profile_member_ids[]']").selectpicker('refresh');
        }
    }

    $(document).ready(function(){
        getProfileMember();            
    });

    </script>
    <script type="text/javascript">
        // Class definition

        var KTBootstrapDatepicker = function () {

            var arrows;
            if (KTUtil.isRTL()) {
                arrows = {
                    leftArrow: '<i class="la la-angle-right"></i>',
                    rightArrow: '<i class="la la-angle-left"></i>'
                }
            } else {
                arrows = {
                    leftArrow: '<i class="la la-angle-left"></i>',
                    rightArrow: '<i class="la la-angle-right"></i>'
                }
            }

            // Private functions
            var demos = function () {
                // minimum setup
                $('.check_out_date_datepicker').datepicker({
                    rtl: KTUtil.isRTL(),
                    todayHighlight: true,
                    orientation: "bottom left",
                    templates: arrows,
                    autoClose: true,
                    format: 'dd-mm-yyyy',
                });
            }

            return {
                // public functions
                init: function() {
                    demos();
                }
            };
        }();

        jQuery(document).ready(function() {
            KTBootstrapDatepicker.init();
        });
    </script>
@endpush