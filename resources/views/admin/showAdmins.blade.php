@extends('layouts.app')


@section('content')


<main id="main" class="main">





    <section class="container">
        <div class="row">

            <div class="col-lg-12">
                <h1>Admins</h1>


                <div class="card">
                    <div class="card-body">
@if($admins->count()>0)
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">{{__('messages.ID')}}</th>
                                    <th scope="col" class="text-center">{{__('messages.Name')}}</th>
                                    <th scope="col" class="text-center">{{__('messages.Email')}}</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($admins as $admin)


                                <tr>
                                    <th scope="row" class="text-center align-middle">{{$admin->id}}</th>
                                    <td class="text-center align-middle">{{$admin->name}}</td>
                                    <td class="text-center align-middle">{{$admin->email}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                              {{ $admins->links() }}
                        <!-- End Table with hoverable rows -->
                        @else
                        <h2>There is no admins yet! </h2>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->

@endsection
