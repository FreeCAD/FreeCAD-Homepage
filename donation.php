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
    var presetsRadios = document.getElementById("presets");
    var methodSelect = document.getElementById("method");
    var sepainfo = document.getElementById("sepainfo");
    var stripeinfo = document.getElementById("stripeinfo");
    var submitButton = document.getElementById("submit");
    var amountInput = document.getElementById("amount");
    var donateModal = document.getElementById('donateModal');
    var donationInfo = document.getElementById("donationInfo");
    var sponsorInfo = document.getElementById("sponsorInfo");
    var presetValues = {
        "preset5": "5.00",
        "preset10": "10.00",
        "preset25": "25.00",
        "preset100": "100.00",
        "preset200": "200.00"
    };

    function methodProcess(method) {
        if (method == "sepa") {
            sepainfo.classList.remove("hidden");
            submitButton.classList.add("disabled");
            stripeinfo.classList.add("hidden");
        }else if(method == "stripe" && type == "sponsor") {
            sepainfo.classList.add("hidden");
            submitButton.classList.add("disabled");
            stripeinfo.classList.remove("hidden");
        }else if(method == "null") {
            sepainfo.classList.add("hidden");
            submitButton.classList.add("disabled");
            stripeinfo.classList.add("hidden");
        }else {
            sepainfo.classList.add("hidden");
            submitButton.classList.remove("disabled");
            stripeinfo.classList.add("hidden");
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

    function presetProcess(preset) {
        if (preset === "other") {
            amountInput.value = "";
            amountInput.focus();
        } else {
            amountInput.value = preset;
        }
    }

    function amountProcess(amount) {
        var numericAmount = parseFloat(amount.trim()).toFixed(2);
        var matchedPreset = Object.keys(presetValues).find(key => presetValues[key] === numericAmount);

        if (matchedPreset) {
            document.getElementById(matchedPreset).checked = true;
        } else {
            document.getElementById("presetother").checked = true;
        }
    }
    function showAccordion(amount) {
        amount = parseFloat(amount);

        var accordions = document.querySelectorAll('.accordion-collapse');
        accordions.forEach(accordion => {
            new bootstrap.Collapse(accordion, { toggle: false }).hide();
        });

        var targetAccordion = null;

        if (amount >= 25 && amount < 100) {
            targetAccordion = document.getElementById('collapseBronze');
        } else if (amount >= 100 && amount < 200) {
            targetAccordion = document.getElementById('collapseSilver');
        } else if (amount >= 200) {
            targetAccordion = document.getElementById('collapseGold');
        } else {
            targetAccordion = document.getElementById('collapseNormal');
        }

        if (targetAccordion) {
            new bootstrap.Collapse(targetAccordion).show();
        }
    }


    var type = document.querySelector('input[name="type"]:checked').id;
    var preset = document.querySelector('input[name="preset"]:checked').id;
    var method = methodSelect.value;
    var amount = amountInput.value;

    methodProcess(method);
    typeProcess(type);
    amountProcess(amount);
    showAccordion(amount)


    typesRadios.addEventListener("change", function() {
        type = document.querySelector('input[name="type"]:checked').id;
        if (type == "sponsor") {
            sponsorInfo.classList.remove("hidden");
            donationInfo.classList.add("hidden");
        } else {
            sponsorInfo.classList.add("hidden");
            donationInfo.classList.remove("hidden");
        }
        methodProcess(method);


    });

    presetsRadios.addEventListener("change", function () {
        var selectedPreset = document.querySelector("input[name='preset']:checked");
        var preset;

        if (selectedPreset.id === "presetother") {
            preset = "other";
        } else {
            preset = presetValues[selectedPreset.id];
            amount = preset;
        }

        presetProcess(preset);
        showAccordion(preset)
    });

    methodSelect.addEventListener('change', function() {
        method = methodSelect.value;
        methodProcess(method);
    });

    amountInput.addEventListener("input", function() {
        amount = amountInput.value;
        if (amount == "") {
            if (amount === "" || isNaN(amount)) {
                amountInput.reportValidity(); // Tarayıcının hata mesajını tetikle
                return;
            } else {
            amount = "5.00";
			}
        }
        amountProcess(amount);
		showAccordion(amount)
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
            amountProcess(amount);
            showAccordion(amount)
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
                <label class="btn btn-outline-light text-center flex-fill" for="donation"> <?php echo _('One-Time'); ?> </label>
                <input type="radio" class="btn-check" name="type" id="sponsor" autocomplete="off">
                <label class="btn btn-outline-light text-center flex-fill" for="sponsor"> <?php echo _('Monthly'); ?> </label>
              </div>
              <div role="group" aria-label="preset" id="presets" class="d-flex flex-wrap mt-3  row-cols-4 gap-2">
                <input type="radio" class="btn-check" name="preset" id="preset5" autocomplete="off" checked=>
                <label class="btn btn-outline-light text-center flex-fill col" for="preset5"> $5 </label>
                <input type="radio" class="btn-check" name="preset" id="preset10" autocomplete="off">
                <label class="btn btn-outline-light text-center flex-fill col" for="preset10"> $10 </label>
                <input type="radio" class="btn-check" name="preset" id="preset25" autocomplete="off">
                <label class="btn btn-outline-light text-center flex-fill col" for="preset25"> $25 </label>
                <input type="radio" class="btn-check" name="preset" id="preset100" autocomplete="off">
                <label class="btn btn-outline-light text-center flex-fill col" for="preset100"> $100 </label>
                <input type="radio" class="btn-check" name="preset" id="preset200" autocomplete="off">
                <label class="btn btn-outline-light text-center flex-fill col" for="preset200"> $200 </label>
                <input type="radio" class="btn-check" name="preset" id="presetother" autocomplete="off">
                <label class="btn btn-outline-light text-center flex-fill col" for="presetother"> Other </label>
              </div>
              <div class="input-group mt-3">
                <span class="input-group-text bg-dark text-light border-secondary">$</span>
                <input type="number" class="form-control bg-dark text-light border-secondary form-control-lg" name="amount" id="amount" min="0" step="0.01" value="5.00">
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
                <button class="btn btn-outline-light input-group-text" value="Submit" id="submit" type="button"> <?php echo _('Donate'); ?> </button>
              </div>
              <div class="sepainfo hidden" id="sepainfo">
                  <table class="table table-dark table-borderless">
                      <thead>
                          <tr>
                              <th colspan="2" class="fw-bold">
                                  <?php echo _('SEPA Information'); ?>
                              </th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr>
                              <td colspan="2"> <?php echo _('Please set up your SEPA bank transfer to'); ?>: </td>
                          </tr>
                          <tr>
                              <td><?php echo _('Beneficiary'); ?>:</td>
                              <td>The FreeCAD project association</td>
                          </tr>
                          <tr>
                              <td>IBAN:</td>
                              <td><b>BE04 0019 2896 4531</b></td>
                          </tr>
                          <tr>
                              <td>BIC/SWIFT:</td>
                              <td>GEBABEBBXXX</td>
                          </tr>
                          <tr>
                              <td><?php echo _('Bank agency'); ?>:</td>
                              <td>BNP Paribas Fortis</td>
                          </tr>
                          <tr>
                              <td><?php echo _('Address'); ?>:</td>
                              <td>Rue de la Station 64, 1360 Perwez, Belgium</td>
                          </tr>
                      </tbody>
                  </table>
              </div>
              <div class="stripeinfo hidden mt-3" id="stripeinfo">
                <p><?php echo _("While Stripe doesn't support monthly donations, you can still become a sponsor! Simply make a one-time donation equivalent to 12 months of support, and you'll gain access to the corresponding sponsoring tier. It's an easy and flexible way to contribute."); ?></p>
              </div>
              </div>
              <div class="col-lg-7 text-light text-center text-lg-start px-md-4 ">
              <div id="donationInfo">
                <p> <?php echo _('If you are not sure or not able to commit to a regular donation, but still want to help the project, you can do a one-time donation, of any amount.'); ?> </p>
                <p> <?php echo _('Choose freely the amount you wish to donate one time only.'); ?> </p>
              </div>
              <div id="sponsorInfo" class="hidden">
                <p> <?php echo _('You can support FreeCAD by sponsoring it as an individual or organization through various platforms. Sponsorship provides a steady income for developers, allowing the FPA to plan ahead and enabling greater investment in FreeCAD. To encourage sponsorship, we offer different tiers, and unless you choose to remain anonymous, your name or company logo will be featured on our website accordingly.'); ?> </p>
                <div class="accordion accordion-dark bg-dark text-white" id="sponsorAccordion">
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="headingNormal">
                      <button class="accordion-button text-white bg-dark border-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNormal" aria-expanded="true" aria-controls="collapseNormal"> ♥ <b class="normal"> <?php echo _('Normal sponsor'); ?> </b>
                      </button>
                    </h2>
                    <div id="collapseNormal" class="accordion-collapse collapse show" aria-labelledby="headingNormal" data-bs-parent="#sponsorAccordion">
                      <div class="accordion-body"> <?php echo _('from 1 USD / 1 EUR per month. You will not have your name displayed here, but you will have helped the project a lot anyway. Together, normal sponsors maintain the project on its feet as much as the bigger sponsors.'); ?> </div>
                    </div>
                  </div>
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="headingBronze">
                      <button class="accordion-button text-white bg-dark border-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBronze" aria-expanded="false" aria-controls="collapseBronze"> 🥉 <b class="bronze"> <?php echo _('Bronze sponsor'); ?> </b>
                      </button>
                    </h2>
                    <div id="collapseBronze" class="accordion-collapse collapse" aria-labelledby="headingBronze" data-bs-parent="#sponsorAccordion">
                      <div class="accordion-body"> <?php echo _('from 25 USD / 25 EUR per month. Your name or company name is displayed on this page.'); ?> </div>
                    </div>
                  </div>
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="headingSilver">
                      <button class="accordion-button text-white bg-dark border-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSilver" aria-expanded="false" aria-controls="collapseSilver"> 🥈 <b class="silver"> <?php echo _('Silver sponsor'); ?> </b>
                      </button>
                    </h2>
                    <div id="collapseSilver" class="accordion-collapse collapse" aria-labelledby="headingSilver" data-bs-parent="#sponsorAccordion">
                      <div class="accordion-body"> <?php echo _('from 100 USD / 100 EUR per month. Your name or company name is displayed on this page, with a link to your website, and a one-line description text.'); ?> </div>
                    </div>
                  </div>
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="headingGold">
                      <button class="accordion-button text-white bg-dark border-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapseGold" aria-expanded="false" aria-controls="collapseGold"> 🥇 <b class="gold"> <?php echo _('Gold sponsor'); ?> </b>
                      </button>
                    </h2>
                    <div id="collapseGold" class="accordion-collapse collapse" aria-labelledby="headingGold" data-bs-parent="#sponsorAccordion">
                      <div class="accordion-body"> <?php echo _('from 200 USD / 200 EUR per month. Your name or company name and logo displayed on this page, with a link to your website and a custom description text. Companies that have helped FreeCAD early on also appear under Gold sponsors.'); ?> </div>
                    </div>
                  </div>
                </div>
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
