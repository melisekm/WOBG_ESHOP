<script src={{asset("js/main.js")}}></script>
<script>
    // na to aby sme mohli poslat POST request cez jQuery potrebuje mat zadany CSRF token
    $(document).ready(function() {
        $.ajaxSetup({
            headers:
                {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });
    })
</script>
@stack("scripts")
