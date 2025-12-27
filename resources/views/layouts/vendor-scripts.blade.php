<!-- JAVASCRIPT -->
<script src="{{ URL::asset('build/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/simplebar/simplebar.min.js') }}"></script>
<!--<script src="{{ URL::asset('build/js/plugins.js') }}"></script>-->

<script src="{{ URL::asset('build/libs/toastify-js/src/toastify.js') }}"></script>
<script src="{{ URL::asset('build/libs/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>


<script src="{{ URL::asset('build/js/app.js') }}"></script>


<script src="{{ URL::asset('build/js/jquery.min.js') }}"></script>
<script src="{{ URL::asset('build/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('build/js/dataTables.bootstrap5.min.js') }}"></script>

<!-- prismjs plugin -->
<script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>
<script src="{{ URL::asset('build/js/pages/form-validation.init.js') }}"></script>


<!-- Sweet Alerts js -->
<script src="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.js') }}"></script>

<!-- Sweet alert init js-->
<script src="{{ URL::asset('build/js/pages/sweetalerts.init.js') }}"></script>

<script src="{{ URL::asset('build/js/printThis.js') }}"></script>


<!-- suneditor -->
<script src="{{ URL::asset('build/libs/suneditor/suneditor.min.js') }}"></script>
<!-- init js -->
<script src="{{ URL::asset('build/js/pages/form-editor.init.js') }}"></script>




<script src="{{ URL::asset('build/js/custom.js') }}"></script>
<script>


    $(document).ready(function(){
        $(".table").not(".notDataTable").DataTable()
    })
</script>

@yield('scripts')



