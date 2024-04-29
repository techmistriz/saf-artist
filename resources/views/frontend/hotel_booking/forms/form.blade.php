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

                    <div class="col-12" style="{{ isset(Auth::user()->frontendRole->name) && (Auth::user()->frontendRole->name == 'Individual') ? 'display:none;' : ''}}">
                        <div class="form-group row validated" >
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Member</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">

                                <select class="form-control form-control-solid form-control-lg selectpicker @error('member_id') is-invalid @enderror" name="member_id" tabindex="null">
                                    <option value="">Select Member</option>
                                    @if($members->count())
                                        @foreach($members as $value)

                                           <option {{ old('member_id', $row->member_id ?? 0) == $value->id ? 'selected' : '' }} value="{{$value->id}}">{{$value->name}}</option>

                                        @endforeach
                                    @endif
                                </select>
                                @error('member_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Accomodation Required</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control form-control-solid form-control-lg form-control-lg form-control-solid selectpicker" name="accomodation" tabindex="null" onchange="hideField()">
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

                    <div class="col-12" id="field_hide" style="{{ (isset(Auth::user()->frontendRole->name) && (Auth::user()->frontendRole->name == 'Individual')) &&(isset($row->accomodation) && ($row->accomodation == 'No')) ? 'display:none;' : ''}}">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Check In Date </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">

                                <div class="input-group date">
                                    <input type="text" name="check_in_date" id="check_in_date" value="{{ old('check_in_date', $row->check_in_date ?? '') }}" class="form-control form-control-solid form-control-lg kt_datepicker" placeholder="Enter Details" readonly onchange="roomNightCalc()" />
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
                                    <input type="text" name="check_out_date" id="check_out_date" value="{{ old('check_out_date', $row->check_out_date ?? '') }}" class="form-control form-control-solid form-control-lg kt_datepicker" placeholder="Enter Details" readonly onchange="roomNightCalc()" />

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
                                <input type="text" name="total_room_nights" id="total_room_nights" value="{{ old('total_room_nights', $row->total_room_nights ?? '') }}" class="form-control form-control-solid form-control-lg" placeholder="Enter Details" readonly="" />
                                @error('total_room_nights')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Artist Remarks</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <textarea class="form-control form-control-solid form-control-lg no-summernote-editor" name="artist_remarks" id="artist_remarks" placeholder="Enter Remarks">{{ old('artist_remarks', $row->artist_remarks ?? '') }}</textarea>
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
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4 text-center">
                        <button type="submit" class="theme-btn mt-0 mb-0">Submit</button>
                        <!-- <a class="btn btn-light-danger" href="{{ route('hotel.booking.list') }}">Cancel</a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@push('scripts')
   <script type="text/javascript">

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

        var userType = '{{ isset(Auth::user()->frontendRole->name) ? Auth::user()->frontendRole->name : '' }}';
        var accomodation = $('select[name="accomodation"] option:selected').text();

        if (userType == 'Individual') {
            if (accomodation == 'Yes') {
                $('#field_hide').show();
            }else if (accomodation == 'No'){
                $('#field_hide').hide();
            }else{
                $('#field_hide').show();
            }
        }
    } 

</script>
@endpush