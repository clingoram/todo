<template>
  <div>
    <FullCalendar v-bind:options="calendarOptions" />
    <!-- <modal v-model="showModal"></modal> -->
    <!-- <modal></modal> -->

    <b-modal
      id="modal-prevent-closing"
      ref="showModal"
      v-model="showModal"
      title="新增代辦事項"
      v-on:show="resetModal"
      v-on:hidden="resetModal"
      v-on:ok="handleOk"
    >
      <form ref="form" v-on:submit.stop.prevent="handleOk">
        <b-form-group
          label="代辦事項:"
          label-for="task-input"
          invalid-feedback="必填"
          v-bind:state="todoTask.taskState"
        >
          <b-form-input
            id="task-input"
            v-model="todoTask.addtaskName"
            v-bind:state="todoTask.taskState"
            required
          ></b-form-input>
        </b-form-group>
      </form>
    </b-modal>
  </div>
</template>
<script>
// FullCalendar
// import "@fullcalendar/core/vdom";
import FullCalendar from "@fullcalendar/vue";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";
// click date to open modal to add new task.
import Modal from "./ModalInfo";

export default {
  components: {
    FullCalendar,
    // Modal,
  },
  created() {
    this.getAlldatas();
  },
  data() {
    return {
      showModal: false,
      // insert todo task
      todoTask: {
        addtaskName: "",
        dateTimeStart: "",
        dateTimeEnd: "",
      },
      // full calendar
      calendarOptions: {
        timeZone: "local",
        plugins: [dayGridPlugin, interactionPlugin],
        initialView: "dayGridMonth",
        events: [],
        dateClick: this.handleDateClick,
        eventClick: function (info) {
          this.showModal = true;
          // console.log(info.event.start);
        }.bind(this),
        // selectable: true,
      },
    };
  },
  methods: {
    checkFormValidity: function () {
      const valid = this.$refs.form.checkValidity();
      this.taskState = valid;
      return valid;
    },
    // cancel
    resetModal: function () {
      this.todoTask.addtaskName = "";
      this.todoTask.taskState = null;
    },
    handleOk: function (bvModalEvt) {
      bvModalEvt.preventDefault();

      // 沒有填上任何task就save
      if (!this.checkFormValidity()) {
        return;
      } else {
        this.submitData();
      }
    },
    /*  
    觸發modal
    並把點擊到的日期傳到modal
    */
    handleDateClick: function (arg) {
      // 日期
      this.dateTimeStart = arg.dateStr;
      this.showModal = true;
      // console.log(this.dateTimeStart);
    },
    // 取得table所有該月份的資料
    getAlldatas: function () {
      axios
        .get("api/item")
        .then((response) => {
          if (response.data.legth !== 0 && response.status === 200) {
            this.calendarOptions.events = response.data;
          }
        })
        .catch((error) => {
          console.log(error);
        });
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
            this.todoTask.addtaskName = "";
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
