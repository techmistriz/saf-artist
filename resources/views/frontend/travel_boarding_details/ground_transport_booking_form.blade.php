<div class="row">
    <div class="col-12">
        <h5 class="card-label">Ground Transport</h5><hr>
    </div>

    <div class="col-12">
        <div class="form-group row validated">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">group poc name</label>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <input type="text" name="group_poc_name" value="{{ old('group_poc_name', $row->travelBoarding->group_poc_name ?? '') }}" class="form-control form-control-solid form-control-lg" placeholder="Enter Details" />
                @error('group_poc_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="form-group row validated">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">group poc whats app number</label>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <input type="text" name="group_poc_whatsapp_number" value="{{ old('group_poc_whatsapp_number', $row->travelBoarding->group_poc_whatsapp_number ?? '') }}" class="form-control form-control-solid form-control-lg" placeholder="Enter Details" />
                @error('group_poc_whatsapp_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="form-group row validated">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">artist remarks</label>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <textarea class="form-control form-control-solid form-control-lg no-summernote-editor" name="hotel_artist_remarks" id="hotel_artist_remarks" placeholder="Enter Permanent Address">{{ old('hotel_artist_remarks', $row->travelBoarding->hotel_artist_remarks ?? '') }}</textarea>
                @error('hotel_artist_remarks')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            
            </div>
        </div>
    </div>

</div>