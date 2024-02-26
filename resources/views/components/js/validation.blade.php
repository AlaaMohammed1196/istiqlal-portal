<script>
    function showValidationError(form, index, value){
        form.find("input[name='"+index+"']").addClass('border-danger');
        form.find("input[name='"+index+"']").parent().append('<div class="invalid-feedback d-block">' + value + '</div');
        form.find("select[name='"+index+"']").addClass('border-danger');
        form.find("select[name='"+index+"']").parent().append('<div class="invalid-feedback d-block">' + value + '</div');
        form.find("textarea[name='"+index+"']").addClass('border-danger');
        form.find("textarea[name='"+index+"']").parent().append('<div class="invalid-feedback d-block">' + value + '</div');
        form.find("select[name='"+index+"[]']").parent().append('<div class="invalid-feedback d-block">' + value + '</div');
    }
</script>
