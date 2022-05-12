@extends('layouts.admin')

@section('main')


    <div class="users-list">
        <table class="table user-table">
            <tr>
                <th>Jméno</th>
                <th>Email</th>
                <th>Povolen</th>
                {{--<th>Povolen</th>--}}
            </tr>
        @foreach($users as $user)
            
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>
                    @if($user->isAdmin())
                        <a href="javascript:void(0)" data-user="{{$user->id}}" data-role="1" class="btn btn-is_admin"><i class="fa-solid fa-circle-check"></i>&nbsp;Ano</a>
                    @else
                        <a href="javascript:void(0)" data-user="{{$user->id}}" data-role="1" class="btn btn-is_not_admin"><i class="fa-solid fa-circle-xmark"></i>&nbsp;Ne</a>
                    @endif
                </td>
             {{--   <td>
                    @if($user->verified)
                        <a href="javascript:void(0)" data-user="{{$user->id}}" data-role="2" class="btn btn-verified"><i class="fa-solid fa-circle-check"></i>&nbsp;Ano</a>
                    @else
                        <a href="javascript:void(0)" data-user="{{$user->id}}" data-role="2" class="btn btn-not_verified"><i class="fa-solid fa-circle-xmark"></i>&nbsp;Ne</a>
                    @endif
                </td>--}}
            </tr>
            
        @endforeach
        </table>
    </div>

    <script>

        $(window).on('load', function() {
            $('.btn-is_admin').on('mouseover', function() {
                $(this).addClass('btn-is_not_admin')
                       .removeClass('btn-is_admin')
                       .html('<i class="fa-solid fa-circle-xmark"></i>&nbsp;Zrušit')     
            }).on('mouseout', function() {
                $(this).html('<i class="fa-solid fa-circle-check"></i>&nbsp;Ano')
                        .addClass('btn-is_admin')
                       .removeClass('btn-is_not_admin');       
            });

            $('.btn-is_not_admin').on('mouseover', function() {
                $(this).addClass('btn-is_admin')
                       .removeClass('btn-is_not_admin')
                       .html('<i class="fa-solid fa-circle-plus"></i>&nbsp;Povolit')     
            }).on('mouseout', function() {
                $(this).html('<i class="fa-solid fa-circle-xmark"></i>&nbsp;Ne')
                        .addClass('btn-is_not_admin')
                       .removeClass('btn-is_admin');       
            });


            $('.btn-verified').on('mouseover', function() {
                $(this).addClass('btn-not_verified')
                       .removeClass('btn-verified')
                       .html('<i class="fa-solid fa-circle-xmark"></i>&nbsp;Zakázat')     
            }).on('mouseout', function() {
                $(this).html('<i class="fa-solid fa-circle-check"></i>&nbsp;Ano')
                        .addClass('btn-verified')
                       .removeClass('btn-not_verified');       
            });

            $('.btn-not_verified').on('mouseover', function() {
                $(this).addClass('btn-verified')
                       .removeClass('btn-not_verified')
                       .html('<i class="fa-solid fa-circle-plus"></i>&nbsp;Povolit')     
            }).on('mouseout', function() {
                $(this).html('<i class="fa-solid fa-circle-xmark"></i>&nbsp;Ne')
                        .addClass('btn-not_verified')
                       .removeClass('btn-verified');       
            });


            $('.btn').on('click', function(){
                var role = $(this).data('role');
                var user = $(this).data('user');
                $.post('/admin/change-role', {
                    role: role,
                    user: user,
                    _token: $('meta[name="csrf-token"]').attr('content')
                })
                .done(function(data){
                    location.reload();
                });
            });
        });


    </script>

@endsection
