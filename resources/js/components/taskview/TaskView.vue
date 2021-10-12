<template>
  <form ref="form" v-on:submit.stop.prevent="handleSubmit">
    <label>{{ clickDateChecked }}</label>
    <br />
    <start-info></start-info>
    <end-info></end-info>
  </form>
</template>
<script>
// import TaskInfoStart、TaskInfoEnd
import StartInfo from "./TaskInfoStart";
import EndInfo from "./TaskInfoEnd";
export default {
  components: {
    StartInfo,
    EndInfo,
  },
  computed: {
    // 檢查月曆上的日期是否有點擊
    clickDateChecked() {
      this.openmodal === true
        ? (this.showModal = true)
        : (this.showModal = false);

      // 若有ID，拿ID做搜尋以及確認是否有點擊到event
      if (this.id !== "" && this.eventisset === true) {
        this.getSpecificTask(this.id);
      } else {
        this.resetModal();
      }
      return this.start !== null ? this.start : "";
    },
  },
  methods: {
    // 檢查input
    checkFormValidity() {
      const valid = this.$refs.form.checkValidity();
      this.todoTask.state = valid;
      return valid;
    },
    // 離開modal就清除input
    resetModal() {
      this.todoTask.name = "";
      this.todoTask.state = null;
    },
    handleOk(bvModalEvt) {
      // Prevent modal from closing
      bvModalEvt.preventDefault();
      // Trigger submit handler
      this.handleSubmit();
    },
    handleSubmit() {
      // 沒有填上任何task就save
      if (!this.checkFormValidity()) {
        return;
      }
      if (this.id === "" && this.eventisset === false) {
        this.insertData();
      } else {
        this.updateData();
      }
      this.$nextTick(() => {
        this.$bvModal.hide("modal-prevent-closing");
      });
    },
    // Insert
    insertData() {
      console.log("insert");
      console.log(this.todoTask.name);
      console.log(this.todoTask.end);

      axios
        .post("api/item/", {
          todoTask: this.todoTask,
          start: this.start,
        })
        .then((response) => {
          if (response.status === 201) {
            // this.todoTask.name = "";
            // this.$emit("reloadlist");
          }
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    },
    // Read
    getSpecificTask() {
      axios
        .get("api/item/" + this.id)
        .then((response) => {
          console.log(response.data.created_at);
          // 點擊到的日期跟task的ID日期符合
          // if (response.data.id === Number(this.id)) {

          this.todoTask.name = response.data.description;
          // this.todoTask.start = response.data.created_at;
          const findStrPosition = response.data.created_at.indexOf("T");
          this.todoTask.start = response.data.created_at.substr(
            0,
            findStrPosition
          );
          this.todoTask.end = response.data.end_at;
          this.todoTask.state = response.data.status ? false : true;
          this.todoTask.category = response.data.category_name;
          // }
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    },
    // Update
    updateData() {
      console.log("update");
      // console.log(this.todoTask);
      axios
        .put("api/item/" + this.id, {
          todoTask: this.todoTask,
        })
        .then((response) => {
          // console.log(response);
          if (response.status === 200) {
            // this.$emit("changeddata");
            // this.$emit("button-click");
            confirm("儲存成功");
          }
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    },
    // Delete
    deleteData() {},
  },
};
</script>