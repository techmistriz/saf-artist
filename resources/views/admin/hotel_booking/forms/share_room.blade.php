<div class="row mb-7 position-relative share-room" style="border: lightgray 1px dashed">
    <div class="col-6 mt-7">
        <div class="form-group row validated">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Room No </label>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <input type="hidden" name="room_no_ids[]" value="{{ $shareRoom->id ?? '' }}" />
                <input type="text" name="room_no[]" value="{{ @old('room_no', [$shareRoom->room_no ?? ''])[0] }}" class="form-control" placeholder="Enter Room No" />
                    
                @error('room_no')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>
        </div>
    </div>

    <div class="col-6 mt-7">
        <div class="form-group row validated">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Name 1</label>
            <div class="col-lg-9 col-md-9 col-sm-12">
                    <input type="text" name="name_1[]" value="{{ @old('name_1', [$shareRoom->name_1 ?? ''])[0] }}" class="form-control" placeholder="Enter Name 1" />
                @error('name_1')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-6 mt-7">
        <div class="form-group row validated">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Name 2</label>
            <div class="col-lg-9 col-md-9 col-sm-12">
                    <input type="text" name="name_2[]" value="{{ @old('name_2', [$shareRoom->name_2 ?? ''])[0] }}" class="form-control" placeholder="Enter Name 2" />
                @error('name_2')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    @if(@$share > 0)
        <a href="javascript:void(0)" onclick="deleteShareRoom(this, {{ $shareRoom->id ?? 0 }})" class="btn btn-danger btn-sm" style="position: absolute; right: 0; top: -15px;">X</a>
    @else
        <a href="javascript:void(0)" onclick="addMoreShareRoom(this)" class="btn btn-primary btn-sm" style="position: absolute; right: 0; top: -15px;">+</a>
    @endif
</div>