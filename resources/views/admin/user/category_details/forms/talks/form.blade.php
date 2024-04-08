@include('flash::message')
<style type="text/css">
    .radio {
        display: -webkit-box;
    }

    .image-input {
        margin-right: 10px;
    }

</style>
<div class="row">
    <div class="col-md-12">
        
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label">{{ isset($row) && !empty($row) ? 'Edit' : 'Add' }} {{$moduleConfig['moduleTitle']}} Category Details</h3>
                </div>
            </div>
            
            <div class="card-body">
                <div class="row">
                    
                    <div class="col-6">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Concept Note</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="file" name="concept_note"  class="form-control form-control-lg form-control-solid  @error('concept_note') is-invalid @enderror " />
                                <p class="text-muted small">Upload PDF (Name of file- Project Name + Artist Name)</p>
                                Uploaded File: 
                                @if($row->concept_note)
                                    <a target="_blank" href="{{ asset('uploads/users/'.$row->concept_note) }}">{{$row->concept_note}}</a>
                                @else
                                N/A
                                @endif
                                @error('concept_note')
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
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <a class="btn btn-light-danger" href="{{ route($moduleConfig['routes']['listRoute']) }}">Cancel</a>
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