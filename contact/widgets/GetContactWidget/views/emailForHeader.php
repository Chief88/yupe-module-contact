<?php if(!empty($contacts)): ?>

        <?php $email = '';
        foreach($contacts as $i =>$contact){
            $email .= '<a href="mailto:'.$contact->data.'">'.$contact->data.'</a>';

            if($i + 1 < count($contacts)){
                $email .= ', ';
            }
        }

        print $email; ?>

<?php endif; ?>