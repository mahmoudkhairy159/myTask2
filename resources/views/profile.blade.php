@extends('layouts.app')


@section('content')

    <section class="section profile">
        <div class="row d-flex justify-content-center">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">


                        <img
                            src="{{$user->photo?asset('storage/images/users/'.$user->photo) : asset('storage/images/defaultProfileImage.jpg')}}"
                            alt="Profile" class="rounded-circle" style="width:100px; height:100px;">
                        <h2>{{$user->name}}</h2>

                    </div>
                </div>

            </div>

            <div class="col-xl-7">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab"
                                        data-bs-target="#profile-overview">{{__('messages.Overview')}}</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#profile-edit">{{__('messages.Edit Profile')}}</button>
                            </li>


                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">

                                <h5 class="card-title">{{__('messages.Profile Information')}}</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">{{__('messages.Name')}}</div>
                                    <div class="col-lg-9 col-md-8">{{$user->name}}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">{{__('messages.E-Mail')}}</div>
                                    <div class="col-lg-9 col-md-8">{{$user->email}}</div>
                                </div>






                            </div>

                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                <!-- Profile Edit Form -->
                                <form action="{{route('users.update',Auth::id())}}" method="post"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row mb-3">
                                        <label for="fullName"
                                               class="col-md-4 col-lg-3 col-form-label">{{__('messages.Name')}}</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="name" type="text" class="form-control" id="fullName"
                                                   value="{{$user->name}}">
                                        </div>
                                    </div>






                                    <div class="row mb-3">
                                        <label for="company"
                                               class="col-md-4 col-lg-3 col-form-label">{{__('messages.Profile Picture')}}</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="file"  name="photo">
                                        </div>
                                    </div>





                                    <div class="text-center">
                                        <button type="submit"
                                                class="btn btn-primary">{{__('messages.Save Changes')}}</button>
                                    </div>
                                </form><!-- End Profile Edit Form -->

                            </div>



                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
