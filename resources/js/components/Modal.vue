<template>
  <!-- Modal -->
  <b-modal
    size="xl"
    id="modal-prevent-closing"
    title="新增待辦事項"
    v-model="showModal"
    v-on:show="resetModal"
    v-on:hidden="resetModal"
    v-on:ok="handleOk"
    modal-footer
  >
    <template #modal-footer="{ ok, cancel, hide }">
      <b-button lg="4" class="pb-2" variant="success" @click="ok()"
        >儲存</b-button
      >
      <b-button lg="4" class="pb-2" variant="outline-primary" @click="cancel()"
        >取消</b-button
      >
      <!-- Button with custom close trigger value -->
      <b-button lg="4" class="pb-2" variant="danger" @click="hide(id)">
        刪除
      </b-button>
    </template>

    <!-- <task-data></task-data> -->

    <form ref="form" v-on:submit.stop.prevent="handleSubmit">
      <label>{{ clickDateChecked }}</label>
      <br />
      <label for="startDate-datepicker">開始:</label>
      <b-input-group class="mb-3">
        <b-form-input
          id="datestart-input"
          v-model="todoTask.start"
          type="text"
          placeholder="YYYY-MM-DD"
          autocomplete="off"
        ></b-form-input>
        <b-input-group-append>
          <b-form-datepicker
            id="startDate-datepicker"
            v-model="todoTask.start"
            v-bind:min="min"
            button-only
            right
            aria-controls="datestart-input"
          ></b-form-datepicker>
        </b-input-group-append>
      </b-input-group>

      <label for="endDate-datepicker">結束:</label>
      <b-input-group class="mb-3">
        <b-form-input
          id="endDate-input"
          v-model="todoTask.end"
          type="text"
          placeholder="YYYY-MM-DD"
          autocomplete="off"
        ></b-form-input>
        <b-input-group-append>
          <b-form-datepicker
            id="endDate-datepicker"
            v-model="todoTask.end"
            v-bind:max="max"
            button-only
            right
            aria-controls="endDate-input"
          ></b-form-datepicker>
        </b-input-group-append>
      </b-input-group>

      <b-form-group
        label="待辦事項:"
        label-for="task-input"
        invalid-feedback="必填"
      >
        <b-form-input
          id="task-input"
          v-model="todoTask.name"
          v-bind:state="todoTask.state"
          placeholder="輸入待辦事項"
          required
        ></b-form-input>
      </b-form-group>
    </form>
  </b-modal>
</template>
<script>
// child component
// need to import TaskView from taskview folder
// import taskdata from "./taskview/TaskView";
export default {
  // components: {
  //   taskdata,
  // },
  props: ["id", "start", "openmodal", "eventisset"],
  data() {
    // modal calendar
    const now = new Date();
    const today = new Date(now.getFullYear(), now.getMonth(), now.getDate());

    // 1個月前又10天
    const minDate = new Date(today);
    minDate.setMonth(minDate.getMonth() - 1);
    minDate.setDate(10);

    // 1個月後又10天
    const maxDate = new Date(today);
    maxDate.setMonth(maxDate.getMonth() + 1);
    maxDate.setDate(20);

    return {
      showModal: false,
      min: minDate,
      max: maxDate,
      /*
        insert datas into table
      */
      todoTask: {
        id: this.id ? this.id : "",
        // 項目名稱
        name: this.name ? this.name : "",
        // 開始時間
        start: this.start ? this.start : "",
        // 結束時間
        end: "",
        // 待辦事項分類選項
        category: null,
        // 狀態
        state: this.status,
      },
    };
  },
  computed: {
    // 檢查月曆上的日期是否有點擊
    clickDateChecked: function () {
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
<style scoped>
#modal-prevent-closing {
  background: black;
  color: white;
}
</style>