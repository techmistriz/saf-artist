@include('flash::message')

<div class="row">
    <div class="col-md-12">
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label">{{$moduleConfig['moduleTitle']}} Export</h3>
                </div>
            </div>
            
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th scope="col">Select</th>
                                    <th scope="col">Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="checkbox" id="check_all" name="check_all" value="check_all"></td>
                                    <td>Check All</td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" class="check-item" name="user_profile" value="profile"></td>
                                    <td>User Profile</td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" class="check-item" name="banking_details" value="bank"></td>
                                    <td>Banking Details</td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" class="check-item" name="ticket_booking" value="ticket"></td>
                                    <td>Ticket Booking</td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" class="check-item" name="hotel_booking" value="hotel"></td>
                                    <td>Hotel Booking</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>                    
                </div>
            </div>

            <div class="card-footer">
                <div class="row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-4 text-center">
                        <button type="submit" class="btn btn-light-primary mr-2" id="export-button">Export</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script type="text/javascript">
    document.getElementById('check_all').addEventListener('change', function() {
        var checkboxes = document.querySelectorAll('.check-item');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = this.checked;
        }, this);
    });

    document.getElementById('export-button').addEventListener('click', function(event) {
        var checkboxes = document.querySelectorAll('.check-item');
        var isChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);

        if (!isChecked) {
            event.preventDefault();
            alert('Please select at least one checkbox before submitting.');
        }
    });
</script>
@endpush
