<!--**********************************
        Scripts
    ***********************************-->
<!-- Required vendors -->
<script src="{{URL::asset('dashboard-layout/vendor/global/global.min.js')}}"></script>
<script src="{{URL::asset('dashboard-layout/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
<script src="{{URL::asset('dashboard-layout/vendor/chart.js/Chart.bundle.min.js')}}"></script>
<script src="{{URL::asset('dashboard-layout/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>

<script src="{{URL::asset('dashboard-layout/js/plugins-init/datatables.init.js')}}"></script>

<script src="{{URL::asset('dashboard-layout/vendor/jquery-nice-select/js/jquery.nice-select.min.js')}}"></script>
<script src="{{URL::asset('dashboard-layout/vendor/select2/js/select2.full.min.js')}}"></script>
<script src="{{URL::asset('dashboard-layout/js/custom.min.js')}}"></script>
<script src="{{URL::asset('dashboard-layout/js/deznav-init.js')}}"></script>
<script src="{{URL::asset('dashboard-layout/js/demo.js')}}"></script>

<!-- Chart piety plugin files -->
<script src="{{URL::asset('dashboard-layout/vendor/peity/jquery.peity.min.js')}}"></script>

<!-- Dashboard  -->
<script src="{{URL::asset('dashboard-layout/js/dashboard-1.js')}}"></script>
<script src="{{URL::asset('dashboard-layout/libs/jquery-toast/jquery.toast.min.js')}}"></script>
<script src="{{URL::asset('dashboard-layout/vendor/sweetalert2/dist/sweetalert2.min.js')}}"></script>
<script src="{{URL::asset('dashboard-layout/vendor/jquery-smartwizard/dist/js/jquery.smartWizard.js')}}"></script>
<script src="{{URL::asset('dashboard-layout/vendor/apexchart/apexchart.js')}}"></script>

{{--<script src="{{URL::asset('dashboard-layout/vendor/bootstrap-daterangepicker/daterangepicker.js')}}"></script>--}}
{{--<script src="{{URL::asset('dashboard-layout/js/plugins-init/material-date-picker-init.js')}}"></script>--}}
<script src="{{URL::asset('dashboard-layout/js/bootstrap-datepicker.min.js')}}"></script>

<script>
    jQuery(document).ready(function(){
        dezSettingsOptions.version = 'dark';
        setTimeout(function(){
            dezSettingsOptions.version = 'dark';
            new dezSettings(dezSettingsOptions);
        },1500)
    });
</script>

<script>
    function ChangeLang(lang){
        var url = "{{ route('changeLang') }}";
        window.location.href = url + "?lang="+ lang;
    }
</script>
<script>
    $("#single-select").select2();
    $('.multi-select').select2();
    $('.dropdown-groups').select2();
</script>

