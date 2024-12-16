<div class="axil-dashboard-order">
    <h5 class="title">سجل الطلبات</h5>

    @php
        $orders = \App\Models\Order::Tenancy()->where('client_id',\Auth::user()->id)->orderBy("id","desc")->get();
    @endphp


    @if ($orders->count() > 0)


    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">رقم الطلب</th>
                <th scope="col">رقم البوليصة</th>
                <th scope="col">تاريخ الطلب</th>
                <th scope="col">الحالة</th>
                <th scope="col">التكلفة</th>
                <th scope="col">خيارات</th>
            </tr>
            </thead>
            <tbody>

                @foreach ($orders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>{{ $order->tracking_id ?? '-----' }}</td>
                        <td>{{ $order->created_at->format('d-m-Y') }}</td>
                        @if ($order->status == "new")
                            <td style="color:orange;">قيد المراجعة</td>
                        @elseif($order->status == "reject")
                            <td style="color:red;">طلب مرفوض</td>
                        @else
                            <td style="color:green;">تم تأكيد الطلب</td>
                        @endif
                        <td>{{ $order->total }} ر.س</td>
                        <td>
                            <a href="{{ makeRoute('orders.show',[$order->id]) }}" class="axil-btn view-btn">عرض</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    @else
        <center>
            <img width="250px" src="{{ url("assets/images/no_address.jpg") }}" alt="not notifications yet">
            <p>
                لا يوجد طلبات لديك حاليا
            </p>
        </center>
    @endif
</div>
