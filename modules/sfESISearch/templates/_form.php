<?php use_helper('Javascript'); ?>

<?php 
 echo form_tag('@signup_esiid', array('name' => 'esi_form', 'id' => 'esi-form')); 
?>
<?php echo input_hidden_tag('hiddenfield', 1); ?>
<p>
	<?php
	echo label_for( 'address', 'Address: ' );
	echo input_tag( 'address', $address );
?></p><p><?
	echo label_for( 'zip', 'Zip: ' );
	echo input_tag( 'zip', $zip );
?></p>
<br>
<?php 
echo submit_tag( 'Find ESI'); 
?>
</form>

<?php echo observe_form('esi-form', 
  array('frequency' => 2,
  'method' => 'post',
  'update' => 'esi-list',
  'url' => 'sfESISearch/findByAddress', 
  'with' => "'address=' + document.esi_form.address.value + '&zip=' + document.esi_form.zip.value +'&time=' + Math.random()*1000"));