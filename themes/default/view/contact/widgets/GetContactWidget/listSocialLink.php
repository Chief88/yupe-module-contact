<?php if(!empty($contacts)): ?>

        <?php $list = '';
        if( isset($params['wrapper']) && !empty($params['wrapper']) ){
            $wrapper = $params['wrapper'];
            $wrapperHtmlOptions = [];
            if( isset($params['wrapperHtmlOptions']) && !empty($params['wrapperHtmlOptions']) ){
                $wrapperHtmlOptions = $params['wrapperHtmlOptions'];
            }

            $wrapperHtmlOptionsString = '';
            foreach($wrapperHtmlOptions as $key => $option ){
                $wrapperHtmlOptionsString .= $key.'=\''.$option.'\' ';
            }

        }

        foreach($contacts as $i =>$contact){

            $image = !empty($contact->image) ? '<img src="'. $contact->getImageUrl() .'" alt="" />' : '';

            $list .= isset($wrapper) ?
                '<'. $wrapper .' '. $wrapperHtmlOptionsString .'>'.
                '<a href="'. $contact->data .'" class="classic" target="_blank">'. $image . $contact->name .'</a>'.
                '</'.$wrapper.'>' :
                '<a href="'. $contact->data .'" class="classic" target="_blank">'.$image . $contact->name .'</a>';

            if($i + 1 < count($contacts)){
                $list .= $itemDelimiter;
            }
        }
        echo $list; ?>

<?php endif; ?>