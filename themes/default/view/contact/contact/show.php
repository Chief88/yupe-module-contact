<?php if (!empty($category)) {
    $this->description = !empty($category->seo_description) ? $category->seo_description : $this->description;
    $this->keywords = !empty($category->seo_keywords) ? $category->seo_keywords : $this->keywords;
    $this->pageTitle = !empty($category->page_title) ? $category->page_title : $this->pageTitle;
} ?>

<div class="content">

    <?php if (empty($contacts)): { ?>
        <p class="alert alert-info">
            Для данного города не добавлены контакты!
        </p>
    <?php } else: { ?>

        <div class="patern-container">
            <h1>Контакты Мегагрупп.ру в городе <?php echo $category->name; ?></h1>
        </div>

        <div>
            <span style="color: #f00; font-weight: bold;">
                19 декабря прием посетителей в офисе ограничен!
            </span>
        </div>
        <div style="margin-bottom: 20px;">
            Просим вас заранее согласовать время вашего визита с секретарем.
        </div>

        <div class="contacts-page">
            <div class="vcard" itemscope="" itemtype="http://schema.org/Organization">
                <div class="block-contacts-title">
                    <span class="fn org" itemprop="name">Веб-студия Megagroup.ru</span>
                </div>
                <div class="block-contacts-link">
                    <a href="/contacts">Офисы в других городах</a>
                </div>
                <div class="block-contacts block-contacts-address adr">Адрес:<br/>
                    <span itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress">
                        <span class="postal-code" itemprop="postalCode">127051</span>,
                        <span class="country-name" itemprop="addressCountry">Россия</span>,
                        <span class="locality" itemprop="addressLocality">Москва</span>,
                        <span class="street-address" itemprop="streetAddress">Цветной бульвар, д. 11, стр. 6</span>,
                        <span class="extended-address">офис 406</span>
                    </span>.
                </div>
                <div class="block-contacts block-contacts-metro-msk">Метро:<br/>
                    <ul class="metro msk">
                        <li class="icn1">м. Цветной Бульвар</li>
                        <li class="icn2">м. Трубная</li>
                    </ul>
                </div>
                <div class="block-contacts block-contacts-phone tel">Телефон:<br/> <span
                        class="bc-num"><abbr itemprop="telephone">+7 (499) 705-30-10</abbr></span>
                </div>
                <div class="block-contacts block-contacts-clock">понедельник-пятница<br/> <span
                        class="bc-num">9:30 - 18:00</span></div>
                <hr/>
                <div class="block-contacts block-contacts-info">Просим вас заранее согласовать дату
                    и время вашего визита с секретарем.<br/>Это значительно сократит время вашего
                    ожидания!<br/><br/> Обслуживание клиентов в офисе до 17.30
                </div>
                <hr/>
                <div class="block-contacts block-contacts-mes">Есть вопросы?<br/> <a
                        href="mail.html">Напишите нам</a></div>
                <div class="block-contacts block-contacts-email">E-mail:<br/> <span
                        itemprop="email"><a href="mailto:support@megagroup.ru" class="email">
                            support@megagroup.ru </a></span></div>
            </div>
            <script charset="utf-8"
                    src="http://api-maps.yandex.ru/services/constructor/1.0/js/?sid=OnuWOm_lFfauDYuSQPDCOZa2dv9ogqDm&amp;width=680&amp;height=380"
                    type="text/javascript"></script>
            <!--noindex--> <br/>

            <p style="text-align: center;"><a class="btn" href="zakazsite.html"><img
                        src="d/738331/t/v2862/images/btn-arr.png"/>Заказать сайт</a></p>
        </div>
        <!--/noindex-->

    <?php }endif; ?>
</div>