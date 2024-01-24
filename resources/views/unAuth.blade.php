@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>رقم الشحنة</th>
                                <th>السعر</th>
                                <th>الحالة</th>
                                <th>نوع الدفع</th>
                                <th>التاريخ</th>
                                <th>التحكم</th>
                            </tr>
                        </thead>
                        <tfoot>
                            @foreach ($Orders as $key => $value)
                                <tr>
                                    <td>
                                        {{ $key + 1 }}
                                    </td>
                                    <td>
                                        {{ $value->id }}
                                    </td>
                                    <td>
                                        {{ $value->order->total ?? 0 + (int) $value->order->shipping }}
                                    </td>
                                    <td>
                                        @if ($value->status == 1)
                                            <span class="badge badge-orange">جارى التجهيز</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($value->pay_type == 1)
                                            <span class="badge badge">عند الإستلام</span>
                                        @endif
                                        @if ($value->pay_type == 2)
                                            <span class="badge badge"> دفع إلكترونى</span>
                                            @if ($value->pay_status == 1)
                                                <span class="badge badge-danger"> لم يتم الدفع</span>
                                            @endif
                                            @if ($value->pay_status == 2)
                                                <span class="badge badge-success"> تم الدفع </span>
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        <span
                                            class="badge badge-success">{{ \Illuminate\Support\Carbon::parse($value->created_at)->format('d-M-Y') }}</span>
                                    </td>
                                    <td>
                                        <button class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#editModal{{ $value->id }}" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <div class="modal fade" id="editModal{{ $value->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <!-- Add your modal content here -->
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel">تفاصيل الطلب</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-sm-6 marbo" style="margin-top: 10px">
                                                                <ul class="list-group">
                                                                    <li
                                                                        class="list-group-item d-flex justify-content-between align-items-center">
                                                                        الاسم
                                                                        <span
                                                                            class="badge badge-primary badge-pill">{{ $value->name }}</span>
                                                                    </li>
                                                                    <li
                                                                        class="list-group-item d-flex justify-content-between align-items-center">
                                                                        رقم الهاتف
                                                                        <span
                                                                            class="badge badge-primary badge-pill">{{ $value->phone }}</span>
                                                                    </li>
                                                                    <li
                                                                        class="list-group-item d-flex justify-content-between align-items-center">
                                                                        العنوان
                                                                        <span
                                                                            class="badge badge-primary badge-pill">{{ $value->address }}</span>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-sm-6 marbo" style="margin-top: 10px">
                                                                <ul class="list-group">
                                                                    <li
                                                                        class="list-group-item d-flex justify-content-between align-items-center">
                                                                        اسم المنتج
                                                                        <span
                                                                            class="badge badge-primary badge-pill">{{ $value->product->name_ar }}</span>
                                                                    </li>
                                                                    <li
                                                                        class="list-group-item d-flex justify-content-between align-items-center">
                                                                        الكمية
                                                                        <span
                                                                            class="badge badge-primary badge-pill">{{ intval($value->order->total / $value->product->price) }}</span>
                                                                    </li>
                                                                    <li
                                                                        class="list-group-item d-flex justify-content-between align-items-center">
                                                                        سعر المنتج
                                                                        <span
                                                                            class="badge badge-primary badge-pill">{{ $value->product->price }}
                                                                            جنيه</span>
                                                                    </li>
                                                                    <li
                                                                        class="list-group-item d-flex justify-content-between align-items-center">
                                                                        الخصم
                                                                        <span class="badge badge-primary badge-pill">0
                                                                            جنيه</span>
                                                                    </li>
                                                                    <li
                                                                        class="list-group-item d-flex justify-content-between align-items-center">
                                                                        الشحن
                                                                        <span
                                                                            class="badge badge-primary badge-pill">{{ $value->order->shipping }}
                                                                            جنيه</span>
                                                                    </li>
                                                                </ul>
                                                            </div>

                                                            <div class="col-sm-12">
                                                                <div class="row">
                                                                    <div class="col-sm-6" style="margin-top: 10px">
                                                                        <div class="from-group">
                                                                            <div
                                                                                class="selectize-control form-control single plugin-remove_button rtl">
                                                                                <div
                                                                                    class="selectize-input items required full has-options has-items">
                                                                                    <div data-value="2" class="item">
                                                                                        @if ($value->status == 1)
                                                                                            جارى التجهيز
                                                                                        @endif
                                                                                    </div><input type="text"
                                                                                        autocomplete="off" tabindex=""
                                                                                        style="width: 4px; opacity: 0; position: absolute; left: 10000px;">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6" style="margin-top: 10px">
                                                                        <form method="POST"
                                                                            action="{{ route('updateOrderStatus', $value->id) }}">
                                                                            @csrf
                                                                            <button
                                                                                style="width: 100%; margin-left: auto; margin-top:30px; margin-right: auto; "
                                                                                type="submit"
                                                                                class="btn btn-outline-primary btn-block">اشحن
                                                                                الطلب
                                                                            </button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <form method="POST" action="{{ route('deleteOrderunAuth', $value->id) }}"
                                            class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm delete" title="Delete"
                                                onclick="return confirm('Are you sure you want to delete this item?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection
