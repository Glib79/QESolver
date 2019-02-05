<div>Quadratic Equation Solver</div>
<div>Please input params to eqation ax<sup>2</sup> + bx + c = 0</div>

<?= $this->Form->create($client_form); ?>
<div class="qes_text"><?= $this->Form->control('var_a', ['label' => '']); ?></div>
<div class="qes_eq">x<sup>2</sup> + </div>
<div class="qes_text"><?= $this->Form->control('var_b', ['label' => '']); ?></div>
<div class="qes_eq">x + </div>
<div class="qes_text"><?= $this->Form->control('var_c', ['label' => '']); ?></div>
<div class="qes_eq"> = 0</div>
<div class="qes_submit"><?= $this->Form->button('Submit'); ?></div>
<?= $this->Form->end(); ?>

<script type="text/javascript">
$(document).ready(function(){
    $("button[type='submit']").click(function(){

        var isValid = true;
        var focusInput = null;
        var var_a = $("input[name='var_a']");
        var var_b = $("input[name='var_b']");
        var var_c = $("input[name='var_c']");

        var check_int = function(field, non_zero) {
            var isValid = true
            $(field).removeClass("error");
            $(field).next().remove();

            if ($(field).val() == null || $(field).val() == "" || Math.floor($(field).val()) != $(field).val() || !$.isNumeric($(field).val()) ||
                (non_zero && $(field).val() == 0)) {
                $(field).addClass("error");
                if(non_zero)
                    $(field).after('<div class="error-message">Value must be a non 0 integer.</div>');
                else
                    $(field).after('<div class="error-message">Value must be an integer.</div>');

                isValid = false;
            }

            return isValid;
        }

        if (!check_int(var_a, true)) {
            if (focusInput == null)
                focusInput = $(var_a);

            isValid = false;
        }

        if (!check_int(var_b, false)) {
            if (focusInput == null)
                focusInput = $(var_b);

            isValid = false;
        }

        if (!check_int(var_c, false)) {
            if (focusInput == null)
                focusInput = $(var_c);

            isValid = false;
        }

        if (!isValid)
            $(focusInput).focus();

        return isValid;
    });     
});

</script>

