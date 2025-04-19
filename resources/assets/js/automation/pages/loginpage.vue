<template>
  <section>
    <section class="fulllogin">
      <div class="container d-flex flex-row justify-content-center">
        <div class="row d-flex flex-row justify-content-center login-form py-5">
          <!---------------------------------------------------------->
          <!-------------------------login--------------------------------->
          <div class="col-md-12">
            <form class="m-3">
              <!---->
              <div class="w-100 d-flex flex-column justify-content-center">
                <div class="d-flex flex-row justify-content-center w-100">
                  <div class="inputst p-0">
                    <div class="d-flex flex-row">
                      <input
                        class="w-100 inputst-text"
                        v-on:keyup.enter="handleLoginFormSubmit"
                        v-model="login.username"
                        placeholder="Username"
                      />
                      <img
                        src="photo/module/Panel/login/user.svg"
                        class="mx-2 mt-1"
                        style="width: 20px; height:20px"
                        alt="vira"
                      />
                    </div>
                  </div>
                </div>
              </div>
              <!---->
              <br />
              <!---->
              <div class="w-100 d-flex flex-column justify-content-center">
                <div class="d-flex flex-row justify-content-center w-100">
                  <div class="inputst p-0">
                    <div class="d-flex flex-row">
                      <input
                        class="w-100 inputst-text"
                        v-on:keyup.enter="handleLoginFormSubmit"
                        placeholder="Password"
                        v-model="login.password"
                        type="password"
                        autocomplete
                      />
                      <img
                        src="photo/module/Panel/login/lock.svg"
                        class="mx-2 mt-1 button-z"
                        style="width: 20px; height:20px"
                        alt="vira"
                        @mousedown="showpassword"
                        @mouseup="hidepassword"
                      />
                    </div>
                  </div>
                </div>
              </div>
              <!---->
              <br />
              <!---->
              <div class="w-100 d-flex flex-column justify-content-center">
                <div class="d-flex flex-row justify-content-center w-100">
                  <div class="p-0 inputst captcha-background">
                    <div
                      class="w-100 d-flex flex-row justify-content-center align-item-center h-100 captcha"
                      oncopy="return false"
                      oncut="return false"
                      unselectable="on"
                      onselectstart="return false;"
                      onmousedown="return false;"
                    >{{this.captcha}}</div>
                  </div>
                </div>
              </div>
              <!---->
              <br />
              <!---->
              <div
                class="d-flex justify-content-center w-100 capchatitle"
              >Enter exactly the above number</div>
              <!---->
              <br />
              <!---->
              <div class="w-100 d-flex flex-column justify-content-center">
                <div class="d-flex flex-row justify-content-center w-100">
                  <div class="inputst p-0">
                    <div class="d-flex flex-row">
                      <input
                        class="w-100 inputst-text"
                        v-model="vcaptcha.value"
                        v-on:keyup.enter="handleLoginFormSubmit"
                        type="text"
                      />
                      <img
                        @click="refreshcaptcha"
                        src="photo/module/Panel/login/reload.svg"
                        class="mx-2 mt-1 button-z"
                        style="width: 20px; height:20px"
                        alt="vira"
                      />
                    </div>
                  </div>
                </div>
              </div>
              <!---->
              <br />
              <!---->
            </form>
            <div class="w-100 d-flex flex-column justify-content-center">
              <div class="d-flex flex-row justify-content-center w-100">
                <div class="inputst p-0">
                  <div class="d-flex flex-row">
                    <div
                      v-on:click.prevent="handleLoginFormSubmit"
                      class="panel-button text-center align-items-center justify-content-center"
                    >
                      <span class="w-100 text-center">Sign in</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!---->
            <br />
            <!---->
            <div class="d-flex flex-row justify-content-center w-100">
              <div class="buttonst text-center w-100 my-2">
                <router-link class="w-100 forget" :to="{ path: '/forgottenpassword'}">
                  <a class="w-100 text-center">Forgot Your Password</a>
                </router-link>
              </div>
            </div>
          </div>
        </div>
        <!-------------------------login--------------------------------->
        <!---------------------------------------------------------->
      </div>
      <div class="logo-left">
        <span class="vira">&nbsp ویرا ارتباطات پرشیا &nbsp</span>
      </div>
      <div class="logo">
        <div class="d-flex flex-row align-items-center">
          <img src="photo/module/Panel/login/logo.png" width="60px" height="60px" />
          <span class="type"></span>
        </div>
      </div>
    </section>
  </section>
</template>
<style scoped>
/*main*/
.forget {
  text-decoration: none;
  color: white;
  font-family: IRANSans;
  cursor: pointer;
}

.fulllogin {
  height: 100vh !important;
  width: 100% !important;
  background-image: url("~/photo/module/Panel/login/loginbackground.jpg");
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  overflow-x: hidden;
}

.logo {
  position: absolute;
  bottom: 0px;
  left: 10px;
}
.logo-left {
  position: absolute;
  bottom: 25px;
  right: 10px;
}
.login-form {
  margin-top: 200px;
  direction: rtl;
  background-color: #fff;
  width: 700px;
  position: relative;
  background: transparent;
}

@media only screen and (max-width: 600px) {
  .login-form {
    width: 400px;
  }
}

@media only screen and (max-height: 680px) {
  .logo {
    display: none;
  }
  .logo-left {
    display: none;
  }
}

.login-form:before {
  content: "";
  position: absolute;
  top: 0;
  right: 0;
  width: 100%;
  height: 100%;
  background: rgb(204, 16, 42);
  background: -moz-linear-gradient(
    rgb(243, 243, 243) 0%,
    rgb(255, 56, 92) 60%,
    rgb(138, 19, 24) 80%
  );
  background: -webkit-linear-gradient(
    rgb(243, 243, 243) 0%,
    rgb(255, 56, 92) 60%,
    rgb(138, 19, 24) 80%
  );
  background: -o-linear-gradient(
    rgb(243, 243, 243) 0%,
    rgb(255, 56, 92) 60%,
    rgb(138, 19, 24) 80%
  );
  background: -ms-linear-gradient(
    rgb(243, 243, 243) 0%,
    rgb(255, 56, 92) 60%,
    rgb(138, 19, 24) 80%
  );
  background: linear-gradient(
    rgb(243, 243, 243) 0%,
    rgb(255, 56, 92) 60%,
    rgb(138, 19, 24) 80%
  );
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#8A1318', endColorstr='#FF385C', GradientType=1);
  mix-blend-mode: multiply;
  isolation: isolate;
}

.label-text {
  font-family: IRANSans;
  color: #868686;
  font-size: 0.8em;
  text-align: right;
  color: #ffffff;
}

.capchatitle {
  color: #ffffff !important;
}

/*main*/

.type {
  color: #ffffff;
  direction: ltr;
  text-alight: right;
}

.vira {
  color: #cb2026;
  font-weight: bold;
  direction: rtl;
  text-alight: right;
  font-family: IRANSans;
}

.inputst-text {
  background-color: transparent;
  z-index: 2;
  border: none;
  text-align: left;
  font-family: IRANSans;
  font-size: 0.9em;
  height: 30px;
  color: #6b696c;
  transition: 0.5s all ease;
  position: relative;
}

.inputst {
  position: relative;
  border-radius: 25px;
  height: 30px;
  overflow-y: hidden;
  overflow-x: hidden;
  border-width: thin;
  font-size: 1em;
  background-color: #f7f9fc;
  outline: none;
  transition: 0.5s all ease;
  width: 350px;
}

.inputst:before {
  content: "";
  right: 0;
  position: absolute;
  width: 0%;
  height: 100%;
  border-radius: 25px;
  transition: 0.5s all ease;
  background: rgb(224, 224, 224);
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#8A1318', endColorstr='#FF385C', GradientType=1);
  mix-blend-mode: multiply;
}

.inputst:hover:before {
  width: 110%;
  transition: 0.5s all ease;
}

.inputst-text:focus {
  outline: none;
  color: #0f0f0f;
  transition: 0.5s all ease;
  background: rgb(224, 224, 224);
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#8A1318', endColorstr='#FF385C', GradientType=1);
}

.panel-button {
  font-family: IRANSans;
  position: relative;
  display: flex;
  float: none;
  margin: 0 auto;
  color: white;
  width: 100%;
  height: 30px;
  font-size: 1em;
  background: rgb(240, 98, 146); /* Old browsers */
  background: -moz-linear-gradient(
    top,
    rgb(233, 30, 99) 30%,
    rgb(240, 98, 146) 98%
  );
  background: -webkit-linear-gradient(
    top,
    rgb(233, 30, 99) 30%,
    rgb(240, 98, 146) 98%
  );
  background: linear-gradient(
    to bottom,
    rgb(233, 30, 99) 30%,
    rgb(240, 98, 146) 98%
  );
  transition: all 0.2s ease;
  text-align: center;
  overflow: hidden;
  cursor: pointer;
  border-radius: 25px;
}

.panel-button:before {
  content: "";
  right: 0px;
  position: absolute;
  width: 0;
  height: 100%;
  border-radius: 10px;
  transition: 0.5s all ease;
  background: rgba(224, 224, 224, 0.1);
}

.panel-button:hover:before {
  width: 100%;
  transition: 0.5s all ease;
}

.panel-button a {
  z-index: 5;
  color: #ffffff !important;
  font-family: IRANSans;
  text-align: center;
}

.button-z {
  z-index: 50;
  cursor: pointer;
}

/*panel-button*/
/*captcha*/
.capchatitle {
  font-family: IRANSans;
  font-size: 0.9em;
  color: #dc1717;
  user-select: none; /* supported by Chrome and Opera */
  -webkit-user-select: none; /* Safari */
  -khtml-user-select: none; /* Konqueror HTML */
  -moz-user-select: none; /* Firefox */
  -ms-user-select: none; /* Internet Explorer/Edge */
}

.captcha {
  color: #37474f !important;
  font-size: 1.2em;
  transform: skew(50deg);
  font-weight: bold;
  user-select: none;
  -webkit-user-select: none;
  -khtml-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
}

.captcha-background {
  background-image: linear-gradient(
      45deg,
      rgba(249, 102, 151, 0.18) 25%,
      transparent 25%
    ),
    linear-gradient(135deg, rgba(249, 102, 151, 0.18) 25%, transparent 25%),
    linear-gradient(45deg, transparent 75%, rgba(249, 102, 151, 0.18) 75%),
    linear-gradient(135deg, transparent 75%, rgba(249, 102, 151, 0.18) 75%);
  background-size: 25px 25px; /* Must be a square */
  background-position: 0 0, 12.5px 0, 12.5px -12.5px, 0px 12.5px; /* Must be half of one side of the square */
}
/*captcha*/
</style>
<script>
import TypeIt from "typeit";

export default {
  name: "adminlogin",
  data() {
    return {
      vcaptcha: {
        value: "",
        newcaptcha: 1
      },
      login: {
        username: "",
        password: ""
      }
    };
  },
  computed: {
    captcha: {
      get() {
        var randomvalue = Math.floor(
          Math.random() *
            100000 *
            (Math.random() * 10 * this.vcaptcha.newcaptcha) +
            1
        );
        return randomvalue;
      }
    }
  },
  methods: {
    showpassword(e) {
      $(e.target)
        .siblings()
        .attr("type", "text");
    },
    hidepassword(e) {
      $(e.target)
        .siblings()
        .attr("type", "password");
    },
    refreshcaptcha() {
      this.vcaptcha.newcaptcha = Math.random() * 10;
    },
    handleLoginFormSubmit() {
      if (this.captcha == this.vcaptcha.value) {
        this.$store
          .dispatch("loginToken", {
            username: this.login.username,
            password: this.login.password
          })
          .then(response => {
            this.$router.push({ name: "dashboard" });
          })
          .catch(error => {
            Vue.notify({
              group: "notification",
              type: "error",
              title: "نام کاربری با کلمه عبور اشتباه است",
              text: "می توانید نام کاربری خود را بازیابی کنید",
              duration: 10000
            });
          });
      } else {
        Vue.notify({
          group: "notification",
          type: "error",
          title: "احراز هویت",
          text: "لطفا مقادیر اعتبار سنجی را درست وارد کنید",
          duration: 10000
        });
      }
    }
  },
  mounted: function() {
    new TypeIt(".type", {
      strings: [
        "Provides Integrated Enterprise Solutions",
        "Web And Mobile App Design And Development",
        "Best Information Security Solutions ",
        "Designing Security Architecture Solutions",
        "Design And Implementation of Inbound And Outbound Communication Platforms"
      ],
      breakLines: false,
      loop: true
    }).go();
  }
};
</script>
