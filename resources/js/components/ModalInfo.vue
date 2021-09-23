<template>
  <!-- Modal -->
  <b-modal
    id="modal-prevent-closing"
    title="新增待辦事項"
    v-model="showModal"
    v-on:show="resetModal"
    v-on:hidden="resetModal"
    v-on:ok="handleOk"
  >
    <form ref="form" v-on:submit.stop.prevent="handleOk">
      <label>在 {{ clickDateChecked }}新增待辦事項</label>
      <br />

      <label for="endDate-datepicker">結束日期:</label>
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
        v-bind:state="todoTask.state"
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
export default {
  props: ["id", "start", "openmodal"],
  data() {
    return {
      showModal: false,
      /*
        insert datas into table
      */
      todoTask: {
        id: "",
        // 項目名稱
        name: "",
        // 開始時間
        start: this.start,
        // 結束時間
        end: "",
        // 待辦事項分類選項
        category: null,
        // 狀態
        state: "",
      },
    };
  },
  computed: {
    // 檢查月曆上的日期是否有點擊
    clickDateChecked: function () {
      if (this.openmodal === true || this.id !== "") {
        this.showModal = true;
      } else {
        this.showModal = false;
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
    // cancel
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
      } else {
        this.submitData();
      }
      // this.$nextTick(() => {
      //   this.$bvModal.hide("modal-prevent-closing");
      // });
    },
    // save data
    submitData() {
      console.log(this.todoTask);
      axios
        .post("api/item/store", {
          todoTask: this.todoTask,
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
    // 把現有特定的代辦顯示在modal內
    getSpecificTask: function (id) {
      if (this.todoTask.id !== "") {
        axios
          .get("api/item/", {
            todoTask: this.todoTask.id,
          })
          .then((response) => {
            console.log(response);
            // if (response.data.legth !== 0 && response.status === 200) {
            // }
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },
  },
};
</script>