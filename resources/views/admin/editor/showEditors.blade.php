@extends('layouts.app')


@section('content')


<main id="main" class="main">





    <section class="container">
        <div class="row">

            <div class="col-lg-12">
                <h1>Editors</h1>


                <div class="card">
                    <div class="card-body">
                    @if($editors->count()>0)
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">{{__('messages.ID')}}</th>
                                    <th scope="col" class="text-center">{{__('messages.Name')}}</th>
                                    <th scope="col" class="text-center">{{__('messages.Email')}}</th>
                                    <th scope="col" class="text-center">{{__('messages.Actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($editors as $editor)
                                <tr>
                                    <th scope="row" class="text-center align-middle">{{$editor->id}}</th>
                                    <td class="text-center align-middle">{{$editor->name}}</td>
                                    <td class="text-center align-middle">{{$editor->email}}</td>


                                    <td class="text-center align-middle">
                                        <form action="{{route('admins.changeEditorsRole',['id'=>$editor->id]) }}" method="post"
                                            class="d-inline">
                                            @csrf
                                            @method('put');
                                            <select class="form-select  w-50 d-inline" aria-label="Default select example" name="newRole">
                                                <option value="admin">Admin</option>
                                                <option value="user">User</option>
                                              </select>
                                            <button type="submit" class="btn btn-danger "> Change Role </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $editors->links() }}

                        <!-- End Table with hoverable rows -->
                        @else
                        <h2>There is no editors yet! </h2>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->

@endsection
