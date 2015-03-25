<?php if(!empty($contacts)): ?>

        <?php $list = '';
        foreach($contacts as $i =>$contact){
            $list .= $contact->data;

            if($i + 1 < count($contacts)){
                $list .= ', ';
            }
        }

        print $list; ?>

<?php endif; ?>