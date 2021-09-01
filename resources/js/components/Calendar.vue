<template>
  <div>
    <!-- FullCalendar -->
    <FullCalendar v-bind:options="calendarOptions" />

    <!-- Modal -->
    <!-- <modal v-model="showModal"></modal> -->
    <modal
      v-if="showModal"
      v-bind:show="showModal"
      v-on:close="showModal = false"
    ></modal>
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
      /*
       FullCalendar
       */
      calendarOptions: {
        timeZone: "local",
        plugins: [dayGridPlugin, interactionPlugin],
        initialView: "dayGridMonth",
        dateClick: this.handleDateClick,
        // eventClick: this.handleEventClick,
        events: [],
      },
    };
  },
  methods: {
    // handleEventClick: function () {
    //   // console.log("click");
    //   this.modalShow = true;
    // },
    /*  
    觸發modal
    並把點擊到的日期傳到modal
    */
    handleDateClick: function (arg) {
      // alert("點到了 " + arg.dateStr);

      // 日期
      this.dateTimeStart = arg.dateStr;
      // console.log(this.dateTimeStart);

      // 取第二個table內的tbody內的tr內的td的data-date(日期)
      // let findModalId = document
      //   .getElementsByClassName("fc-scrollgrid-sync-table")[0]
      //   .getAttribute("class");

      // let findModalId = $(".fc-scrollgrid-sync-table > tbody").children();

      // console.log(findModalId);
      // return this.clickDate;
    },
    // 取得table所有該月份的資料
    getAlldatas: function () {
      axios
        .get("api/item")
        .then((response) => {
          if (response.data.legth !== 0) {
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
