<template>
  <div id="stat container">
    <div class="row flex flex-row mt-1">
      <div class="col-xl-6 col-12 flex flex-wrap -mt-2">
        <el-row :gutter="40" class="panel-group">
          <el-col :xs="22" :sm="12" :lg="12" class="card-panel-col">
            <div class="card-panel">
              <div class="card-panel-icon-wrapper icon-people">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 13v-1m4 1v-3m4 3V8M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                </svg>
              </div>
              <div class="card-panel-description">
                <div class="card-panel-text">
                  Total
                </div>
                <count-to
                  :start-val="0"
                  :end-val="CountElelement.countSujet"
                  :duration="3600"
                  class="card-panel-num"
                />
              </div>
            </div>
          </el-col>
          <el-col :xs="22" :sm="12" :lg="12" class="card-panel-col">
            <div class="card-panel">
              <div class="card-panel-icon-wrapper icon-message">
                <svg-icon icon-class="Farmer" class-name="card-panel-icon" />
              </div>
              <div class="card-panel-description">
                <div class="card-panel-text">
                  Eleveur
                </div>
                <count-to
                  :start-val="0"
                  :end-val="CountElelement.countVeau"
                  :duration="3600"
                  class="card-panel-num"
                />
              </div>
            </div>
          </el-col>
          <el-col :xs="22" :sm="12" :lg="12" class="card-panel-col">
            <div class="card-panel">
              <div class="card-panel-icon-wrapper icon-money">
                <i class="icofont-address-book" />
              </div>
              <div class="card-panel-description">
                <div class="card-panel-text">
                  Proprietaires
                </div>
                <count-to
                  :start-val="0"
                  :end-val="CountElelement.countRigion"
                  :duration="3600"
                  class="card-panel-num"
                />
              </div>
            </div>
          </el-col>
          <el-col :xs="22" :sm="12" :lg="12" class="card-panel-col">
            <div class="card-panel">
              <div class="card-panel-icon-wrapper icon-shopping">
                <svg-icon icon-class="dna" class-name="card-panel-icon" />
              </div>
              <div class="card-panel-description">
                <div class="card-panel-text">
                  Race
                </div>
                <count-to
                  :start-val="0"
                  :end-val="CountElelement.countSujet"
                  :duration="3600"
                  class="card-panel-num"
                />
              </div>
            </div>
          </el-col>
        </el-row>
      </div>
      <div class="col-xl-6 col-12 mb-2 pt-2 lg:mb-0">
        <el-card class="box-card lg:-translate-y-2">
          <!-- Open Weather Map -->
          <vue-weather
            api-key="66bdac134d615152538cda067e5ed6c8"
            language="fr"
            units="uk"
            :latitude="latitude"
            :longitude="longitude"
          />
        </el-card>
      </div>
    </div>
  </div>
</template>

<script>
import CountTo from 'vue-count-to';
import VueWeather from 'vue-weather-widget';
export default {
  components: {
    CountTo,
    VueWeather,
  },
  props: {
     CountElelement: {
      type: Object,
      required: true,
      default: null,
    },
  },
  data(){
    return {
      latitude: '',
      longitude: '',
    };
  },
  created() {
    const success = (position) => {
      this.latitude = position.coords.latitude.toString();
      this.longitude = position.coords.longitude.toString();

      // Do something with the position
    };

    // This will open permission popup
    navigator.geolocation.getCurrentPosition(success);
  },

};
</script>

<style rel="stylesheet/scss" lang="scss" scoped>
.panel-group {
  margin-top: 18px;
  .card-panel-col{
    margin-bottom: 32px;
    box-shadow: 1px 1px 10px rgba(0,0,0,0) !important;
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
    box-shadow:0 4px 24px 0 rgba(34, 41, 47, 0.123) !important;
    border-radius: .5rem !important;
    overflow: hidden !important;
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
