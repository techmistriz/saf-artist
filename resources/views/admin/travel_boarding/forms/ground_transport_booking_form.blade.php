<div class="row">
    <div class="col-12">
        <h5 class="card-label">Ground Transport</h5><hr>
    </div>

    <div class="col-6">
        <div class="form-group row validated">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">airport transfer</label>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <select class="form-control form-control-lg form-control-solid selectpicker" name="airport_transfer" tabindex="null">
                    <option value="">Select</option>
                    <option value="Yes" {{ old('airport_transfer', $row->travelBoarding->airport_transfer ?? '') == 'Yes' ? 'selected' : '' }}>Yes</option>
                    <option value="No" {{ old('airport_transfer', $row->travelBoarding->airport_transfer ?? '') == 'No' ? 'selected' : '' }}>No</option>
                </select>

                @error('airport_transfer')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            
            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="form-group row validated">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">airport drop required</label>
            <div class="col-lg-9 col-md-9 col-sm-12">

                <div class="input-group date">
                    <input type="text" name="airport_drop_required_date" value="{{ old('airport_drop_required_date', $row->travelBoarding->airport_drop_required_date ?? '') }}" class="form-control kt_datepicker" placeholder="Enter Details" readonly />
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="la la-calendar-check-o"></i>
                        </span>
                    </div>
                </div>
                
                @error('airport_drop_required_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="form-group row validated">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">no. of dedicated cab required for the GROUP</label>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <input type="text" name="no_of_dedicated_cab" value="{{ old('no_of_dedicated_cab', $row->travelBoarding->no_of_dedicated_cab ?? '') }}" class="form-control" placeholder="Enter Details" />
                @error('no_of_dedicated_cab')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>


    <div class="col-6">
        <div class="form-group row validated">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">dedicated cab required - starting date </label>
            <div class="col-lg-9 col-md-9 col-sm-12">

                <div class="input-group date">
                    <input type="text" name="dedicated_cab_required_starting_date" value="{{ old('dedicated_cab_required_starting_date', $row->travelBoarding->dedicated_cab_required_starting_date ?? '') }}" class="form-control kt_datepicker" placeholder="Enter Details" readonly />


                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="la la-calendar-check-o"></i>
                        </span>
                    </div>
                </div>
                @error('dedicated_cab_required_starting_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    

    <div class="col-6">
        <div class="form-group row validated">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">dedicated cab required - end date</label>
            <div class="col-lg-9 col-md-9 col-sm-12">

                <div class="input-group date">
                    <input type="text" name="dedicated_cab_required_end_date" value="{{ old('dedicated_cab_required_end_date', $row->travelBoarding->dedicated_cab_required_end_date ?? '') }}" class="form-control kt_datepicker" placeholder="Enter Details" readonly />
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="la la-calendar-check-o"></i>
                        </span>
                    </div>
                </div>
                @error('dedicated_cab_required_end_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="form-group row validated">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">group poc name</label>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <input type="text" name="group_poc_name" value="{{ old('group_poc_name', $row->travelBoarding->group_poc_name ?? '') }}" class="form-control" placeholder="Enter Details" />
                @error('group_poc_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="form-group row validated">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">group poc whatsapp number</label>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <input type="text" name="group_poc_whatsapp_number" value="{{ old('group_poc_whatsapp_number', $row->travelBoarding->group_poc_whatsapp_number ?? '') }}" class="form-control" placeholder="Driver details will be shared on this number" />
                @error('group_poc_whatsapp_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="form-group row validated">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">artist remarks</label>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <textarea class="form-control no-summernote-editor" name="ground_transport_artist_remarks" id="ground_transport_artist_remarks" placeholder="Enter Details" require>{{ old('ground_transport_artist_remarks', $row->travelBoarding->ground_transport_artist_remarks ?? '') }}</textarea>
                @error('ground_transport_artist_remarks')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            
            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="form-group row validated">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">poc remarks</label>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <textarea class="form-control no-summernote-editor" name="ground_transport_poc_remarks" id="ground_transport_poc_remarks" placeholder="Enter Details" require>{{ old('ground_transport_poc_remarks', $row->travelBoarding->ground_transport_poc_remarks ?? '') }}</textarea>
                @error('ground_transport_poc_remarks')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            
            </div>
        </div>
    </div>

</div>