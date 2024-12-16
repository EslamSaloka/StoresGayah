<div class="col-lg-9">
    <div class="axil-dashboard-account">
        <form class="account-details-form SendDataForm" action="{{ makeRoute('change-password.store') }}">
            @csrf
            <div class="row">
                <h5 class="title">تغيير كلمة المرور</h5>
                <div class="form-group">
                    <label>كلمة المرور الحالية</label>
                    <input name="old_password" type="password" class="form-control inputD">
                </div>
                <div class="form-group">
                    <label>كلمة المرور الجديدة</label>
                    <input type="password" name="password" class="form-control inputD">
                </div>
                <div class="form-group">
                    <label>تأكيد كلمة المرور</label>
                    <input type="password" name="password_confirmation" class="form-control inputD">
                </div>
                <div class="form-group mb--0">
                    <input type="submit" class="axil-btn" value="حفظ البيانات">
                </div>
            </div>
        </form>
    </div>
</div>
