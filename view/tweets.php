<?php
addScriptHead('/js/apps/tweets.js', true);
addStyleHead('/js/apps/tweets.css', true);
?>
<style>
    body{
        font-family: "Tahoma", sans-serif;
    }
    .tweet{
        margin: 5px;
        padding: 10px;
        border: 1px solid grey;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
    }
    .tweetTitle{
        font-size: 18px;
    }
</style>
<div class="col-md-6">
    <span class="title">Твиты</span>
    <div class="tweets">
        <div class="tweet">
            <div class="tweetTitle">Заголовок</div>
            <div class="tweetContent">Контент</div>
            <div class="tweetUsername">Пользователь</div>
            <div class="tweetCreateAt">Время</div>
        </div>
    </div>
</div>
<div class="col-md-6">
    <span class="title">Создать твит</span>
    <form id="formSendTweet" method="POST">
        <div class="wrapCategorySelect margin-bottom">
            <select name="CategoryId">
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
            <button class="btn-send" type="submit">Отправить</button>
        </div>
    </form>
</div>

