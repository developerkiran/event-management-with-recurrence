<table>
    <tr>
       <td colspan="2">
          <strong>Event View Page</strong>
      </td>
  </tr>
  <tr>
    <td>
        <?php echo $event_details->event_title; ?>
    </td>
</tr>
<tr>
    <td>

    </td>
    <td>
        <table border=1>
            <tr>
                <td>
                    Date
                </td>
                <td style="width: 100px">
                    Day Name
                </td>
            </tr>

            <tbody>
                <?php 
                foreach ($event_days as $value) {?>
                <tr>
                    <td><?php echo $value->date; ?></td>
                    <td><?php echo $value->days; ?></td>
                </tr>
            <?php } ?>
            </tbody>
                

        </table>
    </td>
</tr>
<tr>
    <td>

    </td>
    <td>
     Total Recurrence Event: <?php echo $event_details->event_recurrence; ?>
 </td>
</tr>
</table>
<a href="<?php echo base_url('welcome');?>">Back to event list</a>