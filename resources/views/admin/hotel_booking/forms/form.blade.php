@include('flash::message')

<div class="row">
    <div class="col-md-12">
        
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label">{{ isset($row) && !empty($row) ? 'Edit' : 'Add' }} {{$moduleConfig['moduleTitle']}}</h3>
                </div>
            </div>

            @if(isset($user->frontendRole->name) && $user->frontendRole->name == 'Individual')
                <div class="card-body">                
                    <div class="row">

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
                                    <select class="form-control form-control-lg form-control-solid selectpicker" name="venue_id" tabindex="null">
                                        <option value="">Select Venue</option>
                                        @if($venues->count())
                                            @foreach($venues as $value)

                                               <option {{ old('venue_id', $row->venue_id ?? 0) == $value->id ? 'selected' : '' }} value="{{$value->id}}">{{$value->name}}</option>

                                            @endforeach
                                        @endif
                                    </select>
                                    @error('venue_id')
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
                            <a class="btn btn-light-danger" href="{{route('admin.user.index')}}">Cancel</a>
                        </div>
                    </div>
                </div>
            @else
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Sr.No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Contact</th>
                            </tr>

                        </thead>
                        <tbody>
                            @forelse($members as $key => $value)
                                <tr>
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->email }}</td>
                                    <td>{{ $value->contact }}</td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-danger">No Record Found</td>
                                </tr>

                            @endforelse
                        </tbody>
                    </table>
                    <!--end: Datatable-->
                    </div>
            @endif            
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">

        function addMoreShareRoom(_this) {
            var html = '\
                <div class="row mb-7 position-relative share-room" style="border: lightgray 1px dashed">\
                    <div class="col-3 mt-7">\
                        <div class="form-group">\
                            <label>Hotel Room Sharing </label>\
                            <input type="hidden" name="sharing_room_ids[]" value="" />\
                            <select name="sharing_room[]" class="form-control sharing-room-select">\
                                <option value="">Select Hotel Room Sharing</option>\
                                <option value="Single Occu">Single Occu</option>\
                                <option value="Double Occu">Double Occu</option>\
                                <option value="Tripple Occu">Tripple Occu</option>\
                            </select>\
                        </div>\
                    </div>\
                    <div class="col-3 mt-7 name-fields" style="display: none;">\
                        <div class="form-group">\
                            <label>Name 1 </label>\
                            <input type="text" name="name_1[]" class="form-control" placeholder="Enter Name 1" />\
                        </div>\
                        <div class="form-group">\
                            <label>Name 2 </label>\
                            <input type="text" name="name_2[]" class="form-control" placeholder="Enter Name 2" />\
                        </div>\
                        <div class="form-group">\
                            <label>Name 3 </label>\
                            <input type="text" name="name_3[]" class="form-control" placeholder="Enter Name 3" />\
                        </div>\
                    </div>\
                    <a href="javascript:void(0)" onclick="deleteShareRoom(this)" class="btn btn-danger btn-sm" style="position: absolute; right: 0; top: -15px;">X</a>\
                </div>';

            $(".share-room:last").after(html);

            $('.sharing-room-select').change(function () {
                var selectedOption = $(this).val();
                var nameFields = $(this).closest('.share-room').find('.name-fields');

                if (selectedOption === 'Single Occu') {
                    nameFields.find('.form-group').hide();
                    nameFields.find('.form-group:nth-child(1)').show(); // Show Name 1 field for Single Occu
                } else if (selectedOption === 'Double Occu') {
                    nameFields.find('.form-group').hide();
                    nameFields.find('.form-group:nth-child(-n+2)').show(); // Show Name 1 and Name 2 fields for Double Occu
                } else if (selectedOption === 'Tripple Occu') {
                    nameFields.find('.form-group').show(); // Show all Name fields for Tripple Occu
                } else {
                    nameFields.find('.form-group').hide(); // Hide all Name fields if no option is selected
                }
            });
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

        $(document).ready(function () {
            $('#sharing-room-select').change(function () {
                var selectedOption = $(this).val();
                $('.name-1, .name-2, .name-3').hide(); // Hide all name fields initially

                if (selectedOption === 'Single Occu') {
                    $('.name-1').show(); // Show Name 1 field for Single Occu
                } else if (selectedOption === 'Double Occu') {
                    $('.name-1, .name-2').show(); // Show Name 1 and Name 2 fields for Double Occu
                } else if (selectedOption === 'Tripple Occu') {
                    $('.name-1, .name-2, .name-3').show(); // Show Name 1, Name 2, and Name 3 fields for Tripple Occu
                }
            });
        });

    </script>
@endpush