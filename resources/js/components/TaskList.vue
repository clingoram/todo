<template>
  <ul>
    <li v-for="(item, index) in item" :key="index">
      {{ item }}
      <!-- <p :item="tasklist()" class="item">{{ item.description }}</p> -->
    </li>
  </ul>
</template>
<script>
export default {
  mounted() {
    console.log("List");
  },
  props: ["index"],
  data: function () {
    return {
      item: {
        description: "",
      },
    };
  },
  methods() {
    axios
      .get("/api/item")
      .then(function (response) {
        console.log(response);
      })
      .catch(function (error) {
        console.log(error);
      });
  },
  // methods: {
  //   tasklist: function () {
  //     axios
  //       .get("/api/item")
  //       .then(function (response) {
  //         console.log(response.data);
  //       })
  //       .catch(function (error) {
  //         console.log(error);
  //       });
  //   },
  // },
};
</script>