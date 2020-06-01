<?php
addScriptHead('/js/apps/tweets.js', true);
addStyleHead('/js/apps/tweets.css', true);
/**
 * @var $items \Tweets\Tweet[]
 */
?>
<div class="col-md-6">
    <span class="title">Твиты</span>
    <div class="tweets">
        <?foreach ($items as $item):?>
            <div class="tweet">
                <div class="tweetTitle"><?=$item->Category->getTitle()?></div>
                <div class="tweetContent"><?=$item->getContent()?></div>
                <div class="tweetUsername"><?=$item->getUsername()?></div>
                <div class="tweetCreateAt"><?=$item->getCreatedAt()?></div>
            </div>
        <?endforeach;?>
    </div>
</div>
<div class="col-md-6">
    <span class="title">Создать твит</span>
    <form id="formSendTweet" method="POST">
        <div class="wrapCategorySelect margin-bottom">
            <select name="CategoryId">
                <?foreach(Categories::GetCategories() as $item):?>
                    <option value="<?=$item->getId()?>"><?=$item->getTitle()?></option>
                <?endforeach;?>
            </select>
        </div>
        <div class="wrapUsernameField margin-bottom">
            <input name="Username" value="" placeholder="Ваше имя" type="text"/>
        </div>
        <div class="wrapMessage">
            <textarea name="Content" placeholder="Сообщение"></textarea><br>
            <button class="btn-send" type="submit">Отправить</button>
        </div>
    </form>
</div>

