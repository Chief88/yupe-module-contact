<?php if(!empty($contacts)): ?>

    <div class="address-header " itemscope itemtype="http://schema.org/PostalAddress">
        <?php print $contacts[0]->data; ?>
    </div>

<? endif; ?>