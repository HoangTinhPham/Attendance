<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @if(isset($platform->logo))
          <link rel="icon" type="image/png" sizes="16x16" href="{{public_path($platform->logo)}}">
        @else
            <link rel="icon" type="image/png" sizes="16x16" href="{{public_path('assets/images/iuh.jpg')}}">
        @endif
        <title>HRM | @if(isset($platform->name)) {{$platform->name}} @else WEB CHẤM CÔNG @endif</title>

        <!-- Google Font: Source Sans Pro StyleSheet -->
        <link rel="stylesheet" href="{{ public_path('assets/backend/plugins/font-googleapis/font.css') }}">

        <!-- Font Awesome Icons StyleSheet -->
        <link rel="stylesheet" href="{{ public_path('assets/backend/plugins/fontawesome-free/css/all.min.css') }}">

        <!-- Theme  StyleSheet -->
        <link rel="stylesheet" href="{{ public_path('assets/backend/dist/css/adminlte.min.css') }}">

        <!-- jQuery Script -->
        <script src="{{ public_path('assets/backend/plugins/jquery/jquery.min.js') }}"></script>
    </head>

    <body>
        <!-- Main Content Start -->
        <div class="col-12 text-center">
            <h4>
                @if(isset($platform->logo))
                    <img src="{{ public_path($platform->logo) }}" alt="Logo" width="40px">
                @else
                    <img src="{{ public_path('assets/images/iuh.jpg') }}" alt="Logo" width=""class="brand-image elevation-3 bg-white" width="80px">
                @endif

                HRM | @if(isset($platform->name)) {{$platform->name}} @else WEB CHẤM CÔNG @endif
            </h4>
        </div>

        <hr>

        @foreach($employees as $employee)
            <div class="bg-dark">
                <h6 class="pl-2 pt-1 pb-1">
                    <i class="fas fa-user fa-sm"></i> Thông tin chi tiết
                </h6>
            </div>
            
            <table style="width: 100%;">
                <tr class="row">
                    <td style="width: 50%;">
                        <p><b>Tên:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>{{$employee->firstname}} {{$employee->lastname}}</p>
                        <p>
                            <b>Vị trí:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
                            @if($employee->designation != '')
                                {{$employee->designation}}
                            @else
                                N/A
                            @endif
                        </p>
                    </td>
                    <td style="width: 50%;">
                        <p>
                            <b>Bộ phận:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
                            @if($employee->department != '')
                                @foreach($departments as $department)
                                    @if($department->id == $employee->department_id)
                                        {{$department->department_name}}
                                    @endif
                                @endforeach
                            @else
                                N/A
                            @endif
                        </p>
                        <p><b>Lương tháng:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>{{$month}}</p>
                    </td>
                </tr>
            </table>

            <div class="bg-dark">
                <h6 class="pl-2 pt-1 pb-1">
                    <i class="fas fa-id-card fa-sm"></i> Thông tin liên lạc
                </h6>
            </div>
            <table style="width: 100%;">
                <tr class="row">
                    <td style="width: 50%;">
                        <p><b>Số liên lạc:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
                            @if($employee->contact_no != '')
                                {{$employee->contact_no}}
                            @else
                                N/A
                            @endif
                        </p>
                        <p><b>Địa chỉ Email:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
                            @if($employee->official_email != '')
                                {{$employee->official_email}}
                            @else
                                N/A
                            @endif
                        </p>
                    </td>
                    <td style="width: 50%;">
                        <p><b>Số khẩn cấp:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
                            @if($employee->contact_no != '')
                                {{$employee->contact_no}}
                            @else
                                N/A
                            @endif
                        </p>
                        <p><b>Email cá nhân:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
                            @if($employee->personal_email != '')
                                {{$employee->personal_email}}
                            @else
                                N/A
                            @endif
                        </p>
                    </td>
                </tr>
            </table>
            <table style="width: 100%;">
                <tr class="row">
                    <td class="pl-0 pr-2" style="width: 50%;">
                        <div class="bg-dark">
                            <h6 class="pl-2 pt-1 pb-1">
                                <i class="fas fa-money-bill"></i> Chi tiết lương
                            </h6>
                        </div>
                    </td>
                    <td class="pr-0" style="width: 50%;">
                        <div class="bg-dark">
                            <h6 class="pl-2 pt-1 pb-1">
                                <i class="fas fa-money-bill"></i> Khấu trừ
                            </h6>
                        </div>
                    </td>
                </tr>
            </table>
            <table style="width: 100%;">
                <tr class="row">
                    <td class="pl-0" style="width: 40%;">
                        <p><b>Tổng lương:</b></p>
                        <p><b>Lương cơ bản:</b></p>
                        @if(isset($employee['salary']->home_allowance))
                        <p><b>Trợ cấp tại nhà:</b></p>
                        @endif
                        @if(isset($employee['salary']->medical_allowance))
                        <p><b>Trợ cấp y tế:</b></p>
                        @endif
                        @if(isset($employee['salary']->special_allowance))
                        <p><b>Trợ cấp đặc biệt:</b></p>
                        @endif
                        @if(isset($employee['salary']->meal_allowance))
                        <p><b>Phụ cấp bữa ăn:</b></p>
                        @endif
                        @if(isset($employee['salary']->conveyance_allowance))
                        <p><b>Trợ cấp đi lại:</b></p>
                        @endif
                        <p><b>Thưởng:</b></p>
                    </td>
                    <td style="width: 10%;">
                        <p>
                            @if(isset($employee['salary']->gross_salary))
                                ${{$employee['salary']->gross_salary}}
                            @else
                                $0
                            @endif
                        </p>
                        <p>
                            @if(isset($employee['salary']->basic_salary))
                                ${{$employee['salary']->basic_salary}}
                            @else
                                $0
                            @endif
                        </p>
                        <p>
                            @if(isset($employee['salary']->home_allowance))
                                ${{$employee['salary']->home_allowance}}
                            @endif
                        </p>
                        <p>
                            @if(isset($employee['salary']->medical_allowance))
                                ${{$employee['salary']->medical_allowance}}
                            @endif
                        </p>
                        <p>
                            @if(isset($employee['salary']->special_allowance))
                                ${{$employee['salary']->special_allowance}}
                            @endif
                        </p>
                        <p>
                            @if(isset($employee['salary']->meal_allowance))
                                ${{$employee['salary']->meal_allowance}}
                            @endif
                        </p>
                        <p>
                            @if(isset($employee['salary']->conveyance_allowance))
                                ${{$employee['salary']->conveyance_allowance}}
                            @endif
                        </p>
                        <p>
                            @if($employee->bonus != '')
                                ${{$employee->bonus}}
                            @else
                                $0
                            @endif
                        </p>
                    </td>
                    <td class="pr-0" style="width: 41%;position: relative;">
                        <p style="position: absolute;top: 0px;"><b>Quỹ tiết kiệm:</b></p>
                        <p style="position: absolute;top: 40px;"><b>Khấu trừ vắng mặt:</b></p>
                    </td>
                    <td class="pr-0" style="width: 9%;position: relative;">
                        <p style="position: absolute;top: 0px;">
                            @if(isset($employee['salary']->pf_deduction))
                                ${{$employee['salary']->pf_deduction}}
                            @else
                                $0
                            @endif
                        </p>
                        @php $deduction = $employee->gross_salary - $subtotal; @endphp
                        <p style="position: absolute;top: 40px;">
                            @if($deduction <= 0)
                                $0
                            @else
                                ${{$employee->gross_salary - $subtotal}}
                            @endif
                        </p>
                    </td>
                </tr>
            </table>

            @php
                if(isset($employee['salary']->pf_deduction)){
                    $gross_deduction = $deduction + $employee['salary']->pf_deduction;
                } else {
                    $gross_deduction = $deduction;
                }
            @endphp
            <table style="width: 100%;">
                <tr class="row">
                    <td class="pl-0" style="width: 40%;">
                        <div class="bg-dark">
                            <h6 class="pl-1 pt-1 pb-1"><b>Tổng phụ thu:</b></h6>
                        </div>
                    </td>
                    <td class="pl-0 pr-2" style="width: 10%;">
                        <div class="bg-dark">
                            <h6 class="pr-0 pt-1 pb-1">${{$subtotal}}</h6>
                        </div>
                    </td>
                    <td class="pr-0" style="width: 41%;">
                        <div class="bg-dark">
                            <h6 class="pl-1 pt-1 pb-1"><b>Tổng khấu trừ:</b></h6>
                        </div>
                    </td>
                    <td class="pl-0 pr-0" style="width: 9%;">
                        <div class="bg-dark">
                            <h6 class="pr-0 pt-1 pb-1">${{$gross_deduction}}</h6>
                        </div>
                    </td>
                </tr>
            </table>
            <table style="width: 50%; float: right;">
                <tr class="row">
                    <?php $tax = 0; $totalTax = $subtotal / 100 * $tax; ?>
                    <td class="pl-2" style="width: 41%;">
                        <p><b>Tax ({{$tax}}%):</b></p>
                        <hr>
                    </td>
                    <td style="width: 9%;">
                        <p>${{$totalTax}}</p>
                        <hr>
                    </td>
                </tr>
                <tr class="row">
                    @php $netPayable = $subtotal - $totalTax - $gross_deduction; @endphp
                    <td style="width: 41%;">
                        <p class="pl-2"><b>Thuế:</b></p>
                        <hr>
                    </td>
                    <td style="width: 9%;">
                        <p>
                            @if($netPayable > 0)
                                ${{$netPayable}}
                            @else
                                $0
                            @endif
                        </p>
                        <hr>
                    </td>
                </tr>
            </table>
        @endforeach
        <!-- Main Content End -->
    </body>
</html>