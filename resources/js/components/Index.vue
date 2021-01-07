<template>
  <div class="container">
    <div class="card" style="width: 18rem">
      <div class="card-header">ToDo List</div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item">Cras justo odio</li>
        <li class="list-group-item">Dapibus ac facilisis in</li>
        <li class="list-group-item">Vestibulum at eros</li>
      </ul>
    </div>
  </div>
</template>
<script>
// entry point
// 這是首頁，要載入list(列表)、addtask(form)

export default {
  mounted() {
    console.log("Component......");
  },
};
</script>