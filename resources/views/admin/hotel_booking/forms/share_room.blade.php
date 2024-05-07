<div class="row mb-7 position-relative share-room" style="border: lightgray 1px dashed">
    <div class="col-3 mt-7">
        <div class="form-group">
            <label>Hotel Room Sharing</label>
            <input type="hidden" name="sharing_room_ids[]" value="{{ $shareRoom->id ?? '' }}" />
            <select name="sharing_room[]" class="form-control" id="sharing-room-select">
                <option value="">Select Hotel Room Sharing</option>
                <option value="Single Occu" {{ old('sharing_room') == 'Single Occu' || (isset($shareRoom->sharing_room) && $shareRoom->sharing_room == 'Single Occu') ? 'selected' : '' }}>Single Occu</option>
                <option value="Double Occu" {{ old('sharing_room') == 'Double Occu' || (isset($shareRoom->sharing_room) && $shareRoom->sharing_room == 'Double Occu') ? 'selected' : '' }}>Double Occu</option>
                <option value="Tripple Occu" {{ old('sharing_room') == 'Tripple Occu' || (isset($shareRoom->sharing_room) && $shareRoom->sharing_room == 'Tripple Occu') ? 'selected' : '' }}>Tripple Occu</option>
            </select>
            @error('sharing_room')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-3 mt-7 name-1" style="display: none;">
        <div class="form-group">
            <label>Name 1</label>
            <input type="text" name="name_1[]" value="{{ @old('name_1', [$shareRoom->name_1 ?? ''])[0] }}" class="form-control" placeholder="Enter Name 1" />
            @error('name_1')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-3 mt-7 name-2" style="display: none;">
        <div class="form-group">
            <label>Name 2</label>
            <input type="text" name="name_2[]" value="{{ @old('name_2', [$shareRoom->name_2 ?? ''])[0] }}" class="form-control" placeholder="Enter Name 2" />
            @error('name_2')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-3 mt-7 name-3" style="display: none;">
        <div class="form-group">
            <label>Name 3</label>
            <input type="text" name="name_3[]" value="{{ @old('name_3', [$shareRoom->name_3 ?? ''])[0] }}" class="form-control" placeholder="Enter Name 3" />
            @error('name_3')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    @if(@$share > 0)
        <a href="javascript:void(0)" onclick="deleteShareRoom(this, {{ $shareRoom->id ?? 0 }})" class="btn btn-danger btn-sm" style="position: absolute; right: 0; top: -15px;">X</a>
    @else
        <a href="javascript:void(0)" onclick="addMoreShareRoom(this)" class="btn btn-primary btn-sm" style="position: absolute; right: 0; top: -15px;">+</a>
    @endif
</div>