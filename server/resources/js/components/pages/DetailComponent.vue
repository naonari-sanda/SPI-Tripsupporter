<template>
  <div>
    <section class="jumbotron text-center d-flex align-items-center visual">
      <div class="bg">
        <img
          class="card-img-top country_img"
          :src="data.imgpath"
          alt="Card image cap"
        />

        <div class="container text">
          <h1 class="jumbotron-heading text-light mb-3 font-weight-bold">
            {{ data.name }}
          </h1>
          <h6 class="text-light mb-3">{{ data.detail | truncate }}</h6>

          <button
            type="button"
            class="btn btn-primary"
            data-toggle="modal"
            data-target="#guestModal"
          >
            レビューを投稿
          </button>
        </div>
      </div>
    </section>

    <div class="container detail">
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
    </div>

    <review-create-component
      v-show="reviewModal"
      @review-child="closeReview"
      :country-id="data.id"
      :country-name="data.name"
      :user-id="auth.id"
    />
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
    countryId: {
      type: Number | String,
    },
    auth: {
      type: Object | String,
    },
  },
  filters: {
    truncate: function (value) {
      var length = 100;
      var ommision = "...";
      if (value.length <= length) {
        return value;
      }
      return value.substring(0, length) + ommision;
    },
  },
  methods: {
    getDetail() {
      axios.get("/api/detail/" + this.countryId).then((res) => {
        this.data = res.data;
      });
    },
  },
  mounted() {
    this.getDetail();
  },
};
</script>