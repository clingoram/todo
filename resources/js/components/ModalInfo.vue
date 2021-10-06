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
  >
    <form ref="form" v-on:submit.stop.prevent="handleOk">
      <label>{{ clickDateChecked }}</label>
      <br />

      <label for="startDate-datepicker">開始:</label>
      <b-form-datepicker
        id="startDate-datepicker"
        v-model="todoTask.start"
        class="col-8"
        menu-class="w-100"
        calendar-width="100%"
      ></b-form-datepicker>

      <label for="endDate-datepicker">結束:</label>
      <b-form-datepicker
        id="endDate-datepicker"
        v-model="todoTask.end"
        class="col-8"
        menu-class="w-100"
        calendar-width="100%"
      ></b-form-datepicker>

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
    <button v-on:click="deleteData()" class="trash">
      <font-awesome-icon icon="trash" />
    </button>
  </b-modal>
</template>
<script>
// child component
export default {
  props: ["id", "start", "openmodal", "eventisset"],
  data() {
    return {
      showModal: false,
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
      // this.handleSubmit();

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
      axios
        .post("api/item/", {
          todoTask: this.todoTask,
          start: this.start,
        })
        .then((response) => {
          if (response.status === 201) {
            this.todoTask.name = "";
            this.$emit("reloadlist");
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
          // 點擊到的日期跟task的ID日期符合
          // if (response.data.id === Number(this.id)) {
          this.todoTask.name = response.data.description;
          this.todoTask.start = response.data.created_at;
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
          console.log(response);
          if (response.status === 200) {
            this.$emit("changeddata");
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