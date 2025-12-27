<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 text-center text-sm-start">
                <script>document.write(new Date().getFullYear())</script> © {{ env('APP_NAME') }}.
            </div>
            <div class="col-sm-6">
                <div class="text-sm-end d-none d-sm-block">
                    DESIGNED AND DEVELOPED BY {{ strtoupper(env('APP_NAME')) }}
                </div>
            </div>
        </div>
    </div>
</footer>