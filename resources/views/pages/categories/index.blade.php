@extends('layouts.app')

@section('title')
    الفئات
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="shadow-primary border-radius-lg pt-4 pb-3">
                        <h3 class="text-dark text-center text-capitalize px-3"> الفئات</h3>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="px-4 py-4 d-flex justify-content-between">
                        <div>
                            <a class="btn btn-outline-info btn-sm" href="{{ route('categories.create') }}">اضافة</a>
                        </div>
                        <form action="{{ route('categories.index') }}" method="GET">
                            <input type="search" value="{{ request('search') }}" name="search"
                                class="form-control bg-light text-dark p-2" placeholder="بحث">
                        </form>

                    </div>
                    <div class="table-responsive p-0" style="min-height: 600px">
                        <table class="table table-bordered align-items-center mb-0">
                            <thead class="text-center bg-light">
                                <tr>
                                    <th class="text-uppercase text-secondary opacity-7">رقم
                                        المعرف</th>
                                    <th class="text-center text-uppercase opacity-7">
                                        صورة </th>
                                    <th class="text-uppercase text-secondary opacity-7">اسم
                                        الفئة</th>

                                    <th class="text-center text-uppercase text-secondary opacity-7">
                                        تاريخ الانشاء</th>
                                    <th class="text-secondary opacity-7">الاجراءات</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @forelse ($categories as $category)
                                    <tr>
                                        <td>#{{ $category->id }}</td>
                                        <td><img class="img-thumbnail" style="width:50px; height:50px"
                                                src="{{ $category->image }}" alt="{{ $category->name }}"></td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->created_at->diffForHumans() }}</td>
                                        <td>
                                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('categories.edit', $category->id) }}"
                                                    class="btn btn-outline-success btn-sm m-1">تعديل</a>
                                                <button onclick="return deleteData()" type="submit"
                                                    class="btn btn-outline-danger btn-sm m-1">حذف</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">
                                            <strong class="text-center">لا توجد بيانات</strong>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
