<template>
  <ul class="item">
    <li v-for="items in item" :key="items.id">
      {{ item.description }}
    </li>
  </ul>
</template>
<script>
export default {
  mounted() {
    console.log("List");
    this.tasklist();
  },
  props: ["index"],
  data: function () {
    return {
      item: {
        description: "",
      },
    };
  },
  // methods() {
  //   axios
  //     .get("/api/item")
  //     .then(function (response) {
  //       console.log(response);
  //     })
  //     .catch(function (error) {
  //       console.log(error);
  //     });
  // },
  methods: {
    tasklist: function () {
      axios
        .get("/api/item")
        .then(function (response) {
          console.log(response.data);
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
};
</script>