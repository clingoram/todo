<template>
  <div id="area">
    <h1>ToDo List</h1>
    <span>Get things done!!!</span>

    <show-calendar></show-calendar>
  </div>
</template>
<script>
// import components
import ShowCalendar from "./Calendar";

export default {
  components: {
    ShowCalendar,
  },
};
</script>
<style scoped>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}
html,
body {
  background: #f7f1f1;
  font-size: 1.1rem;
  font-family: sans-serif;
  height: 100%;
}
#area {
  padding: 80px;
  width: 100%;
}
</style>