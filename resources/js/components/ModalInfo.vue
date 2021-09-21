<template>
  <!-- Modal -->
  <b-modal
    id="modal-prevent-closing"
    v-model="showModal"
    title="新增待辦事項"
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
        v-model="todoTask.dateTimeEnd"
        class="col-8"
        menu-class="w-100"
        calendar-width="100%"
      ></b-form-datepicker>
      <b-form-group
        label="待辦事項:"
        label-for="task-input"
        invalid-feedback="必填"
        v-bind:state="todoTask.taskState"
      >
        <b-form-input
          id="task-input"
          v-model="todoTask.addtaskName"
          v-bind:state="todoTask.taskState"
          placeholder="輸入待辦事項"
          required
        ></b-form-input>
      </b-form-group>
    </form>
  </b-modal>
</template>
<script>
export default {
  mounted() {
    console.log("Modal component is ready");
  },
  data() {
    return {
      showModal: false,
      /*
        insert datas into table
      */
      task: {
        addtaskName: "",
        // taskState: null,
        // submittedNames: [],
        dateTimeStart: "",
        dateTimeEnd: "",
      },
    };
  },
  computed: {},
  methods: {
    toOpenModal: function () {
      if (this.taskEvents) {
        this.modalOpen = true;
      }
      console.log("open");
    },
    // onContext(ctx) {
    //   this.context = ctx;
    // },
    // 檢查input
    checkFormValidity() {
      const valid = this.$refs.form.checkValidity();
      this.taskState = valid;
      return valid;
    },
    // cancel
    resetModal() {
      this.task.addtaskName = "";
      this.task.taskState = null;
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
      console.log(this.task);
      axios
        .post("api/item/store", {
          task: this.task,
        })
        .then((response) => {
          if (response.status === 201) {
            this.task.addtaskName = "";
            this.$emit("reloadlist");
          }
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    },
  },
};
</script>