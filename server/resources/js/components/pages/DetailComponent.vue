<template>
  <div>
    <h1>国詳細</h1>
    <p>{{ data }}</p>
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