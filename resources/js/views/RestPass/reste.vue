/* eslint-disable vue/valid-v-if */
/* eslint-disable key-spacing */
/* eslint-disable no-undef */
/* eslint-disable no-undef */

<template>

  <!---  Login form   -->
  <div class="login">
    <div class="login-container">
      <div class="login-image">
        <!---->
      </div>
      <div class="login-content">
        <div class="bg-white my_logo mx-auto my-3 py-2">
          <h5 class="">App logo</h5>
        </div>
        <div class="title-wrap d-flex flex-column justify-content-center  align-items-center">
          <!---  <img
              class="logo "
              alt="Laravue"
              :src="logo"
            >-->
          <h3 class="title" style="font-size: 16px;font-weight: normal;">
            <!-- {{ $t('login.title') }}-->
            Reinitialiser votre Mot De pass
            <!--  <lang-select class="set-language" />-->
          </h3>

        </div>
        <el-form ref="RestForm" :model="RestForm" :rules="RestRules" class="login-form " auto-complete="on" label-position="left">
          <!-- <el-form-item prop="email">
            <span class="svg-container">
              <svg-icon icon-class="user" />
            </span>-->
          <div v-if="!PasswordRest">
            <div class="mb-3">
              <el-input
                v-model="RestForm.email"
                name="email"
                type="text"
                auto-complete="on"
                placeholder="identifiant D'utilisateur"
              />
            </div>
            <div class="mb-3">
              <el-input
                v-model="RestForm.password"
                name="password"
                auto-complete="on"
                placeholder="Mot de Passe"
                :type="pwdType"
                @keyup.enter.native="RestPass"
              />

            </div>
            <div class="mb-3">
              <el-input
                v-model="RestForm.password_confirmation"
                name="password_confirmation"
                auto-complete="on"
                placeholder="Confirmer le Mot de Passe"
                :type="pwdType"
                @keyup.enter.native="RestPass"
              />

            </div>
            <div class="py-3  d-flex flex-row justify-content-center align-items-center">

              <el-form-item class="ml-5">
                <el-button :loading="loading" type="primary" style="width:100%;background-color:#faefbae0;border-color: #f6e58d;color: black;font-size: 12px;font-weight: bold;" @click.native.prevent="RestPass">
                  ENVOYER
                </el-button>
              </el-form-item>
            </div>
          </div>
          <div>
            <p class="text-white" style="text-align: justify;">
              {{ Message }}
            </p>
          </div>
          <div class="row mt-5" style="width: 300px;">
            <span class="text-white " style="font-size: 11px;font-weight: normal;">
              <router-link :to="{name:'login'}" class="d-flex justify-content-center align-items-center">Se connecter</router-link>
            </span>
          </div>
        </el-form>
      </div>
    </div>
  </div>

  <!---  Rest password form   -->

</template>

<script>
import { validEmail } from '@/utils/validate';
import { csrf } from '@/api/auth';

const logo = require('@/assets/login/logo.png').default;

export default {
  name: 'RestPass',
  components: {},
  data() {
    const validateEmail = (rule, value, callback) => {
      if (!validEmail(value)) {
        callback(new Error('Please enter the correct email'));
      } else {
        callback();
      }
    };

    return {
      RestForm: {
        token: '',
        email: '',
        password: '',
        password_confirmation: '',

      },
      // Message:'X';
      RestRules: {
        email: [{ required: true, trigger: 'blur', validator: validateEmail }],
      },
      loading: false,
      redirect: undefined,
      pwdType: 'password',
      otherQuery: {},
      logo: logo,
      Message: '',
      PasswordRest: false,

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
  mounted() {
    // get data from url
    const q = this.$route.query;
    // console.log(q.token);
    // eslint-disable-next-line no-undef
    this.RestForm.token = q.token;
  },
  methods: {

    RestPass(){
      this.$refs.RestForm.validate(valid => {
        if (valid) {
          this.loading = true;
          csrf().then(() => {
            // eslint-disable-next-line no-undef
            axios.post('http://127.0.0.1:8000/api/reset-password', this.RestForm)
              .then(res => {
                // console.log(res.data.message);
                // console.log(res.data.status);
                // window.location.reload();
                this.Message = res.data.message;
                this.PasswordRest = true;
                //  this.$router.push('/login');
              })
              .catch(err => console.log(err));
          });
        } else {
          console.log('error submit!!');
          return false;
        }
      });
      // console.log('hello');
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

<style rel="stylesheet/scss" lang="scss">
$bg:#2d3a4b;
$light_gray:#eee;

/* reset element-ui css */
.login-container {
        border-radius: 20px;

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
</style>

<style rel="stylesheet/scss" lang="scss" scoped>

$bg:#2d3a4b;
$mybg:rgb(255, 255, 255);
$GreenColor:#3f776c;
$dark_gray:#889aa4;
$light_gray:rgb(7, 6, 6);
$bgColor: #054b5d;
$brown: #B27C66;
$textColor:#eee;

.login {
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 20px;
  background-color: $mybg;

  transition: background-color .3s ease-in-out;
  overflow: auto;

  .login-container {
    background: $GreenColor;
    width: 1120px;
    height: 642px !important;
    min-height: 590px;
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
      background-image: url('../../assets/login/bg1_mg.png');
      background-position: 50%;
      background-size: cover;
      opacity: 1;
      height: 642px !important;

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
      display: block;
      margin-bottom: 15px;

      .title {
        font-size: 24px;
        color: $textColor;
        display: block;
        margin: 0px auto 10px auto;
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
      position: absolute;
      right: 10px;
      top: 7px;
      font-size: 16px;
      color: $dark_gray;
      cursor: pointer;
      user-select: none;
    }
    .set-language {
      color: $textColor;
      position: absolute;
      top: 40px;
      right: 35px;
    }
  }
}
</style>
