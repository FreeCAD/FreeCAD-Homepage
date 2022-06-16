<script>
    function process (select) {
        form = select.parentElement.parentElement;
        method = select.value;
        if (method == "sepa") {
            form.querySelector(".sepainfo").classList.remove("hidden");
            form.querySelector(".submit").classList.add("hidden");
        } else {
            form.querySelector(".sepainfo").classList.add("hidden");
            form.querySelector(".submit").classList.remove("hidden");
        }
    }
    
    function send (button) {
        form = button.parentElement.parentElement;
        method = form.method.value;
        amount = form.amount.value;
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
                if (Number(amount) > 99) {
                    window.location = "https://opencollective.com/freecad/contribute/sponsor-38077/checkout?amount="+amount;
                } else {
                    window.location = "https://opencollective.com/freecad/contribute/backer-38077/checkout?amount="+amount;
                }
            } else {
                window.location = "https://opencollective.com/freecad/donate?amount="+amount;
            }
        } else if (method == "paypal") {
            window.location = "https://www.paypal.com/donate/?hosted_button_id=M3Z8BGW6DB69Q";
        }
    }
</script>
    
<form id="<?php echo $formid; ?>" class="donation">
    <fieldset>
      <label for="amount">Amount:</label>
      <input name="amount" type="text" placeholder="5.00" autofocus />
      <select id="currency" name="currency">
             <option value="usd" selected>USD</option>
             <!--<option value="eur">EUR</option>-->
      </select>
      <br/>
      <label for="method">Donation method:</label>
      <select id="method" name="method" onClick="process(this)">
             <option value="null" selected>Please choose...</option>
             <option value="sepa">SEPA bank transfer</option>
             <option value="paypal">Credit card/Paypal</option>
             <option value="github">Github sponsoring</option>
             <option value="opencollective">OpenCollective</option>
      </select>
      <br/>
      <input type="Button" value="Submit" class="submit" onCLick="send(this)" />
      <div class="sepainfo hidden">
          <b>SEPA Information</b><br/>
          Please set up your SEPA bank transfer to:<br/>
          The FreeCAD project association<br/>
          IBAN: <b>BE04 0019 2896 4531</b><br/>
          BIC/SWIFT code: GEBABEBBXXX<br/>
          Bank agency: BNP Paribas Fortis<br/>
          Address: Rue de la Station 64, 1360 Perwez, Belgium<br/>
          Please inform your forum name or twitter handle as note 
          in your transfer, or 
          <a href="mailto:fpa@freecad.org" class="badge badge-light">reach to us</a>
          , so we can give you proper credits!
      </div>
    </fieldset>
</form>
