<template>
  <div>
    <header>
      <header-component :auth="auth" />
    </header>
    <main>
      <router-view :errors="errors" :auth="auth" />
    </main>
    <footer>
      <footer-component />
    </footer>
  </div>
</template>

<script>
import HeaderComponent from "../common/HeaderComponent";
import FooterComponent from "../common/FooterComponent";

export default {
  components: {
    HeaderComponent,
    FooterComponent,
  },
  props: {
    errors: {
      type: Object | Array,
    },
    auth: {
      type: Object | Array,
    },
  },
};
</script>