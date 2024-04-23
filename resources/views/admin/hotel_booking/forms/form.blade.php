@include('flash::message')

<div class="row">
    <div class="col-md-12">
        
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label">{{ isset($row) && !empty($row) ? 'Edit' : 'Add' }} {{$moduleConfig['moduleTitle']}}</h3>
                </div>
            </div>
            
            <div class="card-body">                
                <div class="row">

                    <div class="col-12">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Member</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">

                                <select class="form-control form-control-lg form-control-solid selectpicker" name="member_id" tabindex="null">
                                    <option value="">Select Member</option>
                                    @if($members->count())
                                        @foreach($members as $value)

                                           <option {{ old('member_id', $row->source_id ?? 0) == $value->id ? 'selected' : '' }} value="{{$value->id}}">{{$value->name}}</option>

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
                                <select class="form-control form-control-solid form-control-lg form-control-lg form-control-solid selectpicker" name="accomodation" tabindex="null">
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

                    <div class="col-12">
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
                    </div>

                    <div class="col-12">
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
                    </div>

                    <div class="col-12">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Total Room Nights</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="total_room_nights" id="total_room_nights" value="{{ old('total_room_nights', $row->total_room_nights ?? '') }}" class="form-control form-control-solid form-control-lg" placeholder="Enter Details" readonly="" />
                                @error('total_room_nights')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
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

                    <div class="col-12">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Performance Venue</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control form-control-lg form-control-solid selectpicker" name="performance_venue" tabindex="null">
                                    <option value="">Select Performance Venue</option>

                                    <option value="Venue 1" {{ old('performance_venue') == 'Venue 1' || (isset($row->performance_venue) && $row->performance_venue == 'Venue 1') ? 'selected' : '' }}> Venue 1</option>

                                    <option value="Venue 2" {{ old('performance_venue') == 'Venue 2' || (isset($row->performance_venue) && $row->performance_venue == 'Venue 2') ? 'selected' : ''  }}>Venue 2</option>

                                    <option value="Venue 3" {{ old('performance_venue') == 'Venue 3' || (isset($row->performance_venue) && $row->performance_venue == 'Venue 3') ? 'selected' : ''  }}>Venue 3</option>

                                </select>
                                @error('performance_venue')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Hotel Budget</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control form-control-lg form-control-solid selectpicker" name="hotel_budget" tabindex="null">
                                    <option value="">Select Hotel Budget</option>

                                    <option value="3-4K" {{ old('hotel_budget') == '3-4K' || (isset($row->hotel_budget) && $row->hotel_budget == '3-4K') ? 'selected' : '' }}> 3-4K</option>

                                    <option value="5-7K" {{ old('hotel_budget') == '5-7K' || (isset($row->hotel_budget) && $row->hotel_budget == '5-7K') ? 'selected' : ''  }}>5-7K</option>

                                    <option value="12-14K" {{ old('hotel_budget') == '12-14K' || (isset($row->hotel_budget) && $row->hotel_budget == '12-14K') ? 'selected' : ''  }}>12-14K</option>

                                </select>
                                @error('hotel_budget')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Hotel Room Sharing</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control form-control-solid form-control-lg form-control-lg form-control-solid selectpicker" name="room_sharing" tabindex="null" onchange="roomSharing()">
                                    <option value="">Select Hotel Room Sharing</option>
                                    <option value="Yes" {{ old('room_sharing') == 'Yes' || (isset($row->room_sharing) && $row->room_sharing == 'Yes') ? 'selected' : '' }}>Yes</option>
                                    <option value="No" {{ old('room_sharing') == 'No' || (isset($row->room_sharing) && $row->room_sharing == 'No') ? 'selected' : '' }}>No</option>
                                </select>

                                @error('room_sharing')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-12" id="room_share" style="{{ isset($row->room_sharing) && $row->room_sharing == 'No' ? 'display:none;' : '' }}" >
                        @if(isset($shareRooms) && !empty($shareRooms) && $shareRooms->count())
                            @foreach($shareRooms as $share => $shareRoom)

                                @include('admin.'.$moduleConfig['viewFolder'].'.forms.share_room')

                            @endforeach
                        @else
                            @include('admin.'.$moduleConfig['viewFolder'].'.forms.share_room')
                        @endif
                    </div>

                    <div class="col-12">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Local Travel</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control form-control-lg form-control-solid selectpicker" name="local_travel" tabindex="null">
                                    <option value="">Select Local Travel</option>

                                    <option value="Self driver" {{ old('local_travel') == 'Self driver' || (isset($row->local_travel) && $row->local_travel == 'Self driver') ? 'selected' : '' }}> Self driver</option>

                                    <option value="Scooty" {{ old('local_travel') == 'Scooty' || (isset($row->local_travel) && $row->local_travel == 'Scooty') ? 'selected' : ''  }}>Scooty</option>

                                    <option value="Cab" {{ old('local_travel') == 'Cab' || (isset($row->local_travel) && $row->local_travel == 'Cab') ? 'selected' : ''  }}>Cab</option>

                                </select>
                                @error('local_travel')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Performance Date </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">

                                <div class="input-group date">
                                    <input type="text" name="performance_date" value="{{ old('performance_date', $row->performance_date ?? '') }}" class="form-control kt_datepicker" placeholder="Enter Performance Date">

                                    @error('performance_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="la la-calendar-check-o"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4 text-center">
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <a class="btn btn-light-danger" href="{{route('admin.artist_member.index')}}">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">

       function addMoreShareRoom(_this){

            var html = '\
                    <div class="row mb-7 position-relative share-room" style="border: lightgray 1px dashed">\
                        <div class="col-6 mt-7">\
                            <div class="form-group row validated">\
                                <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Room No </label>\
                                <div class="col-lg-9 col-md-9 col-sm-12">\
                                    <input type="hidden" name="room_no_ids[]" value="" />\
                                    <input type="text" name="room_no[]" class="form-control" placeholder="Enter Room No" />\
                                </div>\
                            </div>\
                        </div>\
                        <div class="col-6 mt-7">\
                            <div class="form-group row validated">\
                                <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Name 1 </label>\
                                <div class="col-lg-9 col-md-9 col-sm-12">\
                                    <input type="text" name="name_1[]" class="form-control" placeholder="Enter Name 1" />\
                                </div>\
                            </div>\
                        </div>\
                        <div class="col-6 mt-7">\
                            <div class="form-group row validated">\
                                <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Name 2 </label>\
                                <div class="col-lg-9 col-md-9 col-sm-12">\
                                    <input type="text" name="name_2[]" class="form-control" placeholder="Enter Name 2" />\
                                </div>\
                            </div>\
                        </div>\
                        <a href="javascript:void(0)" onclick="deleteShareRoom(this)" class="btn btn-danger btn-sm" style="position: absolute;right: 0;top: -15px; back">X</a>\
                    </div>';

            $(".share-room:last").after(html);
            
        }

        function deleteShareRoom(_this, id = null){

            if(id){

                if(confirm('Are you sure')){
                    $.ajax({
                        type: "GET",
                        url: "{{ url('delete-share-room') }}/" + id,
                        datatype: 'json',
                        success: function (response) {
                            if(response?.status){
                                $(_this).parents('.share-room:first').remove();
                            } else {
                                alert(response?.message);
                            }
                        }
                    });
                }
            } else {
                $(_this).parents('.share-room:first').remove();
            }
        }

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

        function roomSharing () {

            var roomShare = $('select[name="room_sharing"] option:selected').text();
            if (roomShare == 'Yes') {
                $('#room_share').show();
            }else {
                $('#room_share').hide();
            }
        } 

    </script>
@endpush