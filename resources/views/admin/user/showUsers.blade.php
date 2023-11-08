@extends('layouts.app')


@section('content')


<main id="main" class="main">





    <section class="container">
        <div class="row">

            <div class="col-lg-12">
                <h1>Users</h1>


                <div class="card">
                    <div class="card-body">
@if($users->count()>0)
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">{{__('messages.ID')}}</th>
                                    <th scope="col" class="text-center">{{__('messages.Picture')}}</th>
                                    <th scope="col" class="text-center">{{__('messages.Name')}}</th>
                                    <th scope="col" class="text-center">{{__('messages.Email')}}</th>
                                    <th scope="col" class="text-center">{{__('messages.Actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($users as $user)


                                <tr>
                                    <th scope="row" class="text-center align-middle">{{$user->id}}</th>
                                    <td class="text-center align-middle"><img
                                            src="{{$user->photo?asset('storage/images/users/'.$user->photo):asset('storage/images/defaultProfileImage.jpg')}}"
                                            style="width:100px; height:100px;" alt="..." class="rounded "></td>
                                    <td class="text-center align-middle">{{$user->name}}</td>
                                    <td class="text-center align-middle">{{$user->email}}</td>


                                    <td class="text-center align-middle">
                                        <form action="{{route('admins.changeUsersRole',['id'=>$user->id]) }}" method="post"
                                            class="d-inline">
                                            @csrf
                                            @method('put');
                                            <select class="form-select w-50 d-inline" aria-label="Default select example" name="newRole">
                                                <option value="admin">Admin</option>
                                                <option value="editor">Editor</option>
                                              </select>
                                            <button type="submit" class="btn btn-danger "> Change Role </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $users->links() }}

                        <!-- End Table with hoverable rows -->
                        @else
                        <h2>There is no users yet! </h2>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->

@endsection
