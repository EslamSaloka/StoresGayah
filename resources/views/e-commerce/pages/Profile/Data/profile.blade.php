
<div class="col-lg-9">
    <div class="axil-dashboard-account">
        <form class="account-details-form SendDataForm" action="{{ makeRoute('profile.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <h5 class="title">بيانات الحساب</h5>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>الاسم الاول</label>
                        <input type="text" name="name" class="form-control inputD" value="{{ \Auth::user()->name }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>رقم الجوال</label>
                        <input type="text" name="phone" class="form-control inputD" value="{{ \Auth::user()->phone }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>البريد الالكتروني</label>
                        <input type="text" name="email" class="form-control inputD" value="{{ \Auth::user()->email }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>الصورة الشخصية</label>
                        <input type="file" name="avatar" class="form-control inputD">
                    </div>
                </div>

                <div class="form-group mb--0">
                    <input type="submit" class="axil-btn" value="حفظ البيانات">
                </div>
            </div>
        </form>
    </div>
</div>
