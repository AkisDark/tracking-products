@extends('layouts.app')

@section('title')
    سعر المنتج لكل ولاية
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="shadow-primary border-radius-lg pt-4 pb-3">
                        <h4 class="text-dark text-center text-capitalize px-3"> سعر المنتج <span class="text-danger mx-2"> (
                                <strong>{{ $product->name }}</strong> ) </span> لكل
                            ولاية</h4>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0" style="max-height: 650px">
                        <table class="table table-bordered align-items-center mb-0">
                            <thead class="text-center bg-light">
                                <tr>
                                    <th class="text-uppercase text-secondary opacity-7">رقم
                                        الولاية</th>

                                    <th class="text-center text-uppercase opacity-7">الولاية</th>

                                    <th class="text-center text-uppercase opacity-7">سعر بالجملة (DA)</th>

                                    <th class="text-center text-uppercase opacity-7">سعر بالتجزئة (DA)</th>

                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @forelse ($product->prices as $price)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        <td><strong>{{ $price?->state?->name ?? '/' }}</strong></td>

                                        <td><span class="badge bg-warning">{{ $price->wholesale_price }} Da</span></td>

                                        <td><span class="badge bg-warning">{{ $price->retail_price }} Da</span></td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="12">
                                            <strong class="text-center">لا يوجد بيانات</strong>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
