<template>
  <div>
    <FullCalendar v-bind:options="calendarOptions" v-bind:class="getAlldata" />

    <open-modal
      v-bind:id="todoTask.id"
      v-bind:start="todoTask.dateTimeStart"
      v-bind:end="todoTask.dateTimeEnd"
      v-bind:openmodal="modalOpen"
      v-bind:eventisset="checkEventIsset"
    ></open-modal>
  </div>
</template>
<script>
// FullCalendar
// import "@fullcalendar/core/vdom";
import FullCalendar from "@fullcalendar/vue";
import dayGridPlugin from "@fullcalendar/daygrid";
// import momentPlugin from "@fullcalendar/moment";
import interactionPlugin from "@fullcalendar/interaction";
// click date to open modal to add new task.
import OpenModal from "./TaskModal";

export default {
  components: {
    FullCalendar,
    OpenModal,
  },
  props: {
    id: {
      tpye: Number,
    },
    // eventDateTitle: {
    //   type: String,
    // },
    start: {
      type: String,
    },
    end: {
      type: String,
    },
    openmodal: {
      type: Boolean,
    },
    eventisset: {
      type: Boolean,
    },
  },
  data() {
    // date
    let weekDay = {
      Mon: "星期一",
      Tue: "星期二",
      Wed: "星期三",
      Thu: "星期四",
      Fri: "星期五",
      Sat: "星期六",
      Sun: "星期日",
    };
    let monthShort = {
      JAN: "1",
      FEB: "2",
      MAR: "3",
      APR: "4",
      May: "5",
      JUN: "6",
      JUL: "7",
      AUG: "8",
      SEP: "9",
      OCT: "10",
      NOV: "11",
      DEC: "12",
    };
    return {
      date: this.dateData,
      // modal
      modalOpen: this.openmodal,
      title: this.eventDateTitle,
      // 確認是點擊到event還是date，若是event，則顯示該event資訊(update);反之，則顯示新增待辦事項(insert)
      checkEventIsset: this.eventisset,
      todoTask: {
        id: this.id ? this.id : "",
        // 項目名稱
        title: this.title ? this.title : "",
        // 開始時間
        dateTimeStart: this.start ? this.start : "",
        // 結束時間
        dateTimeEnd: this.end ? this.end : "",
      },
      // Full calendar
      calendarOptions: {
        timeZone: "local",
        plugins: [dayGridPlugin, interactionPlugin],
        initialView: "dayGridMonth",
        events: [],
        // eventColor: "antiquewhite",
        // eventTextColor: "#000000",
        // 事件顯示時間格式
        eventTimeFormat: {
          hour: "2-digit",
          minute: "2-digit",
          second: "2-digit",
          hour12: false,
        },
        dateClick: function (arg) {
          this.modalOpen = true;
          this.checkEventIsset = false;

          this.todoTask.dateTimeStart = this.datetimeFormated(arg.date);
          this.todoTask.dateTimeEnd = this.datetimeFormated(arg.date);

          // this.eventDateTitle =
          //   arg.date.getFullYear() +
          //   "-" +
          //   arg.date.getMonth() +
          //   "-" +
          //   arg.date.getDate();
        }.bind(this),
        eventClick: function (info) {
          if (info.event.id !== "") {
            this.modalOpen = true;
            this.checkEventIsset = true;
            this.todoTask.id = info.event.id;

            this.todoTask.dateTimeStart = this.datetimeFormated(
              info.event.start
            );
            this.todoTask.dateTimeEnd = this.datetimeFormated(info.event.end);
          }
        }.bind(this),
      },
    };
  },
  computed: {
    // 取得table所有該月份的資料
    getAlldata: {
      // 讀取
      get() {
        axios
          .get("api/items")
          .then((response) => {
            if (response.data.legth !== 0) {
              this.calendarOptions.events = response.data;
              // this.$emit("changedata");
            }
          })
          .catch((error) => {
            console.log(error);
          });
      },
      // 寫入
      set(value) {
        return (this.calendarOptions.events = value);
      },
    },
  },
  methods: {
    // 開始與結束日期時間轉換(local英轉數字)
    datetimeFormated(datetime) {
      const date = new Date(datetime);
      // 年份
      const year = date.getFullYear();
      // 月份
      const month =
        date.getMonth() + 1 < 9
          ? "0" + date.getMonth() + 1
          : date.getMonth() + 1;
      // 日期
      const day = date.getDate() < 9 ? "0" + date.getDate() : date.getDate();
      // 時
      const hours =
        date.getHours() < 9 ? "0" + date.getHours() : date.getHours();
      // 分
      const minutes =
        date.getMinutes() < 9 ? "0" + date.getMinutes() : date.getMinutes();
      // 秒
      const sec =
        date.getSeconds() < 9 ? "0" + date.getSeconds() : date.getSeconds();
      // 毫秒
      const millSec =
        date.getMilliseconds() < 9
          ? "0" + date.getMilliseconds()
          : date.getMilliseconds();

      // modal title
      // this.eventDateTitle = year + "-" + month + "-" + day;

      return year + "-" + month + "-" + day + " " + hours + ":" + minutes;
    },
  },
};
</script>