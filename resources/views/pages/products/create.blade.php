@extends('layouts.app')

@section('title')
    اضافة منتج
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-body px-0 pb-2">
                    <div class="px-4 d-flex justify-content-end">
                        <div>
                            <a class="btn btn-outline-dark btn-sm" href="{{ route('products.index') }}">الكل </a>
                        </div>
                    </div>
                    <div class="card-body px-4 pb-2">
                        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">

                                <div class="col-lg-4">
                                    <div class="form-group px-3 mb-4">
                                        <label for="delivery_company">اسم الشركة </label>
                                        <input type="text" name="delivery_company"
                                            class="form-control text-center bg-light p-2" id="delivery_company" focus
                                            required dir="auto" value="{{ old('delivery_company') }}">
                                        @error('delivery_company')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group px-3 mb-4">
                                        <label for="name">اسم المنتج </label>
                                        <input type="text" name="name" class="form-control text-center bg-light p-2"
                                            id="name" placeholder="" required dir="auto"
                                            value="{{ old('name') }}">
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group px-3 mb-4">
                                        <label for="barcode"> كود بار </label>
                                        <input type="text" name="barcode" class="form-control bg-light p-2 text-center"
                                            id="barcode" dir="auto" required value="{{ \Str::random(10) }}"
                                            value="{{ old('barcode') }}">
                                        @error('barcode')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group px-3 mb-4">
                                        <label for="wholesale_price"> سعر الجملة (DA)</label>
                                        <input type="number" min="0" name="wholesale_price"
                                            class="form-control bg-light p-2 text-center" id="wholesale_price"
                                            placeholder="0" dir="auto" value="{{ old('wholesale_price') }}">
                                        @error('wholesale_price')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group px-3 mb-4">
                                        <label for="retail_price"> سعر التجزئة (DA)</label>
                                        <input type="number" min="0" name="retail_price"
                                            class="form-control bg-light p-2 text-center" id="retail_price" placeholder="0"
                                            dir="auto" value="{{ old('retail_price') }}">
                                        @error('retail_price')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group px-3 mb-4">
                                        <label for="weight"> الوزن</label>
                                        <input type="number" min="0" name="weight"
                                            class="form-control bg-light p-2 text-center" id="weight" placeholder="0"
                                            value="{{ old('weight') }}" dir="auto">
                                        @error('weight')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group px-3 mb-4">
                                        <label for="category_id">اسم الفئة </label>
                                        <select class="form-control bg-light p-2" name="category_id" id="category_id">
                                            <option value=""></option>
                                            @forelse ($categories as $category)
                                                <option @selected(old('category_id') == $category->id) value="{{ $category->id }}">
                                                    {{ $category->name }}</option>
                                            @empty
                                                <option disabled value="">لا يوجد فئات</option>
                                            @endforelse
                                        </select>
                                        @error('category_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">

                                    <div class="form-group px-3 mb-4">
                                        <label for="subcategory_id">اسم الفئة الفرعية</label>
                                        <select class="form-control bg-light p-2" name="subcategory_id" id="subcategory_id">
                                            <option value=""></option>
                                            @forelse ($subcategories as $subcategory)
                                                <option @selected(old('subcategory_id') == $subcategory->id) value="{{ $subcategory->id }}">
                                                    {{ $subcategory->name }}</option>
                                            @empty
                                                <option disabled value="">لا يوجد فئات فرعية</option>
                                            @endforelse
                                        </select>
                                        @error('subcategory_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>



                            <div class="text-center mt-3">
                                <button class="btn text-dark p-2 btn-light btn-sm" style="width: 98%" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false"
                                    aria-controls="collapseExample">
                                    سعر لكل ولاية
                                </button>
                            </div>
                            <div class="collapse mb-5 {{ old('states') ? 'show' : '' }}" id="collapseExample">
                                <div class="card card-body">
                                    <div class="table-responsive" style="max-height: 400px;overflow-y: scroll">
                                        <table class="table">
                                            <thead class="text-center bg-light sticky-top top-0">
                                                <tr>
                                                    <th scope="col">الولايات</th>
                                                    <th scope="col">سعر الجملة (DA)</th>
                                                    <th scope="col">سعر التجزئة (DA)</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-center">
                                                <tr>
                                                    <td><strong class="text-muted">الكل</strong></td>
                                                    <td>
                                                        <input type="number" placeholder="0"
                                                            class="form-control bg-light p-2 text-center"
                                                            id="wholesale_prices_all" oninput="changeAllWholesalePrices()"
                                                            min="0">
                                                    </td>
                                                    <td>
                                                        <input type="number" placeholder="0"
                                                            class="form-control bg-light p-2 text-center"
                                                            id="retail_prices_all" oninput="changeAllRetailPrices()"
                                                            min="0">
                                                    </td>
                                                </tr>
                                                @forelse ($states as $state)
                                                    <tr>
                                                        <td class="p-2">
                                                            <input type="hidden" name="states[]"
                                                                value="{{ $state->id }}">
                                                            <strong>{{ $state->id }} - {{ $state->name }}</strong>
                                                        </td>

                                                        <td>
                                                            <input type="number" placeholder="0"
                                                                class="form-control bg-light p-2 text-center"
                                                                name="wholesale_prices[]" min="0">
                                                        </td>

                                                        <td>
                                                            <input type="number" placeholder="0"
                                                                class="form-control bg-light p-2 text-center"
                                                                name="retail_prices[]" min="0">
                                                        </td>
                                                    </tr>

                                                @empty
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group px-3 mb-4">
                                <label for="image">صورة</label>
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

@push('scripts')
    <script>
        function changeAllWholesalePrices() {
            const value = document.getElementById('wholesale_prices_all').value;
            for (var i = 0; i < document.getElementsByName('wholesale_prices[]').length; i++) {
                document.getElementsByName('wholesale_prices[]')[i].value = value;
            }

        }

        function changeAllRetailPrices() {
            const value = document.getElementById('retail_prices_all').value;
            for (var i = 0; i < document.getElementsByName('retail_prices[]').length; i++) {
                document.getElementsByName('retail_prices[]')[i].value = value;
            }
        }
    </script>
@endpush
