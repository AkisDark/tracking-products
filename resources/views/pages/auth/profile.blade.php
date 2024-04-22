@extends('layouts.app')

@section('title')
    معلومات المستخدم
@endsection

@section('content')
    <div class="container my-auto mt-5">
        <div class="row">
            <div class="col-lg-4 col-md-8 col-12 mx-auto">
                <div class="card z-index-0 fadeIn3 fadeInBottom">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class=" shadow-primary border-radius-lg py-3 pe-1">
                            <h4 class="text-dark font-weight-bolder text-center mt-2 mb-0">معلومات المستخدم</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form role="form" method="POST" action="{{ route('users.update') }}">
                            @csrf
                            @method("PUT")
                            <div class="form-group mb-3">
                                <label class="form-label">اسم المستخدم</label>
                                <input type="name" class="form-control text-center px-2"
                                    style="border: 1px solid #ced4da" name="name" dir="auto"
                                    value="{{ $user->name ?? '' }}">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">البريد الالكتروني</label>
                                <input type="email" class="form-control text-center px-2"
                                    style="border: 1px solid #ced4da" name="email" dir="auto"
                                    value="{{ $user->email ?? '' }}">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">كلمة المرور</label>
                                <input type="password" class="form-control text-center text-dark px-2"
                                    style="border: 1px solid #ced4da" name="password">
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2"> تحديث </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endSection
