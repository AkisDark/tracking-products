@extends('layouts.app')

@section('title')
    {{ $subcategory->name }}
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-body px-0 pb-2">
                    <div class="px-4 d-flex justify-content-end">
                        <div>
                            <a class="btn btn-outline-info btn-sm" href="{{ route('subcategories.index') }}">الكل</a>
                        </div>
                    </div>
                    <div class="card-body px-4 pb-2">
                        <form action="{{ route('subcategories.update', $subcategory->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group px-3 mb-4">
                                <label for="category_id">اسم الفئة </label>
                                <select class="form-control bg-light p-2 text-center" name="category_id" id="category_id">
                                    <option value=""></option>
                                    @forelse ($categories as $category)
                                        <option @selected($subcategory->category_id == $category->id) value="{{ $category->id }}">
                                            {{ $category->name }}</option>
                                    @empty
                                        <option disabled value="">لا يوجد فئات</option>
                                    @endforelse
                                </select>
                                @error('category_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group px-3 mb-4">
                                <label for="name">اسم الفئة الفرعية</label>
                                <input type="text" name="name" class="form-control bg-light p-2 text-center"
                                    id="name" placeholder="اسم الفئة الفرعية" value="{{ $subcategory->name }}" required
                                    dir="auto">
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
