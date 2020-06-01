<?php
addScriptHead('/js/apps/tweets.js', true);
addStyleHead('/js/apps/tweets.css', true);
?>
<div class="col-md-6">
    <span class="title">Твиты</span>
    <div class="tweets">

    </div>
</div>
<div class="col-md-6">
    <span class="title">Создать твит</span>
    <form id="formSendTweet" method="POST">
        <div class="wrapCategorySelect margin-bottom">
            <select name="categoryId">
                <?foreach(TweetsFactory::GetTweetCategories() as $item):?>
                    <option value="<?=$item->getId()?>"><?=$item->getTitle()?></option>
                <?endforeach;?>
            </select>
        </div>
        <div class="wrapUsernameField margin-bottom">
            <input name="Username" value="" placeholder="Ваше имя" type="text"/>
        </div>
        <div class="wrapMessage">
            <textarea name="Content" placeholder="Сообщение"></textarea><br>
            <button class="btn-send" type="button">Отправить</button>
        </div>
    </form>
</div>

