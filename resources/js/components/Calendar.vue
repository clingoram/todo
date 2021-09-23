<template>
  <div>
    <FullCalendar v-bind:options="calendarOptions" v-bind:class="getAlldatas" />
    <!-- <modal v-model="showModal"></modal> -->
    <open-modal
      v-bind:id="todoTask.id"
      v-bind:start="todoTask.dateTimeStart"
      v-bind:openmodal="modalOpen"
    ></open-modal>

    <!-- <open-modal
      v-bind:start="todoTask.dateTimeStart"
      v-bind:title="todoTask.addtaskName"
      v-bind:openmodal="modalOpen"
      v-bind:watchToOpenModal="todoTask.dateTimeStart"
    ></open-modal> -->

    <!-- <b-modal
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
    </b-modal> -->
  </div>
</template>
<script>
// FullCalendar
// import "@fullcalendar/core/vdom";
import FullCalendar from "@fullcalendar/vue";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";
// click date to open modal to add new task.
import OpenModal from "./ModalInfo";

export default {
  components: {
    FullCalendar,
    OpenModal,
  },
  props: {
    id: {
      tpye: Number,
    },
    // title: {
    //   type: String,
    // },
    start: {
      type: String,
    },
    openmodal: {
      type: Boolean,
    },
  },
  data() {
    return {
      // showModal: false,
      modalOpen: this.openmodal,
      todoTask: {
        id: this.id ? this.id : "",
        // 項目名稱
        title: this.title ? this.title : "",
        // 開始時間
        dateTimeStart: this.start ? this.start : "",
      },
      // Full calendar
      calendarOptions: {
        timeZone: "local",
        plugins: [dayGridPlugin, interactionPlugin],
        initialView: "dayGridMonth",
        events: [],
        // dateClick: this.dateClick(),
        dateClick: function (arg) {
          // this.showModal = true;
          this.modalOpen = true;
          this.todoTask.dateTimeStart = arg.dateStr;
        }.bind(this),
        eventClick: function (info) {
          // this.showModal = true;

          this.modalOpen = true;
          this.todoTask.id = info.event._def.publicId;
          this.todoTask.title = info.event._def.title;
        }.bind(this),
      },
    };
  },
  computed: {
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
    // 檢查月曆上的日期是否有點擊
    // clickDateChecked: function () {
    //   return this.todoTask.dateTimeStart !== null
    //     ? this.todoTask.dateTimeStart
    //     : "";
    // },
  },
  // watch: {
  //   // Watch watchToOpenModal in the child component and call toOpenModal
  //   watchToOpenModal: function () {
  //     this.toOpenModal();
  //   },
  // },
  methods: {
    // checkFormValidity: function () {
    //   const valid = this.$refs.form.checkValidity();
    //   this.taskState = valid;
    //   return valid;
    // },
    // // cancel
    // resetModal: function () {
    //   this.todoTask.addtaskName = "";
    //   this.todoTask.taskState = null;
    // },
    // handleOk: function (bvModalEvt) {
    //   bvModalEvt.preventDefault();
    //   // 沒有填上任何task就save
    //   if (!this.checkFormValidity()) {
    //     return;
    //   } else {
    //     this.submitData();
    //   }
    // },
    // // save data
    // submitData() {
    // console.log(this.todoTask);
    // axios
    //   .post("api/item/store", {
    //     todoTask: this.todoTask,
    //   })
    //   .then((response) => {
    //     if (response.status === 201) {
    //       // this.todoTask.addtaskName = "";
    //       // this.$emit("reloadlist");
    //       this.resetModal();
    //     }
    //   })
    //   .catch((error) => {
    //     console.log(error.response.data);
    //   });
    // },
  },
};
</script>
