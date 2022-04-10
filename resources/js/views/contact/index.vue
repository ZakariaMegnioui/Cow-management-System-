<template>
  <!---  Login form   -->
  <div class="contact">
    <div class="contact-container">
      <div class="contact-image">
        <!-- <div class="photo-credit">
          <h4>Danang - Vietnam</h4>
          <span>Photo by Kiril Dobrev on Unsplash</span>
        </div>-->
      </div>
      <div class="contact-content">
        <div class="bg-white my_logo mx-auto my-3 py-2 mb-2">
          <h5 class="">App logo</h5>
        </div>
        <div class="contact-info d-flex justify-content-center aling-items-center justify-items-center mt-5 ">
          <img
            class="logo "
            alt="Laravue"
            :src="logo"
          >
          <p class="d-flex flex-column text-white  contact-info-p">
            <span> Dispnible du Lundi au Vendredi</span>
            <span> de 8 h a 20 h</span>
            <span class="mt-2"> +212 5 28 1234 1234</span>
            <span> +212 5 28 1234 1234</span>
            <span class="mb-2"> +212 5 28 1234 1234</span>
            <span> E-mail</span>
            <span>  Support@chi7ajatech.com</span>

          </p>
        </div>

      </div>
    </div>
  </div>

</template>

<script>
import { validEmail } from '@/utils/validate';
import { csrf } from '@/api/auth';

const logo = require('@/assets/contacts/cascimg.png').default;

export default {
  name: 'Login',
  components: {},
  data(){
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

<style rel="stylesheet/scss" lang="scss">
$bg:#2d3a4b;
$light_gray:#eee;

/* reset element-ui css */
.contact-container {
        border-radius: 20px;
   .contact-info{
      margin-top: 200px;
      position: relative;
    }
    .contact-info-p{
      font-size: 14px;
     font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    }
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

.contact {
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 20px;
  background-color: $mybg;
  transition: background-color .3s ease-in-out;
  overflow: auto;
  .contact-container {
    background: $GreenColor;
    width: 1120px;
    height: 642px !important;
    min-height: 590px;
    display: grid;
    grid-template-columns: auto 480px;
    transition: all .3s ease-in-out;
    transform: scale(1);

    .logo {
      position: absolute;
      top: -10px;
      left: 70px;
      width: 70px ;
      height: 70px;
      margin-bottom: 20px;
    }

    .contact-image {
      display: flex;
      flex-direction: row;
      justify-content: flex-end;
      overflow: hidden;
      background-color: #303c4b;
      background-image: url('../../assets/login/bg1_mg.png');
      background-position: 50%;
      background-size: cover;
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
