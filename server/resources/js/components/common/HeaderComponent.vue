<template>
  <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
      <router-link :to="{ name: 'home' }">
        <a class="navbar-brand text-dark font-weight-bold">
          <i class="fas fa-globe-americas mr-1"></i>TripSupporter
        </a></router-link
      >

      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav mr-auto"></ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto align-items-center">
          <!-- Authentication Links -->

          <li v-if="auth.length === 0" class="nav-item">
            <a class="nav-link" data-toggle="modal" data-target="#guestModal">
              <i class="fas fa-users mr-1"></i>ユーザー一覧
            </a>
          </li>
          <li v-else class="nav-item">
            <router-link :to="{ name: 'users' }">
              <a class="nav-link">
                <i class="fas fa-users mr-1"></i>ユーザー一覧
              </a>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link :to="{ name: 'ranking' }">
              <a class="nav-link"
                ><i class="fas fa-chart-line mr-1"></i>ランキング</a
              ></router-link
            >
          </li>
          <div class="d-flex" v-if="auth.length === 0">
            <li class="nav-item">
              <router-link :to="{ name: 'login' }">
                <a class="nav-link">ログイン</a>
              </router-link>
            </li>

            <li class="nav-item">
              <router-link :to="{ name: 'register' }">
                <a class="nav-link">会員登録</a>
              </router-link>
            </li>
          </div>
          <li v-if="auth.length !== 0" class="nav-item dropdown">
            <a
              id="navbarDropdown"
              class="nav-link dropdown-toggle d-flex align-items-center py-0"
              href="#"
              role="button"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              <img
                v-if="icon"
                class="cycle img-thumbnail mr-2"
                :src="icon"
                alt="ユーザーアイコン"
              />
              <img
                v-else
                class="cycle img-thumbnail mr-2"
                src="https://tripsupporter.s3-ap-northeast-1.amazonaws.com/none.png"
                alt="アイコン"
              />
              {{ auth.name }}<span class="caret"></span>
            </a>

            <div
              class="dropdown-menu dropdown-menu-right"
              aria-labelledby="navbarDropdown"
            >
              <a class="dropdown-item" @click="logout"> ログアウト </a>
              <form
                action="/logout"
                id="logout-form"
                method="POST"
                styele="display: none"
              >
                <input type="hidden" name="_token" :value="csrf" />
              </form>
              <router-link :to="{ name: 'user', params: { userId: auth.id } }">
                <a class="dropdown-item">マイページ</a>
              </router-link>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  data() {
    return {
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
    };
  },

  props: {
    auth: {
      type: Object | Array,
    },
    icon: {
      type: String | Array,
    },
  },
  methods: {
    logout() {
      document.querySelector("#logout-form").submit();
    },
  },
};
</script>