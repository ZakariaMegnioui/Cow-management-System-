<template>
  <!---  Login form   -->
  <div class="w-full h-full flex bg-white overflow-hidden">

    <div class="w-2/3 hidden md:flex flex-col  bg-orange-100" style="background:#161d30;">
      <div class="brandLogo h-1/6 w-full p-8 flex  items-center justify-start">
        <span class=" w-64 h-64">
          <img
           width="1000"
              height="1000"
              class=""
              alt="BOTFONAST"
              :src="logo"

            >
        </span>

      </div>
      <div class="photo h-5/6 flex justify-center items-center w-full" style="">

        <span class="  w-full h-full  flex justify-center items-center">

       <img :src="bg" class="mb-32"  width="1100"
              height="1100" alt="" >

        </span>
      </div>
    </div>
    <div class="flex flex-col items-center  justify-center md:w-1/3 p-8 py-0 w-full " style="background:#283045">
      <div class="p-8 px-12 ">
        <div class="title-wrap  d-flex flex-column ">
          <span class="sm:block  md:hidden w-16 h-16 mx-auto mb-8">
            <img
              class="logob "
              alt="BOTFONAST"
              :src="logo"
            >
          </span>
          <h3 class=" text-gray-200 text-left font-bold text-3xl w-11/12 flex  self-center">Bienvenue a BOTFONAST</h3>
          <span class="sub-title mt-4 text-xl   text-gray-400 w-11/12 flex  self-center">
            Gestion informatisee des troupeaux bovins laitiers
          </span>

        </div>
        <el-form ref="loginForm" :model="loginForm" :rules="loginRules" class="login-form my-8 flex flex-col items-center " auto-complete="on" label-position="left">
          <div class="mb-3 w-11/12">
            <label class="text-left   text-lg mb-1 text-gray-400" for="email">
              Email
            </label>
            <input
              id="email"
              v-model="loginForm.email"
              name="email"
              type="text"
              class="relative form-control py-3"
              auto-complete="on"
              placeholder="identifiant D'utilisateur"
            />
          </div>
          <div class="mb-3 w-11/12">
            <label class="text-left text-lg mb-1 text-gray-400" for="email">
              Mot de passe
            </label>
            <input
              v-model="loginForm.password"
              class="relative form-control py-3"
              name="password"
              auto-complete="on"
              placeholder="Mot de Passe"
              :type="pwdType"
              @keyup.enter.native="handleLogin"
            />

            <!-- <span class="show-pwd block border border-gray-900 absolute right-0 top-1/2 transform -translate-y-1/2" @click="showPwd">
                <svg-icon icon-class="eye" />
              </span> -->
          </div>

          <div class="w-11/12">
            <div class="form-check ">
              <input id="remember" name="remember" class="form-check-input w-6 h-6" type="checkbox" value="">
              <label class="form-check-label label-check mt-0.5  color-white ml-3 text-lg text-gray-400 " for="SouvCHeck">
                Souviens De Moi
              </label>
            </div>

            <el-form-item class="mt-3">
              <el-button :loading="loading" type="primary" class=" " style="width:100%;background-color:#7367f0;padding-top:20PX;padding-bottom:20px ;border-color:#7367f0;color: #fff;font-size: 18px;font-weight: bold; border-radius:8PX" @click.native.prevent="handleLogin">
                CONNEXION
              </el-button>
            </el-form-item>
          </div>
          <div class=" w-11/12 flex flex-col items-center" >
            <span class=" flex text-gray-400 text-lg" style="
            ">
             Reinitialiser votre
              <router-link :to="{name:'Forgot' }" class="hover:underline ml-2" style="color:#7367f0;font-weight: bold;"> Mot de pass</router-link>

            </span>
            <span class="w-5/6  bg-gray-400 mt-12" style="height:0.5px"></span>
            <span class=" absolute bottom-44 underline underline-offset-8" style="font-size: 17px;font-weight: bold;color:#7367f0;">

              <router-link :to="{name:'Contact' }">Contact</router-link>
            </span>
          </div>
        </el-form>
      </div>
    </div>
  </div>

</template>
<script>
import { validEmail } from '@/utils/validate';
import { csrf } from '@/api/auth';

const logo = require('@/assets/login/valiiri.png').default;
const bg = require('@/assets/login/image.png').default;
const bgimage = require('@/assets/login/cowBG.png').default;
export default {
  name: 'Login',
  components: {},
  data() {
    const validateEmail = (rule, value, callback) => {
      if (!validEmail(value)) {
        callback(new Error('Please enter the correct email'));
      } else {
        callback();
      }
    };
    const validatePass = (rule, value, callback) => {
      if (value.length < 4) {
        callback(new Error('Password cannot be less than 4 digits'));
      } else {
        callback();
      }
    };
    return {
      loginForm: {
        email: '',
        password: '',

      },
      loginRules: {
        email: [{ required: true, trigger: 'blur', validator: validateEmail }],
        password: [{ required: true, trigger: 'blur', validator: validatePass }],
      },
      loading: false,
      pwdType: 'password',
      redirect: undefined,
      otherQuery: {},
      logo: logo,
      bg:bg,
      bgimage: bgimage,

    };
  },
  watch: {
    $route: {
      handler: function(route) {
        const query = route.query;
        if (query) {
          this.redirect = query.redirect;
          this.otherQuery = this.getOtherQuery(query);
        }
      },
      immediate: true,
    },
  },
  methods: {

    showPwd() {
      if (this.pwdType === 'password') {
        this.pwdType = '';
      } else {
        this.pwdType = 'password';
      }
    },
    handleLogin() {
      this.$refs.loginForm.validate(valid => {
        if (valid) {
          this.loading = true;
          csrf().then(() => {
            this.$store.dispatch('user/login', this.loginForm)
              .then(() => {
                this.$router.push({ path: this.redirect || '/', query: this.otherQuery }, onAbort => {});
                this.loading = false;
              })
              .catch(() => {
                this.loading = false;
              });
          });
        } else {
          console.log('error submit!!');
          return false;
        }
      });
    },

    getOtherQuery(query) {
      return Object.keys(query).reduce((acc, cur) => {
        if (cur !== 'redirect') {
          acc[cur] = query[cur];
        }
        return acc;
      }, {});
    },

  },

};

</script>

<style rel="stylesheet/scss" lang="scss" scoped>

$bg:#2d3a4b;
$mybg:rgb(255, 255, 255);
$GreenColor:#3f776c;
$dark_gray:#889aa4;
$light_gray:rgb(7, 6, 6);
$bgColor: #054b5d;
$brown: #B27C66;
$textColor:#eee;
$primary:#7367f0;
$bg:#2d3a4b;
$light_gray:#eee;

/* reset element-ui css */
.bgimage{
  background-image: url('../../assets/login/cowBG.svg');
  background-size: contain;
  background-position: center;
  background-repeat: no-repeat;
}
.login-container {
    border-radius: 0px;

   .my_logo{
     background-color: rgb(228, 224, 224);
     width:250px;
     display: flex;
     justify-content: center;
     align-items: center;
     justify-items: center;

   }

   .label-check{
     color:rgba(240, 236, 236, 0.568);
     font-size: 11px;
     font-weight: lighter;
     margin-right: 70px !important;
     }
  .el-input {
    display: inline-block;
    height: 47px;
    width: 300px;
    input {
      background: white;
      border: 0px;
      -webkit-appearance: none;
      border-radius: 10px;
      padding: 12px 5px 12px 15px;
      color: rgba(73, 73, 73, 0.733);
      height: 47px;
      &:-webkit-autofill {
        -webkit-box-shadow: 0 0 0px 1000px white inset !important;
        -webkit-text-colorfill-color: rgb(228, 228, 228) !important;
      }
    }
  }
  .el-form-item {
    border: 1px solid rgba(255, 255, 255, 0.1);
    background: rgba(0, 0, 0, 0.1);
    border-radius: 5px;
    color: #454545;
  }
}
.login {
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: $mybg;
  transition: background-color .3s ease-in-out;
  overflow: hidden;

  .login-container {
    background: $primary;
    width: 100%;
    min-height: 100%;
    display: grid;
    grid-template-columns: auto 480px;
    transition: all .3s ease-in-out;
    transform: scale(1);

    .logo {
      display: block;
      width: 80px;
      height: 80px;
      margin-bottom: 20px;
    }

    .login-image {
      display: flex;
      flex-direction: row;
      justify-content: flex-end;
      overflow: hidden;
      background-color: #303c4b;
      background-image: url('../../assets/login/cowBG.png');
      background-size: cover;
      background-position: 0 ;
      opacity: 1;
      transition: opacity .3s ease-in-out,padding .2s ease-in-out;
      border-radius: 20px 0 0 20px;

      .photo-credit {
        justify-content: flex-end;
        align-self: flex-end;
        background-color: rgba(255,255,255,0.8);
        margin: 10px;
        padding: 5px 8px;

        h4, span { margin: 0; }
      }
    }

    .login-form {
      display: flex;
      flex-direction: column;
      justify-content: center;
      justify-items: center;
      align-items: center;
      min-width: 320px;
      padding: 130px 60px;
      position: relative;
      opacity: 1;
      transition: opacity .3s ease-in-out,padding .2s ease-in-out;
    }
    .tips {
      font-size: 14px;
      color: #fff;
      margin-bottom: 10px;
      span {
        &:first-of-type {
          margin-right: 16px;
        }
      }
    }
    .svg-container {
      padding: 6px 5px 6px 15px;
      color: $dark_gray;
      vertical-align: middle;
      width: 30px;
      display: inline-block;
    }
    .title-wrap {

      .title {
        font-size: 24px;
        color: $textColor;
        display: block;
        margin: 0px auto 0px auto;
        text-align: left;
        font-weight: bold;
      }
      .sub-title{
        font-size: 9px;
        color: rgba(228, 228, 228, 0.726);
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
      }
      .sub-heading {
        font-size: 14px;
        color: $textColor;
        padding-bottom: 15px;
      }
    }

    .show-pwd {
      // position: absolute;
      // right: 10px;
      // top: 7px;
      // font-size: 16px;
      // color: $dark_gray;
      // cursor: pointer;
      // user-select: none;
    }
    .set-language {
      color: $textColor;
      position: absolute;
      top: 40px;
      right: 35px;
    }
  }
}
input{
  border-radius: 10px;;
}
</style>
