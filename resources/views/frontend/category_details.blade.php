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
                            <h4 class="title">Accessibility</h4>

                            <div class="row">
                            <div class="form-group col-md-6">
                            <label>Project Name</label>
                                <select name="projectname">
                               
                                    <option value="_none" disabled="disabled" selected="selected">Project Name</option>
                                    <option value="1">project 1</option>
                                    <option value="2">project 2</option>
                                    <option value="3">project 3</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Number of people in your group</label>
                                <input type="file" class="regfield" name="numofpeople" id="numofpeople">
                            </div>
                            </div>

                            <div class="row">
                            <div class="form-group col-md-4">
                                <input type="text" name="formgenre" id="formgenre" placeholder="Form / Genre">
                            </div>

                            <div class="form-group col-md-8">
                            <input type="text" name="filedoc" id="filedoc" placeholder="Organisation/ Foundation/ Trust you are associated with(if any)">
                            </div>
                            </div>

                            <div class="row">
                            <div class="form-group col-md-4">
                                <select name="lightdesigner">
                                    <option value="_none" disabled="disabled" selected="selected">Light designer needed</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                    <option value="3">Maybe</option>
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <select name="sounddesigner">
                                    <option value="_none" disabled="disabled" selected="selected">Sound designer needed</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                    <option value="3">Maybe</option>
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <select name="iprslicense">
                                    <option value="_none" disabled="disabled" selected="selected">IPRS licence required?</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                    <option value="3">Maybe</option>
                                </select>
                            </div>
                            </div>


                            <div class="row">
                            <div class="form-group col-md-12">
                                <textarea name="requirements"id="requirements" placeholder="Space and visual design requirements"></textarea>
                            </div>
                            </div>


                            <div class="row">
                            <div class="form-group col-md-9">
                                <input type="text" class="regfield" name="biodata" id="biodata" placeholder="Biodata/ Profile">
                            </div>

                            <div class="form-group col-md-3">
                                <input type="text" class="regfield" name="techrider" id="techrider" placeholder="Tech Rider">
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