<template>
  <section class="row p-5">
    <!-- notify -->
    <div v-if="this.showNotify">
      <div @click="closeNotify" class="vpc_notify_container_background"></div>
      <div class="vpc_notify_container">
        <div class="vpc_notify">
          <div class="d-flex flex-row w-100 vpc_notify_title">ثبت</div>
          <div class="d-flex flex-row w-100 vpc_notify_error">اطلاعات به درستی ثبت شد</div>
          <div
            class="d-flex flex-row justify-content-center align-items-center vpc_notify_icon_holder"
          >
            <img
              @click="closeNotify"
              class="vpc_notify_icon"
              src="photo/module/Panel/forms/accept.png"
            />
          </div>
        </div>
      </div>
    </div>
    <!-- notify -->
        <!-- showRegisterDate -->
    <div v-if="this.showRegisterDate">
      <div @click="closeRegisterDate" class="vpc_notify_container_background"></div>
      <div class="vpc_registerCalender_container">
        <div class="vpc_registerCalender p-1">
          <div class="row d-flex flex-row justify-content-center">
            <div>
              <span
                class="vpc_select_date"
              >{{dayOfWeek(this.data.selectedDay)}} - {{this.data.selectMonth}} ماه در سال {{this.data.selectYear}}</span>
            </div>
          </div>
          <div class="row d-flex flex-row justify-content-center">
            <singleInput :allRow="true" type="text" inputTitle="عنوان" v-model="data.title"></singleInput>
            <listSelector
              :allRow="true"
              selectedItem="name"
              listName="اشتراک"
              :listSource="null"
              parameter="name"
              :getSource="this.$store.state.calenderStore.allUserForCalender"
              :lastValue="users"
              @selectid=" users = $event.id "
            ></listSelector>
            <textareaInput type="description" inputTitle="توضیحات" v-model="data.description"></textareaInput>
            <div class="d-flex flex-row w-100 justify-content-center text-center">
              <button
                v-on:click.prevent="submitRegisterDate"
                class="vpc_button text-center align-items-center justify-content-center"
                type="button"
              >
                <span>ثبت</span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- showRegisterDate -->
    <!-- showTodo -->
    <div v-if="this.showTodo">
      <div @click="closShowTodo" class="vpc_notify_container_background"></div>
      <div class="vpc_showTodoAnimation_container">
        <div class="vpc_showTodoAnimation p-1">
          <div class="row d-flex flex-row justify-content-center">
            <div>
              <span
                class="vpc_select_date"
              >{{dayOfWeek(this.$store.state.calenderStore.selectTodo.day)}} - {{this.$store.state.calenderStore.selectTodo.month}} ماه در سال {{this.$store.state.calenderStore.selectTodo.year}}</span>
            </div>
          </div>
          <div class="row d-flex flex-row justify-content-center">
            <singleInputDisabled
              :allRow="true"
              type="text"
              inputTitle="عنوان"
              v-model="this.$store.state.calenderStore.selectTodo.title"
            ></singleInputDisabled>
            <textareaInputDisabled
              :allRow="true"
              type="description"
              inputTitle="توضیحات"
              v-model="this.$store.state.calenderStore.selectTodo.description"
            ></textareaInputDisabled>
            <singleInputDisabled
              :allRow="true"
              type="text"
              inputTitle="ثبت کننده"
              v-model="this.$store.state.calenderStore.selectTodo.registerer"
            ></singleInputDisabled>
            <div v-on:click.prevent="done">
              <img
                class="calender-accept-icon"
                src="/photo/module/Panel/forms/accept.png"
                width="30px"
                height="30px"
              />
            </div>
            <div v-on:click.prevent="later">
              <img
                class="calender-accept-icon"
                src="/photo/module/Panel/forms/accept.png"
                width="30px"
                height="30px"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- showTodo -->
    <div class="container-fluid vpc_calender">
      <div class="row">
        <listSelector
          :selectedItem="null"
          listName="سال"
          :listSource="null"
          :getSource="this.year"
          :lastValue="data.selectYear"
          @selectid="data.selectYear = $event"
        ></listSelector>
        <listSelector
          :selectedItem="null"
          listName="ماه"
          :listSource="null"
          :getSource="this.month"
          :lastValue="data.selectMonth"
          @selectid="data.selectMonth = $event "
        ></listSelector>
      </div>
      <div class="row" v-if="calenderShow">
        <div class="col-6 col-md-4 col-lg-2 p-1" v-for="(item,index) in this.monthDay" :key="index">
          <div class="vpc_date_part">
            <div class="d-flex flex-row justify-content-around vpc_date_number">
              <div class="vpc_day">{{dayOfWeek(item)}}</div>
              <div class="vpc_date_text">{{item}}</div>
            </div>
            <div class="d-flex flex-row justify-content-center vpc_date_utc">
              <div class="vpc_day">{{englishDate(item)}}</div>
            </div>
            <div class="vpc_todo_list">
              <div
                class="position-relative vpc_todo_item p-1"
                v-bind:class="[(todo.status == 1) ? 'vpc_todo_tolist' :
                                 (todo.status == 2) ? 'vpc_todo_waiting' :
                                  (todo.status == 3) ? 'vpc_todo_done' :
                                   (todo.status == 4) ? 'vpc_todo_other' : 'vpc_todo_tolist']"
                v-for="(todo,index) in todoList.filter((todoItem)=> {return todoItem.day == item})"
                :key="index"
              >
                <div @click="showTodoList(todo)">{{todo.title.substring(0,25)}}</div>
                <div @click="removeToDo(todo.id)" class="vpc_remove_todo">
                  <img src="photo/module/Panel/forms/reject.png" width="9px" height="9px" />
                </div>
              </div>
              <div
                class="vpc_add_todo_btn text-center"
                @click="showTodoRegister(item)"
              >افزودن برنامه</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
<!---->
<style lang="scss">
.vpc_calender {
  direction: rtl;
  text-align: right;
  @include font(faSans);
}
.vpc_date_part {
  position: relative;
  overflow: hidden;
  min-height: 200px;
  border-radius: 10%;
  background: $mainColor1;
  mix-blend-mode: multiply;
  transition: 1s all ease;
  @include shadow(0, 0, 16, 1, rgba(0, 0, 0, 0.5));
  background-image: url("~/photo/module/Panel/forms/calender.svg");
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  animation: show-date-part 1s ease alternate forwards;
}

@keyframes show-date-part {
  0% {
    transform: translateY(200px) scale(0);
  }
  100% {
    transform: translateY(0px) scale(1);
  }
}
.vpc_date_part:hover {
  background: #00bcd4;
  mix-blend-mode: multiply;
  transition: 1s all ease;
  background-image: url("~/photo/module/Panel/forms/calenderhover.svg");
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}

.vpc_date_number {
  z-index: 1;
  top: 0px;
  right: 0px;
  width: 100%;
  position: absolute;
  background-color: #d81b60;
  height: 23px;
  font-size: 1em;
}

.vpc_day {
  color: #ffffff;
}

.vpc_date_text {
  color: #ffffff;
}

.vpc_date_utc {
  z-index: 1;
  top: 23px;
  right: 0px;
  width: 100%;
  position: absolute;
  background-color: #e0e0e0;
  font-size: 0.8em;
}

.vpc_todo_list {
  position: absolute;
  bottom: 0px;
  right: 0px;
  width: 100%;
}
.vpc_add_todo_btn {
  font-family: IRANSans;
  background-color: #ec407a;
  height: 25px;
  color: #ffffff;
  transition: 1s ease all;
  cursor: pointer;
  font-size: 0.8em;
}
.vpc_add_todo_btn:hover {
  background-color: #ad1457;
  transition: 1s ease all;
}
.vpc_todo_item {
  font-family: IRANSans;
  height: 20px;
  color: #212121;
  font-size: 0.8em;
}
.vpc_todo_waiting:hover {
  background-color: #8e24aa;
  color: #ffffff;
  transition: 1s ease all;
}
.vpc_todo_waiting {
  background-color: #ea80fc;
  transition: 1s ease all;
  cursor: pointer;
}
.vpc_todo_done {
  background-color: #00e676;
  transition: 1s ease all;
  cursor: pointer;
}
.vpc_todo_done:hover {
  background-color: #2e7d32;
  color: #ffffff;
  transition: 1s ease all;
}
.vpc_todo_other {
  background-color: #bcaaa4;
  transition: 1s ease all;
  cursor: pointer;
}
.vpc_todo_other:hover {
  background-color: #8d6e63;
  color: #ffffff;
  transition: 1s ease all;
}
.vpc_todo_tolist {
  background-color: #ffd180;
  transition: 1s ease all;
  cursor: pointer;
}
.vpc_todo_tolist:hover {
  background-color: #ffa000;
  color: #ffffff;
  transition: 1s ease all;
}
.vpc_remove_todo {
  position: absolute;
  left: 10px;
  top: 0px;
}
.vpc_select_date {
  @include font(faSans);
  font-size: 0.8em;
}
.calender-accept-icon {
  cursor: pointer;
  margin: 10px;
}
</style>
<script>
var moment = require("moment-jalaali");
export default {
  name: "persianCalender",
  props: ["lastImageProp"],
  data() {
    return {
      showNotify: false,
      showRegisterDate: false,
      showTodo: false,
      calenderShow: true,
      users: "",
      registerCalenderAnimation: new this.$root.$data.gsapVpc.timeline(),
      showTodoAnimation: new this.$root.$data.gsapVpc.timeline(),
      data: {
        selectedDay: "",
        selectYear: "",
        selectMonth: "",
        title: "",
        description: "",
        users: null,
      },
    };
  },
  ///////////////////////////////////////////////////////////////////////methods
  methods: {
    day() {
      let day = new Date("December 17, 1995 03:24:00");
      return day.getDay();
    },
    changeYear(e) {
      this.calenderShow = false;
      this.data.selectYear = e;
      this.$store.dispatch("userCalender", this.data);
      setTimeout(() => {
        this.calenderShow = true;
      }, 100);
    },
    changeMonth(e) {
      this.calenderShow = false;
      this.data.selectMonth = e;
      this.$store.dispatch("userCalender", this.data);
      setTimeout(() => {
        this.calenderShow = true;
      }, 500);
    },
    dayOfWeek(item) {
      let dayOfWeek = new Date(
        moment(
          this.data.selectYear +
            "-" +
            (this.month.indexOf(this.data.selectMonth) + 1) +
            "-" +
            item,
          "jYYYY-jM-jD"
        ).format("YYYY-M-D")
      ).getDay();
      if (dayOfWeek == 0) {
        return "یکشنبه";
      }
      if (dayOfWeek == 1) {
        return "دوشنبه";
      }
      if (dayOfWeek == 2) {
        return "سه شنبه";
      }
      if (dayOfWeek == 3) {
        return "چهارشنبه";
      }
      if (dayOfWeek == 4) {
        return "پنجشنبه";
      }
      if (dayOfWeek == 5) {
        return "جمعه";
      }
      if (dayOfWeek == 6) {
        return "شنبه";
      }
    },
    englishDate(item) {
      return moment(
        this.data.selectYear +
          "-" +
          (this.month.indexOf(this.data.selectMonth) + 1) +
          "-" +
          item,
        "jYYYY-jM-jD"
      ).format("YYYY-M-D");
    },
    removeToDo(data) {
      if (confirm("آیا از انجام عملیات مطمئن هستید")) {
        axios.defaults.headers.common["Authorization"] =
          "Bearer " +
          (document.cookie.match("(^|;) ?token=([^;]*)(;|$)")
            ? document.cookie.match("(^|;) ?token=([^;]*)(;|$)")[2]
            : null);
        axios
          .delete("/api/v1/deleteTodoCalender/" + data)
          .then((response) => {
            this.$store.dispatch("userCalender", this.data);
          })
          .catch((error) => {});
      } else {
        alert("اطلاعات تغییری نکرده است");
      }
    },
    showTodoList(item) {
      this.$store.dispatch("selectTodo", item);
      this.showTodo = true;
    },
    closeRegisterDate() {
      this.showRegisterDate = false;
    },
    closShowTodo() {
      this.showTodo = false;
    },
    showTodoRegister(item) {
      this.data.selectedDay = item;
      this.showRegisterDate = true;
    },
    //selectDate
    done() {
      const data = new FormData();
      data.append("id", this.$store.state.calenderStore.selectTodo.id);
      axios.defaults.headers.common["Authorization"] =
        "Bearer " +
        (document.cookie.match("(^|;) ?token=([^;]*)(;|$)")
          ? document.cookie.match("(^|;) ?token=([^;]*)(;|$)")[2]
          : null);
      axios
        .post("api/v1/todoDone", data)
        .then((response) => {
          this.showTodo = false;
          this.showNotify = true;
          (this.data.title = ""), (this.data.title = "");
          this.data.description = "";
          this.data.users = "";
          let refresh = {
            selectYear: this.$store.state.calenderStore.selectTodo.year,
            selectMonth: this.$store.state.calenderStore.selectTodo.month,
          };
          this.$store.dispatch("userCalender", refresh);
        })
        .catch((error) => {});
    },
    later() {
      const data = new FormData();
      data.append("id", this.$store.state.calenderStore.selectTodo.id);
      axios.defaults.headers.common["Authorization"] =
        "Bearer " +
        (document.cookie.match("(^|;) ?token=([^;]*)(;|$)")
          ? document.cookie.match("(^|;) ?token=([^;]*)(;|$)")[2]
          : null);
      axios
        .post("api/v1/todoLater", data)
        .then((response) => {
          this.showTodo = false;
          this.showNotify = true;
          (this.data.title = ""), (this.data.title = "");
          this.data.description = "";
          this.data.users = "";
          let refresh = {
            selectYear: this.$store.state.calenderStore.selectTodo.year,
            selectMonth: this.$store.state.calenderStore.selectTodo.month,
          };
          this.$store.dispatch("userCalender", refresh);
        })
        .catch((error) => {});
    },
    nameAndFamily({ name, family }) {
      return `${name}  ${family}`;
    },
    //selectDate
    //submitRegisterDate
    submitRegisterDate() {
      const data = new FormData();
      data.append("title", this.data.title);
      data.append("description", this.data.description);
      data.append("day", this.data.selectedDay);
      data.append("month", this.data.selectMonth);
      data.append("year", this.data.selectYear);
      data.append("users", JSON.stringify(this.data.users));
      axios.defaults.headers.common["Authorization"] =
        "Bearer " +
        (document.cookie.match("(^|;) ?token=([^;]*)(;|$)")
          ? document.cookie.match("(^|;) ?token=([^;]*)(;|$)")[2]
          : null);
      axios.post("api/v1/registTodo", data).then((response) => {
        this.showRegisterDate = false;
        this.showNotify = true;
        (this.data.title = ""), (this.data.title = "");
        this.data.description = "";
        this.data.users = "";
        let refreshDate = {
          selectMonth: this.data.selectMonth,
          selectYear: this.data.selectYear,
        };
        this.$store.dispatch("userCalender", refreshDate);
      });
    },
    //submitRegisterDate
    closeNotify() {
      this.showNotify = false;
    },
  },
  ///////////////////////////////////////////////////////////////////////methods
  ///////////////////////////////////////////////////////////////////////compute
  computed: {
    year: {
      get() {
        let year = [];
        for (var i = 1380; i <= 1480; i++) {
          year.push(i);
        }
        return year;
      },
    },
    month: {
      get() {
        let month = [
          "فروردین",
          "اردیبهشت",
          "خرداد",
          "تیر",
          "مرداد",
          "شهریور",
          "مهر",
          "آبان",
          "آذر",
          "دی",
          "بهمن",
          "اسفند",
        ];
        return month;
      },
    },
    monthDay: {
      get() {
        if (
          this.data.selectMonth === "فروردین" ||
          this.data.selectMonth === "اردیبهشت" ||
          this.data.selectMonth === "خرداد" ||
          this.data.selectMonth === "تیر" ||
          this.data.selectMonth === "مرداد" ||
          this.data.selectMonth === "شهریور"
        ) {
          let monthDay = [
            1,
            2,
            3,
            4,
            5,
            6,
            7,
            8,
            9,
            10,
            11,
            12,
            13,
            14,
            15,
            16,
            17,
            18,
            19,
            20,
            21,
            22,
            23,
            24,
            25,
            26,
            27,
            28,
            29,
            30,
            31,
          ];
          return monthDay;
        }
        if (
          this.data.selectMonth === "مهر" ||
          this.data.selectMonth === "آبان" ||
          this.data.selectMonth === "آذر" ||
          this.data.selectMonth === "دی" ||
          this.data.selectMonth === "بهمن"
        ) {
          let monthDay = [
            1,
            2,
            3,
            4,
            5,
            6,
            7,
            8,
            9,
            10,
            11,
            12,
            13,
            14,
            15,
            16,
            17,
            18,
            19,
            20,
            21,
            22,
            23,
            24,
            25,
            26,
            27,
            28,
            29,
            30,
          ];
          return monthDay;
        }
        if (
          this.data.selectMonth === "اسفند" &&
          this.data.selectYear % 4 === 1
        ) {
          let monthDay = [
            1,
            2,
            3,
            4,
            5,
            6,
            7,
            8,
            9,
            10,
            11,
            12,
            13,
            14,
            15,
            16,
            17,
            18,
            19,
            20,
            21,
            22,
            23,
            24,
            25,
            26,
            27,
            28,
            29,
            30,
          ];
          return monthDay;
        }
        if (
          this.data.selectMonth === "اسفند" &&
          this.data.selectYear % 4 !== 1
        ) {
          let monthDay = [
            1,
            2,
            3,
            4,
            5,
            6,
            7,
            8,
            9,
            10,
            11,
            12,
            13,
            14,
            15,
            16,
            17,
            18,
            19,
            20,
            21,
            22,
            23,
            24,
            25,
            26,
            27,
            28,
            29,
          ];
          return monthDay;
        }
      },
    },
    toDayMonth: {
      get() {
        let toDayMountNumber = moment().format("jM");
        if (toDayMountNumber == 1) {
          this.data.selectMonth = "فروردین";
        }
        if (toDayMountNumber == 2) {
          this.data.selectMonth = "اردیبهشت";
        }
        if (toDayMountNumber == 3) {
          this.data.selectMonth = "خرداد";
        }
        if (toDayMountNumber == 4) {
          this.data.selectMonth = "تیر";
        }
        if (toDayMountNumber == 5) {
          this.data.selectMonth = "مرداد";
        }
        if (toDayMountNumber == 6) {
          this.data.selectMonth = "شهریور";
        }
        if (toDayMountNumber == 7) {
          this.data.selectMonth = "مهر";
        }
        if (toDayMountNumber == 8) {
          this.data.selectMonth = "آبان";
        }
        if (toDayMountNumber == 11) {
          this.data.selectMonth = "آذر";
        }
        if (toDayMountNumber == 10) {
          this.data.selectMonth = "دی";
        }
        if (toDayMountNumber == 11) {
          this.data.selectMonth = "بهمن";
        }
        if (toDayMountNumber == 12) {
          this.data.selectMonth = "اسفند";
        }
      },
    },
    toDayYear: {
      get() {
        this.data.selectYear = moment().format("jYYYY");
      },
    },
    todoList: {
      get() {
        return this.$store.state.calenderStore.userCalender;
      },
    },
    selectYearByUser: {
      get() {
        return this.data.selectYear;
      },
    },
    selectMonthByUser: {
      get() {
        return this.data.selectMonth;
      },
    },
  },
  ///////////////////////////////////////////////////////////////////////watch
  watch: {
    toDayYear: function () {
      this.data.selectYear = this.toDayYear;
    },
    toDayMonth: function () {
      this.data.selectMonth = this.toDayMonth;
    },
    selectYearByUser: function () {
      this.changeYear(this.data.selectYear);
    },
    selectMonthByUser: function () {
      this.changeMonth(this.data.selectMonth);
    },
    showRegisterDate: function () {
      if (this.showRegisterDate) {
        setTimeout(() => {
          this.registerCalenderAnimation.to(".vpc_registerCalender", 0.5, {
            width: 400,
          });
        }, 100);
      }
    },
    showTodo: function () {
      if (this.showTodo) {
        setTimeout(() => {
          this.registerCalenderAnimation.to(".vpc_showTodoAnimation", 0.5, {
            width: 400,
          });
        }, 100);
      }
    },
  },
  ///////////////////////////////////////////////////////////////////////watch
  created() {
    this.$store.dispatch("userCalender", this.data);
    this.$store.dispatch("allUserForCalender");
  },
};
</script>