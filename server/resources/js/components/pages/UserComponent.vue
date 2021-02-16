<template>
  <div>
    <h1>ユーザー</h1>
    <p>{{ user }}</p>
  </div>
</template>

<script>
export default {
  data() {
    return {
      user: {},
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
        this.user = res.data;
      });
    },
  },
  mounted() {
    this.getUser();
  },
};
</script>