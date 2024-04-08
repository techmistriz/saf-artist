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
                    <h3 class="card-label">{{ isset($row) && !empty($row) ? 'Edit' : 'Add' }} {{$moduleConfig['moduleTitle']}}</h3>
                </div>
            </div>
            
            <div class="card-body">
                <!-- Ticket Booking -->
                @include('admin.'.$moduleConfig['viewFolder'].'.forms.ticket_booking_form')

                <!-- Hotel Booking -->
                @include('admin.'.$moduleConfig['viewFolder'].'.forms.hotel_booking_form')
                
                <!-- Ground Transport Booking -->
                @include('admin.'.$moduleConfig['viewFolder'].'.forms.ground_transport_booking_form')

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
