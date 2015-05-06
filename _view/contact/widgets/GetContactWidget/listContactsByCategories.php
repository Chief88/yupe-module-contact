<?php if(!empty($contacts)):{
    $categories = [];

    foreach($contacts as $contact){
        $categories[$contact->category->name][] = $contact;
    } ?>

    <?php foreach($categories as $nameCategory => $contacts):{ ?>

        <li>
            <div class="title"><?= $nameCategory; ?></div>
            <?php $this->widget('application.modules.contact.widgets.GetContactWidget', [
                'nameContact' => 'Телефон',
                'categoryId' => $contacts[0]->category->id,
                'itemDelimiter' => ', ',
                'params' => [
                    'itemsWrapper' => 'div',
                    'htmlOptions' => [
                        'class' => 'phone'
                    ]
                ]
            ]); ?>
            <?php $this->widget('application.modules.contact.widgets.GetContactWidget', [
                'nameContact' => 'E-mail',
                'categoryId' => $contacts[0]->category->id,
                'itemDelimiter' => ', ',
                'params' => [
                    'itemsWrapper' => 'div',
                    'htmlOptions' => [
                        'class' => 'email'
                    ]
                ]
            ]); ?>
        </li>

    <?php }endforeach; ?>

<?php }endif; ?>