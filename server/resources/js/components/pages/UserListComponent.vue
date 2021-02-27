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
          <h1 class="jumbotron-heading text-light mb-0 font-weight-bold">
            ユーザー一覧
          </h1>
          <p class="lead text-light">Find your favorite user</p>

          <a type="button" class="btn btn-primary"
            >お気に入りの国をさがそう！</a
          >
        </div>
      </div>
    </section>

    <div class="container mypage">
      <article class="user">
        <table class="table table-hover">
          <thead class="">
            <tr>
              <th scope="col">ユーザー</th>
              <th scope="col">性別</th>
              <th scope="col">年齢</th>
              <th scope="col">詳細</th>
            </tr>
          </thead>
          <tbody v-for="(user, index) in data" :key="index">
            <tr>
              <td>
                <router-link
                  :to="{ name: 'user', params: { userId: user.id } }"
                >
                  <a
                    class="text-dark d-flex align-items-center font-weight-bold"
                  >
                    <img
                      v-if="user.acount"
                      class="cycle img-thumbnail mr-2"
                      :src="user.acount.icon"
                      alt="ユーザーアイコン"
                    />
                    <img
                      v-else
                      class="cycle img-thumbnail mr-2"
                      src="https://tripsupporter.s3-ap-northeast-1.amazonaws.com/none.png"
                      alt="アイコン"
                    />
                    {{ user.name }}</a
                  >
                </router-link>
              </td>
              <td v-if="user.acount">{{ user.acount.gender }}</td>
              <td v-else>回答がありません</td>
              <td v-if="user.acount">{{ user.acount.age }}</td>
              <td v-else>回答がありません</td>
              <td>
                <router-link
                  :to="{ name: 'user', params: { userId: user.id } }"
                >
                  <a class="btn btn-primary">詳細</a>
                </router-link>
              </td>
            </tr>
          </tbody>
        </table>
      </article>
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
  },
  methods: {
    getUsers() {
      axios
        .get("/api/user")
        .then((res) => {
          this.data = res.data;
        })
        .catch((res) => {
          console.log(error.response);
          alert("表示できません");
        });
    },
  },
  mounted() {
    this.getUsers();
  },
};
</script>