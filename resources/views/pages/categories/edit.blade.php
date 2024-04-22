@extends('layouts.app')

@section('title')
    {{ $category->name }}
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-body px-0 pb-2">
                    <div class="px-4 d-flex justify-content-end">
                        <div>
                            <a class="btn btn-outline-dark btn-sm" href="{{ route('categories.index') }}">الكل</a>
                        </div>
                    </div>
                    <div class="card-body px-4 pb-2">
                        <form action="{{ route('categories.update', $category->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group px-3 mb-4">
                                <label for="name">اسم الفئة</label>
                                <input type="text" name="name" class="form-control text-center bg-light p-2"
                                    id="name" placeholder="اسم الفئة" dir="auto" value="{{ $category->name }}" required>
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group px-3 mb-4">
                                <label for="image"> صورة</label>
                                <input type="file" name="image" class="form-control text-center bg-light p-3 "
                                    id="image" dir="ltr" accept="image/*">
                                @error('image')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-success">تعديل</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
