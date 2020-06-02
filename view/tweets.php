<?php
addScriptHead('/js/apps/tweets.js', true);
addStyleHead('/js/apps/tweets.css', true);
/**
 * @var $items \Tweets\Tweet[]
 */
?>
<div class="wrapTweets">
    <span class="title">Твиты</span>
    <div class="tweets"></div>
</div>
<div class="wrapTweetAddForm">
    <span class="title">Создать твит</span>
    <form id="formSendTweet" method="POST">
        <div class="wrapCategorySelect margin-bottom">
            <select name="CategoryId" class="form-control">
                <?foreach(Categories::GetCategories() as $item):?>
                    <option value="<?=$item->getId()?>"><?=$item->getTitle()?></option>
                <?endforeach;?>
            </select>
        </div>
        <div class="wrapUsernameField margin-bottom">
            <input name="Username" value="" class="form-control" placeholder="Ваше имя" type="text"/>
        </div>
        <div class="wrapMessage">
            <textarea name="Content" class="form-control" placeholder="Сообщение"></textarea><br>
            <button class="btn-send btn" type="submit">Отправить</button>
            <button class="btn-send btn" type="reset">Сброс</button>
        </div>
    </form>
</div>

