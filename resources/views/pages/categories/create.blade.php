@extends('layouts.app')

@section('title')
    اضافة فئة
@endsection 

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-body px-0 pb-2">
                    <div class="px-4 d-flex justify-content-end">
                        <div>
                            <a class="btn btn-outline-dark" href="{{ route('categories.index') }}">الكل</a>
                        </div>
                    </div>
                    <div class="card-body px-4 pb-2">
                        <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group px-3 mb-4">
                                <label for="name">اسم الفئة</label>
                                <input type="text" name="name" class="form-control bg-light p-2 text-center"
                                    id="name" placeholder="اسم الفئة" required dir="auto">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group px-3 mb-4">
                                <label for="image"> صورة</label>
                                <input type="file" name="image" class="form-control text-center bg-light p-3 "
                                    id="image" required dir="ltr" accept="image/*">
                                @error('image')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-info">حفظ</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
