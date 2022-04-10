<template>
  <el-row :gutter="40" class="panel-group">
    <el-col :xs="12" :sm="12" :lg="6" class="card-panel-col">
      <div class="card-panel" @click="handleSetLineChartData('newVisitis')">
        <div class="card-panel-icon-wrapper icon-people">
          <svg-icon icon-class="sujet" class-name="card-panel-icon" />
        </div>
        <div class="card-panel-description">
          <div class="card-panel-text">
            Sujets
          </div>
          <count-to :start-val="0" :end-val="CountSujets" :duration="2600" class="card-panel-num" />
        </div>
      </div>
    </el-col>
    <el-col :xs="12" :sm="12" :lg="6" class="card-panel-col">
      <div class="card-panel" @click="handleSetLineChartData('messages')">
        <div class="card-panel-icon-wrapper icon-message">
          <svg-icon icon-class="eleveurnaisseurs" class-name="card-panel-icon" />
        </div>
        <div class="card-panel-description">
          <div class="card-panel-text">
            Eleveurnaisseurs
          </div>
          <count-to :start-val="0" :end-val="CountEleveursnaisseurs" :duration="3000" class="card-panel-num" />
        </div>
      </div>
    </el-col>
    <el-col :xs="12" :sm="12" :lg="6" class="card-panel-col">
      <div class="card-panel" @click="handleSetLineChartData('purchases')">
        <div class="card-panel-icon-wrapper icon-money">
          <svg-icon icon-class="eleveurproprietaires" class-name="card-panel-icon" />
        </div>
        <div class="card-panel-description">
          <div class="card-panel-text">
            Eleveurproprietaires
          </div>
          <count-to :start-val="0" :end-val="CountEleveurproprietaires" :duration="3200" class="card-panel-num" />
        </div>
      </div>
    </el-col>
    <el-col :xs="12" :sm="12" :lg="6" class="card-panel-col">
      <div class="card-panel" @click="handleSetLineChartData('shoppings')">
        <div class="card-panel-icon-wrapper icon-shopping">
          <svg-icon icon-class="user" class-name="card-panel-icon" />
        </div>
        <div class="card-panel-description">
          <div class="card-panel-text">
            User
          </div>
          <count-to :start-val="0" :end-val="CountUsers" :duration="3600" class="card-panel-num" />
        </div>
      </div>
    </el-col>
  </el-row>
</template>

<script>
import Axios from 'axios';
import CountTo from 'vue-count-to';

export default {
  components: {
    CountTo,
  },
  data() {
    return {
      CountUsers: '',
      CountSujets: '',
      CountEleveursnaisseurs: '',
      CountEleveurproprietaires: '',
    };
  },
  mounted() {
    this.getSujetesCount();
    this.getEleveursnaisseursCount();
    this.getEleveurproprietairesCount();
    this.getUsersCount();
  },
  methods: {
    handleSetLineChartData(type) {
      this.$emit('handleSetLineChartData', type);
    },

    getSujetesCount(){
      // eslint-disable-next-line no-undef
      Axios.get('http://127.0.0.1:8000/api/SujetsCount')
        .then(res => {
          this.CountSujets = res.data.NbrSujets;
          // console.log(this.CountSujets);
        })
        .catch(err => console.log(err));
    },
    getEleveursnaisseursCount(){
      Axios.get('http://127.0.0.1:8000/api/EnCount')
        .then(res => {
          this.CountEleveursnaisseurs = res.data.NbrEleveursnaisseurs;
          // console.log(this.CountSujets);
        })
        .catch(err => console.log(err));
    },
    getEleveurproprietairesCount(){
      Axios.get('http://127.0.0.1:8000/api/EpCount')
        .then(res => {
          this.CountEleveurproprietaires = res.data.NbrEleveurproprietaire;
          // console.log(this.CountSujets);
        })
        .catch(err => console.log(err));
    },
    getUsersCount(){
      // eslint-disable-next-line no-undef
      Axios.get('http://127.0.0.1:8000/api/UsersCount')
        .then(res => {
          this.CountUsers = res.data.UsersNbr;
        })
        .catch(err => console.log(err));
    },
  },
};
</script>

<style rel="stylesheet/scss" lang="scss" scoped>
.panel-group {
  margin-top: 18px;
  .card-panel-col{
    margin-bottom: 32px;
  }
  .card-panel {
    height: 108px;
    cursor: pointer;
    font-size: 12px;
    position: relative;
    overflow: hidden;
    color: #666;
    background: #fff;
    box-shadow: 4px 4px 40px rgba(0, 0, 0, .05);
    border-color: rgba(0, 0, 0, .05);
    &:hover {
      .card-panel-icon-wrapper {
        color: #fff;
      }
      .icon-people {
         background: #40c9c6;
      }
      .icon-message {
        background: #40c9c6;
      }
      .icon-money {
        background: #40c9c6;
      }
      .icon-shopping {
        background: #34bfa3;
        color: #131414
      }
    }
    .icon-people {
      color: #676b6b;
    }
    .icon-message {
      color: #36a3f7;
    }
    .icon-money {
      color: #f4516c;
    }
    .icon-shopping {
      color: #131414
    }
    .card-panel-icon-wrapper {
      float: left;
      margin: 14px 0 0 14px;
      padding: 16px;
      transition: all 0.38s ease-out;
      border-radius: 6px;
    }
    .card-panel-icon {
      float: left;
      font-size: 48px;
    }
    .card-panel-description {
      float: right;
      font-weight: bold;
      margin: 26px;
      margin-left: 0px;
      .card-panel-text {
        line-height: 18px;
        color: rgba(0, 0, 0, 0.45);
        font-size: 16px;
        margin-bottom: 12px;
      }
      .card-panel-num {
        font-size: 20px;
      }
    }
  }
}
</style>
