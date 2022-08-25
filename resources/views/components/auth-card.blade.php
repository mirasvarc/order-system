<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-custom">
    <div class="shadow"></div>
    <div class="login-card">
        <img class="login-logo" src="/images/logo_af.png">
        

        <div class="w-full  mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <div class="text-center">
                <h1 class="login-title">Přihlášení</h1>
            </div>
            <br>
            {{ $slot }}
        </div>
    </div>
</div>
