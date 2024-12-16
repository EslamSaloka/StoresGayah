<div class="axil-dashboard-order">
    <h5 class="title">سجل الاشعارات</h5>
    <div class="table-responsive">
        <table class="table">
            <tbody>
                @php
                    $notifications = \Auth::user()->notifications()->Tenancy()->orderBy("id","desc")->get();
                @endphp
                @if (count($notifications) > 0)
                    @foreach ($notifications as $notification)
                        <tr>
                            <td>
                                {!! $notification->message !!}
                            </td>
                            <td>
                                <a href="{{ makeRoute('profile.notifications.destroy',[$notification->id]) }}" class="axil-btn view-btn row_deletedd">
                                    حذف
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <center>
                        <img width="250px" src="{{ url("assets/images/no_notifications.jpg") }}" alt="not notifications yet">
                        <p>
                            لا يوجد اشعارات لديك حاليا
                        </p>
                    </center>
                @endif
            </tbody>
        </table>
    </div>
</div>


@push('scripts')


<script>
    $('.row_deletedd').click(function(e){
        e.preventDefault();
        row_url     = $(this).attr('href');
        Swal.fire({
            title: 'تنبية',
            text: "متأكد من حذف هذا الإشعار",
            icon: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'نعم ، قم بالحذف'
            }).then((result) => {
            if (result.isConfirmed) {
                $.get(row_url,(res)=>{
                    $(this).parent().parent().fadeOut();
                    Swal.fire(
                        'تم الحذف!',
                        'هذا الإشعار تم حذفه بنجاح.',
                        'success'
                    );
                });
            }
        });

    });
</script>

@endpush
