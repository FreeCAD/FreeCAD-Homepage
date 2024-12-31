<script>
    function process (form,method) {
        if (method == "sepa") {
            form.querySelector(".sepainfo").classList.remove("hidden");
            form.querySelector(".submit").classList.add("hidden");
        } else {
            form.querySelector(".sepainfo").classList.add("hidden");
            form.querySelector(".submit").classList.remove("hidden");
        }
    }

    function send (form, method, amount) {
        if (amount == "") {
            amount = "5";
        }
        type = form.getAttribute('id');
        if (method == "github") {
            if (type == "sponsor") {
                window.location = "https://github.com/sponsors/FreeCAD?frequency=recurring&amount="+amount;
            } else {
                window.location = "https://github.com/sponsors/FreeCAD?frequency=one-time&amount="+amount;
            }
        } else if (method == "opencollective") {
            if (type == "sponsor") {
                window.location = "https://opencollective.com/freecad/donate?interval=month&amount="+amount;
            } else {
                window.location = "https://opencollective.com/freecad/donate?interval=oneTime&amount="+amount;
            }
        } else if (method == "paypal") {
            window.location = "https://www.paypal.com/donate/?hosted_button_id=M3Z8BGW6DB69Q";
        } else if (method == "stripe") {
            // window.location = "https://buy.stripe.com/fZe0263vA809dpu5kk";
            window.location = "https://donate.stripe.com/14k3ei9TYgwFclq145";
            //key = 'pk_live_51LBbBhG41gbfoxVMdipYZmLiMEFcvny3hRbWLp6uJ3JrTNEelJgZiPcSeQZLYaubp4FsmNj5ErUzaNdgzAnFLoJZ00sJo45QgI'
            //stripe.redirectToCheckout({
            //    items: [{
            //        sku: 'price_1LMtrnG41gbfoxVMqiuZsJg4',
            //        quantity: amount,
            //    }],
            //    successUrl: 'https://example.com/success',
            //    cancelUrl: 'https://example.com/cancel',
            //});
        }
    }
    document.addEventListener('DOMContentLoaded', function () {
        var methodselects = document.querySelectorAll('.method');
        methodselects.forEach(function (select) {
            select.addEventListener('change', function () {
                var form = select.parentElement.parentElement;
                var method = select.value;
                process(form, method);
            });
        });

        var submitButtons = document.querySelectorAll('.submit');
        submitButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                var form = button.parentElement.parentElement;
                var method = form.method.value;
                var amount = form.amount.value;
                send(form, method, amount);
            });
        });
    });
</script>

<!--<script src="https://js.stripe.com/v3/"></script>-->

<form id="<?php echo $formid; ?>" class="donation">
    <fieldset>
      <label for="amount"><?php echo _('Amount'); ?>:</label>
      <input name="amount" type="text" placeholder="5.00" />
      <select class="currency" name="currency">
             <option value="usd" selected>USD</option>
             <!--<option value="eur">EUR</option>-->
      </select>
      <br/>
      <br/>
      <label for="method"><?php echo _('Donation method'); ?>:</label>
      <select class="method" name="method">
             <option value="null" selected><?php echo _('Please choose'); ?>...</option>
             <option value="sepa" title="<?php echo _('Direct SEPA bank transfer using your own bank apps'); ?>"><?php echo _('SEPA bank transfer'); ?></option>
             <option value="stripe" title="<?php echo _('Credit card payment via Stripe'); ?>"><?php echo _('Credit card (Stripe)'); ?></option>
             <option value="paypal" title="<?php echo _('Paypal allows to donate using your Paypal account, or a credit card') ?>"><?php echo _('Paypal'); ?></option>
             <option value="github" title="<?php echo _('GitHub allows you to sponsor your favorite projects using your GitHub account, and a credit card') ?>"><?php echo _('GitHub'); ?></option>
             <option value="opencollective" title="<?php echo _('OpenCollective acts as a fiscal host for open-source projects. You can donate with a credit card or bank account. OpenCollective is a 501(c)3 org and provides tax deduction in the US.') ?>"><?php echo _('OpenCollective (501(c)3)'); ?></option>
      </select>
      <br/>
      <br/>
      <div class="sepainfo hidden">
          <b><?php echo _('SEPA Information'); ?></b><br/>
          <?php echo _('Please set up your SEPA bank transfer to'); ?>:<br/>
          The FreeCAD project association<br/>
          IBAN: <b>BE04 0019 2896 4531</b><br/>
          BIC/SWIFT code: GEBABEBBXXX<br/>
          <?php echo _('Bank agency'); ?>: BNP Paribas Fortis<br/>
          <?php echo _('Address'); ?>: Rue de la Station 64, 1360 Perwez, Belgium<br/>
      </div>
      <input type="Button" value="<?php echo _('Submit'); ?>" class="submit"/>
      <br/>
      <?php echo _('More information about the different donation methods and options on the
      <a href=https://wiki.freecad.org/donate>donations</a> page.'); ?>
    </fieldset>
</form>
