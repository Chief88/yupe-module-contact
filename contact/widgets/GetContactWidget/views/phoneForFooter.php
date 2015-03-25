<?php if(!empty($contacts)): ?>

   <?php $phone = '';
    foreach($contacts as $i =>$contact){
        $phone .= $contact->data;

        if($i + 1 < count($contacts)){
            $phone .= ', ';
        }
    }

    print $phone; ?>

<?php endif; ?>