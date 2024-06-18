@include('flash::message')

<div class="row">
    <div class="col-md-12">
        
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label">{{ isset($row) && !empty($row) ? 'Edit' : 'Add' }} Member</h3>
                </div>

                @if($row == '')
                    <div class="card-toolbar">
                        <a data-toggle="modal" data-target="#myModal" class="btn font-weight-bold ml-2" id="button">Import member</a>
                    </div>
                @endif
            </div>
            
            <div class="card-body">                
                <div class="row">

                    <div class="col-12">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Full Name:</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">                                
                                <input type="text" name="name" value="{{ old('name', $row->name ?? '') }}" class="form-control" required placeholder="Enter Full Name"/>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">DOB</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <div class="input-group date">
                                    <input type="text" name="dob" value="{{ old('dob') ? old('dob') :( isset($row->dob) ? $row->dob : '') }}" class="form-control kt_datepicker" placeholder="Enter DOB" autocomplete="new dob" readonly/>
                                    @error('dob')
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

                    <div class="col-12">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Contact</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" oninput="this.value=this.value.replace(/[^0-9]/, '')" name="contact" value="{{ old('contact') ? old('contact') :( isset($row->contact) ? $row->contact : '') }}" class="form-control" minlength="10" maxlength="10" placeholder="Enter Contact"/>
                                @error('contact')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Email</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="email" name="email" value="{{ old('email') ? old('email') :( isset($row->email) ? $row->email : '') }}" class="form-control" placeholder="Enter Email"/>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>                    
                    <div class="col-12">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Room Sharing</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control selectpicker" name="room_sharing" tabindex="null">
                                    <option value="">Select Room Sharing</option>
                                    <option value="1" {{ old('room_sharing') == '1' || (isset($row->room_sharing) && $row->room_sharing == '1') ? 'selected' : '' }}>Single Occupancy</option>
                                    <option value="2" {{ old('room_sharing') == '2' || (isset($row->room_sharing) && $row->room_sharing == '2') ? 'selected' : '' }}>Double Occupancy</option>
                                    <option value="3" {{ old('room_sharing') == '3' || (isset($row->room_sharing) && $row->room_sharing == '3') ? 'selected' : '' }}>Triple Occupancy</option>
                                </select>
                                @error('room_sharing')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-12">
                        <h4 class="card-label">For marketing and social media purpose</h4><hr>
                    </div>

                    <div class="col-12">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Stage Name <i>(If Any)</i> </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <textarea class="form-control form-control-lg form-control-solid no-summernote-editor" name="stage_name" id="stage_name" placeholder="Enter Stage Name" maxlength="150">{{ old('stage_name') ? old('stage_name') : ( isset($row->stage_name) ? $row->stage_name : '') }}</textarea>
                                @error('stage_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror                            
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Artist Bio <i>(150 words only) </i> </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <textarea class="form-control form-control-lg form-control-solid no-summernote-editor" name="artist_bio" id="artist_bio" placeholder="Enter Artist Bio" maxlength="150">{{ old('artist_bio') ? old('artist_bio') : ( isset($row->artist_bio) ? $row->artist_bio : '') }}</textarea>
                                @error('artist_bio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror                            
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Instagram Profile Link </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="instagram_url" value="{{ old('instagram_url') ? old('instagram_url') :( isset($row->instagram_url) ? $row->instagram_url : '') }}" class="form-control form-control-lg form-control-solid"   placeholder="Enter Instagram Profile Link"/>
                                @error('instagram_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror                            
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Facebook Profile Link </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="facebook_url" value="{{ old('facebook_url') ? old('facebook_url') :( isset($row->facebook_url) ? $row->facebook_url : '') }}" class="form-control form-control-lg form-control-solid"   placeholder="Enter Facebook Profile Link"/>
                                @error('facebook_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror                            
                            </div>
                        </div>
                    </div>                                

                    <div class="col-12">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Linkdin Profile Link </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="linkdin_url" value="{{ old('linkdin_url') ? old('linkdin_url') :( isset($row->linkdin_url) ? $row->linkdin_url : '') }}" class="form-control form-control-lg form-control-solid"   placeholder="Enter Linkdin Profile Link"/>
                                @error('linkdin_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror                            
                            </div>
                        </div>
                    </div>                               

                    <div class="col-12">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Twitter Profile Link </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="twitter_url" value="{{ old('twitter_url') ? old('twitter_url') :( isset($row->twitter_url) ? $row->twitter_url : '') }}" class="form-control form-control-lg form-control-solid"   placeholder="Enter Twitter Profile Link"/>
                                @error('twitter_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror                            
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Website <i>(If any)</i> </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="website" value="{{ old('website') ? old('website') :( isset($row->website) ? $row->website : '') }}" class="form-control form-control-lg form-control-solid"   placeholder="Enter Website"/>
                                @error('website')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror                            
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Status:</label>
                            <div class="col-3">
                                <span class="switch switch-icon">
                                    <label>
                                        <input type="checkbox" value="1" name="status" {{ old('status', $row->status ?? 1) == '1' ? 'checked' : '' }} />
                                        <span></span>
                                    </label>
                                </span>
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
                        <!-- <a class="btn btn-light-danger" href="{{ route('profile.member.list') }}">Cancel</a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@push('scripts')
<script type="text/javascript">
    

</script>
@endpush