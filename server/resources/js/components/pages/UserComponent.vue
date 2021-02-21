<template>
  <div>
    <section class="jumbotron text-center d-flex align-items-center visual">
      <div class="bg">
        <img
          class="card-img-top country_img"
          src="https://tripsupporter.s3-ap-northeast-1.amazonaws.com/user.jpg"
          alt="Card image cap"
        />
        <div class="container text">
          <div class="mb-0">
            <div v-if="auth">
              <h1 class="jumbotron-heading text-light mb-0 font-weight-bold">
                マイページ
              </h1>
            </div>
            <div v-else>
              <h1 class="jumbotron-heading text-light mb-0 font-weight-bold">
                {{ data.name }}さんのページ
              </h1>
            </div>
          </div>
          <p class="lead text-light">Find your favorite user</p>

          <button type="button" class="btn btn-danger" @click="showProfile">
            プロフィールを追加する
          </button>
        </div>
      </div>
    </section>

    <div class="container mypage">
      <ul class="nav d-flex justify-content-around nav nav-tabs">
        <li @click="tabChange(1)" :class="{ active: isActive === 1 }">
          プロフィール
        </li>
        <li @click="tabChange(2)" :class="{ active: isActive === 2 }">
          レビュー
        </li>
        <li @click="tabChange(3)" :class="{ active: isActive === 3 }">
          いいね
        </li>
        <li @click="tabChange(4)" :class="{ active: isActive === 4 }">
          フォト
        </li>
      </ul>

      <article v-if="isActive === 1" class="profile"></article>

      <article v-else-if="isActive === 2" class="review"></article>

      <article v-else-if="isActive === 3" class="favorite"></article>

      <article v-else-if="isActive === 4" class="phots"></article>

      <acount-component
        v-show="profileModal"
        @profile-child="closeProfile"
        :user-id="auth.id"
      />
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      data: {},
    };
  },
  props: {
    auth: {
      type: Object | String,
    },
    userId: {
      type: Number | String,
    },
  },
  methods: {
    getUser() {
      axios.get("/api/user/" + this.userId).then((res) => {
        this.data = res.data;
      });
    },
  },
  mounted() {
    this.getUser();
  },
};
</script>