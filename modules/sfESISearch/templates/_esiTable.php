<?php if ( !empty($results) && array_key_exists('error_message', $results) ): ?>
<?php echo "<b>".$results['error_message']."</pre>"; ?>
<?php elseif ( empty( $results ) ): ?>
<b>No Results Found for Your Search</b>
<?php else: ?>
<form>
	<table>
		<tr>
			<th></th>
			<th>ESI ID</th>
			<th>Street</th>
			<th>City</th>
			<th>State</th>
			<th>Zip</th>
			<th>Type</th>
			<th>Active?</th>
			<th>TDSP</th>
		<?php $test = true; foreach ( $results as $result ) {  ?>
			</tr><tr>
			<td><?php echo radiobutton_tag('esiID', $result['esiid'], $test )?></td>
			<td><?php echo $result['esiid'] ?></td>
			<td><?php echo $result['address'] ?></td>
			<td><?php echo $result['city'] ?></td>
			<td><?php echo $result['state'] ?></td>
			<td><?php echo $result['zip'] ?></td>
			<td><?php echo $result['premise_type'] ?></td>
			<td><?php echo $result['status']; ?></td>
			<td><?php echo $result['tdsp_name']; ?></td>
		<?php $test = false; } ?>
		</tr>
	</table>
</form>
<?php endif; ?>