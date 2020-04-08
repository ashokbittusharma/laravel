@extends('layouts.admin')

@section('content')
<!-- begin:: Content Head -->
<div class="kt-subheader   kt-grid__item" id="add-employees-page">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                New Employee
            </h3>
            <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            <div class="kt-subheader__group" id="kt_subheader_search">
                <span class="kt-subheader__desc" id="kt_subheader_total">
                    Enter Employee details and submit </span>
            </div>
        </div>
        <!-- <div class="kt-subheader__toolbar">
            <a href="{{ route('user-employees') }}" class="btn btn-default btn-bold">
                Back </a>
            <div class="btn-group">
                <button type="button" class="btn btn-brand btn-bold" data-ktwizard-type="action-submit">
                    Submit </button>
                <button type="button" class="btn btn-brand btn-bold dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <ul class="kt-nav">
                        <li class="kt-nav__item">
                            <a href="#" class="kt-nav__link">
                                <i class="kt-nav__link-icon flaticon2-writing"></i>
                                <span class="kt-nav__link-text">Save &amp; continue</span>
                            </a>
                        </li>
                        <li class="kt-nav__item">
                            <a href="#" class="kt-nav__link">
                                <i class="kt-nav__link-icon flaticon2-medical-records"></i>
                                <span class="kt-nav__link-text">Save &amp; add new</span>
                            </a>
                        </li>
                        <li class="kt-nav__item">
                            <a href="#" class="kt-nav__link">
                                <i class="kt-nav__link-icon flaticon2-hourglass-1"></i>
                                <span class="kt-nav__link-text">Save &amp; exit</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div> -->
    </div>
</div>
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="kt-wizard-v4" id="register-an-employee" data-ktwizard-state="step-first">

        <!--begin: Form Wizard Nav -->
        <div class="kt-wizard-v4__nav">
            <div class="kt-wizard-v4__nav-items nav">
                <a class="kt-wizard-v4__nav-item nav-item" href="#" data-ktwizard-type="step" data-ktwizard-state="current">
                    <div class="kt-wizard-v4__nav-body">
                        <div class="kt-wizard-v4__nav-number">
                            1
                        </div>
                        <div class="kt-wizard-v4__nav-label">
                            <div class="kt-wizard-v4__nav-label-title">
                                Profile
                            </div>
                            <div class="kt-wizard-v4__nav-label-desc">
                                Employee's Personal Information
                            </div>
                        </div>
                    </div>
                </a>
                <a class="kt-wizard-v4__nav-item nav-item" href="#" data-ktwizard-type="step">
                    <div class="kt-wizard-v4__nav-body">
                        <div class="kt-wizard-v4__nav-number">
                            2
                        </div>
                        <div class="kt-wizard-v4__nav-label">
                            <div class="kt-wizard-v4__nav-label-title">
                                Assigned Services
                            </div>
                            <div class="kt-wizard-v4__nav-label-desc">
                                Employee's Assigned Services
                            </div>
                        </div>
                    </div>
                </a>
                <a class="kt-wizard-v4__nav-item nav-item" href="#" data-ktwizard-type="step">
                    <div class="kt-wizard-v4__nav-body">
                        <div class="kt-wizard-v4__nav-number">
                            3
                        </div>
                        <div class="kt-wizard-v4__nav-label">
                            <div class="kt-wizard-v4__nav-label-title">
                                Work Hours
                            </div>
                            <div class="kt-wizard-v4__nav-label-desc">
                                Employee's Work Hours
                            </div>
                        </div>
                    </div>
                </a>
                <a class="kt-wizard-v4__nav-item nav-item" href="#" data-ktwizard-type="step">
                    <div class="kt-wizard-v4__nav-body">
                        <div class="kt-wizard-v4__nav-number">
                            4
                        </div>
                        <div class="kt-wizard-v4__nav-label">
                            <div class="kt-wizard-v4__nav-label-title">
                                Days Off
                            </div>
                            <div class="kt-wizard-v4__nav-label-desc">
                                Days Off and Submit
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!--end: Form Wizard Nav -->
        <div class="kt-portlet">
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="kt-grid">
                    <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v4__wrapper">

                        <!--begin: Form Wizard Form-->
                        <form class="kt-form" id="kt_apps_user_add_user_form">
                           @csrf
                            <!--begin: Form Wizard Step 1-->
                            <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
                             <div class="kt-heading kt-heading--md">User's Profile Details:</div>
                                <div class="kt-section kt-section--first">
                                    <div class="kt-wizard-v4__form">
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="kt-section__body">
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Avatar</label>
                                                        <div class="col-lg-9 col-xl-6">
                                                            <div class="kt-avatar kt-avatar--outline kt-avatar--circle" id="kt_apps_user_add_avatar">
                                                                <div class="kt-avatar__holder" style="overflow: hidden;"><img id="emp_avatar_preview" src="{{asset('backend/media/users/default.jpg')}}" width="100%" height="100%"></div>
                                                                <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change avatar">
                                                                    <i class="fa fa-pen"></i>
                                                                    <input type="file" name="kt_apps_user_add_user_avatar" id="emp_avatar" accept="image/*">
                                                                </label>
                                                                <span id="kt-avatar__cancel" class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Cancel avatar">
                                                                    <i class="fa fa-times"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">First Name</label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <input class="form-control" name="profile_first_name" type="text" value="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Last Name</label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <input class="form-control" name="profile_last_name" type="text" value="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Gender</label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <select name="gender" class="form-control" aria-invalid="false">
                                                                <option value="">Select</option>
                                                                <option value="male">Male</option>
                                                                <option value="female">Female</option>

                                                            </select>           
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Date Of Birth</label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <input id="dob-emp" class="form-control" type="text" readonly="" placeholder="Select date" name="dob">           
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Contact Phone</label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-phone"></i></span></div>
                                                                <input type="text" name="profile_phone" class="form-control" value="" placeholder="+15678967456" aria-describedby="basic-addon1">
                                                            </div>                                                            
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Email Address</label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-at"></i></span></div>
                                                                <input type="text" class="form-control" value="" name="profile_email" placeholder="Email" aria-describedby="basic-addon1">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-group-last row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Note(Internal)</label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <div class="input-group">
                                                                <textarea name="note" class="form-control" id="note" rows="4"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--end: Form Wizard Step 1-->

                            <!--begin: Form Wizard Step 2-->
                            <div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-wizard-v4__form">
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="kt-section__body">
                                                    <div class="form-group row">
                                                        <div class="col-lg-9 col-xl-6">
                                                            <h3 class="kt-section__title kt-section__title-md">User's Assigned Services</h3>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Last Name</label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <input class="form-control" type="text" value="Anna">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Email Address</label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-at"></i></span></div>
                                                                <input type="text" class="form-control" value="nick.watson@loop.com" placeholder="Email" aria-describedby="basic-addon1">
                                                            </div>
                                                            <span class="form-text text-muted">Email will not be publicly displayed. <a href="#" class="kt-link">Learn more</a>.</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Language</label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <select class="form-control">
                                                                <option>Select Language...</option>
                                                                <option value="id">Bahasa Indonesia - Indonesian</option>
                                                                <option value="msa">Bahasa Melayu - Malay</option>
                                                            
                                                                <option value="zh-cn">简体中文 - Simplified Chinese</option>
                                                                <option value="zh-tw">繁體中文 - Traditional Chinese</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Time Zone</label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <select class="form-control">
                                                                <option data-offset="-39600" value="International Date Line West">(GMT-11:00) International Date Line West</option>
                                                                <option data-offset="-39600" value="Midway Island">(GMT-11:00) Midway Island</option>
                                                                <option data-offset="-39600" value="Samoa">(GMT-11:00) Samoa</option>
                                                                <option data-offset="-36000" value="Hawaii">(GMT-10:00) Hawaii</option>
                                                                
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-group-last row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Communication</label>
                                                        <div class="col-lg-9 col-xl-6">
                                                            <div class="kt-checkbox-inline">
                                                                <label class="kt-checkbox">
                                                                    <input type="checkbox" checked=""> Email
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-checkbox">
                                                                    <input type="checkbox" checked=""> SMS
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-checkbox">
                                                                    <input type="checkbox"> Phone
                                                                    <span></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="kt-separator kt-separator--border-dashed kt-separator--portlet-fit kt-separator--space-lg"></div>
                                                    <div class="form-group row">
                                                        <div class="col-lg-9 col-xl-6">
                                                            <h3 class="kt-section__title kt-section__title-md">User's Account Settings</h3>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Login verification</label>
                                                        <div class="col-lg-9 col-xl-6">
                                                            <button type="button" class="btn btn-label-brand btn-bold btn-sm kt-margin-t-5 kt-margin-b-5">Setup login verification</button>
                                                            <span class="form-text text-muted">
                                                                After you log in, you will be asked for additional information to confirm your identity and protect your account from being compromised.
                                                                <a href="#" class="kt-link">Learn more</a>.
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Password reset verification</label>
                                                        <div class="col-lg-9 col-xl-6">
                                                            <div class="kt-checkbox-single">
                                                                <label class="kt-checkbox">
                                                                    <input type="checkbox"> Require personal information to reset your password.
                                                                    <span></span>
                                                                </label>
                                                            </div>
                                                            <span class="form-text text-muted">
                                                                For extra security, this requires you to confirm your email or phone number when you reset your password.
                                                                <a href="#" class="kt-link">Learn more</a>.
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row kt-margin-t-10 kt-margin-b-10">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"></label>
                                                        <div class="col-lg-9 col-xl-6">
                                                            <button type="button" class="btn btn-label-danger btn-bold btn-sm kt-margin-t-5 kt-margin-b-5">Deactivate your account ?</button>
                                                        </div>
                                                    </div> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--end: Form Wizard Step 2-->

                            <!--begin: Form Wizard Step 3-->
                            <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
                                <div class="kt-heading kt-heading--md">Work Hours</div>
                                <!-- <div class="kt-form__section kt-form__section--first">
                                    <div class="kt-wizard-v4__form">
                                        <div class="form-group">
                                            <label>Address Line 1</label>
                                            <input type="text" class="form-control" name="address1" placeholder="Address Line 1" value="Address Line 1">
                                            <span class="form-text text-muted">Please enter your Address.</span>
                                        </div>
                                        <div class="form-group">
                                            <label>Address Line 2</label>
                                            <input type="text" class="form-control" name="address2" placeholder="Address Line 2" value="Address Line 2">
                                            <span class="form-text text-muted">Please enter your Address.</span>
                                        </div>
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label>Postcode</label>
                                                    <input type="text" class="form-control" name="postcode" placeholder="Postcode" value="2000">
                                                    <span class="form-text text-muted">Please enter your Postcode.</span>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label>City</label>
                                                    <input type="text" class="form-control" name="state" placeholder="City" value="London">
                                                    <span class="form-text text-muted">Please enter your City.</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label>State</label>
                                                    <input type="text" class="form-control" name="state" placeholder="State" value="VIC">
                                                    <span class="form-text text-muted">Please enter your Postcode.</span>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label>Country:</label>
                                                    <select name="country" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="AF">Afghanistan</option>
                                                        <option value="AX">Åland Islands</option>                                                        
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                            </div>

                            <!--end: Form Wizard Step 3-->

                            <!--begin: Form Wizard Step 4-->
                            <div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
                                <div class="kt-heading kt-heading--md">Days Off</div>
                                <!-- <div class="kt-form__section kt-form__section--first">
                                    <div class="kt-wizard-v4__review">
                                        <div class="kt-wizard-v4__review-item">
                                            <div class="kt-wizard-v4__review-title">
                                                Your Account Details
                                            </div>
                                            <div class="kt-wizard-v4__review-content">
                                                John Wick
                                                <br /> Phone: +61412345678
                                                <br /> Email: johnwick@reeves.com
                                            </div>
                                        </div>
                                        <div class="kt-wizard-v4__review-item">
                                            <div class="kt-wizard-v4__review-title">
                                                Your Address Details
                                            </div>
                                            <div class="kt-wizard-v4__review-content">
                                                Address Line 1
                                                <br /> Address Line 2
                                                <br /> Melbourne 3000, VIC, Australia
                                            </div>
                                        </div>
                                        <div class="kt-wizard-v4__review-item">
                                            <div class="kt-wizard-v4__review-title">
                                                Payment Details
                                            </div>
                                            <div class="kt-wizard-v4__review-content">
                                                Card Number: xxxx xxxx xxxx 1111
                                                <br /> Card Name: John Wick
                                                <br /> Card Expiry: 01/21
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                            </div>

                            <!--end: Form Wizard Step 4-->

                            <!--begin: Form Actions -->
                            <div class="kt-form__actions">
                                <div class="btn btn-secondary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-prev">
                                    Previous
                                </div>
                                <div class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-submit">
                                    Submit
                                </div>
                                <div class="btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-next">
                                    Next Step
                                </div>
                            </div>

                            <!--end: Form Actions -->
                        </form>

                        <!--end: Form Wizard Form-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
