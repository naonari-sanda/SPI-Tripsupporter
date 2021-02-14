<template>
  <div>
    <section
      class="jumbotron text-center visual mainvisual"
      style="margin-bottom: 6rem"
    >
      <div class="bg">
        <img
          class="card-img-top country_img"
          src="https://tripsupporter.s3-ap-northeast-1.amazonaws.com/main.jpg"
          alt="Card image cap"
        />

        <div class="container text">
          <h1 class="jumbotron-heading font-weight-bold text-light mb-4 h1">
            さあ 旅に出かけよう！
          </h1>

          <div id="search">
            <div class="inner">
              <form method="get">
                <div class="row justify-content-center">
                  <div class="">
                    <label for="category">地域</label>
                    <select name="category" id="category" class="form-control">
                      <option disabled selected value>選択...</option>
                      <option value="ajia">アジア</option>
                      <option value="ocea">オセアニア</option>
                      <option value="eu">ヨーロッパ</option>
                      <option value="easta">中東</option>
                      <option value="africa">アフリカ</option>
                      <option value="northa">北米</option>
                      <option value="latin">南米</option>
                    </select>
                  </div>
                  <div class="">
                    <label for="special">詳細</label>
                    <select name="special" id="special" class="form-control">
                      <option disabled selected value>選択...</option>
                      <option value="wh">ワーキングホリデー</option>
                      <option value="corona">入国可能国(コロナ禍)</option>
                    </select>
                  </div>

                  <div class="keyword">
                    <label for="keyword">国名</label>
                    <input
                      id="keyword"
                      type="text"
                      name="keyword"
                      class="form-control"
                      placeholder="入力てください..."
                    />
                  </div>
                  <input
                    type="submit"
                    class="btn btn-primary px-4"
                    value="検索"
                  />
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>

    <div class="container row mx-auto">
      <div class="col-lg-4 mb-2">
        <img
          class="rounded-circle mx-auto d-flex justify-content-center mb-3"
          src="https://tripsupporter.s3-ap-northeast-1.amazonaws.com/find.png"
          alt=""
          width="140"
          height="140"
        />
        <h2 class="text-center">見つけよう</h2>
        <p class="text-center">
          「海外に行きたい！」しかし「どこに行くか？」。国々のそれぞれの良いところを紹介します。ぜひ、次の旅行先の決定の参考にしてみてくださいね。
        </p>
        <p class="d-flex justify-content-center">
          <a class="btn btn-primary center-block" href="#" role="button"
            >見つける &raquo;</a
          >
        </p>
      </div>
      <div class="col-lg-4 mb-2">
        <img
          class="rounded-circle mx-auto d-flex justify-content-center mb-3"
          src="https://tripsupporter.s3-ap-northeast-1.amazonaws.com/corona.png"
          alt=""
          width="140"
          height="140"
        />
        <h2 class="text-center">入国可能国</h2>
        <p class="text-center">
          新型コロナウィルス感染拡大中のヨーロッパではロックダウン中の国も多め。日本からの入国規制解除や緩和を発表した国にも変化が出ています。
        </p>
        <div class="d-flex justify-content-center">
          <form method="get">
            <input type="hidden" name="special" value="corona" />
            <input
              type="submit"
              class="btn btn-primary"
              value="見つける &raquo;"
            />
          </form>
        </div>
      </div>
      <div class="col-lg-4 mb-2">
        <img
          class="rounded-circle mx-auto d-flex justify-content-center mb-3"
          src="https://tripsupporter.s3-ap-northeast-1.amazonaws.com/waking.png"
          alt=""
          width="140"
          height="140"
        />
        <h2 class="text-center">ワーキングホリデー</h2>
        <p class="text-center">
          働きながら旅行をしたりということが出来るのはワーキングホリデーという制度だけです。ただお金の為に働くのではなく海外の文化を楽しもう！
        </p>
        <div class="d-flex justify-content-center">
          <form method="get">
            <input type="hidden" name="special" value="wh" />
            <input
              type="submit"
              class="btn btn-primary"
              value="見つける &raquo;"
            />
          </form>
        </div>
      </div>
    </div>

    <hr class="featurette-divider" style="margin: 3rem 0" />

    <div class="container main">
      <div v-if="data.information">
        <h3 class="text-center">{{ data.information.information }}</h3>
        <hr class="featurette-divider" style="margin: 3rem 0" />
      </div>
      <h3 class="text-center mb-5">検索結果</h3>
      <p></p>

      <div class="row pt-5">
        <div
          v-for="(country, index) in data.countries"
          :key="index"
          class="col d-flex justify-content-center"
        >
          <div class="card shadow">
            <div class="bg">
              <img
                class="card-img-top country_img"
                :src="country.imgpath"
                alt="Card image cap"
              />
              <h5 class="text">{{ country.name }}</h5>
            </div>
            <div class="card-body">
              <div class="d-flex mb-2">
                <star-rating
                  v-bind:increment="0.5"
                  v-bind:rating="country.id"
                  text-class="custom-text"
                  v-bind:read-only="true"
                  v-bind:show-rating="false"
                  v-bind:star-size="23"
                  active-color="#ff4742"
                ></star-rating>
                <p class="custom-text d-flex align-items-center mb-0 ml-1">1</p>
              </div>
              <p>{{ country.reviews }}</p>
              <p class="card-text mb-2">{{ country.detail | truncate }}</p>
              <div class="d-flex">
                <a class="btn btn-primary">詳細はこちら</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import StarRating from "vue-star-rating";

export default {
  data() {
    return {
      data: {},
    };
  },
  components: {
    StarRating,
  },
  props: {
    auth: {
      type: Object | Array,
    },
  },
  filters: {
    truncate: function (value) {
      var length = 30;
      var ommision = "...";
      if (value.length <= length) {
        return value;
      }
      return value.substring(0, length) + ommision;
    },
  },
  methods: {
    getData() {
      axios
        .get("/api")
        .then((res) => {
          this.data = res.data;
        })
        .catch((error) => {
          console.log(error.res);
        });
    },
  },
  mounted() {
    this.getData();
    var arr = this.data.countries.reviews;
    console.log(arr);
  },
};
</script>