<?php if(!empty($contacts)): ?>

    <?php $emailMeta = '';
    foreach($contacts as $i =>$contact){
        $emailMeta .= '<meta itemprop="email" content="'.$contact->data.'"/>';
    }

    print $emailMeta; ?>

<?php endif; ?>