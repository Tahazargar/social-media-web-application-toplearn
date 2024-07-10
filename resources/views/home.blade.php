<x-layout pageTitle="تاپ لرن">
    <div class="container py-md-5 tz-fix-height">
        <div class="row align-items-center">
          <div class="col-lg-7 py-3 py-md-5">
            <h1 class="display-3 text-right">آخرین بار کی نوشتی؟</h1>
            <p class="lead text-right text-muted">به رسانه ما خوش آمدی، توی این رسانه میتونی نوشته های خودت رو بنویسی و با دوستات به اشتراک بذاری، اونارو دنبال کنی و با بقیه تعامل داشته باشی.</p>
          </div>
          <div class="col-lg-5 pl-lg-5 pb-3 py-lg-5">
            <form action="/register" method="POST" id="registration-form">
                @csrf
              <div class="form-group text-right">
                <label for="username-register" class="text-muted mb-1"><small>نام کاربری</small></label>
                <input name="username" value="{{old('username')}}" id="username-register" class="form-control" type="text" placeholder="نام کاربری خود را انتخاب کنید" autocomplete="off" />
                @error('username')
                  <p class="m-0 small alert alert-danger shadow-sm p-2">{{ $message }}</p>
                @enderror
              </div>
  
              <div class="form-group text-right">
                <label for="email-register" class="text-muted mb-1"><small>پست الکترونیکی</small></label>
                <input name="email" value="{{ old('email') }}" id="email-register" class="form-control" type="text" placeholder="example@example.com" autocomplete="off" />
                @error('email')
                <p class="m-0 small alert alert-danger shadow-sm p-2">{{ $message }}</p>
              @enderror
              </div>
  
              <div class="form-group text-right">
                <label for="password-register" class="text-muted mb-1"><small>رمز عبور</small></label>
                <input name="password" id="password-register" class="form-control" type="password" placeholder="رمز عبور خود را وارد کنید" />
                @error('password')
                <p class="m-0 small alert alert-danger shadow-sm p-2">{{ $message }}</p>
                @enderror
              </div>
  
              <div class="form-group text-right">
                <label for="password-register-confirm" class="text-muted mb-1"><small>تکرار رمز عبور خود را وارد کنید</small></label>
                <input name="password_confirmation" id="password-register-confirm" class="form-control" type="password" placeholder="تکرار رمز عبور را وارد کنید" />
              </div>
  
              <button type="submit" class="py-3 mt-4 btn btn-lg btn-success btn-block">ثبت نام در اپلیکیشن</button>
            </form>
          </div>
        </div>
      </div>
</x-layout>