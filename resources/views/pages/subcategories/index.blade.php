@extends('layouts.app')

@section('title')
    الفئات الفرعية
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="shadow-primary border-radius-lg pt-4 pb-3">
                        <h3 class="text-dark text-center text-capitalize px-3">الفئات الفرعية</h3>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="p-4 d-flex justify-content-between">
                        <div>
                            <a class="btn btn-outline-info btn-sm" href="{{ route('subcategories.create') }}">اضافة</a>
                        </div>
                        <form action="{{ route('subcategories.index') }}" method="GET">
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

                                    <th class="text-uppercase text-secondary opacity-7">اسم الفئة الفرعية</th>

                                    <th class="text-center text-uppercase text-secondary opacity-7">
                                        تاريخ الانشاء</th>
                                    <th class="text-secondary opacity-7">الاجراءات</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @forelse ($subcategories as $subcategory)
                                    <tr>
                                        <td>#{{ $subcategory->id }}</td>
                                        <td><img class="img-thumbnail" style="width:50px; height:50px"
                                                src="{{ $subcategory->image }}" alt="{{ $subcategory->name }}"></td>
                                        <td>
                                            @if (!empty($subcategory->category?->name))
                                                <a href="{{ route('categories.edit', $subcategory->category?->id) }}">
                                                    {{ $subcategory?->category?->name ?? '/' }}
                                                </a>
                                            @else
                                                /
                                            @endif
                                        </td>
                                        <td>{{ $subcategory->name }}</td>
                                        <td>{{ $subcategory->created_at->diffForHumans() }}</td>
                                        <td>
                                            <form action="{{ route('subcategories.destroy', $subcategory->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('subcategories.edit', $subcategory->id) }}"
                                                    class="btn btn-outline-success btn-sm m-1">تعديل</a>
                                                <button onclick="return deleteData()" type="submit"
                                                    class="btn btn-outline-danger btn-sm m-1">حذف</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">
                                            <h5 class="text-center">لا توجد بيانات</h5>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $subcategories->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
