<?php if(!empty($contacts)): ?>

        <?php $list = '';
        foreach($contacts as $i =>$contact){
            $list .= '<a href="mailto:'.$contact->data.'">'.$contact->data.'</a>';

            if($i + 1 < count($contacts)){
                $list .= $itemDelimiter.' ';
            }
        }
        print $list; ?>

<?php endif; ?>