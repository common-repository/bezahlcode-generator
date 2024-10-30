<div id="BezahlCodeWidget">
<h3>BezahlCode-Generator</h3>
<div id="bezahlcodeimage"></div><br/>
<form action="" name="wizard" method="post" class="BezahlCodeForm">

<label for="singlepayment"><input type="radio" id="singlepayment" name="gen_type" value="singlepayment" <?php if($_REQUEST['gen_type']=="singlepayment" || empty($_REQUEST['gen_type'])) echo 'checked="checked"'?> /> &Uuml;berweisung</label><br />
<label for="singlepaymentspende"><input type="radio" id="singlepaymentspende" name="gen_type" value="singlepaymentspende" <?php if($_REQUEST['gen_type']=="singlepaymentspende") echo 'checked="checked"'?>/> Spendenzahlung</label><br />
<label for="singledirectdebit"><input type="radio" id="singledirectdebit" name="gen_type" value="singledirectdebit" <?php if($_REQUEST['gen_type']=="singledirectdebit") echo 'checked="checked"'?>/> Lastschrift</label><br />
<label for="singlepaymentsepa"><input type="radio" id="singlepaymentsepa" name="gen_type" value="singlepaymentsepa" <?php if($_REQUEST['gen_type']=="singlepaymentsepa") echo 'checked="checked"'?>/> SEPA-&Uuml;berweisung</label><br />
<label for="contact_v2"><input type="radio" id="contact_v2" name="gen_type" value="contact_v2" <?php if($_REQUEST['gen_type']=="contact_v2") echo 'checked="checked"'?>/> Kontakt</label><br />


Name:<br /><input type="text" tooltipText="Format: DTAUS Text" id="gen_name" onblur="checkInput(this, 'dtaus')" name="gen_name" maxlength="27" value="<?= isset($_REQUEST['gen_name'])?htmlspecialchars($_REQUEST['gen_name']):""?>">
<br />
Kontonummer:<br /><input type="text" tooltipText="Format: Ganzzahl z.B. 1234" id="gen_account" onblur="checkInput(this, 'ganzzahl')" name="gen_account" value="<?= isset($_REQUEST['gen_account'])?htmlspecialchars($_REQUEST['gen_account']):""?>" >
<br />
BLZ:<br /><input type="text" tooltipText="Format: Ganzzahl z.B. 1234" id="gen_BNC" onblur="checkInput(this, 'ganzzahl')" name="gen_BNC" value="<?= isset($_REQUEST['gen_BNC'])?htmlspecialchars($_REQUEST['gen_BNC']):""?>" >
<br />
IBAN:<br /><input type="text" tooltipText="Format: 0-9 und A-Z" id="gen_IBAN" onblur="checkInput(this, 'ibanundbic')" name="gen_IBAN" value="<?= isset($_REQUEST['gen_IBAN'])?htmlspecialchars($_REQUEST['gen_IBAN']):""?>" >
<br />
BIC:<br /><input type="text" tooltipText="Format: 0-9 und A-Z" id="gen_BIC" onblur="checkInput(this, 'ibanundbic')" name="gen_BIC" value="<?= isset($_REQUEST['gen_BIC'])?htmlspecialchars($_REQUEST['gen_BIC']):""?>" >
<br />
Betrag in Euro (z.B. 1234,50) <br /><input type="text" tooltipText="Format: Dezimalzahl z.B. 1234,50" onblur="checkInput(this, 'dezimalzahl')" id="gen_amount" name="gen_amount" value="<?= isset($_REQUEST['gen_amount'])?htmlspecialchars($_REQUEST['gen_amount']):""?>" >
<br />
Verwendungszweck:<br /><input type="text" id="gen_reason" tooltipText="Format: DTAUS Text" onblur="checkInput(this, 'dtaus')" name="gen_reason" maxlength="54" value="<?= isset($_REQUEST['gen_reason'])?htmlspecialchars($_REQUEST['gen_reason']):""?>" >
<br/><br/>
<input type="button" id="generateButton" value="Erstellen">
</form>
<?php if(!(get_option("bezahlcode_showlink") == "hidden")) {	?>
<br />
<span class="bezahlCodeLink">Weitere Informationen: <a href="http://www.bezahlcode.de" title="BezahlCode - Schnell, einfach und sicher bezahlen" target="_blank">www.bezahlcode.de</a></span>
<?php } ?>
</div>

<script type="text/javascript">
var tooltipObj = new DHTMLgoodies_formTooltip();
tooltipObj.initFormFieldTooltip();
</script>