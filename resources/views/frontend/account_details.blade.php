@extends('layouts.app')

@section('content')

<section class="cntform">
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <div class="logo-sa">
                        <img src="{{url('/image/Logo-SVG.svg')}}" alt="Image"/>
                    </div>
                </div>
            </div>


            <div class="row justify-content-center">
                <div class="col-md-10">
                    <form class="form-sa" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="tab-1">
                            <h4 class="title">Account Details</h4>

                            <div class="form-group">
                                <input type="text" class="regfield" name="name" id="name" placeholder="Full Name">
                            </div>

                            <div class="form-group">
                                <textarea class="regfield" name="permanentaddress" id="permanentaddress" placeholder="Permanent Address"></textarea>
                            </div>

                            <div class="form-group">
	                            <label>Address Proof</label>
	                            <input type="file" name="addressproof" id="addressproof" >
                            </div>

                            <div class="row">
	                            <div class="form-group col-md-6">
	                                <input type="number" class="regfield" name="number" id="number" placeholder="Account number">
	                            </div>

	                            <div class="form-group col-md-6">
	                                <input type="number" class="regfield" name="number" id="number" placeholder="Confirm account number">
	                            </div>
                            </div>


                            <div class="row">
	                            <div class="form-group col-md-6">
	                                <input type="text" class="regfield" name="bnkholde" id="bnkholder" placeholder="Bank holder number">
	                            </div>

	                            <div class="form-group col-md-6">
	                                <input type="text" class="regfield" name="bnkname" id="bnkname" placeholder="Bank name">
	                            </div>
                            </div>

                            <div class="row">
	                            <div class="form-group col-md-9">
	                                <input type="text" class="regfield" name="branchaddress" id="branchaddress" placeholder="Branch Address">
	                            </div>

	                            <div class="form-group col-md-3">
	                                <input type="number" class="regfield" name="ifsc" id="ifsc" placeholder="Ifsc code">
	                            </div>
                            </div>

                            <div class="row">
	                            <div class="form-group col-md-4">
	                            	<label>Cancel Check</label>
	                                <input type="file" class="regfield" name="cancelcheque" id="cancelcheque" placeholder="Cancel cheque">
	                            </div>

	                            <div class="form-group col-md-4">
	                            	<label>Pan Card No.</label>
	                                <input type="number" class="regfield" name="pannum" id="pannum" placeholder="Pan card no.">
	                            </div>

	                            <div class="form-group col-md-4">
	                                
	                            	<label>Pan Card Image</label>
	                                <input type="file" class="regfield" name="pannumimg" id="pannumimg" placeholder="Pan card image">
	                            </div>
                            </div>

                            <div class="row">
	                            <div class="form-group col-md-12">
	                                <select class="regfield" name="gstfield" id="gstfield">
	                                    <option value="_none" disabled="disabled" selected="selected">Gst number</option>
	                                    <option value="1">Yes</option>
	                                    <option value="2">No</option>
	                                </select>
	                            </div>
                            </div>

                            <div id="gstmorefield">
	                            <div class="row">
	                                <div class="form-group col-md-4">
		                                <label>Gst Certificate</label>
		                                <input type="file" name="gstcertificate" id="gstcertificate" placeholder="GST Certificate">
	                                </div>
	                                <div class=" form-group col-md-4">
		                                <label>HSN/SAC Code</label>
		                                <input type="text" class="regfield" name="hsncode" id="hsncode" placeholder="HSN/SAC Code">
	                                </div>
	                                <div class="form-group col-md-4">
		                                <label>Menu/Inventory list of the products to be sold (with MRP and Quantity)</label>
		                                <input type="file" class="regfield" name="menuinventory" id="menuinventory" placeholder="Menu/Inventory list of the products to be sold (with MRP and Quantity)">
	                                </div>
	                            </div>
                            </div>


                            <div class="action-btn">
                                <!--<button type="submit" class="btn btn-primary">-->
                                <!--    {{ __('Register') }}-->
                                <!--</button>-->
                                <!-- <a type="button" id="nextBtn1"> Submit</a> -->
                                <input type="submit" value="Submit">
                            </div>  
                        </div>



                    </form>
                </div>
            </div>

        </div>
    </section>



@endsection