<?php if(!empty($contacts)):{ ?>

    <ul class="footer__social">

        <?php foreach($contacts as $contact):{ ?>
            <li>
                <a href="<?= $contact->data; ?>" target="_blank">
                    <img src="<?= $contact->getImageUrl(); ?>" alt="" />
                </a>
            </li>
        <?php }endforeach; ?>

    </ul>

<?php }endif; ?>