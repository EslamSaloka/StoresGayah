<div class="axil-dashboard-address">
    <h5 class="title">عناوين الشحن المضافة</h5>
    <div class="row row--30">

        @php
            $address = \App\Models\User\Address::Tenancy()->where('client_id',\Auth::user()->id)->get();
        @endphp

        @if (count($address) > 0)
            @foreach ($address as $item)
                <div class="col-lg-6" id="row_{{$item->id}}">
                    <div class="address-info mb--40">
                        <div class="addrss-header d-flex align-items-center justify-content-between">
                            <h4 class="title mb-0">
                                {{ $item->title }}
                            </h4>
                            <a href="{{ makeRoute('profile.address.destroy',[$item->id]) }}" class="address-edit row_deleted" data-id="{{ $item->id }}">
                                <i class="far fa-trash" style="color:#fff;background:red;padding:13px 14px;border-radius:20px;"></i>
                            </a>
                        </div>
                        <ul class="address-details">
                            <li>المدينة : {{ $item->city }}</li>
                            <li>العنوان : {{ $item->address }}</li>
                            <li>الرمز البريدي : {{ $item->postcode }}</li>
                            <li>رقم الدور : {{ $item->phone }}</li>
                        </ul>
                    </div>
                </div>
            @endforeach
        @else
            <center>
                <img width="250px" src="{{ url("assets/images/no_address.jpg") }}" alt="not notifications yet">
                <p>
                    لا يوجد عناوين لديك حاليا
                </p>
            </center>
        @endif

    </div>
</div>

@push('scripts')


<script>
    $('.row_deleted').click(function(e){
        e.preventDefault();
        row_url     = $(this).attr('href');
        row_deleted = $(this).data('id');
        Swal.fire({
            title: 'تنبية',
            text: "متأكد من حذف هذا العنوان",
            icon: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'نعم ، قم بالحذف'
            }).then((result) => {
            if (result.isConfirmed) {
                $.get(row_url,(res)=>{
                    $(this).parent().parent().parent().fadeOut();
                    Swal.fire(
                        'تم الحذف!',
                        'هذا العنوان تم حذفه بنجاح.',
                        'success'
                    );
                });
            }
        });

    });
</script>

@endpush
