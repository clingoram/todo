<template>
  <div>
    <FullCalendar v-bind:options="calendarOptions" />
    <div>
      <modal v-model="showModal"></modal>
    </div>
    <!-- <modal
      v-if="showModal"
      v-bind:show="showModal"
      v-bind:info="tasks.info"
      v-bind:save="addEvent()"
      v-on:close="showModal = false"
    ></modal> -->
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
    Modal,
  },
  created() {
    this.getAlldatas();
  },
  data() {
    return {
      showModal: false,
      // tasks: { info: "" },
      // calendar: {},
      calendarOptions: {
        timeZone: "local",
        plugins: [dayGridPlugin, interactionPlugin],
        initialView: "dayGridMonth",
        dateClick: this.handleDateClick,
        events: [],
        eventClick: function (info) {
          this.showModal = true;
          console.log(info.event.start);
          // alert("Event: " + info.event.title);
        }.bind(this),
      },
    };
  },
  methods: {
    /*  
    觸發modal
    並把點擊到的日期傳到modal
    */
    handleDateClick: function (arg) {
      // alert("點到了 " + arg.dateStr);
      // 日期
      this.dateTimeStart = arg.dateStr;
      // console.log(this.dateTimeStart);
    },
    addEvent: function () {
      console.log("add events");
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
  },
};
</script>
