@extends('portal.layouts.main')

@section('content')
    <div class="container">
        <!-- Title and Top Buttons Start -->
        <div class="page-title-container">
            <div class="row">
                <!-- Title Start -->
                <div class="col-12 col-md-7">
                    <a href="{{route('portal.home')}}"><i class="fa-solid fa-chevron-right"></i> الرئيسية</a>
                    <h1 class="my-3 pb-0 display-4 text-secondary fw-bold" id="title">بيانات الشركة</h1>
                    <nav class="breadcrumb-container d-inline-block" aria-label="breadcrumb">
                        <ul class="breadcrumb pt-0">
                            <li class="breadcrumb-item"><a href="{{route('portal.company.info.index')}}">بيانات الشركة</a></li>
                            <li class="breadcrumb-item"><a href="{{route('portal.company.partner.index')}}">الشركاء</a></li>
                        </ul>
                    </nav>
                </div>
                <!-- Title End -->
            </div>
        </div>
        <!-- Title and Top Buttons End -->
        <div class="row gx-5">
            @include('portal.components.company_link_list')
            <div class="col-lg-8 col-xl-8 position-relative">
                <div class="d-sm-flex justify-content-end flex-column flex-sm-row">
                    <a href="{{route('portal.company.partner.add.index')}}" class="btn btn-secondary w-100 w-sm-auto mb-2 position-absolute top-m-30"><i class="fa-solid fa-plus"></i> إضافة شريك</a>
                </div>
                <!-- Details Start -->
                <h2 class="h4">الشركاء</h2>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped align-middle">
                                <thead>
                                <tr>
                                    <th scope="col" style="word-wrap: break-word;">رقم الهوية / التسجيل</th>
                                    <th scope="col">اسم الشريك</th>
                                    <th scope="col" class="text-center">عدد الأسهم</th>
                                    <th scope="col" class="text-center">نسبة المساهمة</th>
                                    <th scope="col" class="text-center">مقترض قائم</th>
{{--                                    <th scope="col" class="text-center">ملاحظات أخرى</th>--}}
                                    <th scope="col" class="text-center">أدوات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($data) > 0)
                                    @foreach($data as $item)
                                        <tr id="item-{{$item['PARTNER_ID']}}">
                                            <th scope="row"><i class="fa-solid fa-user-check text-secondary"></i> {{$item['ID_NUM']}}</th>
                                            <td>{{$item['PARTNER_FULL_NAME']}}</td>
                                            <td class="text-center"><span class="text-secondary">{{$item['SHARES_CNT']}}</span></td>
                                            <td class="text-center"><span class="text-secondary">{{$item['CONTRIBUTION_PERCENT']}}</span></td>
                                            <td class="text-center"><span class="{{$item['IS_BANK_BORROWER']==1?'text-success':'text-muted'}}"><i class="fa-solid fa-circle-check"></i></span></td>
{{--                                            <td class="text-center"><span class="{{$item['NOTES']?'text-secondary':'text-muted'}}"><i class="fa-solid fa-circle-info"></i></span></td>--}}
                                            <td  class="text-center">
                                                <a href="{{$item['CUST_TYPE_ID']==1?route('portal.company.partner.edit.firm', $item['PARTNER_ID']):route('portal.company.partner.edit.person', $item['PARTNER_ID'])}}" class="btn btn-sm btn-icon btn-icon-only btn-outline-dark align-top mx-2">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                                <button class="btn btn-sm btn-icon btn-icon-only btn-outline-danger align-top delete_item" data-id="{{$item['PARTNER_ID']}}" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                                                    <i class="fa-solid fa-circle-xmark"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7" class="text-center"><span class="text-secondary"><i class="fa-solid fa-circle-info"></i></span> لا يوجد بيانات حتى الآن</td>
                                    </tr>
                                @endif
                                <tr class="d-none">
                                    <td colspan="7" class="text-center"><span class="text-secondary"><i class="fa-solid fa-circle-info"></i></span> لا يوجد بيانات حتى الآن</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row mb-3 mt-5">
                            <div class="d-sm-flex justify-content-end flex-column flex-sm-row">
                                <a href="{{route('portal.company.contact.index')}}" class="btn btn-icon btn-icon-only btn-outline-secondary mx-0 mx-sm-3 w-100 w-sm-auto  mb-2"><svg class="svg-inline--fa fa-chevron-right" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg=""><path fill="currentColor" d="M342.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L274.7 256 105.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"></path></svg><!-- <i class="fa-solid fa-chevron-right"></i> Font Awesome fontawesome.com --></a>
                                <a href="{{route('portal.company.board.index')}}" class="btn btn-secondary w-100 w-sm-auto  mb-2">التالي</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Details End -->
            </div>
        </div>
    </div>
@endsection

@push('style')
    <style>
        .form-floating > label{
            height: auto;
        }
    </style>
@endpush

@push('script')
    <script>
        $(document).ready(function() {
            $('.delete_item').on('click', function (e) {
                e.preventDefault();
                let btn = $(this);
                let PARTNER_ID = btn.data('id');
                Swal.fire({
                    title: '',
                    text: '{{__('msg.are_you_sure_delete')}}',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d49839',
                    cancelButtonColor: '#cf2637',
                    confirmButtonText: '{{__('msg.confirm_delete')}}',
                    cancelButtonText: '{{__('msg.no_cancel')}}'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            url: '{{route('portal.company.partner.delete')}}',
                            type: 'POST',
                            data: {
                                "PARTNER_ID": PARTNER_ID,
                            },
                            success: function (data) {
                                if(data.status){
                                    $('#item-'+PARTNER_ID).remove();
                                    if($('table tbody tr').length == 1){
                                        $('tr.d-none').removeClass('d-none');
                                    }
                                    Swal.fire('', data.msg, 'success', 2000);
                                }else{
                                    Swal.fire(data.msg, '', 'error', 2000);
                                }
                            },
                        });
                    }
                });
            });
        });
    </script>
@endpush

@push('page_style')
    <link rel="stylesheet" href="{{asset('assets')}}/css/vendor/select2.min.css" />
    <link rel="stylesheet" href="{{asset('assets')}}/css/vendor/select2-bootstrap4.min.css" />
    <link rel="stylesheet" href="{{asset('assets')}}/css/vendor/bootstrap-datepicker3.standalone.min.css" />
@endpush

@push('page_script')
    <script src="{{asset('assets')}}/js/vendor/movecontent.js"></script>
    <script src="{{asset('assets')}}/js/vendor/select2.full.min.js"></script>
    <script src="{{asset('assets')}}/js/vendor/datepicker/bootstrap-datepicker.min.js"></script>
    <script src="{{asset('assets')}}/js/pages/profile.settings.js"></script>

    <script src="{{asset('assets')}}/js/common.js"></script>
    <script src="{{asset('assets')}}/js/scripts.js"></script>
@endpush
