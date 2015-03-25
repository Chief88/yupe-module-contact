<?php if(!empty($contacts)):{ ?>

    <?php foreach($contacts as $i =>$contact):{
        if( !empty($contact->category) ):{
            ($i+1) == count($contacts) ? $br = '': $br = '<br/><br/>';?>

        <?php echo $contact->category->name; ?><br/>
        <span class="bc-num2">
                <?php echo $contact->data; ?>
        </span><?php echo $br; ?>

    <?php }endif; }endforeach; ?>

<?php }endif; ?>