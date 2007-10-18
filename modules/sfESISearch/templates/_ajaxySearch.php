<h3>Please select your address from the possible options.</h3>
<p style="width: 300px;"><b>If you do not see your address as an option</b>, try removing things like 'drive' or 'street' from your address to get more results and the results will refresh within a few seconds.<br><b>If it doesn't refresh automatically</b>, hit the "Find ESI" button to do it manually</p>
<?php include_partial('sfESISearch/form', array('address' => $address, 'zip' => $zip)); ?>

<?php echo form_tag('cc_signup/submitEsiId', array('name' => 'form2')) ?>
<div id="esi-list">
  <?php include_component('sfESISearch', 'esiTable', array('address' => $address, 'zip' => $zip)); ?>
</div>
<br>
<?php echo submit_tag('Select Service Address'); ?>
</form>