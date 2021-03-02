<div class="modal gust_modal" id="guestModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="overlay">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title mx-auto" id="exampleModalLabel">
                    ログインが必要です
                </h4>
            </div>
            <div class="modal-body">
                <router-link :to="{ name: 'login' }">
                    <a data-dismiss="modal" class="link-font">ログイン</a>
                </router-link>
            </div>
            <div class="modal-body">
                <router-link :to="{ name: 'register' }">
                    <a data-dismiss="modal" class="denger-link">会員登録</a>
                </router-link>
            </div>
            <div class="modal-body-b">
                <span data-dismiss="modal">キャンセル</span>
            </div>
        </div>
    </div>
</div>