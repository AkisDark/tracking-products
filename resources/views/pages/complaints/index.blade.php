@extends('layouts.app')

@section('title')
    الشكاوي
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="shadow-primary border-radius-lg pt-4 pb-3">
                        <h3 class="text-dark text-center text-capitalize px-3"> الشكاوي</h3>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="px-4 py-4 d-flex justify-content-end">
                        <form action="{{ route('complaints.index') }}" method="GET">
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
                                        صورة المنتج </th>

                                    <th class="text-center text-uppercase opacity-7">
                                        اسم المنتج </th>

                                    <th class="text-center text-uppercase opacity-7">
                                        الاسم الكامل </th>

                                    <th class="text-uppercase text-secondary opacity-7">البريد الالكتروني</th>

                                    <th class="text-uppercase text-secondary opacity-7">الهاتف</th>

                                    <th class="text-uppercase text-secondary opacity-7">الرسالة</th>

                                    <th class="text-uppercase text-secondary opacity-7">تاريخ الانشاء</th>

                                    <th class="text-secondary opacity-7">الاجراءات</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @forelse ($complaints as $complaint)
                                    <tr>
                                        <td>#{{ $complaint->id }}</td>
                                        <td>
                                            @if (!empty($complaint->image))
                                                <img class="img-thumbnail" style="width:50px; height:50px"
                                                    src="{{ $complaint->image }}" alt="{{ $complaint->name }}" />
                                            @endif
                                        </td>
                                        <td>
                                            @if (!empty($complaint->product))
                                                <a href="{{ route('products.edit', $complaint->product->id) }}">
                                                    {{ $complaint->product->name ?? '/' }}
                                                </a>
                                            @endif
                                        </td>
                                        <td>{{ $complaint->name ?? '/' }}</td>
                                        <td>
                                            @if (!empty($complaint->email))
                                                <a href="mailto:{{ $complaint->email }}">{{ $complaint->email }}</a>
                                            @else
                                                /
                                            @endif
                                        </td>
                                        <td>
                                            @if (!empty($complaint->phone))
                                                <a href="tel:{{ $complaint->phone }}">{{ $complaint->phone }}</a>
                                            @else
                                                /
                                            @endif
                                        </td>
                                        <td><strong>{{ $complaint->message ?? '/' }}</strong></td>

                                        <td>{{ $complaint->created_at->diffForHumans() }}</td>
                                        <td>
                                            <form action="{{ route('complaints.destroy', $complaint->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return deleteData()" type="submit"
                                                    class="btn btn-outline-danger btn-sm m-1">حذف</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10">
                                            <strong class="text-center">لا توجد بيانات</strong>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $complaints->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
