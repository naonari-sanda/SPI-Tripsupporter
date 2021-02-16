<template>
  <div>
    <h1>リスト</h1>
    <P>{{ list }}</P>
  </div>
</template>

<script>
export default {
  data() {
    return {
      list: {},
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
          this.list = res.data;
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