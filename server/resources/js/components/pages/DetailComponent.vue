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
            v-if="auth.length == 0"
            type="button"
            class="btn btn-primary"
            data-toggle="modal"
            data-target="#guestModal"
          >
            レビューを投稿
          </button>
          <button
            v-else
            type="button"
            class="btn btn-primary"
            data-toggle="modal"
            data-target="#guestModal"
          >
            レビューを投稿!
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

      <article v-if="isActive === 1" class="profile">
        <div>
          <h2>Profile</h2>
          <table class="table table-striped">
            <tr>
              <th>面積</th>
              <td>約{{ data.area.toLocaleString() }}万平方キロメートル</td>
            </tr>
            <tr>
              <th>人口</th>
              <td>約{{ data.population.toLocaleString() }}万人</td>
            </tr>
            <tr>
              <th>首都</th>
              <td>{{ data.capital.toLocaleString() }}</td>
            </tr>
            <tr>
              <th>母国語</th>
              <td>{{ data.language }}</td>
            </tr>
            <tr>
              <th>宗教</th>
              <td>{{ data.religion }}</td>
            </tr>
            <tr>
              <th>GDP</th>
              <td>約{{ data.gdp.toLocaleString() }}万ドル</td>
            </tr>
            <tr>
              <th>幸福度</th>
              <td>
                約{{ data.happiness.toLocaleString() }}
                <a
                  href="https://ja.wikipedia.org/wiki/%E4%B8%96%E7%95%8C%E5%B9%B8%E7%A6%8F%E5%BA%A6%E5%A0%B1%E5%91%8A"
                  >世界幸福度報告</a
                >
              </td>
            </tr>
            <tr>
              <th>入国制限<br />（コロナ）</th>
              <td>{{ data.covid }}</td>
            </tr>
            <tr>
              <th>詳細</th>
              <td>
                {{ data.detail }}
              </td>
            </tr>
          </table>
        </div>
        '
      </article>
      <article v-else-if="isActive === 2" class="review">
        <h2>Reviews</h2>

        <p class="mb-3 font-weight-bold">
          {{ data.reviews.length }}件のレビューがありました
        </p>
        <div
          v-for="(review, index) in data.reviews"
          :key="index"
          class="wrapper"
        >
          <router-link
            :to="{ name: 'user', params: { userId: review.user.id } }"
          >
            <a
              v-if="auth.length !== 0"
              class="text-dark d-flex align-items-center font-weight-bold mb-0"
              href=""
            >
              <img
                v-if="review.user.acount.icon"
                class="cycle img-thumbnail mr-2"
                :src="review.user.acount.icon"
                alt="ユーザーアイコン"
              />
              <img
                v-else
                class="cycle img-thumbnail mr-2"
                src="https://tripsupporter.s3-ap-northeast-1.amazonaws.com/none.png"
                alt="アイコン"
              />{{ review.user.name }}</a
            ></router-link
          >
          <a
            v-if="auth.length == 0"
            class="text-dark d-flex align-items-center font-weight-bold mb-0"
            data-toggle="modal"
            data-target="#guestModal"
          >
            <img
              v-if="review.user.acount"
              class="cycle img-thumbnail mr-2"
              :src="review.user.acount.icon"
              alt="ユーザーアイコン"
            />
            <img
              v-else
              class="cycle img-thumbnail mr-2"
              src="https://tripsupporter.s3-ap-northeast-1.amazonaws.com/none.png"
              alt="アイコン"
            />{{ review.user.name }}</a
          >

          <p class="mt-1 ml-1 mb-0">
            {{ review.created_at | moment }}に投稿しました。
          </p>

          <div class="star d-flex align-items-center ml-1 mb-2">
            <p class="d-flex align-items-center mb-0 mr-1 font-weight-bold">
              総合
            </p>
            <star-rating
              v-bind:increment="0.5"
              v-bind:rating="Number(review.recommend)"
              v-bind:read-only="true"
              v-bind:show-rating="false"
              v-bind:star-size="20"
              active-color="#ff4742"
            >
            </star-rating>
            <p class="custom-text d-flex align-items-center mb-0 ml-1 mr-1"></p>
            <a
              href=""
              data-toggle="collapse"
              :data-target="'#review-' + review.id"
              aria-expand="false"
              :aria-controls="'review-' + review.id"
              >評価を詳しく見る</a
            >
          </div>
          <div class="collapse" :id="'review-' + review.id">
            <div class="star d-flex align-items-center ml-1 mb-2">
              <p class="d-flex align-items-center mb-0 mr-1">治安</p>
              <star-rating
                v-bind:increment="0.5"
                v-bind:rating="Number(review.safe)"
                v-bind:read-only="true"
                v-bind:show-rating="false"
                v-bind:star-size="20"
                active-color="#ff4742"
              >
              </star-rating>
              <p
                class="custom-text d-flex align-items-center mb-0 ml-1 mr-1"
              ></p>
            </div>
            <div class="star d-flex align-items-center ml-1 mb-2">
              <p class="d-flex align-items-center mb-0 mr-1">費用</p>
              <star-rating
                v-bind:increment="0.5"
                v-bind:rating="Number(review.cost)"
                v-bind:read-only="true"
                v-bind:show-rating="false"
                v-bind:star-size="20"
                active-color="#ff4742"
              >
              </star-rating>
              <p
                class="custom-text d-flex align-items-center mb-0 ml-1 mr-1"
              ></p>
            </div>
            <div class="star d-flex align-items-center ml-1 mb-2">
              <p class="d-flex align-items-center mb-0 mr-1">観光</p>
              <star-rating
                v-bind:increment="0.5"
                v-bind:rating="Number(review.tourism)"
                v-bind:read-only="true"
                v-bind:show-rating="false"
                v-bind:star-size="20"
                active-color="#ff4742"
              >
              </star-rating>
              <p
                class="custom-text d-flex align-items-center mb-0 ml-1 mr-1"
              ></p>
            </div>
            <div class="star d-flex align-items-center ml-1 mb-2">
              <p class="d-flex align-items-center mb-0 mr-1">料理</p>
              <star-rating
                v-bind:increment="0.5"
                v-bind:rating="Number(review.food)"
                v-bind:read-only="true"
                v-bind:show-rating="false"
                v-bind:star-size="20"
                active-color="#ff4742"
              >
              </star-rating>
              <p
                class="custom-text d-flex align-items-center mb-0 ml-1 mr-1"
              ></p>
            </div>
            <div class="star d-flex align-items-center ml-1 mb-2">
              <p class="d-flex align-items-center mb-0 mr-1">楽しさ</p>
              <star-rating
                v-bind:increment="0.5"
                v-bind:rating="Number(review.fun)"
                v-bind:read-only="true"
                v-bind:show-rating="false"
                v-bind:star-size="20"
                active-color="#ff4742"
              >
              </star-rating>
              <p
                class="custom-text d-flex align-items-center mb-0 ml-1 mr-1"
              ></p>
            </div>
          </div>

          <div class="fill mb-1">
            <p class="mb-1 font-weight-bold">お気に入り都市</p>
            <p class="text mb-0">{{ review.city }}</p>
          </div>

          <div class="fill mb-3">
            <p class="mb-1 font-weight-bold">レビュー</p>
            <p class="text mb-0">{{ review.review }}</p>
          </div>

          <img
            v-if="review.imgpath"
            class="img img-thumbnail"
            :src="review.imgpath"
            style="width: 200px"
          />
        </div>
      </article>

      <article v-else-if="isActive === 3" class="favorite">
        <h2>Favorites</h2>

        <table v-if="data.reviews" class="table table-hover">
          <thead class="">
            <tr>
              <th scope="col">ユーザー</th>
              <th scope="col">性別</th>
              <th scope="col">年齢</th>
              <th scope="col">詳細</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(like, index) in data.likes" :key="index">
              <td>
                <router-link
                  :to="{ name: 'user', params: { userId: like.user.id } }"
                >
                  <a
                    v-if="auth.length !== 0"
                    class="text-dark d-flex align-items-center font-weight-bold mb-0"
                    href=""
                  >
                    <img
                      v-if="like.user.acount"
                      class="cycle img-thumbnail mr-2"
                      :src="like.user.acount.icon"
                      alt="ユーザーアイコン"
                    />
                    <img
                      v-else
                      class="cycle img-thumbnail mr-2"
                      src="https://tripsupporter.s3-ap-northeast-1.amazonaws.com/none.png"
                      alt="アイコン"
                    />
                    {{ like.user.name }}</a
                  ></router-link
                >
                <a
                  v-if="auth.length == 0"
                  class="text-dark d-flex align-items-center font-weight-bold mb-0"
                  data-toggle="modal"
                  data-target="#guestModal"
                >
                  <img
                    v-if="like.user.acount"
                    class="cycle img-thumbnail mr-2"
                    :src="like.user.acount.icon"
                    alt="ユーザーアイコン"
                  />
                  <img
                    v-else
                    class="cycle img-thumbnail mr-2"
                    src="https://tripsupporter.s3-ap-northeast-1.amazonaws.com/none.png"
                    alt="アイコン"
                  />{{ like.user.name }}</a
                >
              </td>
              <td v-if="like.user.acount">
                {{ like.user.acount.gender }}
              </td>
              <td v-else>回答がありません</td>
              <td v-if="like.user.acount">{{ like.user.acount.age }}</td>
              <td v-else>回答がありません</td>
              <td>
                <router-link
                  :to="{ name: 'user', params: { userId: like.user.id } }"
                >
                  <a v-if="auth.length !== 0" class="btn btn-primary">詳細</a>
                </router-link>
                <a
                  v-if="auth.length === 0"
                  data-toggle="modal"
                  data-target="#guestModal"
                  class="btn btn-primary"
                  >詳細</a
                >
              </td>
            </tr>
          </tbody>
        </table>

        <div v-else>
          <h5 class="mb-5">＊いいねの投稿がありません</h5>
          <a type="button" class="btn btn-primary"
            >お気に入りの国をさがそう！</a
          >
        </div>
      </article>

      <article v-else-if="isActive === 4" class="phots">
        <h2 font-weight-bold>Photo gallery</h2>

        <a
          v-if="auth.length !== 0"
          @click="showImage"
          type="button"
          class="btn btn-danger mb-2"
          >画像を投稿しよう！</a
        >
        <hr />

        <div v-if="data.reviews || data.imgages" id="lightgallery ">
          <div class="row">
            <div
              v-for="(review, index) in data.reviews"
              :key="index"
              class="bg col-md-3 col-6 mb-2"
            >
              <a
                class="d-block"
                :href="review.imgpath"
                data-lightbox="example-1"
              >
                <img class="img img-thumbnail" :src="review.imgpath" />
              </a>
              <p class="text">{{ review.user.name }}さんの投稿</p>
            </div>
            <div
              v-for="(img, index) in data.images"
              :key="index"
              class="bg col-md-3 col-6 mb-2"
            >
              <a class="d-block" :href="img.imgpath" data-lightbox="example-1">
                <img class="img img-thumbnail" :src="img.imgpath" />
              </a>
              <p class="text">{{ img.user.name }}さんの投稿</p>
            </div>
          </div>
        </div>
      </article>
    </div>
  </div>
</template>

<script>
import StarRating from "vue-star-rating";
import moment from "moment";

export default {
  data() {
    return {
      data: {},
      isActive: 1,
      rating: "0",
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
  components: {
    StarRating,
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
    moment: function (data) {
      return moment(data).format("Y年M月D日");
    },
  },
  methods: {
    getDetail() {
      axios.get("/api/detail/" + this.countryId).then((res) => {
        this.data = res.data;
      });
    },
    tabChange: function (num) {
      this.isActive = num;
    },
    showImage: function () {
      return alert();
    },
  },
  mounted() {
    this.getDetail();
  },
};
</script>

<style lang="scss" scoped>
.profile tr:nth-child(odd) {
  background-color: rgba(0, 0, 0, 0.05);
}

.row {
  width: 100%;

  .bg {
    position: relative;

    a {
      position: relative;
      width: 100%;
      margin: auto;

      &:before {
        content: "";
        display: block;
        padding-top: 75%;
      }

      img {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        margin: auto;
        object-fit: cover;
      }
    }

    .text {
      display: block;
      font-size: 14px;
      margin-left: 2%;
      margin-bottom: 0;
    }
  }
}
</style>
