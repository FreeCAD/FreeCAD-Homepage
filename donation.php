<script>
function send(type, method, amount) {
    if (method == "github") {
        if (type == "sponsor") {
            window.location = "https://github.com/sponsors/FreeCAD?frequency=recurring&amount=" + amount;
        } else {
            window.location = "https://github.com/sponsors/FreeCAD?frequency=one-time&amount=" + amount;
        }
    } else if (method == "opencollective") {
        if (type == "sponsor") {
            window.location = "https://opencollective.com/freecad/donate?interval=month&amount=" + amount;
        } else {
            window.location = "https://opencollective.com/freecad/donate?interval=oneTime&amount=" + amount;
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

document.addEventListener('DOMContentLoaded', function() {

    var typesRadios = document.getElementById("types");
    var methodSelect = document.getElementById("method");
    var sepainfo = document.getElementById("sepainfo");
    var submitButton = document.getElementById("submit");
    var amountInput = document.getElementById("amount");
    var donateModal = document.getElementById('donateModal');
    var donationInfo = document.getElementById("donationInfo");
    var sponsorInfo = document.getElementById("sponsorInfo");


    function methodProcess(method) {
        if (method == "sepa") {
            sepainfo.classList.remove("hidden");
            submitButton.classList.add("disabled");
        } else {
            sepainfo.classList.add("hidden");
            submitButton.classList.remove("disabled");
        }
    }

    function typeProcess(type) {
        if (type == "sponsor") {
            sponsorInfo.classList.remove("hidden");
            donationInfo.classList.add("hidden");
        } else {
            sponsorInfo.classList.add("hidden");
            donationInfo.classList.remove("hidden");
        }
    }


    var type = document.querySelector('input[name="type"]:checked').id;
    var method = methodSelect.value;
    var amount = amountInput.value;

    methodProcess(method);
    typeProcess(type);


    typesRadios.addEventListener("change", function() {
        type = document.querySelector('input[name="type"]:checked').id;
        if (type == "sponsor") {
            sponsorInfo.classList.remove("hidden");
            donationInfo.classList.add("hidden");
        } else {
            sponsorInfo.classList.add("hidden");
            donationInfo.classList.remove("hidden");
        }


    });

    methodSelect.addEventListener('change', function() {
        method = methodSelect.value;
        methodProcess(method);
    });

    amountInput.addEventListener("input", function() {
        amount = amountInput.value;
        if (amount == "") {
            amount = "5";
        }
    });

    submitButton.addEventListener('click', function() {
        send(type, method, amount);
    });

    donateModal.addEventListener('show.bs.modal', function(event) {
        var modalToogle = event.relatedTarget;
        var typeAttribute = modalToogle.getAttribute('data-bs-type');
        var amountAttribute = modalToogle.getAttribute('data-bs-amount');
        var methodAttribute = modalToogle.getAttribute('data-bs-method');
        if (typeAttribute) {
            document.getElementById(typeAttribute).checked = true;
            type = typeAttribute;
            typeProcess(type);
        }
        if (amountAttribute) {
            amountInput.value = amountAttribute;
            amount = amountAttribute;
        }
        if (methodAttribute) {
            methodSelect.value = methodAttribute;
            method = methodAttribute;
            methodProcess(method);
        }
    });
});
</script>
<!-- Modal -->
<div class="modal fade" id="donateModal" tabindex="-1">
  <div class="modal-dialog modal-xl">
    <div class="modal-content bg-dark">
      <div class="modal-header border-secondary">
        <h1 class="modal-title fs-5" id="donateModalLabel"> <?php echo _('Donate'); ?> </h1>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-5 mb-3">
              <div class="btn-group d-flex flex-wrap" role="group" aria-label="type" id="types">
                <input type="radio" class="btn-check" name="type" id="donation" autocomplete="off" checked>
                <label class="btn btn-outline-light text-center flex-fill" for="donation"> <?php echo _('Donation'); ?> </label>
                <input type="radio" class="btn-check" name="type" id="sponsor" autocomplete="off">
                <label class="btn btn-outline-light text-center flex-fill" for="sponsor"> <?php echo _('Sponsor'); ?> </label>
              </div>
              <div class="input-group mt-3">
                <span class="input-group-text bg-dark text-light border-secondary">$</span>
                <input type="text" class="form-control bg-dark text-light border-secondary form-control-lg" name="amount" id="amount" type="text" value="5.00">
              </div>
              <div class="input-group mt-3">
                <select class="form-select bg-dark text-light border-secondary" id="method" name="method">
                  <option value="null" selected> <?php echo _('Please choose'); ?>... </option>
                  <option value="sepa" title="<?php echo _('Direct SEPA bank transfer using your own bank apps'); ?>"> <?php echo _('SEPA bank transfer'); ?> </option>
                  <option value="stripe" title="<?php echo _('Credit card payment via Stripe'); ?>"> <?php echo _('Credit card (Stripe)'); ?> </option>
                  <option value="paypal" title="<?php echo _('Paypal allows to donate using your Paypal account, or a credit card') ?>"> <?php echo _('Paypal'); ?> </option>
                  <option value="github" title="<?php echo _('GitHub allows you to sponsor your favorite projects using your GitHub account, and a credit card') ?>"> <?php echo _('GitHub'); ?> </option>
                  <option value="opencollective" title="<?php echo _('OpenCollective acts as a fiscal host for open-source projects. You can donate with a credit card or bank account. OpenCollective is a 501(c)3 org and provides tax deduction in the US.') ?>"> <?php echo _('OpenCollective (501(c)3)'); ?> </option>
                </select>
                <button class="btn btn-outline-light input-group-text" value="Submit" id="submit" type="button"> <?php echo _('Submit'); ?> </button>
              </div>
              <div class="sepainfo hidden" id="sepainfo">
                <b> <?php echo _('SEPA Information'); ?> </b>
                <br /> <?php echo _('Please set up your SEPA bank transfer to'); ?>: <br /> The FreeCAD project association <br /> IBAN: <b>BE04 0019 2896 4531</b>
                <br /> BIC/SWIFT code: GEBABEBBXXX <br /> <?php echo _('Bank agency'); ?>: BNP Paribas Fortis <br /> <?php echo _('Address'); ?>: Rue de la Station 64, 1360 Perwez, Belgium <br />
              </div>
            </div>
            <div class="col-lg-7 text-light text-center text-lg-start px-md-4 ">
              <div id="donationInfo">
                <p> <?php echo _('If you are not sure or not able to commit to a regular donation, but still want to help the project, you can do a one-time donation, of any amount.'); ?> </p>
                <p> <?php echo _('Choose freely the amount you wish to donate one time only.'); ?> </p>
              </div>
              <div id="sponsorInfo" class="hidden">
                <p> <?php echo _('We call sponsoring the act of donating money recurrently to the FreeCAD project. You can do that as an individual or as a company or institution, through different channels or platforms, depending on your preferences.'); ?> </p>
                <p> <?php echo _('Sponsoring FreeCAD allows its developers to count on a steady flow of income, so it allows the FPA to plan things ahead, and the FreeCAD developers to invest themselves more seriously into FreeCAD.'); ?> </p>
                <p> <?php echo _('To encourage persons and companies to sponsor the FreeCAD project, we have created different sponsoring tiers. When donating regularly to the project, unless you prefer to stay anonymous, your name, company name and/or logo will be featured on this website, depending on the tier you fit into:'); ?> </p>
                <ul class="sponsortitle">
                  <li>♥ <b class="normal"> <?php echo _('Normal sponsor'); ?> </b>: <?php echo _('from 1 USD / 1 EUR per month. You will not have your name displayed here, but you will have helped the project a lot anyway. Together, normal sponsors maintain the project on its feet as much as the bigger sponsors.'); ?> </li>
                  <li>
                    <b class="bronze">🥉 <?php echo _('Bronze sponsor'); ?> </b>: <?php echo _('from 25 USD / 25 EUR per month. Your name or company name is displayed on this page.'); ?>
                  </li>
                  <li>
                    <b class="silver">🥈 <?php echo _('Silver sponsor'); ?> </b>: <?php echo _('from 100 USD / 100 EUR per month. Your name or company name is displayed on this page, with a link to your website, and a one-line description text.'); ?>
                  </li>
                  <li>
                    <b class="gold">🥇 <?php echo _('Gold sponsor'); ?> </b>: <?php echo _('from 200 USD / 200 EUR per month. Your name or company name and logo displayed on this page, with a link to your website and a custom description text. Companies that have helped FreeCAD early on also appear under Gold sponsors.'); ?>
                  </li>
                </ul>
                <p> <?php echo _("Instead of donating each month, you might find it more comfortable to make a one-time donation that, when divided by twelve, would give you right to enter a sponsoring tier. Don't hesitate to do so!"); ?> </p>
                <p> <?php echo _('Choose freely the amount you wish to donate each month.'); ?> </p>
                <p> <?php echo _('Please inform your forum name or twitter handle as a notein your transfer, or <a href=mailto:fpa@freecad.org>reach to us</a>, so we can give you proper credits!'); ?> </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
